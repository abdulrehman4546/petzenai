<?php
/**
 * Adjusts Rank Math's JSON-LD @graph (filter rank_math/json_ld).
 *
 * - Publisher: Rank Math's "#person" node (["Person","Organization"] named "petzenai", no logo) becomes one
 *   Organization "PetZenAI" (#organization) with logo and support email; all references are re-pointed.
 * - Tool pages: drop the generic "Article" node. Tools with their own calculator/content ('calc' key in the
 *   registry) get a WebApplication node as the page's main entity; the others stay a plain WebPage.
 *   WebPage.breadcrumb points at the BreadcrumbList JSON-LD printed by inc/tool-renderer.php.
 * - /blog/, /about/, /contact/: WebPage type CollectionPage / AboutPage / ContactPage, no "Article" node.
 * - Blog posts: BreadcrumbList (Home > Blog > Post) added to the graph and linked from WebPage.breadcrumb.
 * - Text: names/headlines are entity-decoded and " & " is written as " and ", because Rank Math runs the
 *   whole graph through wp_kses_post_deep() on output, which turns every "&" into "&amp;".
 *
 * No ratings, reviews, user counts or authority claims are added here.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/** Logo for the Organization node: Customizer logo, then WordPress custom logo, then the theme's 512px paw icon. */
function pz_schema_logo() {
    $url = (string) get_theme_mod( 'petzenai_logo_image', '' );
    if ( $url !== '' ) return [ 'url' => $url ];
    $id = (int) get_theme_mod( 'custom_logo' );
    if ( $id && ( $img = wp_get_attachment_image_src( $id, 'full' ) ) ) return [ 'url' => $img[0], 'width' => (int) $img[1], 'height' => (int) $img[2] ];
    return [ 'url' => get_template_directory_uri() . '/assets/img/favicon-512.png', 'width' => 512, 'height' => 512 ];
}

/** Plain text for schema names: decode entities, "&" -> "and" (see file header). */
function pz_schema_text( $text ) {
    $text = html_entity_decode( (string) $text, ENT_QUOTES | ENT_HTML5, 'UTF-8' );
    $text = preg_replace( '/\s+&\s+/u', ' and ', $text );
    return trim( preg_replace( '/\s+/u', ' ', $text ) );
}

/** Replace {"@id": $from} references anywhere in the graph. */
function pz_schema_repoint( $node, $from, $to ) {
    if ( ! is_array( $node ) ) return $node;
    foreach ( $node as $k => $v ) {
        if ( $k === '@id' && $v === $from ) { $node[ $k ] = $to; continue; }
        if ( is_array( $v ) ) $node[ $k ] = pz_schema_repoint( $v, $from, $to );
    }
    return $node;
}

/**
 * Pure transform (unit-testable without WordPress).
 *
 * @param array $data Rank Math graph, keyed ('publisher', 'WebSite', 'WebPage', 'ProfilePage', 'richSnippet', ...).
 * @param array $ctx  home (site root URL with trailing slash), kind (post|tool|blog|about|contact|front|other),
 *                    logo (url[,width,height]), email, tool (registry row or null), tool_desc, post_title.
 */
