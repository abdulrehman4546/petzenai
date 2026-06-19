<?php
/**
 * Template Name: Terms of Service Page
 * Template Post Type: page
 */
get_header();
$site_name  = get_bloginfo('name');
$site_url   = home_url('/');
$email      = get_theme_mod('petzenai_contact_email', 'support@petzenai.com');
$today_year = date('Y');
?>

<section class="pz-page-hero" aria-label="Terms Hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">Legal</span>
    <h1 class="pz-page-hero-title">Terms of Service</h1>
    <p class="pz-page-hero-desc">Last updated: <?php echo date('F j, Y'); ?> &nbsp;·&nbsp; Please read carefully before using our Site.</p>
  </div>
</section>

<main>
  <section class="section" aria-label="Terms of Service Content">
    <div class="container" style="max-width:860px">
      <div class="pz-legal-content">

        <div class="pz-legal-intro">
          <p>These Terms of Service ("<strong>Terms</strong>") govern your access to and use of <strong><?php echo esc_html($site_name); ?></strong>, accessible at <a href="<?php echo esc_url($site_url); ?>"><?php echo esc_html($site_url); ?></a> (the "<strong>Site</strong>"). By accessing or using our Site, you agree to be bound by these Terms. If you disagree with any part of these Terms, please do not use our Site.</p>
        </div>

        <h2>1. Acceptance of Terms</h2>
        <p>By accessing or using <?php echo esc_html($site_name); ?>, you confirm that you are at least 13 years of age, have read and understood these Terms, and agree to be legally bound by them. If you are using the Site on behalf of an organization, you represent that you have the authority to bind that organization to these Terms.</p>

        <h2>2. Description of Service</h2>
        <p><?php echo esc_html($site_name); ?> provides free, science-based pet care tools and educational content, including:</p>
        <ul>
          <li>Pet Food Portion Calculator</li>
          <li>Pet Age Calculator</li>
          <li>Pet Vaccination Schedule Tracker</li>
          <li>AI Pet Name Generator</li>
          <li>Pet Exercise Calculator</li>
          <li>What Pet Should I Get Quiz</li>
          <li>Educational blog articles on pet nutrition and health</li>
        </ul>
        <p>All tools and content are provided free of charge, without registration or subscription requirements.</p>

        <h2>3. Not a Substitute for Veterinary Advice</h2>
        <div style="background:#FFF3CD;border-left:4px solid #FFC107;padding:20px 24px;border-radius:0 12px 12px 0;margin:20px 0">
          <strong>⚠️ Important Medical Disclaimer:</strong>
          <p style="margin:8px 0 0">The information, tools, and content provided on <?php echo esc_html($site_name); ?> are for <strong>educational and informational purposes only</strong>. They are NOT a substitute for professional veterinary advice, diagnosis, or treatment. Always consult a qualified veterinarian regarding any questions you may have about your pet's health, nutrition, or medical condition. Never disregard professional veterinary advice or delay seeking it because of something you have read or used on this Site.</p>
        </div>

        <h2>4. Use of Our Tools</h2>
        <p>Our free pet care tools are designed to provide general guidance based on commonly accepted veterinary and nutritional guidelines. By using our tools, you acknowledge that:</p>
        <ul>
          <li>Results are estimates and general guidelines, not personalized veterinary prescriptions.</li>
          <li>Individual pets may have unique medical conditions that require customized care from a licensed veterinarian.</li>
          <li>You will not rely solely on our tool results for critical health decisions regarding your pet.</li>
          <li>We are not liable for any harm, injury, or illness to your pet resulting from use of our tools.</li>
        </ul>

        <h2>5. Intellectual Property</h2>
        <p>All content on <?php echo esc_html($site_name); ?>, including but not limited to text, graphics, logos, images, audio clips, digital downloads, data compilations, and software, is the property of <?php echo esc_html($site_name); ?> or its content suppliers and is protected by applicable intellectual property laws.</p>
        <ul>
          <li>You may not reproduce, distribute, modify, create derivative works of, publicly display, or otherwise exploit any content from this Site without our prior written permission.</li>
          <li>You may share links to our content, provided you give proper credit to <?php echo esc_html($site_name); ?>.</li>
          <li>Limited, non-commercial personal use of our free tools is permitted.</li>
        </ul>

        <h2>6. User Conduct</h2>
        <p>You agree not to use our Site to:</p>
        <ul>
          <li>Violate any applicable laws or regulations</li>
          <li>Submit false, misleading, or harmful information</li>
          <li>Attempt to gain unauthorized access to our systems or other users' accounts</li>
          <li>Transmit any viruses, malware, or other harmful code</li>
          <li>Engage in any activity that disrupts or interferes with our Site's functionality</li>
          <li>Scrape, crawl, or use automated means to collect data from our Site without written permission</li>
          <li>Use our tools for commercial resale or redistribution without authorization</li>
        </ul>

        <h2>7. Advertising and Third-Party Services</h2>
        <p>Our Site displays advertisements through <strong>Google AdSense</strong>. These advertisements are served by Google and may be based on your browsing history. We are not responsible for the content of third-party advertisements or the products/services they promote.</p>
        <p>Our Site may also contain links to third-party websites. We have no control over the content, privacy policies, or practices of these websites and are not responsible for any loss or damage arising from your use of them.</p>

        <h2>8. Disclaimer of Warranties</h2>
        <p>Our Site and all tools are provided on an "<strong>as is</strong>" and "<strong>as available</strong>" basis, without warranties of any kind, either express or implied, including but not limited to implied warranties of merchantability, fitness for a particular purpose, or non-infringement.</p>
        <p><?php echo esc_html($site_name); ?> does not warrant that:</p>
        <ul>
          <li>The Site will be uninterrupted, error-free, or secure</li>
          <li>Results obtained from using our tools will be accurate or reliable</li>
          <li>Any errors in the Site will be corrected</li>
        </ul>

        <h2>9. Limitation of Liability</h2>
        <p>To the fullest extent permitted by law, <?php echo esc_html($site_name); ?> and its owners, employees, and affiliates shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including without limitation, loss of profits, data, goodwill, or other intangible losses, resulting from:</p>
        <ul>
          <li>Your use or inability to use our Site or tools</li>
          <li>Any harm to your pet resulting from following recommendations from our tools</li>
          <li>Any unauthorized access to or use of our servers or personal information</li>
          <li>Any bugs, viruses, or other harmful code transmitted through our Site</li>
        </ul>

        <h2>10. Privacy Policy</h2>
        <p>Your use of our Site is also governed by our <a href="<?php echo home_url('/privacy-policy/'); ?>">Privacy Policy</a>, which is incorporated into these Terms by reference. Please review our Privacy Policy to understand our practices.</p>

        <h2>11. Changes to Terms</h2>
        <p>We reserve the right to modify these Terms at any time. We will provide notice of significant changes by updating the "Last updated" date at the top of this page. Your continued use of the Site after any changes constitutes your acceptance of the new Terms. We encourage you to review these Terms periodically.</p>

        <h2>12. Termination</h2>
        <p>We reserve the right to terminate or suspend your access to our Site immediately, without prior notice or liability, for any reason, including without limitation if you breach these Terms.</p>

        <h2>13. Governing Law</h2>
        <p>These Terms shall be governed by and construed in accordance with the laws of the United States, without regard to conflict of law provisions. Any disputes arising under these Terms shall be subject to the exclusive jurisdiction of the courts located in the United States.</p>

        <h2>14. Severability</h2>
        <p>If any provision of these Terms is held to be invalid or unenforceable, the remaining provisions will continue in full force and effect.</p>

        <h2>15. Contact Us</h2>
        <p>If you have any questions about these Terms of Service, please contact us:</p>
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
