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
      $pz_counts = [];
      require_once get_template_directory() . '/inc/tool-registry.php';
      if ( function_exists('pz_get_tool_categories') && function_exists('pz_get_all_tools') ) {
          foreach ( pz_get_all_tools() as $t ) { $pz_counts[ $t['cat'] ] = ( $pz_counts[ $t['cat'] ] ?? 0 ) + 1; }
          foreach ( pz_get_tool_categories() as $slug => $c ) {
              if ( ! empty( $pz_counts[ $slug ] ) ) { $pz_nav_cats[ $slug ] = $c; }
          }
      }
      // Group categories by pet for the mega menu; anything unlisted lands in "More".
      $pz_nav_groups = [
          [ 'title' => 'Dogs',       'icon' => '🐕', 'color' => '#FF6B1A', 'cats' => [ 'dog-grooming', 'dog-health', 'dog-nutrition', 'dog-training' ] ],
          [ 'title' => 'Cats',       'icon' => '🐱', 'color' => '#FF3D81', 'cats' => [ 'cat-grooming', 'cat-health', 'cat-nutrition' ] ],
          [ 'title' => 'Other Pets', 'icon' => '🐾', 'color' => '#00C2FF', 'cats' => [ 'bird-care', 'rabbit-care', 'fish-aquarium', 'reptile-care', 'small-pets' ] ],
          [ 'title' => 'All Pets',   'icon' => '✨', 'color' => '#B388FF', 'cats' => [ 'general-pet', 'pet-behavior', 'pet-safety' ] ],
      ];
      $pz_listed = array_merge( ...array_column( $pz_nav_groups, 'cats' ) );
      $pz_more = array_diff( array_keys( $pz_nav_cats ), $pz_listed );
      if ( $pz_more ) { $pz_nav_groups[] = [ 'title' => 'More', 'icon' => '➕', 'color' => '#7C4DFF', 'cats' => array_values( $pz_more ) ]; }
      $pz_total_tools = array_sum( $pz_counts );
      ?>
      <li role="none" class="nav-item-has-sub">
        <a href="<?php echo home_url('/tools/'); ?>" role="menuitem"<?php if ( $pz_nav_cats ) echo ' aria-haspopup="true"'; ?>>Tools</a>
        <?php if ( $pz_nav_cats ) : ?>
        <button type="button" class="nav-sub-toggle" aria-label="Show tool categories" aria-expanded="false"><span aria-hidden="true">▾</span></button>
        <div class="nav-sub" role="menu">
          <div class="nav-mega-head">
            <strong>Explore our pet tools</strong>
            <span><?php echo esc_html( number_format_i18n( $pz_total_tools ) ); ?> free calculators, checkers &amp; guides</span>
          </div>
          <div class="nav-mega-grid">
            <?php foreach ( $pz_nav_groups as $g ) :
                $cats = array_filter( $g['cats'], function ( $k ) use ( $pz_nav_cats ) { return isset( $pz_nav_cats[ $k ] ); } );
                if ( ! $cats ) continue; ?>
            <div class="nav-mega-col" style="--g:<?php echo esc_attr( $g['color'] ); ?>">
              <div class="nav-mega-title"><span aria-hidden="true"><?php echo esc_html( $g['icon'] ); ?></span> <?php echo esc_html( $g['title'] ); ?></div>
              <ul role="none">
                <?php foreach ( $cats as $slug ) : $c = $pz_nav_cats[ $slug ]; ?>
                <li role="none"><a href="<?php echo esc_url( home_url( '/tools/' . $slug . '/' ) ); ?>" role="menuitem"><span class="nav-sub-icon" aria-hidden="true"><?php echo esc_html( $c['icon'] ); ?></span><span class="nav-sub-txt"><?php echo esc_html( $c['label'] ); ?></span><span class="nav-sub-count"><?php echo (int) $pz_counts[ $slug ]; ?></span></a></li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endforeach; ?>
          </div>
          <a class="nav-mega-foot" href="<?php echo home_url('/tools/'); ?>" role="menuitem">View all tools <span aria-hidden="true">→</span></a>
        </div>
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
