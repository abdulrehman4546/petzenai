<?php
/**
 * Template Name: Blog Archive Page
 * Template Post Type: page
 */
get_header();
$paged = get_query_var('paged') ?: 1;
$posts = new WP_Query(['posts_per_page' => 9, 'post_status' => 'publish', 'paged' => $paged]);
?>

<!-- Page Hero -->
<section class="pz-page-hero" aria-label="Blog Hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">Pet Health Blog</span>
    <h1 class="pz-page-hero-title">Pet Care Articles</h1>
    <p class="pz-page-hero-desc">Expert-written guides on pet nutrition, health, and wellness — updated weekly.</p>
  </div>
</section>

<main>
  <section class="section" aria-label="Blog Posts">
    <div class="container">
      <?php if ( $posts->have_posts() ): ?>
        <div class="blog-grid">
          <?php while ( $posts->have_posts() ): $posts->the_post(); ?>
          <article class="blog-card" data-aos itemscope itemtype="https://schema.org/BlogPosting">
            <a href="<?php the_permalink(); ?>" class="blog-card-img-wrap" aria-label="<?php the_title_attribute(); ?>">
              <?php if ( has_post_thumbnail() ): ?>
                <?php the_post_thumbnail('petzenai-thumb', ['loading' => 'lazy', 'itemprop' => 'image']); ?>
              <?php else: ?>
                <img src="https://images.unsplash.com/photo-1450778869180-41d0601e046e?w=600&q=80&auto=format&fit=crop"
                     alt="<?php the_title_attribute(); ?>" loading="lazy" width="600" height="280">
              <?php endif; ?>
              <div class="blog-card-overlay" aria-hidden="true"></div>
            </a>
            <div class="blog-card-body">
              <span class="blog-card-cat"><?php echo get_the_category_list(', ') ?: 'Pet Health'; ?></span>
              <h2 class="blog-card-title" itemprop="headline">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <p class="blog-card-desc"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
              <div class="blog-card-footer">
                <span class="blog-card-date" itemprop="datePublished">📅 <?php echo get_the_date('M j, Y'); ?></span>
                <a href="<?php the_permalink(); ?>" class="blog-read-more">Read More →</a>
              </div>
            </div>
          </article>
          <?php endwhile; wp_reset_postdata(); ?>
        </div>

        <!-- Pagination -->
        <div style="text-align:center;margin-top:60px">
          <?php
          echo paginate_links([
            'total'   => $posts->max_num_pages,
            'current' => $paged,
            'prev_text' => '← Previous',
            'next_text' => 'Next →',
          ]);
          ?>
        </div>

      <?php else: ?>
        <div style="text-align:center;padding:80px 0">
          <div style="font-size:64px;margin-bottom:16px">📝</div>
          <h2 style="font-size:24px;font-weight:800;color:#0D0D0D;margin-bottom:8px">No Posts Yet</h2>
          <p style="color:#888">Check back soon — we publish new pet care guides every week.</p>
        </div>
      <?php endif; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>
