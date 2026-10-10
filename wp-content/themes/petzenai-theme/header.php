<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#FF6B1A">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Preloader -->
<div id="preloader">
  <div class="preloader-paw">🐾</div>
</div>

<!-- Navbar -->
<nav class="navbar" id="navbar" role="navigation" aria-label="Main Navigation">
  <div class="nav-container">
    <a href="<?php echo home_url('/'); ?>" class="nav-logo" aria-label="PetZenAI Home">
      <span class="logo-icon">🐾</span>
      PetZen<span>AI</span>
    </a>
    <ul class="nav-menu" id="navMenu" role="menubar">
      <li role="none"><a href="<?php echo home_url('/'); ?>" role="menuitem">Home</a></li>
      <?php
      $pz_nav_cats = [];
      require_once get_template_directory() . '/inc/tool-registry.php';
      if ( function_exists('pz_get_tool_categories') && function_exists('pz_get_all_tools') ) {
          $pz_counts = [];
          foreach ( pz_get_all_tools() as $t ) { $pz_counts[ $t['cat'] ] = ( $pz_counts[ $t['cat'] ] ?? 0 ) + 1; }
          foreach ( pz_get_tool_categories() as $slug => $c ) {
              if ( ! empty( $pz_counts[ $slug ] ) ) { $pz_nav_cats[ $slug ] = $c; }
          }
      }
      ?>
      <li role="none" class="nav-item-has-sub">
        <a href="<?php echo home_url('/tools/'); ?>" role="menuitem"<?php if ( $pz_nav_cats ) echo ' aria-haspopup="true"'; ?>>Tools</a>
        <?php if ( $pz_nav_cats ) : ?>
        <button type="button" class="nav-sub-toggle" aria-label="Show tool categories" aria-expanded="false"><span aria-hidden="true">▾</span></button>
        <ul class="nav-sub" role="menu">
          <?php foreach ( $pz_nav_cats as $slug => $c ) : ?>
          <li role="none"><a href="<?php echo esc_url( home_url( '/tools/' . $slug . '/' ) ); ?>" role="menuitem"><span class="nav-sub-icon" aria-hidden="true"><?php echo esc_html( $c['icon'] ); ?></span> <?php echo esc_html( $c['label'] ); ?></a></li>
          <?php endforeach; ?>
          <li role="none" class="nav-sub-all"><a href="<?php echo home_url('/tools/'); ?>" role="menuitem">View all tools →</a></li>
        </ul>
        <?php endif; ?>
      </li>
      <li role="none"><a href="<?php echo home_url('/blog/'); ?>" role="menuitem">Blog</a></li>
      <li role="none"><a href="<?php echo home_url('/about/'); ?>" role="menuitem">About Us</a></li>
      <li role="none"><a href="<?php echo home_url('/contact/'); ?>" class="nav-cta" role="menuitem">Contact Us</a></li>
    </ul>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle Menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>
