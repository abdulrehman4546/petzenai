<?php
/**
 * Google Indexing API: notifies Google the moment a post goes live, the same way inc/blog-seed.php already
 * does for IndexNow (Bing/Yandex). Google does not use IndexNow, so this is the Google-side equivalent.
 *
 * Needs a service-account JSON key at ABSPATH . 'pz-google-service-account.json' (same folder as wp-config.php,
 * gitignored — upload it to the server by hand, it is never deployed by git on purpose). That service account
 * must be added as an Owner on the petzenai.com Search Console property, and the "Web Search Indexing API"
 * must be enabled on its Google Cloud project. Every call is wrapped so a missing key or a Google-side failure
 * can never break the page being served.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

define( 'PZ_GOOGLE_SA_KEY_PATH', ABSPATH . 'pz-google-service-account.json' );

/** Base64url-encode (JWT uses this, not plain base64). */
function pz_google_b64url( $data ) {
    return rtrim( strtr( base64_encode( $data ), '+/', '-_' ), '=' );
}

/**
 * Exchange the service-account key for a short-lived OAuth access token (cached ~55 min in a transient).
 * @return string|null access token, or null if the key is missing/invalid or the exchange failed.
 */
function pz_google_indexing_get_token() {
    if ( ! is_readable( PZ_GOOGLE_SA_KEY_PATH ) ) return null;

    $cached = get_transient( 'pz_google_indexing_token' );
    if ( $cached ) return $cached;

    $key = json_decode( file_get_contents( PZ_GOOGLE_SA_KEY_PATH ), true );
    if ( empty( $key['client_email'] ) || empty( $key['private_key'] ) ) return null;

    $now    = time();
    $header = pz_google_b64url( wp_json_encode( [ 'alg' => 'RS256', 'typ' => 'JWT' ] ) );
    $claims = pz_google_b64url( wp_json_encode( [
        'iss'   => $key['client_email'],
        'scope' => 'https://www.googleapis.com/auth/indexing',
        'aud'   => 'https://oauth2.googleapis.com/token',
        'iat'   => $now,
        'exp'   => $now + 3600,
    ] ) );

    $signing_input = $header . '.' . $claims;
    $signature     = '';
    $ok = openssl_sign( $signing_input, $signature, $key['private_key'], 'sha256WithRSAEncryption' );
    if ( ! $ok ) return null;

    $jwt = $signing_input . '.' . pz_google_b64url( $signature );

    $res = wp_remote_post( 'https://oauth2.googleapis.com/token', [
        'timeout' => 8,
        'body'    => [
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt,
        ],
    ] );
    if ( is_wp_error( $res ) ) return null;

    $body = json_decode( wp_remote_retrieve_body( $res ), true );
    if ( empty( $body['access_token'] ) ) return null;

    set_transient( 'pz_google_indexing_token', $body['access_token'], (int) ( $body['expires_in'] ?? 3300 ) - 300 );
    return $body['access_token'];
}

/**
 * Tell Google a URL was published/updated. Fire-and-forget (non-blocking), never fatal.
 * @param string $url
 * @param string $type 'URL_UPDATED' (default) or 'URL_DELETED'
 */
function pz_google_indexing_notify( $url, $type = 'URL_UPDATED' ) {
    try {
        $token = pz_google_indexing_get_token();
        if ( ! $token ) return false;
        wp_remote_post( 'https://indexing.googleapis.com/v3/urlNotifications:publish', [
            'timeout'  => 5,
            'blocking' => false,
            'headers'  => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type'  => 'application/json',
            ],
            'body' => wp_json_encode( [ 'url' => $url, 'type' => $type ] ),
        ] );
        return true;
    } catch ( \Throwable $e ) {
        error_log( 'PetZenAI Google Indexing API failed: ' . $e->getMessage() );
        return false;
    }
}

/** Same trigger as the IndexNow hook in blog-seed.php: fires when a post (any status) transitions to publish. */
add_action( 'transition_post_status', function ( $new, $old, $post ) {
    if ( $new !== 'publish' || $old === 'publish' || $post->post_type !== 'post' ) return;
    if ( wp_parse_url( home_url(), PHP_URL_HOST ) !== 'petzenai.com' ) return; // never from the local copy
    pz_google_indexing_notify( get_permalink( $post ) );
}, 10, 3 );
