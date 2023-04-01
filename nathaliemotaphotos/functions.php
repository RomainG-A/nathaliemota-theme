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

function afficherTaxonomies($nomTaxonomie) {
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
    afficherImages($ajaxposts, true);
    /* wp_reset_postdata();
    exit(); */
}
add_action('wp_ajax_load_more', 'load_more');
add_action('wp_ajax_nopriv_load_more', 'load_more');



function filter() {
    $ajaxposts = new WP_Query(array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'paged' => '1',
        'tax_query' => array(
	        array(
	            'taxonomy' => $_POST['nomTaxonomie'],
	            'field'    => 'slug',
	            'terms'    => $_POST['slugTaxonomie'],
	        ),
	    ),
    ));
    afficherImages($ajaxposts, true);
    /* wp_reset_postdata();
    exit(); */
}
add_action('wp_ajax_nopriv_filter', 'filter');
add_action('wp_ajax_filter', 'filter');

function order() {
    $ajaxposts = new WP_Query(array(
        'post_type' => 'photos',
        'orderby' => 'date',
        'order' => $_POST['orderDirection'],
        'posts_per_page' => 4,
        'paged' => '1',
    ));
    afficherImages($ajaxposts, true);
    /* wp_reset_postdata();
    exit(); */
}
add_action('wp_ajax_nopriv_order', 'order');
add_action('wp_ajax_order', 'order');


function afficherImages($galerie, $exit) {
    if($galerie->have_posts()) {
        while ($galerie->have_posts()) { ?>
        <?php $galerie->the_post(); ?>
            <div class="colonne">
                <div class="rangee">
                    <img class="img-medium" src="<?php echo the_post_thumbnail_url(); ?>" />
                    <a href="<?php echo get_post_permalink(); ?>">
                        <div class="img-hover" >
                            <img class="btn-plein-ecran" src="<?php echo get_template_directory_uri(); ?>/assets/images/fullscreen.png" alt="Icône de plein écran" />
                            <img class="btn-oeil" src="<?php echo get_template_directory_uri(); ?>/assets/images/eye_icon.png" alt="Icône en fome d'oeil" />
                            <div>
                                <p><?php the_title(); ?></p>
                                <p><?php echo strip_tags(get_the_term_list($galerie->ID, 'categories')); ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div> <?php
        }
    }
    /* else {
        echo "Il n'y a pas d'images à charger";
    } */

    wp_reset_postdata();
    if ($exit) {
        //wp_reset_postdata();
        exit(); 
    }
    /* exit(); */
}