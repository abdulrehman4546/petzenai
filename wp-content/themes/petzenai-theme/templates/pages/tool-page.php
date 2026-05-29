<?php
/**
 * Template Name: Tool Page
 * Template Post Type: page
 * Description: Use for all 6 pet care tool pages. Add shortcode in content.
 */
get_header();
$title  = get_the_title();
$parent = wp_get_post_parent_id( get_the_ID() );
?>

<!-- Breadcrumb -->
<nav class="pz-breadcrumb" aria-label="Breadcrumb">
  <div class="container">
    <ol class="pz-breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?php echo home_url('/'); ?>" itemprop="item"><span itemprop="name">Home</span></a>
        <meta itemprop="position" content="1">
      </li>
      <span class="pz-bc-sep" aria-hidden="true">›</span>
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <a href="<?php echo home_url('/tools/'); ?>" itemprop="item"><span itemprop="name">Tools</span></a>
        <meta itemprop="position" content="2">
      </li>
      <span class="pz-bc-sep" aria-hidden="true">›</span>
      <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
        <span itemprop="name"><?php echo esc_html($title); ?></span>
        <meta itemprop="position" content="3">
      </li>
    </ol>
  </div>
</nav>

<main id="tool-main">
  <?php while (have_posts()): the_post(); ?>
    <?php the_content(); ?>
  <?php endwhile; ?>

  <!-- Ad: Below Tool -->
  <div class="container" style="padding-top:0;padding-bottom:8px">
    <?php petzenai_ad( 'petzenai_adsense_ad_tools', 'tools-page' ); ?>
  </div>
</main>

<!-- Related Tools -->
<section class="section section-alt pz-related-tools" aria-label="Other Free Tools">
  <div class="container">
    <div class="section-header" style="margin-bottom:40px">
      <span class="section-tag">More Free Tools</span>
      <h2 class="section-title" style="font-size:28px">You Might Also Like</h2>
    </div>
    <div class="tools-grid">
      <?php
      $all_tools = [
        ['🍽️','Pet Food Portion Calculator',  'Calculate perfect daily portions.',        '/pet-food-portion-calculator/'],
        ['🎂','Pet Age Calculator',             'Convert pet age to human years.',          '/pet-age-calculator/'],
        ['💉','Vaccination Schedule Tracker',  'Never miss a vaccine again.',              '/pet-vaccination-schedule/'],
        ['✨','AI Pet Name Generator',          '10,000+ unique AI-generated names.',       '/ai-pet-name-generator/'],
        ['🏃','Pet Exercise Calculator',        'Build the perfect exercise plan.',         '/pet-exercise-calculator/'],
        ['❓','What Pet Should I Get?',         'Find your ideal pet in 10 questions.',     '/what-pet-should-i-get/'],
      ];
      $current = '/' . get_post_field('post_name', get_the_ID()) . '/';
      $shown   = 0;
      foreach ( $all_tools as $t ):
        if ( $t[3] === $current || $shown >= 3 ) continue;
        $shown++;
      ?>
      <article class="tool-card" style="padding:28px">
        <div class="tool-card-glow" aria-hidden="true"></div>
        <div class="tool-icon-wrap" style="width:60px;height:60px;font-size:28px;margin-bottom:16px">
          <span class="tool-icon" aria-hidden="true"><?php echo $t[0]; ?></span>
        </div>
        <h3 class="tool-title" style="font-size:16px;margin-bottom:8px"><?php echo esc_html($t[1]); ?></h3>
        <p class="tool-desc" style="font-size:13px;margin-bottom:12px"><?php echo esc_html($t[2]); ?></p>
        <a href="<?php echo home_url($t[3]); ?>" class="tool-link" style="font-size:13px">
          Try Now <span class="tool-link-arrow">→</span>
        </a>
        <div class="tool-card-paw" aria-hidden="true">🐾</div>
      </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
