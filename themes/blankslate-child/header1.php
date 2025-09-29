<?php
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<header class="site-header">
  <div class="container brand">
    <div>
      <a class="site-title" href="<?php echo esc_url(home_url('/')); ?>">
        <?php bloginfo('name'); ?>
      </a>
      <?php if (get_bloginfo('description')): ?>
        <p class="site-description"><?php bloginfo('description'); ?></p>
      <?php endif; ?>
    </div>
  </div>

  <?php if (has_nav_menu('primary')): ?>
  <nav class="site-nav" aria-label="<?php esc_attr_e('Primary', 'blankslate-child'); ?>">
    <div class="container">
      <?php wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => '',
        'menu_class'     => 'menu',
        'depth'          => 1,
      ]); ?>
    </div>
  </nav>
  <?php endif; ?>
</header>

<main class="container main">
