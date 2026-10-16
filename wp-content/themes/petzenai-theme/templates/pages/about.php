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
    <p class="pz-page-hero-desc">Clear, practical pet-care help — not guesswork. That's why we built these free tools.</p>
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
            PetZenAI is built on a simple belief: every pet owner should have clear, practical pet-care information, such as how much to feed, how often to groom and what is unsafe, available for free and in plain language.
          </p>
          <p style="font-size:16px;color:#555;line-height:1.8;margin-bottom:24px">
            PetZenAI is an independent educational project run by a small team of pet owners and developers. We turn published pet-care guidance and standard formulas into calculators, checkers and guides that are easy to use on any phone.
          </p>
          <div class="cta-trust-badges" style="justify-content:flex-start;margin:0">
            <span style="background:rgba(255,107,26,0.08);color:var(--orange)">✅ Free to Use</span>
            <span style="background:rgba(255,107,26,0.08);color:var(--orange)">✅ Educational</span>
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
        require_once get_template_directory() . '/inc/tool-registry.php';
        $pz_all  = pz_get_all_tools();
        $stats = [
          [ (string) count( $pz_all ), 'Free Tools' ],
          [ (string) count( array_unique( array_column( $pz_all, 'cat' ) ) ), 'Tool Categories' ],
          [ (string) count( array_diff( array_unique( array_column( $pz_all, 'animal' ) ), [ 'all', 'small' ] ) ), 'Pet Types' ],
          [ '30+', 'Blog Guides' ],
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

  <!-- How it works / editorial approach / advertising -->
  <section class="section" aria-label="How PetZenAI Works">
    <div class="container" style="max-width:820px">
      <div class="section-header" data-aos>
        <span class="section-tag">Transparency</span>
        <h2 class="section-title">How PetZenAI <span>Works</span></h2>
      </div>
      <div style="font-size:16px;color:#444;line-height:1.85">
        <h3 style="font-size:20px;margin:0 0 8px;color:#0D0D0D">What you can find here</h3>
        <?php
        $pz_about_counts = [];
        foreach ( $pz_all as $pz_t ) { $pz_about_counts[ $pz_t['cat'] ] = ( $pz_about_counts[ $pz_t['cat'] ] ?? 0 ) + 1; }
        $pz_about_cats = pz_get_tool_categories();
        ?>
        <p>PetZenAI has free tools and guides for dogs, cats, birds, rabbits, fish, reptiles and small pets, grouped into categories you can browse:</p>
        <ul style="margin:0 0 16px 22px">
          <?php foreach ( $pz_about_cats as $pz_slug => $pz_c ) : if ( empty( $pz_about_counts[ $pz_slug ] ) ) continue; ?>
          <li><a href="<?php echo esc_url( home_url( '/tools/' . $pz_slug . '/' ) ); ?>" style="color:var(--orange);font-weight:600"><?php echo esc_html( $pz_c['label'] ); ?></a>: <?php echo (int) $pz_about_counts[ $pz_slug ]; ?> tools</li>
          <?php endforeach; ?>
        </ul>
        <p>Our <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" style="color:var(--orange);font-weight:600">blog</a> adds longer guides on grooming, feeding and everyday pet care.</p>

        <h3 style="font-size:20px;margin:28px 0 8px;color:#0D0D0D">How our tools work</h3>
        <p>Our calculators use standard, widely published formulas, for example the Resting Energy Requirement (70 × body weight in kg<sup>0.75</sup>) for calorie estimates, and then adjust for life stage, neuter status and activity. Each tool page explains the method it uses, shows the result as a range because every pet is different, and runs in your browser. What you type into a calculator is not sent to our servers.</p>

        <h3 style="font-size:20px;margin:28px 0 8px;color:#0D0D0D">Our editorial approach</h3>
        <p>Our guides are written by the PetZenAI team from published pet-care information. Each tool page ends with links to veterinary and animal-welfare organisations such as the AVMA, the Merck Veterinary Manual, the ASPCA and WSAVA, so you can read the original guidance. We do not claim that pages are reviewed by veterinarians.</p>
        <p>PetZenAI is an educational resource, not a veterinary practice. Nothing on this site is veterinary advice, diagnosis or treatment. If your pet is unwell, or you are unsure, contact a licensed veterinarian. In an emergency, call your nearest emergency clinic or a poison helpline.</p>

        <h3 style="font-size:20px;margin:28px 0 8px;color:#0D0D0D">Corrections and updates</h3>
        <p>If you find something that looks wrong or out of date, please tell us at <a href="mailto:support@petzenai.com" style="color:var(--orange);font-weight:600">support@petzenai.com</a> or through the <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color:var(--orange);font-weight:600">contact page</a>. We review reports and correct pages when needed.</p>

        <h3 style="font-size:20px;margin:28px 0 8px;color:#0D0D0D">How the site is funded</h3>
        <p>PetZenAI is free to use and does not need an account. The site may show advertising, for example through Google AdSense, and some pages may contain affiliate links, which can earn a commission at no extra cost to you. Advertising does not decide what our tools calculate or what our guides say. See our <a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>" style="color:var(--orange);font-weight:600">Privacy Policy</a> for details on cookies and ads.</p>
      </div>
    </div>
  </section>

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
          ['🔬','Science First','Our tools use standard, widely published formulas and we link to veterinary organisations so you can read more.'],
          ['💚','Pet Welfare','We put the health and happiness of animals above everything else.'],
          ['🆓','Always Free','Quality pet care information should be accessible to everyone, regardless of budget.'],
          ['🤝','Community','We are building a community of informed, caring pet owners across America.'],
          ['🔒','Privacy','We never sell your data. No accounts required to use any of our tools.'],
          ['⚡','Accuracy','We review and update our tools regularly.'],
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
