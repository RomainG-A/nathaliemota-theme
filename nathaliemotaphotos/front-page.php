<?php get_header() ?>

<section class="hero">
    <h1><img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero_title.png" title="Photographe event" alt="Photographe event" /></h1>
    <?php 
        $random_image = new WP_Query(array ('post_type' => 'photos', 'orderby' => 'rand', 'posts_per_page' => '1'));
        if (have_posts()) {
            while ($random_image->have_posts()) {
                $random_image->the_post();
                echo '<img class="hero__background" src="';
                echo the_post_thumbnail_url();
                echo '" />';
            }
        }
    ?> 

</section>

<section class="galerie bloc-page">

    <div class="filtres colonnes">

        <div class="filtres__taxonomie colonnes colonne">
            <div class="filtres__taxonomie_categories colonne">
                <p>Catégories</p>
            </div>
            <div class="filtres_taxonomie__formats colonne">
                <p>Formats</p>
            </div>
        </div>

        <div class="filtres__tri colonnes colonne">
            <div class="colonne">
            </div>
            <div class="filtres__tri__ordre colonne">
                <p>Trier par</p>
            </div>
        </div>
    </div>

    <div class="galerie__photos colonnes">
        <img class="colonne img-medium" src="http://nathalie-mota.local/wp-content/uploads/2023/03/nathalie-2-scaled.jpeg" />
        <img class="colonne img-medium" src="http://nathalie-mota.local/wp-content/uploads/2023/03/nathalie-2-scaled.jpeg" />
        <img class="colonne img-medium" src="http://nathalie-mota.local/wp-content/uploads/2023/03/nathalie-2-scaled.jpeg" />
        <img class="colonne img-medium" src="http://nathalie-mota.local/wp-content/uploads/2023/03/nathalie-2-scaled.jpeg" />
        <img class="colonne img-medium" src="http://nathalie-mota.local/wp-content/uploads/2023/03/nathalie-2-scaled.jpeg" />
        <img class="colonne img-medium" src="http://nathalie-mota.local/wp-content/uploads/2023/03/nathalie-2-scaled.jpeg" />
        <img class="colonne img-medium" src="http://nathalie-mota.local/wp-content/uploads/2023/03/nathalie-2-scaled.jpeg" />
        <img class="colonne img-medium" src="http://nathalie-mota.local/wp-content/uploads/2023/03/nathalie-2-scaled.jpeg" />
    </div>
    <div class="galerie__btn">
        <input type="button" value="Charger plus">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/camera_icon.png" alt="Icône d'appareil photo" />
    </div>
    
    <!-- <div class="galerie__btn">
        Charger plus
    </div> -->

</section>

<?php get_footer() ?>