<?php get_header(); ?>

    <div class="page-photo">

        <section class="bloc-photo">
            <div class="bloc-photo__description">
                <h1><?php the_title() ?></h1>
                <p>Référence : <?php afficherChamp('reference_photo') ?></p>
                <p>Catégorie : <?php afficherTaxonomie('categories'); ?></p>
                <p>Format : <?php afficherTaxonomie('format'); ?></p>
                <p>Type : <?php afficherChamp('type_photo') ?></p>
                <p>Année : <?php echo get_the_date('Y');?></p>
            </div>
            <img class="bloc-photo__image" src="<?php the_post_thumbnail_url(); ?>">
        </section>

        <section class="contact-photo">
            <p>Cette photo vous intéresse ?</p>
            <input class="btn-contact bouton" type="button" value="Contact">
        </section>

    </div>

<?php get_footer(); ?>