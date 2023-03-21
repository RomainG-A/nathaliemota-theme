<?php

add_action('after_setup_theme', function() {
    add_theme_support('title-tag');
    add_theme_support('menus');
    register_nav_menus(array(
        'primary_menu' => __('Primary Menu'),
	    'footer_menu'  => __('Footer Menu'),
    ));
});

function theme_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_scripts() {
    wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.4.slim.min.js', array(), '3.6.4', true);
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/assets/js/script.js', array(), '', true);
}
add_action('wp_enqueue_scripts', 'theme_scripts');