<?php if(!defined('ABSPATH')) exit; ?>
<nav class="ht-breadcrumb" aria-label="Breadcrumb">
  <a href="<?php echo home_url('/'); ?>">🏠 Home</a><span>›</span>
  <a href="<?php echo home_url('/tools/'); ?>">All Tools</a><span>›</span>
  <?php the_title(); ?>
</nav>
