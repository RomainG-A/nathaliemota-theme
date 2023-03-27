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
    //wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.6.4.slim.min.js', array(), '3.6.4', true);
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '', true);
}
add_action('wp_footer', 'theme_scripts');

add_theme_support( 'post-thumbnails' );

function afficherTaxonomie($nomTaxonomie) {
    $terms = wp_get_post_terms(get_the_ID(), $nomTaxonomie);
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            echo $term->name;
        }
    } else {
        echo 'Non renseigné';
    }
}
function afficherChamp($nomChamp) {
    $champ = get_field($nomChamp);
    if($champ) {
        echo $champ;
    } else {
        echo 'Non renseigné';
    }
}