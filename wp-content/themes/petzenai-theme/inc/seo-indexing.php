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
    if ( $type === 'post' && is_object( $object ) && ( pz_duplicate_target( $object ) || pz_is_noindexed_generic_tool( $object ) ) ) return false;
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


/* ============================================================
   Category hub SEO — each /tools/<category>/ gets its own title, description, canonical and schema
   (they are virtual routes on the "tools" page, so Rank Math would otherwise reuse the /tools/ values).
   ============================================================ */

/** Current category hub info, or null when not on a hub. */
function pz_current_hub() {
    static $cache = [];
    $slug = sanitize_key( (string) get_query_var( 'pz_cat' ) );
    if ( $slug === '' ) return null;
    if ( isset( $cache[ $slug ] ) ) return $cache[ $slug ];
    require_once get_template_directory() . '/inc/tool-registry.php';
    $cats = pz_get_tool_categories();
    if ( ! isset( $cats[ $slug ] ) ) return $cache[ $slug ] = null;
    $tools = array_values( array_filter( pz_get_all_tools(), function ( $t ) use ( $slug ) { return $t['cat'] === $slug; } ) );
    if ( ! $tools ) return $cache[ $slug ] = null;
    $types = [];
    foreach ( $tools as $t ) { $types[ $t['type'] ] = ( $types[ $t['type'] ] ?? 0 ) + 1; }
    return $cache[ $slug ] = [ 'slug' => $slug, 'label' => $cats[ $slug ]['label'], 'tools' => $tools, 'count' => count( $tools ), 'types' => $types, 'url' => home_url( '/tools/' . $slug . '/' ) ];
}

/** Shorten to $max chars at a word boundary. */
function pz_trim_chars( $text, $max ) {
    $text = trim( preg_replace( '/\s+/', ' ', $text ) );
    if ( mb_strlen( $text ) <= $max ) return $text;
    $cut = mb_substr( $text, 0, $max - 1 );
    return rtrim( mb_substr( $cut, 0, mb_strrpos( $cut, ' ' ) ?: $max - 1 ), " ,;:-—" ) . '…';
}

add_filter( 'rank_math/frontend/title', function ( $title ) {
    if ( ( $ov = pz_current_tool_override() ) && $ov['title'] !== '' ) return $ov['title'];
    if ( $hub = pz_current_hub() ) {
        foreach ( [ ' Free Calculators & Guides', ' Free Guides & Tools', ' Free Tools' ] as $tail ) {
            $t = $hub['label'] . ' Tools: ' . $hub['count'] . $tail . ' | PetZenAI';
            if ( mb_strlen( $t ) <= 60 ) return $t;
        }
        return $hub['label'] . ' Tools | PetZenAI';
    }
    if ( is_front_page() ) return 'PetZenAI — Free Pet Care Tools & Calculators';
    // Tool pages: "<Title> | <Category> | PetZenAI" is often > 60 chars; drop the category segment first.
    if ( is_page() && mb_strlen( $title ) > 60 ) {
        $parts = array_map( 'trim', explode( '|', $title ) );
        if ( count( $parts ) === 3 ) {
            $short = $parts[0] . ' | ' . $parts[2];
            if ( mb_strlen( $short ) <= 60 ) return $short;
            return pz_trim_chars( $parts[0], 60 );
        }
        // "<Title> | PetZenAI" still too long -> keep the (more valuable) title alone.
        if ( count( $parts ) === 2 && mb_strlen( $parts[0] ) >= 30 ) return $parts[0];
    }
    return $title;
}, 20 );

