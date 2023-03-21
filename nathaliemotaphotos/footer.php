<footer class="footer">
    <nav class="footer__nav">
        <?php wp_nav_menu(array(
            'theme_location' => 'footer_menu',
        )); ?>
        <ul>
            <li>Tous droits réservés</li>
        </ul>
    </nav>
    <?php wp_footer() ?>
</footer>

</body>
</html>