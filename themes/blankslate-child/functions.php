<?php

// Enqueue parent + child styles
add_action('wp_enqueue_scripts', function () {
    $parent = wp_get_theme('blankslate');
    wp_enqueue_style('blankslate-parent', get_template_directory_uri() . '/style.css', [], $parent->get('Version'));
    
    //Enqueue compiled main.scss from dist/style.css
    wp_enqueue_style(
        'blankslate-child',
        get_stylesheet_directory_uri() . '/dist/style.css', // compiled CSS
        ['blankslate-parent'],
        filemtime(get_stylesheet_directory() . '/dist/style.css') // cache busting
    );
});

// Theme supports
add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('responsive-embeds');
    register_nav_menus([
        'primary' => __('Primary Menu', 'blankslate-child'),
        'footer'  => __('Footer Menu', 'blankslate-child'),
    ]);
});

// Sidebar
add_action('widgets_init', function () {
    register_sidebar([
        'name'          => __('Primary Sidebar', 'blankslate-child'),
        'id'            => 'primary',
        'before_widget' => '<section class="widget">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
});
