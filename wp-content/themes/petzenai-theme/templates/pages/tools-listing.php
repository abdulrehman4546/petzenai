<?php
/**
 * Template Name: Tools Listing Page
 * Template Post Type: page
 * Description: Dynamically lists all tool pages using the auto-tool template.
 */
get_header();
?>

<!-- Hero -->
<section class="pz-page-hero" aria-label="Tools Page Hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">100% Free</span>
    <h1 class="pz-page-hero-title">All Pet Care Tools</h1>
    <p class="pz-page-hero-desc">Free, science-based tools to help you feed, track, and care for your pet — no sign-up needed.</p>
  </div>
</section>

<!-- Tools Grid -->
<section class="section" aria-label="All Tools">
  <div class="container">
    <?php
    $tools_query = new WP_Query([
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'templates/pages/auto-tool.php',
        'orderby'        => 'title',
        'order'          => 'ASC',
    ]);
    ?>
    <div class="tools-grid">
      <?php if ( $tools_query->have_posts() ) :
        $i = 0;
        while ( $tools_query->have_posts() ) : $tools_query->the_post();
          $tool_icon = get_post_meta( get_the_ID(), 'pz_tool_icon', true ) ?: '🐾';
          $works_for = get_post_meta( get_the_ID(), 'pz_works_for', true );
          $excerpt   = get_the_excerpt();
      ?>
      <article class="tool-card" data-aos data-aos-delay="<?php echo ( $i % 6 ) * 80; ?>"
        itemscope itemtype="https://schema.org/SoftwareApplication">
        <div class="tool-card-glow" aria-hidden="true"></div>
        <div class="tool-icon-wrap" aria-hidden="true">
          <span class="tool-icon"><?php echo esc_html( $tool_icon ); ?></span>
        </div>
        <h2 class="tool-title" itemprop="name"><?php the_title(); ?></h2>
        <?php if ( $excerpt ) : ?>
        <p class="tool-desc" itemprop="description"><?php echo esc_html( $excerpt ); ?></p>
        <?php endif; ?>
        <?php if ( $works_for ) : ?>
        <p style="font-size:12px;color:#999;margin-bottom:16px;font-weight:600">
          Works for: <?php echo esc_html( $works_for ); ?>
        </p>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>" class="tool-link" itemprop="url">
          Use Tool Free <span class="tool-link-arrow">→</span>
        </a>
        <div class="tool-card-paw" aria-hidden="true">🐾</div>
      </article>
      <?php $i++; endwhile; wp_reset_postdata();
      else : ?>
      <p style="text-align:center;color:#888;padding:40px 0">No tools found.</p>
      <?php endif; ?>
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
