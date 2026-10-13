<?php
/**
 * Branding: favicon / site icon.
 *
 * The live site has no WordPress "Site Icon" saved, so browsers and Google showed WordPress's default "W".
 * Until an icon is chosen in Appearance > Customize > Site Identity, serve the theme's own paw icon.
 * A Site Icon picked there always wins (the filters below only act when none is set).
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function pz_icon_url( $file ) {
    return get_template_directory_uri() . '/assets/img/' . $file;
}

/** Nearest bundled PNG size (smallest one that is >= the requested size, else the largest). */
function pz_icon_size_for( $size ) {
    $have = [ 16, 32, 48, 96, 144, 180, 192, 270, 512 ];
    foreach ( $have as $s ) { if ( $s >= (int) $size ) return $s; }
    return end( $have );
}

/** wp_site_icon() prints the <link rel="icon">, apple-touch-icon and tile tags once has_site_icon() is true. */
add_filter( 'get_site_icon_url', function ( $url, $size ) {
    if ( $url ) return $url;
    return pz_icon_url( 'favicon-' . pz_icon_size_for( $size ) . '.png' );
}, 10, 2 );

/** Also advertise the 48px PNG (Google's recommended base size) and an SVG for modern browsers. */
add_action( 'wp_head', function () {
    if ( get_option( 'site_icon' ) ) return;
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url( pz_icon_url( 'favicon.svg' ) ) . '">' . "\n";
    echo '<link rel="icon" type="image/png" sizes="48x48" href="' . esc_url( pz_icon_url( 'favicon-48.png' ) ) . '">' . "\n";
    echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url( pz_icon_url( 'apple-touch-icon.png' ) ) . '">' . "\n";
}, 98 );

/** /favicon.ico: serve a real .ico instead of redirecting to WordPress's default "W" image. */
add_action( 'do_faviconico', function () {
    if ( get_option( 'site_icon' ) ) return;
    $file = get_template_directory() . '/assets/img/favicon.ico';
    if ( ! is_readable( $file ) ) return;
    header( 'Content-Type: image/x-icon' );
    header( 'Cache-Control: public, max-age=604800' );
    readfile( $file );
    exit;
} );
