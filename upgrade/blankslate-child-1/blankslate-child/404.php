<?php get_header(); ?>
<div class="card">
  <h1><?php _e('Page not found', 'blankslate-child'); ?></h1>
  <p class="post-meta"><?php _e('Sorry, the page you’re looking for doesn’t exist.', 'blankslate-child'); ?></p>
  <p><a class="button" href="<?php echo esc_url(home_url('/')); ?>"><?php _e('Back to home', 'blankslate-child'); ?></a></p>
</div>
<?php get_footer(); ?>
