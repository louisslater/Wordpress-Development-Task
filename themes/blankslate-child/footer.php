<?php
?></main>

<footer class="site-footer">
  <div class="container">
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    <?php if (has_nav_menu('footer')):
      wp_nav_menu([
        'theme_location' => 'footer',
        'container'      => '',
        'menu_class'     => 'menu',
        'depth'          => 1,
      ]);
    endif; ?>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