function pz_schema_transform( $data, $ctx ) {
    if ( ! is_array( $data ) ) return $data;
    $home   = trailingslashit( $ctx['home'] );
    $org_id = $home . '#organization';
    $kind   = $ctx['kind'] ?? 'other';

    // ── Publisher -> Organization "PetZenAI" ──
    if ( isset( $data['publisher'] ) && is_array( $data['publisher'] ) ) {
        $old_id = $data['publisher']['@id'] ?? '';
        $logo   = array_merge( [ '@type' => 'ImageObject', '@id' => $home . '#logo' ], $ctx['logo'], [ 'caption' => 'PetZenAI' ] );
        $org    = [
            '@type' => 'Organization',
            '@id'   => $org_id,
            'name'  => 'PetZenAI',
            'url'   => $home,
            'logo'  => $logo,
            'image' => [ '@id' => $home . '#logo' ],
        ];
        if ( ! empty( $ctx['email'] ) ) $org['email'] = $ctx['email'];
        if ( ! empty( $data['publisher']['sameAs'] ) ) $org['sameAs'] = $data['publisher']['sameAs']; // only real profiles saved in Rank Math
        $data['publisher'] = $org;
        if ( $old_id !== '' && $old_id !== $org_id ) $data = pz_schema_repoint( $data, $old_id, $org_id );
    }
    if ( isset( $data['WebSite']['name'] ) && strtolower( $data['WebSite']['name'] ) === 'petzenai' ) $data['WebSite']['name'] = 'PetZenAI';

    // ── Author node: fix the saved localhost URL; drop the avatar query string (kses would turn "&" into "&amp;") ──
    if ( isset( $data['ProfilePage'] ) && is_array( $data['ProfilePage'] ) ) {
        $p = &$data['ProfilePage'];
        if ( ! empty( $p['sameAs'] ) ) {
            $p['sameAs'] = array_values( array_unique( array_map( function ( $u ) use ( $home ) {
                return preg_match( '#^https?://(localhost|127\.0\.0\.1)(:\d+)?/[^/]*/?#i', $u ) ? preg_replace( '#^https?://(localhost|127\.0\.0\.1)(:\d+)?/[^/]+/#i', $home, $u ) : $u;
            }, (array) $p['sameAs'] ) ) );
        }
        if ( ! empty( $p['image']['url'] ) && strpos( $p['image']['url'], 'gravatar.com' ) !== false ) {
            $clean = strtok( $p['image']['url'], '?' );
            $p['image']['url'] = $clean;
            $p['image']['@id'] = $clean;
        }
        unset( $p );
    }

    $page_url = $data['WebPage']['url'] ?? '';

    // ── Page types ──
    $types = [ 'blog' => 'CollectionPage', 'about' => 'AboutPage', 'contact' => 'ContactPage' ];
    if ( isset( $types[ $kind ] ) && isset( $data['WebPage'] ) ) {
        $data['WebPage']['@type'] = $types[ $kind ];
        if ( $kind === 'about' ) $data['WebPage']['about'] = [ '@id' => $org_id ];
        unset( $data['richSnippet'], $data['ProfilePage'] );
    }

    if ( $kind === 'tool' && isset( $data['WebPage'] ) ) {
        unset( $data['richSnippet'], $data['ProfilePage'] );
        $data['WebPage']['breadcrumb'] = [ '@id' => $page_url . '#breadcrumb' ];
        $tool = $ctx['tool'] ?? null;
        if ( $tool && ! empty( $tool['calc'] ) ) {
            $app = [
                '@type'               => 'WebApplication',
                '@id'                 => $page_url . '#app',
                'name'                => pz_schema_text( $tool['title'] ),
                'url'                 => $page_url,
                'applicationCategory' => 'LifestyleApplication',
                'operatingSystem'     => 'Any',
                'isAccessibleForFree' => true,
                'offers'              => [ '@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD' ],
                'publisher'           => [ '@id' => $org_id ],
                'mainEntityOfPage'    => [ '@id' => $page_url . '#webpage' ],
                'inLanguage'          => $data['WebPage']['inLanguage'] ?? 'en-US',
            ];
            if ( ! empty( $ctx['tool_desc'] ) ) $app['description'] = $ctx['tool_desc'];
            $data['WebApplication']       = $app;
            $data['WebPage']['mainEntity'] = [ '@id' => $page_url . '#app' ];
        }
    }

    if ( $kind === 'post' && isset( $data['WebPage'] ) && ! isset( $data['BreadcrumbList'] ) ) {
        $data['BreadcrumbList'] = [
            '@type'           => 'BreadcrumbList',
            '@id'             => $page_url . '#breadcrumb',
            'itemListElement' => [
                [ '@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $home ],
                [ '@type' => 'ListItem', 'position' => 2, 'name' => 'Blog', 'item' => $home . 'blog/' ],
                [ '@type' => 'ListItem', 'position' => 3, 'name' => pz_schema_text( $ctx['post_title'] ?? '' ), 'item' => $page_url ],
            ],
        ];
        $data['WebPage']['breadcrumb'] = [ '@id' => $page_url . '#breadcrumb' ];
    }

    // ── Clean names/headlines (all pages) ──
    foreach ( $data as $key => $node ) {
        if ( ! is_array( $node ) ) continue;
        foreach ( [ 'name', 'headline' ] as $f ) {
            if ( isset( $node[ $f ] ) && is_string( $node[ $f ] ) ) $data[ $key ][ $f ] = pz_schema_text( $node[ $f ] );
        }
    }
    return $data;
}

/** Build the context for the current request. */
function pz_schema_context() {
    $ctx = [
        'home'       => home_url( '/' ),
        'kind'       => 'other',
        'logo'       => pz_schema_logo(),
        'email'      => sanitize_email( (string) get_theme_mod( 'petzenai_contact_email', 'support@petzenai.com' ) ) ?: 'support@petzenai.com',
        'tool'       => null,
        'tool_desc'  => '',
        'post_title' => '',
    ];
    if ( is_front_page() ) {
        $ctx['kind'] = 'front';
    } elseif ( is_singular( 'post' ) ) {
        $ctx['kind']       = 'post';
        $ctx['post_title'] = get_the_title( get_queried_object_id() );
    } elseif ( is_page() && ( $q = get_queried_object() ) && ! empty( $q->post_name ) ) {
        $map = [ 'blog' => 'blog', 'about' => 'about', 'contact' => 'contact' ];
        if ( (int) $q->post_parent === 0 && isset( $map[ $q->post_name ] ) ) {
            $ctx['kind'] = $map[ $q->post_name ];
        } elseif ( function_exists( 'pz_seo_tools_by_slug' ) ) {
            $tools = pz_seo_tools_by_slug();
            if ( isset( $tools[ $q->post_name ] ) && ! pz_current_hub() ) {
                $ctx['kind'] = 'tool';
                $ctx['tool'] = $tools[ $q->post_name ];
                if ( ! empty( $ctx['tool']['calc'] ) ) {
                    // Same text as the page's meta description (Paper applies rank_math/frontend/description,
                    // where inc/seo-indexing.php replaces templated boilerplate).
                    $desc = class_exists( '\\RankMath\\Paper\\Paper' ) ? (string) \RankMath\Paper\Paper::get()->get_description() : '';
                    if ( function_exists( 'pz_tool_meta_description' ) && pz_is_boilerplate_tool_desc( $desc ) ) $desc = pz_tool_meta_description( $ctx['tool'], $desc );
                    $ctx['tool_desc'] = pz_schema_text( $desc );
                }
            }
        }
    }
    return $ctx;
}

add_filter( 'rank_math/json_ld', function ( $data ) {
    try {
        return pz_schema_transform( $data, pz_schema_context() );
    } catch ( \Throwable $e ) {
        error_log( 'PetZenAI schema filter: ' . $e->getMessage() );
        return $data; // never break the page over schema
    }
}, 20 );
