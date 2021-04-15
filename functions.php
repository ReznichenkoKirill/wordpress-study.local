<?php

add_theme_support( 'post-thumbnails', array( 'post' ) );
add_action('wp_enqueue_scripts', 'study_template_scripts');
function study_template_scripts()
{
   wp_enqueue_style('study-template-bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_style('study-template-css', get_template_directory_uri() . '/style.css');
    wp_enqueue_script('study-template-jquery', get_template_directory_uri() . '/assets/js/jquery.js');
    wp_enqueue_script('study-template-main', get_template_directory_uri() . '/assets/js/main.js', 'study-template-jquery',);
}

add_filter('the_content', 'study_template_content_filter');
function study_template_content_filter($content) {
    $content = ucfirst($content);
    return $content;
}

add_action( 'init', 'study_template_menu' );
function study_template_menu() {
    register_nav_menus([
        'top' => 'Top Menu',
        'bottom' => 'Bottom Menu',
    ]);
}



