<?php
/**
 * Plugin Name: Custom Post
 * Description: Registers new custom post type (case studies) and allows users to add a shortcode to their website that displays the 3 latest case studies.
 */

//register new wordpress admin tab
add_action('init','register_case_studies');

function register_case_studies() : void {
    $labels = array(
        'name'               => __('Case Studies', 'custom-post'),
        'singular_name'      => __('Case Study', 'custom-post'),
        'add_new'            => __('Add New', 'custom-post'),
        'add_new_item'       => __('Add New Case Study', 'custom-post'),
        'edit_item'          => __('Edit Case Study', 'custom-post'),
        'new_item'           => __('New Case Study', 'custom-post'),
        'view_item'          => __('View Case Study', 'custom-post'),
        'search_items'       => __('Search Case Studies', 'custom-post'),
        'not_found'          => __('No case studies found', 'custom-post'),
        'not_found_in_trash' => __('No case studies found in Trash', 'custom-post'),
        'all_items'          => __('All Case Studies', 'custom-post'),
        'menu_name'          => __('Case Studies', 'custom-post'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'case-studies'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true, // enable Gutenberg + REST API
        'menu_icon'          => 'dashicons-portfolio',
    );

    register_post_type('case_study', $args);
}

//register new custom field case_study_date
add_action( 'init', function() {
    register_post_meta( 'case_study', '_case_study_date', array(
        'type'              => 'string',
        'single'            => true,
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest'      => true,
    ) );
});

//add meta box for case_study_date
add_action( 'add_meta_boxes', function() {
    add_meta_box(
        'case_study_date_meta',
        __('Case Study Date', 'custom-post'),
        'render_case_study_date_meta_box',
        'case_study',
        'side',
        'default'
    );
});

//display case_study_date in Gutenberg editor
function render_case_study_date_meta_box( $post ) {
    $value = get_post_meta( $post->ID, '_case_study_date', true );

    wp_nonce_field( 'save_case_study_date', 'case_study_date_nonce' );

    echo '<label for="case_study_date">' . esc_html__('Date Published:', 'custom-post') . '</label>';
    echo '<input type="date" id="case_study_date" name="case_study_date" value="' . esc_attr( $value ) . '" style="width:100%;">';
}

//save case_study_date
add_action( 'save_post_case_study', function( $post_id ) {

    if ( ! isset($_POST['case_study_date_nonce']) || ! wp_verify_nonce($_POST['case_study_date_nonce'], 'save_case_study_date') ) {
        return;
    }

    if ( isset($_POST['case_study_date']) ) {
        update_post_meta( $post_id, '_case_study_date', sanitize_text_field($_POST['case_study_date']) );
    }
});


//shortcode to display the 3 latest case studies
add_shortcode('latest_case_studies', 'render_latest_case_studies');

function render_latest_case_studies(): string {
    $query = new WP_Query(array(
        'post_type'      => 'case_study',
        'posts_per_page' => 3,
    ));

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="latest-case-studies">';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<div class="case-study">';
            if (has_post_thumbnail()) {
                the_post_thumbnail('medium');
            }
            echo '<h3>' . esc_html(get_the_title()) . '</h3>';
            $date = get_post_meta( get_the_ID(), '_case_study_date', true );
            if ( $date ) {
                echo '<p class="case-study-date">Published: ' . esc_html( $date ) . '</p>';
            }
            $excerpt = wp_trim_words( get_the_content(), 30, '…' );
            echo '<div class="excerpt">' . esc_html( $excerpt ) . '</div>';
            echo '<a class="read-more" href="' . esc_url( get_permalink() ) . '">Read More</a>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No case studies found.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
