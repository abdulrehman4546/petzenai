<?php
/**
 * Google AdSense site code.
 *
 * Adds the AdSense loader and the "google-adsense-account" verification meta to every front-end page so
 * Google can verify the site and, once approved, serve Auto ads / the consent message configured in AdSense.
 * No ad is displayed by this file; manual slots still come from petzenai_ad() and need slot ids.
 *
 * Publisher id: Customizer value if present, else the id already published in /ads.txt.
 * Disable with: define( 'PZ_DISABLE_ADSENSE', true );
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_adsense_client() {
    $id = trim( (string) get_theme_mod( 'petzenai_adsense_publisher_id', '' ) );
    if ( $id === '' ) $id = 'pub-4379837532366669';               // from ads.txt
    $id = preg_replace( '/^ca-/', '', $id );
    return preg_match( '/^pub-\d{10,20}$/', $id ) ? 'ca-' . $id : '';
}

add_action( 'wp_head', function () {
    if ( defined( 'PZ_DISABLE_ADSENSE' ) && PZ_DISABLE_ADSENSE ) return;
    if ( is_admin() || is_preview() || is_customize_preview() || is_404() ) return;
    $client = pz_adsense_client();
    if ( ! $client ) return;
    echo '<meta name="google-adsense-account" content="' . esc_attr( $client ) . '">' . "\n";
    echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . esc_attr( $client ) . '" crossorigin="anonymous"></script>' . "\n";
}, 2 );
