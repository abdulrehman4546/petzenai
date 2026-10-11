<?php
/**
 * Indexing helpers: category-hub sitemap, duplicate-page redirects/exclusion, IndexNow key file.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/** IndexNow key (public by design — it is served at /<key>.txt to prove site ownership). */
if ( ! defined( 'PZ_INDEXNOW_KEY' ) ) define( 'PZ_INDEXNOW_KEY', 'a65fc239e578d8cc9d569a9044d8b8e2' );

/** Slugs of top-level pages that are legitimately NOT tool duplicates. */
function pz_core_page_slugs() {
    return [ 'about', 'blog', 'contact', 'privacy-policy', 'terms-of-service', 'tools' ];
}

/**
 * If a top-level page duplicates a tool (e.g. /dog-zoomies-guide-2/ vs /tools/dog-zoomies-guide/),
 * return the canonical /tools/<slug>/ URL; '/' for the default sample page; '' when not a duplicate.
 */
function pz_duplicate_target( $post ) {
    if ( ! $post || $post->post_type !== 'page' || (int) $post->post_parent !== 0 ) return '';
    $slug = $post->post_name;
    // The default sample page is a duplicate of the homepage unless it IS the static front page (handled below).
    if ( $slug === 'sample-page' ) return ( (int) $post->ID === (int) get_option( 'page_on_front' ) ) ? '' : home_url( '/' );
    if ( in_array( $slug, pz_core_page_slugs(), true ) ) return '';
    require_once get_template_directory() . '/inc/tool-registry.php';
    static $known = null;
    if ( $known === null ) $known = array_flip( array_column( pz_get_all_tools(), 'slug' ) );
    $base = preg_replace( '/-\d+$/', '', $slug );
    if ( isset( $known[ $slug ] ) ) return home_url( '/tools/' . $slug . '/' );
    if ( isset( $known[ $base ] ) ) return home_url( '/tools/' . $base . '/' );
    return '';
}

/** 301 duplicates to their canonical URL. */
add_action( 'template_redirect', function () {
    // Front page reachable at a second URL (e.g. /sample-page/) -> 301 to the root.
    if ( is_front_page() && ! is_paged() ) {
        $path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
        $base = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );
        if ( $base !== '' && strpos( $path, $base ) === 0 ) $path = trim( substr( $path, strlen( $base ) ), '/' );
        if ( $path !== '' && $path !== 'index.php' && empty( $_GET ) ) { wp_redirect( home_url( '/' ), 301 ); exit; }
        return;
    }
    if ( ! is_page() ) return;
    $target = pz_duplicate_target( get_queried_object() );
    if ( $target ) { wp_redirect( $target, 301 ); exit; }
}, 1 );

/** Keep duplicates out of the Rank Math sitemap. */
add_filter( 'rank_math/sitemap/entry', function ( $url, $type, $object ) {
    if ( $type === 'post' && is_object( $object ) && pz_duplicate_target( $object ) ) return false;
    return $url;
}, 10, 3 );

/** Advertise a sitemap of tool-category hub pages (they are virtual routes, so Rank Math can't see them). */
add_filter( 'rank_math/sitemap/index', function ( $xml ) {
    return $xml . '<sitemap><loc>' . esc_url( home_url( '/pz-sitemap-hubs.xml' ) ) . '</loc><lastmod>' . gmdate( 'c' ) . '</lastmod></sitemap>';
} );

/** Serve the hubs sitemap and the IndexNow key file before WordPress routes the request. */
add_action( 'init', function () {
    $path = trim( (string) wp_parse_url( $_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH ), '/' );
    $base = trim( (string) wp_parse_url( home_url( '/' ), PHP_URL_PATH ), '/' );
    if ( $base !== '' && strpos( $path, $base . '/' ) === 0 ) $path = substr( $path, strlen( $base ) + 1 );

    if ( $path === PZ_INDEXNOW_KEY . '.txt' ) {
        header( 'Content-Type: text/plain; charset=utf-8' );
        echo PZ_INDEXNOW_KEY;
        exit;
    }

    if ( $path === 'pz-sitemap-hubs.xml' ) {
        require_once get_template_directory() . '/inc/tool-registry.php';
        $counts = [];
        foreach ( pz_get_all_tools() as $t ) { $counts[ $t['cat'] ] = true; }
        $lastmod = gmdate( 'c' );
        header( 'Content-Type: application/xml; charset=utf-8' );
        header( 'X-Robots-Tag: noindex, follow' );
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ( array_keys( $counts ) as $slug ) {
            echo '<url><loc>' . esc_url( home_url( '/tools/' . $slug . '/' ) ) . '</loc><lastmod>' . $lastmod . '</lastmod></url>' . "\n";
        }
        echo '</urlset>';
        exit;
    }
}, 1 );
