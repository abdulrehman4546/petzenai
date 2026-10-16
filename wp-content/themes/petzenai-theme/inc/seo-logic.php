<?php
/**
 * SEO control panel: data + logic (no output).
 *
 * Options used:
 *   pz_seo_overrides   [ tool-slug => [ 'index' => auto|index|noindex, 'keyword', 'title', 'description' ] ]
 *   pz_noindex_generic '1' | '0'  (falls back to the PZ_NOINDEX_GENERIC constant when never saved)
 *   pz_seo_suggestions [ tool-slug => [ 'keyword', 'volume', 'kd' ] ]   (from the Ahrefs import)
 *   pz_seo_unmatched   [ [ 'keyword', 'volume', 'kd' ], ... ]           (keywords with no matching tool)
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ---------- overrides ---------- */

function pz_seo_overrides() {
    $o = get_option( 'pz_seo_overrides', [] );
    return is_array( $o ) ? $o : [];
}

/** One tool's override with defaults filled in. */
function pz_seo_override_for( $slug ) {
    $all = pz_seo_overrides();
    $o   = isset( $all[ $slug ] ) && is_array( $all[ $slug ] ) ? $all[ $slug ] : [];
    return $o + [ 'index' => 'auto', 'keyword' => '', 'title' => '', 'description' => '' ];
}

/** Clean one submitted override row. Returns null when it holds nothing (so it can be dropped). */
function pz_seo_clean_override( $row ) {
    $row   = is_array( $row ) ? $row : [];
    $index = isset( $row['index'] ) && in_array( $row['index'], [ 'index', 'noindex' ], true ) ? $row['index'] : 'auto';
    $clean = [
        'index'       => $index,
        'keyword'     => function_exists( 'mb_substr' ) ? mb_substr( trim( wp_strip_all_tags( (string) ( $row['keyword'] ?? '' ) ) ), 0, 120 ) : substr( trim( wp_strip_all_tags( (string) ( $row['keyword'] ?? '' ) ) ), 0, 120 ),
        'title'       => mb_substr( trim( wp_strip_all_tags( (string) ( $row['title'] ?? '' ) ) ), 0, 120 ),
        'description' => mb_substr( trim( wp_strip_all_tags( (string) ( $row['description'] ?? '' ) ) ), 0, 320 ),
    ];
    if ( $clean['index'] === 'auto' && $clean['keyword'] === '' && $clean['title'] === '' && $clean['description'] === '' ) return null;
    return $clean;
}

/* ---------- global switch ---------- */

function pz_noindex_generic_enabled() {
    $v = get_option( 'pz_noindex_generic', null );
    if ( $v === null || $v === false ) return defined( 'PZ_NOINDEX_GENERIC' ) ? (bool) PZ_NOINDEX_GENERIC : false;
    return $v === '1' || $v === 1 || $v === true;
}

/* ---------- registry helpers ---------- */

/** [ slug => tool array ] for every registry tool. */
function pz_seo_tools_by_slug() {
    static $map = null;
    if ( $map === null ) {
        require_once get_template_directory() . '/inc/tool-registry.php';
        $map = [];
        foreach ( pz_get_all_tools() as $t ) { $map[ $t['slug'] ] = $t; }
    }
    return $map;
}

/**
 * Should this page send noindex? Per-tool override wins; otherwise the global "templated tools" switch applies.
 * Only registry tool pages are ever affected.
 */
function pz_tool_is_noindexed( $post ) {
    if ( ! $post || empty( $post->post_name ) || ( isset( $post->post_type ) && $post->post_type !== 'page' ) ) return false;
    $tools = pz_seo_tools_by_slug();
    if ( ! isset( $tools[ $post->post_name ] ) ) return false;
    $mode = pz_seo_override_for( $post->post_name )['index'];
    if ( $mode === 'noindex' ) return true;
    if ( $mode === 'index' )   return false;
    return pz_noindex_generic_enabled() && empty( $tools[ $post->post_name ]['calc'] );
}

