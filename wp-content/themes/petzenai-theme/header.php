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
      <li role="none"><a href="<?php echo home_url('/tools/'); ?>" role="menuitem">Tools</a></li>
      <li role="none"><a href="<?php echo home_url('/blog/'); ?>" role="menuitem">Blog</a></li>
      <li role="none"><a href="<?php echo home_url('/about/'); ?>" role="menuitem">About Us</a></li>
      <li role="none"><a href="<?php echo home_url('/contact/'); ?>" class="nav-cta" role="menuitem">Contact Us</a></li>
    </ul>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle Menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</nav>
