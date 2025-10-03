<?php
/**
 * Single Case Study
 * Template for post type: case-study
 */
get_header();

// helper to pull either ACF or plain meta
$meta = function($key) {
  return function_exists('get_field') ? get_field($key) : get_post_meta(get_the_ID(), $key, true);
};
?>

<article <?php post_class('card'); ?> style="grid-column:1 / -1">
  <?php if (have_posts()): the_post(); ?>

    <header class="cs-header">
      <h1><?php the_title(); ?></h1>
      <p class="post-meta">
        <?php echo esc_html( get_the_date() ); ?>
        <?php
          $client   = $meta('cs_client');
          $industry = $meta('cs_industry');
          $services = $meta('cs_services'); // comma-separated
          $bits = [];
          if ($client)   $bits[] = 'Client: '   . esc_html($client);
          if ($industry) $bits[] = 'Industry: ' . esc_html($industry);
          if ($services) $bits[] = 'Services: ' . esc_html($services);
          if ($bits) echo ' • ' . implode(' • ', $bits);
        ?>
      </p>
    </header>

    <?php if (has_post_thumbnail()): ?>
      <figure style="margin:1rem 0"><?php the_post_thumbnail('large'); ?></figure>
    <?php endif; ?>

    <?php if ($summary = $meta('cs_summary')): ?>
      <div class="card" style="margin-bottom:1rem">
        <h2 style="margin-top:0">Summary</h2>
        <p><?php echo wp_kses_post($summary); ?></p>
      </div>
    <?php endif; ?>

    <div class="entry-content">
      <?php
        // Optional structured sections (fill any you use)
        $challenge = $meta('cs_challenge');
        $solution  = $meta('cs_solution');
        $results   = $meta('cs_results');
      ?>

      <?php if ($challenge): ?>
        <h2>Challenge</h2>
        <div><?php echo wp_kses_post($challenge); ?></div>
      <?php endif; ?>

      <?php if ($solution): ?>
        <h2>Solution</h2>
        <div><?php echo wp_kses_post($solution); ?></div>
      <?php endif; ?>

      <?php if ($results): ?>
        <h2>Results</h2>
        <div><?php echo wp_kses_post($results); ?></div>
      <?php endif; ?>

      <?php
        // Fallback to main content editor if you’re writing in the post body
        the_content();
        wp_link_pages();
      ?>
    </div>

    <?php if ($url = $meta('cs_website_url')): ?>
      <p style="margin-top:1rem">
        <a class="button" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">Visit project</a>
      </p>
    <?php endif; ?>

    <nav class="post-navigation" style="margin-top:2rem;display:flex;justify-content:space-between;gap:1rem">
      <div><?php previous_post_link('%link','← Previous case study'); ?></div>
      <div><?php next_post_link('%link','Next case study →'); ?></div>
    </nav>

    <?php
      // Comments are usually off for case studies, but keep this if you want them:
      // if (comments_open() || get_comments_number()) comments_template();
    ?>
  <?php endif; ?>
</article>

<?php get_footer(); ?>
