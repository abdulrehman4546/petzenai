<?php
/**
 * Template Name: Privacy Policy Page
 * Template Post Type: page
 */
get_header();
$site_name  = get_bloginfo('name');
$site_url   = home_url('/');
$email      = get_theme_mod('petzenai_contact_email', 'support@petzenai.com');
$today_year = date('Y');
?>

<section class="pz-page-hero" aria-label="Privacy Policy Hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">Legal</span>
    <h1 class="pz-page-hero-title">Privacy Policy</h1>
    <p class="pz-page-hero-desc">Last updated: June 11, 2026 &nbsp;·&nbsp; Effective: January 1, <?php echo $today_year; ?></p>
  </div>
</section>

<main>
  <section class="section" aria-label="Privacy Policy Content">
    <div class="container" style="max-width:860px">
      <div class="pz-legal-content">

        <div class="pz-legal-intro">
          <p>Welcome to <strong><?php echo esc_html($site_name); ?></strong> ("<strong>we</strong>," "<strong>us</strong>," or "<strong>our</strong>"). We operate the website located at <a href="<?php echo esc_url($site_url); ?>"><?php echo esc_html($site_url); ?></a> (the "<strong>Site</strong>"). This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our Site. Please read this policy carefully.</p>
          <p>By accessing or using our Site, you agree to the collection and use of information in accordance with this policy.</p>
        </div>

        <h2>1. Information We Collect</h2>
        <h3>1.1 Information You Provide Voluntarily</h3>
        <p>We may collect personal information that you voluntarily provide when you:</p>
        <ul>
          <li>Fill out our contact form (name, email address, message)</li>
          <li>Subscribe to our newsletter (email address)</li>
          <li>Leave a comment on our blog posts</li>
        </ul>

        <h3>1.2 Information Collected Automatically</h3>
        <p>When you visit our Site, we automatically collect certain information, including:</p>
        <ul>
          <li><strong>Log Data:</strong> IP address, browser type and version, pages visited, time and date of visit, time spent on pages, and other diagnostic data.</li>
          <li><strong>Cookies and Tracking Technologies:</strong> We use cookies, web beacons, and similar tracking technologies to track activity on our Site and hold certain information. See Section 5 for details.</li>
          <li><strong>Usage Data:</strong> Information about how you use our free pet care tools (e.g., inputs entered into calculators — but we do not store these inputs on our servers).</li>
        </ul>

        <h3>1.3 Information from Third Parties</h3>
        <p>We may receive information about you from third-party services such as Google Analytics and Google AdSense. These services collect data as described in their own privacy policies.</p>

        <h2>2. How We Use Your Information</h2>
        <p>We use the information we collect for the following purposes:</p>
        <ul>
          <li>To operate and maintain our Site and free pet care tools</li>
          <li>To respond to your inquiries and customer support requests</li>
          <li>To send you newsletters and marketing communications (only if you opted in)</li>
          <li>To analyze usage trends and improve our Site and tools</li>
          <li>To detect, prevent, and address technical issues or fraudulent activity</li>
          <li>To display personalized advertisements through Google AdSense</li>
          <li>To comply with legal obligations</li>
        </ul>

        <h2>3. Google AdSense and Advertising</h2>
        <p>We use <strong>Google AdSense</strong> to display advertisements on our Site. Google AdSense uses cookies to serve ads based on your prior visits to our Site and other websites on the Internet.</p>
        <ul>
          <li>Google may use the information it collects to personalize the ads you see.</li>
          <li>You may opt out of personalized advertising by visiting <a href="https://www.google.com/settings/ads" target="_blank" rel="noopener noreferrer">Google Ads Settings</a>.</li>
          <li>You can also opt out by visiting the <a href="http://www.aboutads.info/choices/" target="_blank" rel="noopener noreferrer">Network Advertising Initiative opt-out page</a>.</li>
          <li>Third-party vendors, including Google, use cookies to serve ads based on a user's prior visits to our website or other websites.</li>
        </ul>
        <p>For more information on how Google uses data when you use our Site, please visit: <a href="https://policies.google.com/technologies/partner-sites" target="_blank" rel="noopener noreferrer">How Google uses data from sites that use their services</a>.</p>

        <h2>4. Google Analytics</h2>
        <p>We use <strong>Google Analytics</strong> to understand how visitors use our Site. Google Analytics collects information such as how often users visit the Site, what pages they visit, and what other sites they used prior to coming to our Site.</p>
        <p>Google Analytics collects only the IP address assigned to you on the date you visit our Site, not your name or other identifying information. We do not combine the information collected using Google Analytics with personally identifiable information.</p>
        <p>You may prevent Google Analytics from recognizing you on return visits by disabling cookies in your browser or by using the <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer">Google Analytics Opt-out Browser Add-on</a>.</p>

        <h2>5. Cookies Policy</h2>
        <p>Cookies are small data files placed on your device. We use the following types of cookies:</p>
        <ul>
          <li><strong>Essential Cookies:</strong> Required for the Site to function properly (e.g., WordPress session cookies).</li>
          <li><strong>Analytics Cookies:</strong> Help us understand how visitors interact with our Site (Google Analytics).</li>
          <li><strong>Advertising Cookies:</strong> Used by Google AdSense to serve relevant advertisements.</li>
          <li><strong>Preference Cookies:</strong> Remember your preferences and settings.</li>
        </ul>
        <p>You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, some parts of our Site may not function properly.</p>

        <h2>6. How We Share Your Information</h2>
        <p>We do not sell, trade, or rent your personal information to third parties. We may share your information in the following circumstances:</p>
        <ul>
          <li><strong>Service Providers:</strong> We may share data with trusted third-party service providers who assist us in operating our Site (e.g., hosting providers, email services). These providers are contractually obligated to keep your information confidential.</li>
          <li><strong>Business Transfers:</strong> If we are involved in a merger, acquisition, or sale of assets, your information may be transferred as part of that transaction.</li>
          <li><strong>Legal Requirements:</strong> We may disclose your information if required to do so by law or in response to valid requests by public authorities.</li>
          <li><strong>Protection of Rights:</strong> We may disclose information to protect the rights, property, or safety of <?php echo esc_html($site_name); ?>, our users, or others.</li>
        </ul>

        <h2>7. Data Retention</h2>
        <p>We retain personal information only for as long as necessary to fulfill the purposes described in this Privacy Policy, unless a longer retention period is required or permitted by law.</p>
        <ul>
          <li>Contact form submissions: retained for up to 12 months</li>
          <li>Newsletter subscriptions: retained until you unsubscribe</li>
          <li>Analytics data: retained per Google's standard retention policies</li>
        </ul>

        <h2>8. Your Rights and Choices</h2>
        <p>Depending on your location, you may have the following rights regarding your personal data:</p>
        <ul>
          <li><strong>Access:</strong> You can request a copy of the personal information we hold about you.</li>
          <li><strong>Correction:</strong> You can request that we correct inaccurate or incomplete information.</li>
          <li><strong>Deletion:</strong> You can request that we delete your personal information ("right to be forgotten").</li>
          <li><strong>Opt-Out:</strong> You can opt out of marketing communications at any time by clicking "unsubscribe" in any email or contacting us directly.</li>
          <li><strong>Data Portability:</strong> You may request your data in a portable format.</li>
        </ul>
        <p>To exercise any of these rights, please contact us at <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>. We will respond within 30 days.</p>

        <h2>9. Children's Privacy</h2>
        <p><?php echo esc_html($site_name); ?> is not directed to children under the age of 13. We do not knowingly collect personally identifiable information from children under 13. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us immediately so that we can take necessary action.</p>

        <h2>10. Third-Party Links</h2>
        <p>Our Site may contain links to third-party websites. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services. We encourage you to review the privacy policy of every site you visit.</p>

        <h2>11. Security of Your Information</h2>
        <p>We use commercially reasonable technical and organizational measures to protect your personal information. However, no method of transmission over the Internet or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your information, we cannot guarantee its absolute security.</p>

        <h2>12. California Privacy Rights (CCPA)</h2>
        <p>If you are a California resident, you have specific rights under the California Consumer Privacy Act (CCPA), including the right to know what personal data is collected, the right to know whether your personal data is sold or disclosed, the right to say no to the sale of personal data, and the right to non-discrimination in terms of price or service for exercising your privacy rights.</p>
        <p>We do <strong>not sell</strong> your personal information to third parties.</p>

        <h2>13. GDPR — Rights of EU/EEA Users</h2>
        <p>If you are located in the European Union or European Economic Area, you have rights under the General Data Protection Regulation (GDPR), including rights of access, rectification, erasure, restriction of processing, data portability, and the right to object. The legal basis for processing your data is typically your consent, our legitimate interests, or compliance with legal obligations.</p>
        <p>To exercise your GDPR rights, contact us at <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>.</p>

        <h2>14. Changes to This Privacy Policy</h2>
        <p>We may update this Privacy Policy from time to time. We will notify you of any changes by updating the "Last updated" date at the top of this page. You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>

        <h2>15. Contact Us</h2>
        <p>If you have any questions about this Privacy Policy or our data practices, please contact us:</p>
        <div class="pz-legal-contact-box">
          <strong><?php echo esc_html($site_name); ?></strong><br>
          Email: <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><br>
          Website: <a href="<?php echo esc_url($site_url); ?>"><?php echo esc_html($site_url); ?></a>
        </div>

      </div><!-- /pz-legal-content -->
    </div>
  </section>
</main>

<style>
.pz-legal-content{color:#333;line-height:1.8;font-size:16px}
.pz-legal-intro{background:#FFF8F4;border-left:4px solid var(--orange);padding:24px 28px;border-radius:0 16px 16px 0;margin-bottom:40px}
.pz-legal-content h2{font-size:22px;font-weight:900;color:#0D0D0D;margin:40px 0 14px;padding-bottom:10px;border-bottom:2px solid #F0F0F0}
.pz-legal-content h3{font-size:17px;font-weight:800;color:#0D0D0D;margin:24px 0 10px}
.pz-legal-content p{margin-bottom:16px}
.pz-legal-content ul{margin:0 0 20px 24px}
.pz-legal-content li{margin-bottom:8px}
.pz-legal-content a{color:var(--orange);font-weight:600;text-decoration:underline}
.pz-legal-contact-box{background:#F7F7F7;border-radius:16px;padding:24px 28px;margin-top:16px;font-size:15px;line-height:2}
</style>

<?php get_footer(); ?>
