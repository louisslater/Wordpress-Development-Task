<?php get_header(); ?>
<section>
  <?php if (have_posts()): while (have_posts()): the_post(); ?>
    <article <?php post_class('card post-item'); ?>>
      <?php if (has_post_thumbnail()): ?>
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('large'); ?></a>
      <?php endif; ?>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <p class="post-meta">
        <?php echo get_the_date(); ?>
        <?php _e(' • by ', 'blankslate-child'); the_author(); ?>
      </p>
      <div><?php the_excerpt(); ?></div>
      <a class="button read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'blankslate-child'); ?></a>
    </article>
  <?php endwhile;

    the_posts_pagination([
      'mid_size'  => 2,
      'prev_text' => __('← Prev', 'blankslate-child'),
      'next_text' => __('Next →', 'blankslate-child'),
    ]);

  else: ?>
    <div class="card"><p><?php _e('No content found.', 'blankslate-child'); ?></p></div>
  <?php endif; ?>
</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
