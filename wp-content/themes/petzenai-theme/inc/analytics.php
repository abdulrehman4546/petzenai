<?php
/**
 * Google Analytics 4 (gtag.js).
 *
 * - Measurement id: saved in wp-admin > PetZenAI SEO (type "off" to disable), else the default below.
 * - Consent Mode v2: for the EEA, the UK and Switzerland analytics and ad storage start as "denied" and stay that way until
 *   a consent tool (for example the Google-certified message set up in AdSense > Privacy & messaging) grants them.
 *   Everywhere else it starts as granted.
 * - Logged-in editors/admins are not counted, so the owner's own visits do not skew the numbers.
 * - Printed before the AdSense loader (priority 1 vs 2) because the consent default must be set first.
 * Do not also tick "Install analytics code" in Rank Math, or visits would be counted twice.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'PZ_GA4_DEFAULT_ID' ) ) define( 'PZ_GA4_DEFAULT_ID', 'G-DSGEETLLHD' );

/** @return string a valid GA4 measurement id, or '' when analytics is off */
function pz_ga4_id() {
    if ( defined( 'PZ_DISABLE_ANALYTICS' ) && PZ_DISABLE_ANALYTICS ) return '';
    $id = trim( (string) get_option( 'pz_ga4_id', '' ) );
    if ( strtolower( $id ) === 'off' ) return '';
    if ( $id === '' ) $id = PZ_GA4_DEFAULT_ID;
    return preg_match( '/^G-[A-Z0-9]{6,14}$/', $id ) ? $id : '';
}

add_action( 'wp_head', function () {
    if ( is_admin() || is_preview() || is_customize_preview() || is_404() ) return;
    if ( is_user_logged_in() && current_user_can( 'edit_posts' ) ) return;
    $id = pz_ga4_id();
    if ( $id === '' ) return;
    $regions = [ 'AT','BE','BG','HR','CY','CZ','DK','EE','FI','FR','DE','GR','HU','IS','IE','IT','LV','LI','LT','LU','MT','NL','NO','PL','PT','RO','SK','SI','ES','SE','GB','CH' ];
    ?>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $id ); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('consent', 'default', {
    'ad_storage': 'denied', 'ad_user_data': 'denied', 'ad_personalization': 'denied', 'analytics_storage': 'denied',
    'region': <?php echo wp_json_encode( $regions ); ?>,
    'wait_for_update': 500
  });
  gtag('js', new Date());
  gtag('config', '<?php echo esc_js( $id ); ?>');
</script>
<?php
}, 1 );
