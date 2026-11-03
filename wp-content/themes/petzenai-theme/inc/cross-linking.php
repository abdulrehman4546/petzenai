<?php
/**
 * Smart two-way internal linking between the ~300 tool pages and the blog.
 * A single scoring function, wired into the shared single-post template and the shared tool template, so
 * every page on both sides benefits without hand-editing individual posts or tool entries.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/** Tokenise free text into meaningful lowercase stems (same stopword list style as pz_tool_tokens). */
function pz_xlink_tokens( $text ) {
    static $stop = [ 'the','a','an','and','or','for','of','to','in','your','my','how','what','is','guide','calculator','checker',
                     'tracker','complete','best','by','with','vs','pet','pets','often','should','i','do','does','can','when',
                     'why','are','you','this','that','it','on','at','from','about' ];
    $words = preg_split( '/[^a-z0-9]+/', strtolower( $text ), -1, PREG_SPLIT_NO_EMPTY );
    $out   = [];
    foreach ( $words as $w ) {
        if ( strlen( $w ) < 3 || in_array( $w, $stop, true ) ) continue;
        $out[ rtrim( $w, 's' ) ] = true;
    }
    return array_keys( $out );
}

/** All published, already-live blog posts seeded from inc/blog-content/, with the fields needed for matching. @return array */
function pz_xlink_blog_index() {
    static $cache = null;
    if ( $cache !== null ) return $cache;
    $out = [];
    foreach ( (array) glob( get_template_directory() . '/inc/blog-content/*.php' ) as $file ) {
        $post = include $file;
        if ( ! is_array( $post ) || ( $post['status'] ?? '' ) !== 'publish' ) continue;
        $found = get_page_by_path( $post['slug'], OBJECT, 'post' );
        if ( ! $found || $found->post_status !== 'publish' ) continue; // only link to posts actually live right now
        $text   = ( $post['title'] ?? '' ) . ' ' . ( $post['keyword'] ?? '' ) . ' ' . ( $post['category'] ?? '' );
        $animal = 'all';
        if ( preg_match( '/\bcat\b/i', $text ) && ! preg_match( '/\bdog\b/i', $text ) ) $animal = 'cat';
        elseif ( preg_match( '/\bdog\b/i', $text ) && ! preg_match( '/\bcat\b/i', $text ) ) $animal = 'dog';
        $out[] = [
            'post_id' => $found->ID,
            'title'   => get_the_title( $found->ID ),
            'url'     => get_permalink( $found->ID ),
            'tokens'  => pz_xlink_tokens( $text ),
            'animal'  => $animal,
            'thumb'   => get_the_post_thumbnail_url( $found->ID, 'thumbnail' ),
        ];
    }
    return $cache = $out;
}

/**
 * Best-matching blog posts for a tool-registry entry (for the tool page's "Related Reading" box).
 * @param array $tool  one row from pz_get_all_tools()
 */
function pz_get_blog_posts_for_tool( $tool, $limit = 3 ) {
    $self_tokens = pz_xlink_tokens( ( $tool['title'] ?? '' ) . ' ' . ( $tool['kw'] ?? '' ) );
    $scored = [];
    foreach ( pz_xlink_blog_index() as $p ) {
        $score = 8 * count( array_intersect( $self_tokens, $p['tokens'] ) );
        if ( ( $tool['animal'] ?? '' ) !== 'all' && $p['animal'] !== 'all' && $p['animal'] === $tool['animal'] ) $score += 10;
        if ( $score <= 0 ) continue; // only genuinely relevant matches, never a random fallback
        $score += ( crc32( ( $tool['slug'] ?? '' ) . '>' . $p['url'] ) % 100 ) / 20;
        $scored[] = [ $score, $p ];
    }
    usort( $scored, function ( $a, $b ) { return $b[0] <=> $a[0]; } );
    return array_map( function ( $row ) { return $row[1]; }, array_slice( $scored, 0, $limit ) );
}

/**
 * Best-matching tools for the current blog post (for the single-post sidebar's "Free Pet Tools" box).
 * @param int $post_id
 */
function pz_get_tools_for_post( $post_id, $limit = 5 ) {
    require_once get_template_directory() . '/inc/tool-registry.php';
    $cats       = get_the_category( $post_id );
    $cat_name   = $cats ? $cats[0]->name : '';
    $text       = get_the_title( $post_id ) . ' ' . $cat_name . ' ' . get_post_meta( $post_id, 'rank_math_focus_keyword', true );
    $self_tokens = pz_xlink_tokens( $text );
    $animal = 'all';
    if ( preg_match( '/\bcat\b/i', $text ) && ! preg_match( '/\bdog\b/i', $text ) ) $animal = 'cat';
    elseif ( preg_match( '/\bdog\b/i', $text ) && ! preg_match( '/\bcat\b/i', $text ) ) $animal = 'dog';

    $scored = [];
    foreach ( pz_get_all_tools() as $t ) {
        $t_tokens = pz_xlink_tokens( ( $t['title'] ?? '' ) . ' ' . ( $t['kw'] ?? '' ) );
        $score = 8 * count( array_intersect( $self_tokens, $t_tokens ) );
        if ( $animal !== 'all' && ( $t['animal'] ?? '' ) === $animal ) $score += 10;
        $score += ( crc32( $post_id . '>' . $t['slug'] ) % 100 ) / 20; // stable tie-break so it varies post to post
        $scored[] = [ $score, $t ];
    }
    usort( $scored, function ( $a, $b ) { return $b[0] <=> $a[0]; } );
    return array_map( function ( $row ) { return $row[1]; }, array_slice( $scored, 0, $limit ) );
}
