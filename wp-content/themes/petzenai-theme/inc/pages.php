<?php
/**
 * Page template overrides.
 * The live "Privacy Policy" page is stored in the database with older text and no page template assigned,
 * so force the theme's template (which carries the full, AdSense-ready policy) for that page.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'template_include', function ( $template ) {
    if ( is_page( 'privacy-policy' ) ) {
        $file = get_template_directory() . '/templates/pages/privacy-policy.php';
        if ( is_readable( $file ) ) return $file;
    }
    return $template;
}, 20 );
