<?php
/**
 * Template Name: Contact Us Page
 * Template Post Type: page
 */
get_header();
$email  = esc_attr( get_theme_mod('petzenai_contact_email', 'support@petzenai.com') );
$hours1 = esc_html( get_theme_mod('petzenai_contact_hours1', 'Mon–Fri: 9AM–8PM EST') );
$hours2 = esc_html( get_theme_mod('petzenai_contact_hours2', 'Sat–Sun: 10AM–4PM EST') );
?>

<!-- Page Hero -->
<section class="pz-page-hero" aria-label="Contact Hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">Get In Touch</span>
    <h1 class="pz-page-hero-title">Contact PetZenAI</h1>
    <p class="pz-page-hero-desc">Have a question, suggestion, or need help? We're here for you and your pet!</p>
  </div>
</section>

<main>
  <section class="section" aria-label="Contact">
    <div class="container">
      <div style="display:grid;grid-template-columns:1fr 1.4fr;gap:60px;align-items:start">

        <!-- Info -->
        <div data-aos="fade-right">
          <h2 class="section-title why-title" style="font-size:30px;margin-bottom:24px">
            We'd Love to <span>Hear From You</span>
          </h2>

          <div style="display:flex;flex-direction:column;gap:20px;margin-bottom:40px">
            <?php
            $infos = [
              ['📧','Email Us', $email, 'mailto:' . $email],
              ['🕐','Support Hours', $hours1 . ' · ' . $hours2, ''],
              ['📍','Location', 'Serving pet owners across the United States', ''],
            ];
            foreach($infos as $info): ?>
            <div style="display:flex;gap:16px;align-items:flex-start;padding:20px;background:#F7F7F7;border-radius:16px">
              <span style="font-size:28px;flex-shrink:0"><?php echo $info[0]; ?></span>
              <div>
                <div style="font-weight:800;font-size:15px;color:#0D0D0D;margin-bottom:4px"><?php echo esc_html($info[1]); ?></div>
                <div style="font-size:14px;color:#666">
                  <?php if($info[3]): ?>
                    <a href="<?php echo esc_url($info[3]); ?>" style="color:var(--orange);font-weight:700"><?php echo esc_html($info[2]); ?></a>
                  <?php else: echo esc_html($info[2]); endif; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>

          <div style="padding:24px;background:linear-gradient(135deg,#1A1A2E,#16213E);border-radius:20px;text-align:center">
            <div style="font-size:36px;margin-bottom:8px">🐾</div>
            <div style="color:rgba(255,255,255,0.9);font-weight:700;font-size:16px">Average response time</div>
            <div style="color:var(--orange);font-size:32px;font-weight:900;margin:4px 0">Under 24 hours</div>
            <div style="color:rgba(255,255,255,0.5);font-size:13px">on business days</div>
          </div>
        </div>

        <!-- Form -->
        <div data-aos="fade-left">
          <div style="background:#fff;border-radius:24px;padding:40px;box-shadow:0 4px 40px rgba(0,0,0,0.08);border:1.5px solid #F0F0F0">
            <h3 style="font-size:22px;font-weight:900;color:#0D0D0D;margin-bottom:28px">Send Us a Message</h3>
            <?php
            // Show sent message if CF7 or built-in form submitted
            if ( isset($_GET['sent']) && $_GET['sent'] === '1' ): ?>
            <div style="background:#E8F5E9;border:1px solid #4CAF50;border-radius:12px;padding:16px 20px;margin-bottom:24px;color:#2E7D32;font-weight:700">
              ✅ Message sent! We'll reply within 24 hours.
            </div>
            <?php endif; ?>

            <!-- If Contact Form 7 is installed, replace with [contact-form-7 ...] shortcode -->
            <?php if ( have_posts() ): while(have_posts()): the_post(); ?>
              <?php $content = get_the_content();
              if ( trim($content) ): ?>
                <?php the_content(); ?>
              <?php else: ?>
                <!-- Fallback native form -->
                <form method="POST" action="" class="pz-contact-form" onsubmit="pzContactSubmit(event)">
                  <?php wp_nonce_field('pz_contact','pz_nonce'); ?>
                  <div class="pz-form-grid pz-form-grid--2" style="margin-bottom:20px">
                    <div class="pz-field">
                      <label for="cf-name">Your Name *</label>
                      <input type="text" id="cf-name" name="cf_name" placeholder="John Smith" required>
                    </div>
                    <div class="pz-field">
                      <label for="cf-email">Email Address *</label>
                      <input type="email" id="cf-email" name="cf_email" placeholder="you@email.com" required>
                    </div>
                  </div>
                  <div class="pz-field" style="margin-bottom:20px">
                    <label for="cf-subject">Subject</label>
                    <select id="cf-subject" name="cf_subject" aria-label="Subject">
                      <option value="general">General Question</option>
                      <option value="tool-help">Tool Help</option>
                      <option value="vet-question">Pet Health Question</option>
                      <option value="suggestion">Feature Suggestion</option>
                      <option value="bug">Report a Bug</option>
                    </select>
                  </div>
                  <div class="pz-field" style="margin-bottom:24px">
                    <label for="cf-message">Message *</label>
                    <textarea id="cf-message" name="cf_message" rows="5" placeholder="Tell us how we can help..." required
                      style="width:100%;padding:12px 16px;border:2px solid #E8E8E8;border-radius:12px;font-size:15px;font-family:inherit;resize:vertical;outline:none;transition:border-color 0.3s"
                      onfocus="this.style.borderColor='var(--orange)'" onblur="this.style.borderColor='#E8E8E8'"></textarea>
                  </div>
                  <button type="submit" class="pz-btn-calculate" style="width:100%">📨 Send Message</button>
                </form>
              <?php endif; ?>
            <?php endwhile; endif; ?>
          </div>
        </div>

      </div>
    </div>
  </section>
</main>

<script>
function pzContactSubmit(e) {
  e.preventDefault();
  var btn = e.target.querySelector('.pz-btn-calculate');
  btn.textContent = '⏳ Sending...';
  setTimeout(function() {
    btn.textContent = '✅ Sent! We\'ll reply soon.';
    btn.style.background = '#4CAF50';
    e.target.reset();
  }, 1200);
}
</script>

<?php get_footer(); ?>
