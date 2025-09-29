<?php
if (post_password_required()) return;
?>
<section id="comments" class="card">
  <?php if (have_comments()): ?>
    <h2><?php
      printf(_nx('One comment', '%1$s comments', get_comments_number(), 'comments title', 'blankslate-child'),
      number_format_i18n(get_comments_number()));
    ?></h2>

    <ol class="comment-list">
      <?php wp_list_comments(['style'=>'ol','short_ping'=>true]); ?>
    </ol>

    <?php the_comments_pagination([
      'prev_text' => __('← Older', 'blankslate-child'),
      'next_text' => __('Newer →', 'blankslate-child'),
    ]); ?>

  <?php endif; ?>

  <?php if (!comments_open() && get_comments_number()): ?>
    <p class="post-meta"><?php _e('Comments are closed.', 'blankslate-child'); ?></p>
  <?php endif; ?>

  <?php comment_form(); ?>
</section>