add_filter( 'rank_math/frontend/description', function ( $desc ) {
    $desc = pz_scrub_claims( (string) $desc ); // stored descriptions can still carry old claims
    if ( ( $ov = pz_current_tool_override() ) && $ov['description'] !== '' ) return $ov['description'];
    if ( $hub = pz_current_hub() ) {
        $sing = [ 'calculator', 'guide', 'checker', 'tracker' ];
        $bits = [];
        foreach ( $hub['types'] as $ty => $n ) { $bits[] = $n . ' ' . $ty . ( $n === 1 ? '' : 's' ); }
        $text = 'Browse ' . $hub['count'] . ' free ' . strtolower( $hub['label'] ) . ' tools: ' . implode( ', ', $bits ) . '. Instant results in your browser, no sign-up needed.';
        return pz_trim_chars( $text, 158 );
    }
    // Tool pages: replace the stored boilerplate ("Comprehensive Dog guide: … vet-reviewed advice …") with a
    // specific, claim-free description; keep hand-written ones but cap them at SERP length.
    if ( is_page() && ( $post = get_queried_object() ) && ! empty( $post->post_name ) ) {
        if ( ! function_exists( 'pz_get_tool_data' ) ) require_once get_template_directory() . '/inc/tool-renderer.php';
        $tool = function_exists( 'pz_get_tool_data' ) ? pz_get_tool_data( $post->post_name ) : null;
        if ( $tool ) {
            $boiler = ( stripos( $desc, 'vet-reviewed' ) !== false || stripos( $desc, 'vet-backed' ) !== false || stripos( $desc, 'vet-informed' ) !== false || stripos( $desc, 'Comprehensive ' ) === 0 || $desc === '' );
            return pz_trim_chars( $boiler ? pz_tool_description( $tool ) : $desc, 158 );
        }
    }
    if ( is_front_page() && mb_strlen( $desc ) < 110 ) {
        return 'Free pet care calculators, trackers and guides for dogs, cats, birds, rabbits, fish and more — 300 tools in one place, instant results, no sign-up.';
    }
    return $desc;
}, 20 );

add_filter( 'rank_math/frontend/canonical', function ( $canonical ) {
    $hub = pz_current_hub();
    return $hub ? $hub['url'] : $canonical;
}, 20 );

