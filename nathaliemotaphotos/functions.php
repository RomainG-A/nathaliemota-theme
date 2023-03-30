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
    wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), '', true);
}
add_action('wp_footer', 'theme_scripts');

add_theme_support( 'post-thumbnails' );

function afficherTaxonomie($nomTaxonomie) {
    $terms = wp_get_post_terms(get_the_ID(), $nomTaxonomie);
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            return $term->name;
        }
    } else {
        return 'Non renseigné';
    }
}
function afficherChamp($nomChamp) {
    $champ = get_field($nomChamp);
    if($champ) {
        return $champ;
    } else {
        return 'Non renseigné';
    }
}
function toutesLesTaxonomies($nomTaxonomie) {
    if($terms = get_terms(array(
        'taxonomy' => $nomTaxonomie,
        'orderby' => 'name'
    ))) {
        foreach ( $terms as $term ) {
            echo '<option class="js-filter-item" value="' . $term->slug . '">' . $term->name . '</option>';
        }
    }
}

function load_more() {
    $ajaxposts = new WP_Query(array (
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => 4,
        'paged' => $_POST['paged'])
    );
    afficherImages($ajaxposts);
    /* if($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()) {
            $ajaxposts->the_post();
            echo '<img class="colonne img-medium" src="';
            echo the_post_thumbnail_url();
            echo '" />';
        }
    } else {
        echo '';
    } */
    //exit();
}
add_action('wp_ajax_load_more', 'load_more');
add_action('wp_ajax_nopriv_load_more', 'load_more');





function filter() {
    $ajaxposts = new WP_Query(array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => '4',
        'paged' => '1',
        'tax_query' => array(
	        array(
	            'taxonomy' => $_POST['nomTaxonomie'],
                //'taxonomy' => 'categories',
	            'field'    => 'slug',
	            'terms'    => $_POST['slugTaxonomie'],
                //'terms'    => 'concert',
	        ),
	    ),
    ));
    afficherImages($ajaxposts);
    /* if($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()) {
            $ajaxposts->the_post();
            echo '<img class="colonne img-medium" src="';
            echo the_post_thumbnail_url();
            echo '" />';
        }
    }
    else {
        echo "Il n'y a pas d'images à charger";
    } */
    //wp_reset_postdata();
    //exit();
}
add_action('wp_ajax_nopriv_filter', 'filter');
add_action('wp_ajax_filter', 'filter');

function afficherImages($ajaxposts) {
    if($ajaxposts->have_posts()) {
        while ($ajaxposts->have_posts()) {
            $ajaxposts->the_post();
            echo '<img class="colonne img-medium" src="';
            echo the_post_thumbnail_url();
            echo '" />';
        }
    }
    else {
        echo "Il n'y a pas d'images à charger";
    }
    //wp_reset_postdata();
    exit();
}