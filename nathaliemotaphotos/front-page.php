<?php get_header() ?>
<main>

<div class="modale">
    <div class="modale__header">
        <div class="modale__header__line1">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact-texte.png" alt="Contact" />
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact-texte.png" alt="Contact" />
        </div>
        <div class="modale__header__line2">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact-texte.png" alt="Contact" />
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/contact-texte.png" alt="Contact" />
        </div>
    </div>
    <div class="modale__form">  	
        <?php echo apply_shortcodes( '[contact-form-7 id="36" title="Formulaire de contact"]' ); ?> 
    </div>
</div>

</main>
<?php get_footer() ?>