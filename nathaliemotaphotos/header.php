<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>
<body>

<header class="header">
    <div class="header__heading">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/site_logo.png" alt="Logo de Nathalie Mota" />
    </div>
    <nav class="header__nav">
        <?php wp_nav_menu(array(
            'theme_location' => 'primary_menu',
        )); ?>
    </nav>
</header>