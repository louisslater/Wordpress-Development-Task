<?php get_header(); ?>
<article <?php post_class('card'); ?>>
  <?php if (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <p class="post-meta">
      <?php echo get_the_date(); ?> • <?php _e('by', 'blankslate-child'); ?> <?php the_author(); ?>
      <?php the_category(' • '); ?>
    </p>
    <?php if (has_post_thumbnail()) the_post_thumbnail('large'); ?>
    <div class="entry-content"><?php the_content(); ?></div>
    <?php wp_link_pages(); ?>
    <?php the_tags('<p class="post-meta">Tags: ', ', ', '</p>'); ?>
    <?php comments_template(); ?>
  <?php endif; ?>
</article>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
