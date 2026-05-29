<?php
/**
 * Archive / Category Template — PetZenAI
 */
get_header();
$title = get_the_archive_title();
$desc  = get_the_archive_description();
$paged = get_query_var('paged') ?: 1;
?>

<section class="pz-page-hero">
  <div class="pz-page-hero-bg" aria-hidden="true"></div>
  <div class="container pz-page-hero-content">
    <span class="section-tag">Pet Health Blog</span>
    <h1 class="pz-page-hero-title"><?php echo wp_strip_all_tags($title); ?></h1>
    <?php if($desc): ?><p class="pz-page-hero-desc"><?php echo wp_strip_all_tags($desc); ?></p><?php endif; ?>
  </div>
</section>

<section class="section" aria-label="Archive Posts">
  <div class="container">
    <?php if(have_posts()): ?>
    <div class="blog-grid">
      <?php while(have_posts()): the_post(); ?>
      <article class="blog-card" data-aos itemscope itemtype="https://schema.org/BlogPosting">
        <a href="<?php the_permalink(); ?>" class="blog-card-img-wrap" aria-label="<?php the_title_attribute(); ?>">
          <?php if(has_post_thumbnail()): the_post_thumbnail('petzenai-thumb',['loading'=>'lazy','itemprop'=>'image']);
          else: ?>
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
          <p class="blog-card-desc"><?php echo wp_trim_words(get_the_excerpt(),20); ?></p>
          <div class="blog-card-footer">
            <span class="blog-card-date">📅 <?php echo get_the_date('M j, Y'); ?></span>
            <a href="<?php the_permalink(); ?>" class="blog-read-more">Read More →</a>
          </div>
        </div>
      </article>
      <?php endwhile; ?>
    </div>
    <div style="text-align:center;margin-top:56px">
      <?php echo paginate_links(['prev_text'=>'← Previous','next_text'=>'Next →']); ?>
    </div>
    <?php else: ?>
    <div style="text-align:center;padding:80px 0">
      <div style="font-size:64px;margin-bottom:16px">🐾</div>
      <h2 style="font-size:24px;font-weight:800">No posts found</h2>
      <p style="color:#888;margin-top:8px">Check back soon!</p>
      <a href="<?php echo home_url('/'); ?>" class="btn-primary" style="display:inline-flex;margin-top:24px">← Back to Home</a>
    </div>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
