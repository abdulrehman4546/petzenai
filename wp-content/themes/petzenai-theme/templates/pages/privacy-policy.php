<?php
/**
 * Template Name: Privacy Policy Page
 * Template Post Type: page
 */
get_header();
$site_name = get_bloginfo('name');
$site_url  = home_url('/');
$email     = get_theme_mod('petzenai_contact_email', 'support@petzenai.com');
?>

<section class="pz-page-hero" aria-label="Privacy Policy Hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">Legal</span>
    <h1 class="pz-page-hero-title">Privacy Policy</h1>
    <p class="pz-page-hero-desc">Last updated: October 15, 2026</p>
  </div>
</section>

<main>
  <section class="section" aria-label="Privacy Policy Content">
    <div class="container" style="max-width:860px">
      <div class="pz-legal-content">

        <div class="pz-legal-intro">
          <p><strong><?php echo esc_html($site_name); ?></strong> (“we,” “us,” or “our”) operates <a href="<?php echo esc_url($site_url); ?>">petzenai.com</a>, a free website offering pet-care calculators, guides and articles. This Privacy Policy explains what information is collected when you use the site, how it is used, and the choices you have.</p>
          <p>By using this site you agree to the practices described here. If you do not agree, please do not use the site.</p>
        </div>

        <h2>1. Information We Collect</h2>
        <h3>1.1 Information you provide</h3>
        <p>If you use our <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a> form, we collect the name, email address, subject and message you submit so that we can reply. You do not need an account or login to use any tool, calculator or article on this site.</p>

        <h3>1.2 Calculator and tool inputs</h3>
        <p>Our calculators and interactive tools run in your browser. What you type into them (for example your pet’s weight, age or symptoms) is used on your device to produce your result and is not sent to or stored on our servers.</p>

        <h3>1.3 Information collected automatically</h3>
        <p>As with most websites, technical information is processed when you visit: your IP address (which indicates approximate location), browser and device type, pages viewed, date and time, and the website that referred you. This is recorded in our hosting provider’s server logs and, if enabled, by the analytics and advertising services described below.</p>

        <h3>1.4 Information stored on your device</h3>
        <p>Some features store small amounts of data in your browser’s local storage, for example a short list of tools you recently viewed and your light/dark display preference. This data stays on your device, is not sent to us, and you can clear it at any time in your browser settings.</p>

        <h2>2. Cookies and Similar Technologies</h2>
        <p>Cookies are small files placed on your device. We and our partners may use:</p>
        <ul>
          <li><strong>Essential cookies</strong> needed for the site to work and stay secure.</li>
          <li><strong>Analytics cookies</strong> (for example Google Analytics, if enabled) to understand which pages and tools are used so we can improve them.</li>
          <li><strong>Advertising cookies</strong> used by Google AdSense and its partners to show and measure ads (see Section 3).</li>
        </ul>
        <p>You can block or delete cookies in your browser settings. Some parts of the site may not work as intended without them.</p>

        <h2>3. Advertising (Google AdSense)</h2>
        <p>We use Google AdSense to display ads on this site. Third-party vendors, including Google, use cookies to serve ads based on a user’s prior visits to this website and other websites. Google’s use of advertising cookies enables it and its partners to serve ads to you based on your visit to this site and/or other sites on the Internet.</p>
        <ul>
          <li>You can opt out of personalized advertising by visiting <a href="https://adssettings.google.com" target="_blank" rel="noopener noreferrer">Google Ads Settings</a>.</li>
          <li>You can also opt out of a third-party vendor’s use of cookies for personalized advertising by visiting <a href="https://www.aboutads.info/choices/" target="_blank" rel="noopener noreferrer">www.aboutads.info/choices</a>. Users in Europe can use <a href="https://www.youronlinechoices.com/" target="_blank" rel="noopener noreferrer">www.youronlinechoices.com</a>.</li>
          <li>To learn how Google uses data from sites that use its services, see <a href="https://policies.google.com/technologies/partner-sites" target="_blank" rel="noopener noreferrer">How Google uses information from sites or apps that use our services</a>.</li>
        </ul>
        <p>Ads may be non-personalized if you decline consent or opt out. We do not control the cookies set by advertising partners; please review their privacy policies.</p>

        <h2>4. Affiliate Links</h2>
        <p>Some pages may contain affiliate links (for example to products or pet-insurance providers). If you click one and make a purchase, we may earn a commission at no extra cost to you. Affiliate partners may use cookies to track referred purchases.</p>

        <h2>5. How We Use Information</h2>
        <ul>
          <li>To respond to messages sent through our Contact form</li>
          <li>To operate, secure and maintain the site and to prevent abuse</li>
          <li>To understand how tools and content are used, and improve them</li>
          <li>To show advertising that supports keeping the tools free</li>
          <li>To comply with legal obligations</li>
        </ul>

        <h2>6. Sharing of Information</h2>
        <p>We do not sell your personal information for money. We share information only with:</p>
        <ul>
          <li><strong>Service providers</strong> that help us run the site, such as our web hosting provider and email service, who may process data on our behalf.</li>
          <li><strong>Advertising and analytics partners</strong> described above, such as Google.</li>
          <li><strong>Authorities or other parties</strong> where required by law, or to protect our rights, users or the public.</li>
        </ul>
        <p>Some partners, including Google, are based in the United States and may process data there.</p>

        <h2>7. Data Retention</h2>
        <p>We keep Contact form messages for as long as needed to answer you and keep reasonable records, then delete them. Server logs and analytics data are kept by our providers under their own retention schedules.</p>

        <h2>8. Your Rights and Choices</h2>
        <p>Depending on where you live, you may have the right to request access to, correction of, or deletion of personal information we hold about you (mainly Contact form messages, since we do not otherwise keep personal data), and to object to or restrict certain processing. To make a request, email <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>. We will respond within 30 days.</p>

        <h3>8.1 European Economic Area, United Kingdom and Switzerland</h3>
        <p>Where required, we ask for your consent before using cookies or similar technologies for personalized advertising or measurement, through a consent message shown on the site. You can change your choice at any time using the privacy settings link on the site, if shown, or by clearing your cookies. Where we rely on consent, you may withdraw it at any time. You also have the right to lodge a complaint with your local data protection authority.</p>

        <h3>8.2 California and other US states</h3>
        <p>Residents of some US states, including California, may have rights to know what personal information is collected, to request deletion, and to opt out of the “sale” or “sharing” of personal information for targeted advertising. Advertising partners such as Google may collect information through cookies on this site, which some state laws treat as “sharing” or “selling.” You can opt out using the privacy choices message shown on the site (where available), <a href="https://adssettings.google.com" target="_blank" rel="noopener noreferrer">Google Ads Settings</a>, or by contacting us. We will not discriminate against you for exercising your rights.</p>

        <h2>9. Children’s Privacy</h2>
        <p><?php echo esc_html($site_name); ?> is intended for a general audience and is not directed at children under 13. We do not knowingly collect personal information from children under 13. If you believe a child has sent us personal information, contact us and we will delete it.</p>

        <h2>10. Third-Party Links</h2>
        <p>Our pages link to third-party websites, including veterinary organisations and resources, for further reading. We do not control these sites and are not responsible for their content or privacy practices.</p>

        <h2>11. Security</h2>
        <p>We take reasonable technical and organizational measures to protect information. No method of transmission or storage is completely secure, so we cannot guarantee absolute security.</p>

        <h2>12. Educational Content Notice</h2>
        <p>The information on this site is educational and is not veterinary advice, diagnosis or treatment. Always consult a licensed veterinarian about your pet’s health.</p>

        <h2>13. Changes to This Policy</h2>
        <p>We may update this policy from time to time. We will change the “Last updated” date at the top of this page when we do, so please review it periodically.</p>

        <h2>14. Contact Us</h2>
        <p>If you have questions about this Privacy Policy or how information is handled, contact us:</p>
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
