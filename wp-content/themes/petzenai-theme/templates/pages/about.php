<?php
/**
 * Template Name: About Us Page
 * Template Post Type: page
 */
get_header();
?>

<!-- Page Hero -->
<section class="pz-page-hero" aria-label="About Hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">Our Story</span>
    <h1 class="pz-page-hero-title">About PetZenAI</h1>
    <p class="pz-page-hero-desc">We believe every pet deserves science-backed care — not guesswork. That's why we built these tools.</p>
  </div>
</section>

<main>
  <!-- Mission -->
  <section class="section" aria-label="Our Mission">
    <div class="container">
      <div class="why-grid">
        <div data-aos="fade-right">
          <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b?w=600&q=80&auto=format&fit=crop"
               alt="Dogs running — PetZenAI mission"
               width="560" height="420"
               style="border-radius:24px;width:100%;box-shadow:0 20px 60px rgba(0,0,0,0.12)"
               loading="lazy">
        </div>
        <div data-aos="fade-left">
          <span class="section-tag">Our Mission</span>
          <h2 class="section-title why-title">
            Healthier Pets Through<br><span>Better Information</span>
          </h2>
          <p style="font-size:16px;color:#555;line-height:1.8;margin-bottom:20px">
            PetZenAI was founded with a simple belief: every pet owner should have access to the same high-quality nutritional and health information that veterinarians use — for free.
          </p>
          <p style="font-size:16px;color:#555;line-height:1.8;margin-bottom:24px">
            Our team of veterinary nutritionists, data scientists, and passionate pet owners work together to build tools grounded in peer-reviewed science, not generic advice.
          </p>
          <div class="cta-trust-badges" style="justify-content:flex-start;margin:0">
            <span style="background:rgba(255,107,26,0.08);color:var(--orange)">✅ Vet-Reviewed</span>
            <span style="background:rgba(255,107,26,0.08);color:var(--orange)">✅ Science-Based</span>
            <span style="background:rgba(255,107,26,0.08);color:var(--orange)">✅ 100% Free</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats -->
  <section class="section section-dark" aria-label="Our Numbers">
    <div class="container">
      <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:32px;text-align:center">
        <?php
        $stats = [
          ['50,000+','Pet Owners Helped'],
          ['6','Free Tools'],
          ['10,000+','Pet Names'],
          ['4.9★','Average Rating'],
        ];
        foreach($stats as $s): ?>
        <div data-aos>
          <div style="font-size:44px;font-weight:900;color:var(--orange)"><?php echo $s[0]; ?></div>
          <div style="font-size:14px;color:rgba(255,255,255,0.5);margin-top:4px;font-weight:600"><?php echo $s[1]; ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Page content from editor -->
  <?php if ( have_posts() ): while ( have_posts() ): the_post(); ?>
    <?php if ( get_the_content() ): ?>
    <section class="section">
      <div class="container" style="max-width:800px">
        <div class="pz-page-content">
          <?php the_content(); ?>
        </div>
      </div>
    </section>
    <?php endif; ?>
  <?php endwhile; endif; ?>

  <!-- Values -->
  <section class="section section-alt" aria-label="Our Values">
    <div class="container">
      <div class="section-header" data-aos>
        <span class="section-tag">What We Stand For</span>
        <h2 class="section-title">Our Core <span>Values</span></h2>
      </div>
      <div class="tools-grid">
        <?php
        $values = [
          ['🔬','Science First','Every recommendation we make is backed by peer-reviewed veterinary research.'],
          ['💚','Pet Welfare','We put the health and happiness of animals above everything else.'],
          ['🆓','Always Free','Quality pet care information should be accessible to everyone, regardless of budget.'],
          ['🤝','Community','We are building a community of informed, caring pet owners across America.'],
          ['🔒','Privacy','We never sell your data. No accounts required to use any of our tools.'],
          ['⚡','Accuracy','We update our tools regularly to reflect the latest veterinary guidelines.'],
        ];
        foreach($values as $i => $v): ?>
        <article class="tool-card" data-aos data-aos-delay="<?php echo $i*80; ?>" style="padding:28px;text-align:center">
          <div class="tool-card-glow" aria-hidden="true"></div>
          <div class="tool-icon-wrap" aria-hidden="true"><span class="tool-icon"><?php echo $v[0]; ?></span></div>
          <h3 class="tool-title" style="font-size:17px"><?php echo esc_html($v[1]); ?></h3>
          <p class="tool-desc" style="font-size:13px"><?php echo esc_html($v[2]); ?></p>
          <div class="tool-card-paw" aria-hidden="true">🐾</div>
        </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>
