<?php
/**
 * Template Name: Tools Listing Page
 * Template Post Type: page
 * Description: Shows all 6 pet care tools in a grid.
 */
get_header();
?>

<!-- Hero -->
<section class="pz-page-hero" aria-label="Tools Page Hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">100% Free</span>
    <h1 class="pz-page-hero-title">All Pet Care Tools</h1>
    <p class="pz-page-hero-desc">6 free, science-based tools to help you feed, track, and care for your pet — no sign-up needed.</p>
  </div>
</section>

<!-- Tools Grid -->
<section class="section" aria-label="All Tools">
  <div class="container">
    <div class="tools-grid">
      <?php
      $tools = [
        ['🍽️','Pet Food Portion Calculator',
         'Calculate the perfect daily food portions for dogs, cats, birds, rabbits and more based on weight, age & activity level.',
         '/tools/pet-food-portion-calculator/', 'Dogs · Cats · Rabbits · Birds'],
        ['🎂','Pet Age Calculator',
         'Convert your pet\'s age to human years using science-backed, breed-specific formulas — not the "multiply by 7" myth.',
         '/tools/pet-age-calculator/', 'Dogs · Cats · Rabbits · Birds · Hamsters'],
        ['💉','Vaccination Schedule Tracker',
         'Get a complete vet-recommended vaccination schedule. See overdue, upcoming, and completed vaccines at a glance.',
         '/tools/pet-vaccination-schedule/', 'Dogs · Cats'],
        ['✨','AI Pet Name Generator',
         'Find the perfect name from 10,000+ options — filtered by pet type, gender, personality, and starting letter.',
         '/tools/ai-pet-name-generator/', 'All Pets'],
        ['🏃','Pet Exercise Calculator',
         'Discover how much daily exercise your pet needs based on breed energy level, age, weight, and health condition.',
         '/tools/pet-exercise-calculator/', 'Dogs · Cats · Rabbits · Birds'],
        ['❓','What Pet Should I Get?',
         'Answer 10 lifestyle questions and our AI matches you with your perfect companion pet.',
         '/tools/what-pet-should-i-get/', 'All Pet Types'],
      ];
      foreach ( $tools as $i => $t ): ?>
      <article class="tool-card" data-aos data-aos-delay="<?php echo $i * 80; ?>"
        itemscope itemtype="https://schema.org/SoftwareApplication">
        <div class="tool-card-glow" aria-hidden="true"></div>
        <div class="tool-icon-wrap" aria-hidden="true">
          <span class="tool-icon"><?php echo $t[0]; ?></span>
        </div>
        <h2 class="tool-title" itemprop="name"><?php echo esc_html($t[1]); ?></h2>
        <p class="tool-desc" itemprop="description"><?php echo esc_html($t[2]); ?></p>
        <p style="font-size:12px;color:#999;margin-bottom:16px;font-weight:600">
          Works for: <?php echo esc_html($t[4]); ?>
        </p>
        <a href="<?php echo home_url($t[3]); ?>" class="tool-link" itemprop="url">
          Use Tool Free <span class="tool-link-arrow">→</span>
        </a>
        <div class="tool-card-paw" aria-hidden="true">🐾</div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section" style="padding:60px 0" aria-label="CTA">
  <div class="cta-paw-bg" aria-hidden="true">🐾</div>
  <div class="container">
    <div class="cta-content" data-aos style="padding:0">
      <h2 class="cta-title" style="font-size:36px">All Tools Are 100% Free 🐾</h2>
      <p class="cta-desc">No sign-up, no credit card, no limit. Use as many times as you need.</p>
      <div class="cta-trust-badges" style="margin-top:16px">
        <span>✅ No Sign-Up</span><span>✅ Vet-Approved</span>
        <span>✅ Science-Based</span><span>✅ Instant Results</span>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
