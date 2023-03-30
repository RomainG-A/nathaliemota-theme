<?php get_header() ?>

<section class="hero">
    <h1>Photographe event</h1>
    <?php 
        $random_image = new WP_Query(array (
            'post_type' => 'photos',
            'tax_query' => array(
                array(
                    'taxonomy' => 'format',
                    'field' => 'slug',
                    'terms' => 'paysage',
                ),
            ),
            'orderby' => 'rand',
            'posts_per_page' => '1'));
        if ($random_image->have_posts()) {
            while ($random_image->have_posts()) {
                $random_image->the_post();
                echo '<img class="hero__background" src="';
                echo the_post_thumbnail_url();
                echo '" />';
            }
        }
        wp_reset_postdata();
    ?> 

</section>

<section class="galerie bloc-page">

    <div class="filtres colonnes">

        <div class="filtres__taxonomie colonnes colonne">
            <form id="categories" class="js-filter-form filtres__taxonomie_categories filtre colonne">
                <label for="select-categorie">Catégories</label>
                <select id="select-categorie" name="categorie">
                    <option value="" hidden></option>
                    <?php toutesLesTaxonomies('categories'); ?>
                </select>
            </form>
            <form id="format "class="js-filter-form filtres_taxonomie__formats filtre colonne">
                <label for="select-format">Formats</label>
                <select id="select-format" name="format">
                    <option value="" hidden></option>
                    <?php toutesLesTaxonomies('format'); ?>
                </select>
            </form>
        </div>

        <div class="filtres__tri colonnes colonne">
            <div class="colonne">
            </div>
            <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filtre-ordre" class="filtres__tri__ordre filtre colonne">
                <label for="select-ordre">Trier par</label>
                <select id="select-ordre" name="ordre">
                    <!-- <option value=""></option> -->
                    <option value="DESC">Nouveautés</option>
                    <option value="ASC">Les plus anciens</option>
                </select>
            </form>
        </div>
    </div>

    <div class="galerie__photos colonnes">
        <?php 
            $galerie = new WP_Query(array (
                'post_type' => 'photos',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => 4,
                'paged' => 1)
            );
            /* $galerie = new WP_Query(array (
                'post_type' => 'photos',
                'orderby' => 'date',
                'order' => 'DESC',
                'posts_per_page' => '4',
                'paged' => 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categories',
	                    'field'    => 'slug',
	                    'terms'    => 'concert',
                    ),
                ),
            )); */
            if ($galerie->have_posts()) {
                while ($galerie->have_posts()) {
                    $galerie->the_post();
                    echo '<img class="colonne img-medium" src="';
                    echo the_post_thumbnail_url();
                    echo '" />';
                }
            }
        ?>
    </div>
    <div class="galerie__btn">
        <input type="button" value="Charger plus">
        <img id="btn-charger-plus" src="<?php echo get_template_directory_uri(); ?>/assets/images/camera_icon.png" alt="Icône d'appareil photo" />
    </div>

</section>

<?php get_footer() ?>