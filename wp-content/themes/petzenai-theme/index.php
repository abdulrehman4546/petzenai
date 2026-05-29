<?php get_header(); ?>
<main style="padding:120px 24px;text-align:center;min-height:60vh;">
  <h1 style="font-size:32px;font-weight:900;color:#0D0D0D;margin-bottom:16px;">
    <?php wp_title(''); ?>
  </h1>
  <div class="container">
    <?php if (have_posts()): while (have_posts()): the_post(); ?>
      <article><?php the_content(); ?></article>
    <?php endwhile; else: ?>
      <p style="color:#666;">No content found.</p>
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>
