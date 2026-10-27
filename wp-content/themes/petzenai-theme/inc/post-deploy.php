<?php
/**
 * Release tasks: things that must happen on the server once after a deploy, so the owner does not have to click them.
 *
 * Runs once per PZ_RELEASE value (bump the string to run again), on the first request after the deploy:
 *   1. publish any blog posts in inc/blog-content/ that are not on the site yet
 *   2. flush Rank Math's cached sitemaps (so noindex/index changes and new pages show up in the sitemap)
 *   3. delete a few stale backup files left on the server by earlier deploys (exact paths only)
 *   4. try to clear the page cache (known cache plugins, plus any "stackcache ... purge" function with no arguments)
 *   5. tell IndexNow (Bing, Yandex) about the newly published posts and tools (non-blocking)
 * Each step is wrapped so a failure can never break the page being served. The outcome is stored in the option
 * pz_release_log and shown in wp-admin > PetZenAI SEO.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'PZ_RELEASE' ) ) define( 'PZ_RELEASE', '2026-10-27-a' );

/** Delete Rank Math's cached sitemap files and transients. @return int number of cache entries removed */
function pz_flush_rankmath_sitemap_cache() {
    global $wpdb;
    $n = 0;
    if ( isset( $wpdb ) ) {
        $n += (int) $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '\\_transient\\_sitemap\\_%rank\\_math%' OR option_name LIKE '\\_transient\\_timeout\\_sitemap\\_%rank\\_math%'" );
    }
    $up = wp_upload_dir( null, false );
    if ( ! empty( $up['basedir'] ) ) {
        foreach ( (array) glob( rtrim( $up['basedir'], '/' ) . '/rank-math/*.xml' ) as $f ) {
            if ( is_file( $f ) && @unlink( $f ) ) $n++;
        }
    }
    update_option( 'rank_math_sitemap_cache_files', [] );
    return $n;
}

/** Remove known stale files. Only these exact paths inside wp-content/themes are ever touched. */
function pz_delete_stale_files() {
    $themes = rtrim( WP_CONTENT_DIR, '/' ) . '/themes';
    $paths  = [
        $themes . '/petzenai-theme.zip',
        $themes . '/petzenai-theme/inc/tool-renderer.php.bak',
        $themes . '/petzenai-theme/templates/pages/auto-tool.php.bak',
    ];
    $deleted = [];
    foreach ( $paths as $f ) {
        if ( is_file( $f ) && @unlink( $f ) ) $deleted[] = basename( $f );
    }
    return $deleted;
}

/** Try the common ways of clearing a page cache. @return string[] what was called */
function pz_purge_page_cache() {
    $called = [];
    foreach ( [ 'rocket_clean_domain', 'w3tc_flush_all', 'wp_cache_clear_cache', 'sg_cachepress_purge_cache' ] as $fn ) {
        if ( function_exists( $fn ) ) { $fn(); $called[] = $fn; }
    }
    if ( class_exists( 'autoptimizeCache' ) && method_exists( 'autoptimizeCache', 'clearall' ) ) { autoptimizeCache::clearall(); $called[] = 'autoptimizeCache::clearall'; }
    // Host cache plugins (for example the "Purge Cache" button in the admin bar): any function whose name mentions
    // stack + cache + purge/flush/clear and that needs no arguments.
    $user = get_defined_functions()['user'] ?? [];
    foreach ( $user as $fn ) {
        if ( count( $called ) >= 6 ) break;
        if ( strpos( $fn, 'pz_' ) === 0 || strpos( $fn, 'petzenai' ) === 0 ) continue;
        if ( ! preg_match( '/stack.?cache/', $fn ) || ! preg_match( '/(purge|flush|clear)/', $fn ) ) continue;
        $ref = new ReflectionFunction( $fn );
        if ( $ref->getNumberOfRequiredParameters() === 0 ) { $fn(); $called[] = $fn; }
    }
    do_action( 'pz_purge_page_cache' );
    return $called;
}

