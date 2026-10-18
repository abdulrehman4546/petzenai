<?php
/**
 * Google AdSense site code.
 *
 * Adds the AdSense loader and the "google-adsense-account" verification meta to every front-end page so
 * Google can verify the site and, once approved, serve Auto ads / the consent message configured in AdSense.
 * No ad is displayed by this file; manual slots still come from petzenai_ad() and need slot ids.
 *
 * Publisher id: the value saved in WordPress admin > PetZenAI SEO (or the Customizer) if set, else the default below, which
 * must match /ads.txt.
 * Disable with: define( 'PZ_DISABLE_ADSENSE', true );
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/** The site's AdSense publisher id (the same one published in /ads.txt). */
if ( ! defined( 'PZ_ADSENSE_DEFAULT_PUB' ) ) define( 'PZ_ADSENSE_DEFAULT_PUB', 'pub-1736474691234357' );
/** An id that was used by mistake earlier; never use it even if it is still saved in the database. */
if ( ! defined( 'PZ_ADSENSE_WRONG_PUBS' ) ) define( 'PZ_ADSENSE_WRONG_PUBS', 'pub-4379837532366669' );

function pz_adsense_client() {
    $id = preg_replace( '/^ca-/', '', trim( (string) get_theme_mod( 'petzenai_adsense_publisher_id', '' ) ) );
    if ( $id === '' || in_array( $id, explode( ',', PZ_ADSENSE_WRONG_PUBS ), true ) ) $id = PZ_ADSENSE_DEFAULT_PUB;
    if ( ! preg_match( '/^pub-\d{10,20}$/', $id ) ) $id = PZ_ADSENSE_DEFAULT_PUB;   // a malformed saved value falls back to the default
    return 'ca-' . $id;
}

add_action( 'wp_head', function () {
    if ( defined( 'PZ_DISABLE_ADSENSE' ) && PZ_DISABLE_ADSENSE ) return;
    if ( is_admin() || is_preview() || is_customize_preview() || is_404() ) return;
    $client = pz_adsense_client();
    if ( ! $client ) return;
    echo '<meta name="google-adsense-account" content="' . esc_attr( $client ) . '">' . "\n";
    echo '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=' . esc_attr( $client ) . '" crossorigin="anonymous"></script>' . "\n";
}, 2 );
