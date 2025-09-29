<?php get_header(); ?>
<article <?php post_class('card'); ?>>
  <?php if (have_posts()): the_post(); ?>
    <h1><?php the_title(); ?></h1>
    <div class="entry-content"><?php the_content(); ?></div>
    <?php wp_link_pages(); ?>
    <?php if (comments_open() || get_comments_number()) comments_template(); ?>
  <?php endif; ?>
</article>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