/* ---------- Ahrefs CSV import ---------- */

/** Decode an Ahrefs export (UTF-16 or UTF-8, tab/comma/semicolon separated) into [ [ 'keyword', 'volume', 'kd' ], ... ]. */
function pz_seo_parse_ahrefs_csv( $raw ) {
    if ( substr( $raw, 0, 2 ) === "\xFF\xFE" )      $raw = mb_convert_encoding( substr( $raw, 2 ), 'UTF-8', 'UTF-16LE' );
    elseif ( substr( $raw, 0, 2 ) === "\xFE\xFF" )  $raw = mb_convert_encoding( substr( $raw, 2 ), 'UTF-8', 'UTF-16BE' );
    elseif ( substr( $raw, 0, 3 ) === "\xEF\xBB\xBF" ) $raw = substr( $raw, 3 );

    $lines = preg_split( '/\r\n|\n|\r/', trim( $raw ) );
    if ( count( $lines ) < 2 ) return [];
    $first = $lines[0];
    $delim = "\t";
    foreach ( [ "\t", ';', ',' ] as $d ) { if ( substr_count( $first, $d ) > substr_count( $first, $delim ) ) $delim = $d; }
    $head = array_map( function ( $h ) { return strtolower( trim( $h, " \"\t" ) ); }, str_getcsv( $first, $delim ) );

    $col = [ 'keyword' => null, 'volume' => null, 'kd' => null ];
    foreach ( $head as $i => $h ) {
        if ( $col['keyword'] === null && ( $h === 'keyword' || $h === 'keywords' ) ) $col['keyword'] = $i;
        elseif ( $col['volume'] === null && $h === 'volume' )                         $col['volume'] = $i;
        elseif ( $col['kd'] === null && ( $h === 'kd' || strpos( $h, 'difficulty' ) !== false ) ) $col['kd'] = $i;
    }
    if ( $col['keyword'] === null ) return [];

    $rows = [];
    foreach ( array_slice( $lines, 1 ) as $line ) {
        if ( trim( $line ) === '' ) continue;
        $c = str_getcsv( $line, $delim );
        $kw = trim( (string) ( $c[ $col['keyword'] ] ?? '' ) );
        if ( $kw === '' ) continue;
        $rows[] = [
            'keyword' => $kw,
            'volume'  => $col['volume'] !== null ? (int) preg_replace( '/[^\d]/', '', (string) ( $c[ $col['volume'] ] ?? '0' ) ) : 0,
            'kd'      => $col['kd'] !== null ? (int) preg_replace( '/[^\d]/', '', (string) ( $c[ $col['kd'] ] ?? '0' ) ) : 0,
        ];
    }
    return $rows;
}

/** Words used to compare a keyword with a tool (stemmed, stop-words removed, animal words kept). */
function pz_seo_match_tokens( $text ) {
    static $stop = [ 'the','a','an','and','or','for','of','to','in','your','my','how','what','is','do','does','can','should','i','vs','with','by','much','many','often','best','free','online','near','me','when','why','are','at','on','it','need','require','get','give','make','take','eat','use','have','go','keep','long','old','big','tell','know' ];
    $words = preg_split( '/[^a-z0-9]+/', strtolower( (string) $text ), -1, PREG_SPLIT_NO_EMPTY );
    $out = [];
    foreach ( $words as $w ) {
        if ( in_array( $w, $stop, true ) ) continue;
        if ( strlen( $w ) > 3 && substr( $w, -1 ) === 's' && substr( $w, -2 ) !== 'ss' ) $w = substr( $w, 0, -1 );
        $out[ $w ] = true;
    }
    return array_keys( $out );
}

/**
 * Match keywords to tools and pick one suggestion per tool.
 *
 * @return array [ 'suggestions' => [ slug => [keyword, volume, kd] ], 'unmatched' => [ [keyword, volume, kd], ... ] ]
 */