function pz_run_release_tasks() {
    if ( get_option( 'pz_release_done' ) === PZ_RELEASE ) return;
    if ( get_transient( 'pz_release_lock' ) ) return;
    set_transient( 'pz_release_lock', 1, 5 * MINUTE_IN_SECONDS );

    $log = [ 'release ' . PZ_RELEASE . ' at ' . gmdate( 'Y-m-d H:i' ) . ' UTC' ];
    $new_urls = [];

    try {
        $ids = function_exists( 'pz_seed_blog_posts' ) ? pz_seed_blog_posts() : [];
        foreach ( $ids as $id ) { if ( get_post_status( $id ) === 'publish' ) $new_urls[] = get_permalink( $id ); }
        $log[] = 'blog posts created: ' . count( $ids ) . ( $ids ? ' (' . implode( ', ', array_map( 'get_post_status', $ids ) ) . ')' : '' );
    } catch ( \Throwable $e ) { $log[] = 'blog posts failed: ' . $e->getMessage(); }

    try {
        $cs = function_exists( 'pz_sync_post_content' ) ? pz_sync_post_content() : [];
        $log[] = 'post content updates: ' . ( $cs ? implode( '; ', $cs ) : 'none' );
    } catch ( \Throwable $e ) { $log[] = 'post content sync failed: ' . $e->getMessage(); }

    try {
        $st = function_exists( 'pz_sync_post_statuses' ) ? pz_sync_post_statuses() : [];
        $log[] = 'post status changes: ' . ( $st ? implode( '; ', $st ) : 'none' );
    } catch ( \Throwable $e ) { $log[] = 'post status sync failed: ' . $e->getMessage(); }

    try {
        $bf = function_exists( 'pz_seed_backfill_featured_images' ) ? pz_seed_backfill_featured_images() : [];
        $log[] = 'featured images added to existing posts: ' . count( $bf );
    } catch ( \Throwable $e ) { $log[] = 'featured image backfill failed: ' . $e->getMessage(); }

    try { $log[] = 'sitemap cache entries removed: ' . pz_flush_rankmath_sitemap_cache(); }
    catch ( \Throwable $e ) { $log[] = 'sitemap flush failed: ' . $e->getMessage(); }

    try { $d = pz_delete_stale_files(); $log[] = 'stale files deleted: ' . ( $d ? implode( ', ', $d ) : 'none found' ); }
    catch ( \Throwable $e ) { $log[] = 'stale file cleanup failed: ' . $e->getMessage(); }

    try { $c = pz_purge_page_cache(); $log[] = 'page cache purge calls: ' . ( $c ? implode( ', ', $c ) : 'none matched (press Purge Cache in the admin bar)' ); }
    catch ( \Throwable $e ) { $log[] = 'page cache purge failed: ' . $e->getMessage(); }

    try {
        if ( defined( 'PZ_INDEXNOW_KEY' ) ) {
            $urls = array_merge( $new_urls, [ home_url( '/' ), home_url( '/blog/' ) ] );
            wp_remote_post( 'https://api.indexnow.org/indexnow', [
                'timeout' => 3, 'blocking' => false,
                'headers' => [ 'Content-Type' => 'application/json; charset=utf-8' ],
                'body'    => wp_json_encode( [ 'host' => wp_parse_url( home_url(), PHP_URL_HOST ), 'key' => PZ_INDEXNOW_KEY, 'keyLocation' => home_url( '/' . PZ_INDEXNOW_KEY . '.txt' ), 'urlList' => array_values( array_unique( $urls ) ) ] ),
            ] );
            $log[] = 'IndexNow notified for ' . count( array_unique( $urls ) ) . ' URLs';
        }
    } catch ( \Throwable $e ) { $log[] = 'IndexNow failed: ' . $e->getMessage(); }

    update_option( 'pz_release_log', $log, false );
    update_option( 'pz_release_done', PZ_RELEASE, true );
    delete_transient( 'pz_release_lock' );
}
add_action( 'init', 'pz_run_release_tasks', 30 );
