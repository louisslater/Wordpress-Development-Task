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
    <a class="site-home" href="<?php echo esc_url(home_url('/')); ?>">
      <img class="custom-logo" 
           src="<?php echo esc_url('http://wordpress-task.local/wp-content/uploads/2025/10/Superior1022x1024.jpg'); ?>" 
           alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
    </a>
    <?php if (get_bloginfo('description')): ?>
      <p class="site-description"><?php bloginfo('description'); ?></p>
    <?php endif; ?>

    <!-- Search Form -->
    <div class="site-search">
      <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
        <input type="search" class="search-field" 
               placeholder="<?php echo esc_attr_x('Search…', 'placeholder'); ?>" 
               value="<?php echo get_search_query(); ?>" name="s" />
        <button type="submit" class="search-submit">
          <?php echo esc_html_x('Search', 'submit button'); ?>
        </button>
      </form>
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