function pz_seo_match_keywords( array $rows, $min_volume = 100, $max_kd = 30 ) {
    $tools   = pz_seo_tools_by_slug();
    $animals = [ 'dog','cat','rabbit','bird','fish','reptile','hamster','guinea','ferret','kitten','puppy','parrot','budgie','gecko','python','dragon','turtle','aquarium' ];
    $ttok = [];
    foreach ( $tools as $slug => $t ) {
        $ttok[ $slug ] = pz_seo_match_tokens( $t['title'] . ' ' . ( $t['kw'] ?? '' ) . ' ' . str_replace( '-', ' ', $slug ) . ' ' . $t['animal'] );
    }
    // Words that say what kind of page it is, not what it is about. A match must also share the real topic.
    $generic = array_merge( $animals, [ 'calculator','guide','checker','tracker','schedule','chart','care','tool','list','tip','help','vs','pet','owner','new' ] );
    $best = []; $unmatched = [];
    foreach ( $rows as $r ) {
        if ( $r['volume'] < $min_volume || $r['kd'] > $max_kd ) continue;
        $k = pz_seo_match_tokens( $r['keyword'] );
        if ( ! $k ) continue;
        $topic = array_values( array_diff( $k, $generic ) );
        if ( ! $topic ) { $unmatched[] = $r; continue; }                 // too generic to pin to one tool
        $animal_words = array_values( array_intersect( $k, $animals ) );
        $type_words   = array_values( array_intersect( $k, [ 'calculator', 'checker', 'tracker' ] ) ); // a calculator keyword needs a calculator page
        $pick = null; $pick_spec = 0;
        foreach ( $ttok as $slug => $tk ) {
            if ( count( array_intersect( $topic, $tk ) ) < count( $topic ) ) continue;          // every topic word must be in the tool
            if ( $type_words && count( array_intersect( $type_words, $tk ) ) < count( $type_words ) ) continue;
            if ( $animal_words && $tools[ $slug ]['animal'] !== 'all' && ! array_intersect( $animal_words, $tk ) ) continue;
            $spec = count( array_intersect( $k, $tk ) ) / max( 1, count( $tk ) );                 // prefer the most specific tool
            if ( $spec > $pick_spec ) { $pick = $slug; $pick_spec = $spec; }
        }
        if ( $pick === null ) { $unmatched[] = $r; continue; }
        if ( ! isset( $best[ $pick ] ) || $r['volume'] > $best[ $pick ]['volume'] ) $best[ $pick ] = $r;
    }
    usort( $unmatched, function ( $a, $b ) { return $b['volume'] <=> $a['volume']; } );
    return [ 'suggestions' => $best, 'unmatched' => array_slice( $unmatched, 0, 60 ) ];
}

/* ---------- IndexNow URL list ---------- */

/** Every URL worth telling search engines about: indexable tool pages, hubs, key pages and published posts. */
function pz_seo_indexnow_urls() {
    $urls = [ home_url( '/' ), home_url( '/tools/' ), home_url( '/blog/' ), home_url( '/about/' ), home_url( '/contact/' ), home_url( '/privacy-policy/' ), home_url( '/terms-of-service/' ) ];
    $tools = pz_seo_tools_by_slug();
    $cats  = [];
    foreach ( $tools as $slug => $t ) {
        $cats[ $t['cat'] ] = true;
        $stub = (object) [ 'post_name' => $slug, 'post_type' => 'page' ];
        if ( pz_tool_is_noindexed( $stub ) ) continue;
        $urls[] = home_url( '/tools/' . $slug . '/' );
    }
    foreach ( array_keys( $cats ) as $c ) { $urls[] = home_url( '/tools/' . $c . '/' ); }
    foreach ( get_posts( [ 'post_type' => 'post', 'post_status' => 'publish', 'numberposts' => 500, 'fields' => 'ids' ] ) as $id ) { $urls[] = get_permalink( $id ); }
    return array_values( array_unique( $urls ) );
}