/** CollectionPage + ItemList + BreadcrumbList for hubs. */
add_action( 'wp_head', function () {
    $hub = pz_current_hub();
    if ( ! $hub ) return;
    $items = [];
    foreach ( $hub['tools'] as $i => $t ) {
        $items[] = [ '@type' => 'ListItem', 'position' => $i + 1, 'url' => home_url( '/tools/' . $t['slug'] . '/' ), 'name' => $t['title'] ];
    }
    $graph = [
        '@context' => 'https://schema.org',
        '@graph'   => [
            [
                '@type' => 'CollectionPage', '@id' => $hub['url'] . '#collection', 'url' => $hub['url'],
                'name' => $hub['label'] . ' Tools', 'isPartOf' => [ '@id' => home_url( '/#website' ) ],
                'mainEntity' => [ '@type' => 'ItemList', 'numberOfItems' => $hub['count'], 'itemListElement' => $items ],
            ],
            [
                '@type' => 'BreadcrumbList', '@id' => $hub['url'] . '#breadcrumb',
                'itemListElement' => [
                    [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url( '/' ) ],
                    [ '@type' => 'ListItem', 'position' => 2, 'name' => 'Tools', 'item' => home_url( '/tools/' ) ],
                    [ '@type' => 'ListItem', 'position' => 3, 'name' => $hub['label'], 'item' => $hub['url'] ],
                ],
            ],
        ],
    ];
    echo '<script type="application/ld+json">' . wp_json_encode( $graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}, 30 );


/** Specific, claim-free meta description for a tool (by type). */
function pz_tool_description( $tool ) {
    // Hand-written, keyword-targeted descriptions for pages that have been individually polished.
    static $custom = [
        'dog-bathing-frequency-calculator' => 'How often should you bathe your dog? Get a personalized schedule by coat type, breed, activity and season — plus shampoo dosage and a free calendar reminder.',
    ];
    if ( isset( $custom[ $tool['slug'] ] ) ) return $custom[ $tool['slug'] ];
    $title  = trim( preg_replace( '/\s*[:|—-]\s*(Complete|Step[- ]by[- ]Step)?.*$/u', '', $tool['title'] ) ) ?: $tool['title'];
    $animal = ( $tool['animal'] ?? 'all' ) === 'all' ? 'pet' : str_replace( '-', ' ', $tool['animal'] );
    switch ( $tool['type'] ?? 'guide' ) {
        case 'calculator':
            return $tool['title'] . ' — enter your ' . $animal . '’s details for an instant, personalised result. Free, no sign-up needed.';
        case 'checker':
            return $tool['title'] . ' — answer a few questions to see what the signs may mean and when to call the vet. Free and instant.';
        case 'tracker':
            return $tool['title'] . ' — keep a simple record, spot changes early and bring clear notes to your vet. Free, no sign-up.';
        default:
            return $tool['title'] . ' — practical steps, common mistakes and warning signs for ' . $animal . ' owners. Free to read.';
    }
}


/**
 * Customizer values saved in the live database can still contain old, unverifiable claims
 * ("vet-formulated", "Vet-Approved", "peer-reviewed", "50K+"). Scrub them on read so the theme
 * defaults and the database agree.
 */
function pz_scrub_claims( $value ) {
    if ( ! is_string( $value ) || $value === '' ) return $value;
    static $map = [
        '/Science-based diet planning and vet-formulated tools/i'                         => 'Free diet planning and pet care tools',
        '/\bFree,? vet-reviewed /'                                                         => 'Free ',
        '/\bfree,? vet-reviewed /'                                                         => 'free ',
        '/Vet[- ]Approved Tools/i'                                                          => 'Free Pet Care Tools',
        '/Free,? vet-formulated /'                                                          => 'Free ',
        '/(free,? )?vet-formulated (calculators|tools|pet care tools)/i'                  => 'free $2',
        '/\s*[-—]?\s*Vet[- ](Approved|Reviewed|Formulated)( Tools)?/i'                      => '',
        '/peer-reviewed (nutritional |veterinary )?(research|science)( and veterinary guidelines)?/i' => 'standard, widely published pet-care formulas',
        '/\bTrusted by 50K\+/i'                                                             => '',
        '/\s*Used by 50,000\+ pet owners\.?/i'                                              => '',
    ];
    foreach ( $map as $pat => $rep ) { $value = preg_replace( $pat, $rep, $value ); }
    return trim( $value );
}
foreach ( [ 'petzenai_hero_desc', 'petzenai_why_badge', 'petzenai_why_feat1_desc', 'petzenai_footer_desc', 'petzenai_seo_description', 'petzenai_hero_seo_title' ] as $pz_mod ) {
    add_filter( 'theme_mod_' . $pz_mod, 'pz_scrub_claims' );
}


/** Same scrub for "description" values inside Rank Math's JSON-LD graph. */
add_filter( 'rank_math/json_ld', function ( $data ) {
    if ( is_array( $data ) ) {
        array_walk_recursive( $data, function ( &$v, $k ) {
            if ( $k === 'description' && is_string( $v ) ) { $v = pz_scrub_claims( $v ); }
        } );
    }
    return $data;
}, 99 );


/* ============================================================
   Optional: noindex tools that still run on the shared template
   ------------------------------------------------------------
   About 190 tools have no content of their own (no 'calc' hook in the registry), so most of their text is
   identical on many pages. While PZ_NOINDEX_GENERIC is true they send "noindex, follow" and are left out of
   the sitemap. Giving a tool its own content (adding a 'calc' hook) re-indexes it automatically.
   Default is ON (owner chose to fix content quality before applying to AdSense). It can now be switched, and each tool
   overridden, from WordPress admin > PetZenAI SEO (inc/seo-panel.php); the constant is only the fallback.
   ============================================================ */
if ( ! defined( 'PZ_NOINDEX_GENERIC' ) ) define( 'PZ_NOINDEX_GENERIC', true );

/** True when the page is a registry tool that has no tool-specific content. */
function pz_is_generic_tool( $post ) {
    if ( ! $post || empty( $post->post_name ) || $post->post_type !== 'page' ) return false;
    require_once get_template_directory() . '/inc/tool-registry.php';
    static $generic = null;
    if ( $generic === null ) {
        $generic = [];
        foreach ( pz_get_all_tools() as $t ) { if ( empty( $t['calc'] ) ) $generic[ $t['slug'] ] = true; }
    }
    return isset( $generic[ $post->post_name ] );
}

function pz_is_noindexed_generic_tool( $post ) {
    // The SEO control panel (inc/seo-logic.php) decides: per-tool override first, then the global switch.
    if ( function_exists( 'pz_tool_is_noindexed' ) ) return pz_tool_is_noindexed( $post );
    return PZ_NOINDEX_GENERIC && pz_is_generic_tool( $post );
}

/** Saved override (title / description / keyword / index) for the tool page being viewed, or null. */
function pz_current_tool_override() {
    if ( ! function_exists( 'pz_seo_override_for' ) || ! is_page() ) return null;
    $q = get_queried_object();
    if ( ! $q || empty( $q->post_name ) ) return null;
    $tools = pz_seo_tools_by_slug();
    return isset( $tools[ $q->post_name ] ) ? pz_seo_override_for( $q->post_name ) : null;
}

add_filter( 'rank_math/frontend/robots', function ( $robots ) {
    if ( is_page() && pz_is_noindexed_generic_tool( get_queried_object() ) ) {
        $robots['index'] = 'noindex';
    }
    return $robots;
}, 20 );
