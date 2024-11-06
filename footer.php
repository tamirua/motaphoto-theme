<!-- footer.php -->
<footer class="site-footer">
    <div class="container">
        <nav class="footer-navigation">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'footer-menu', // This matches the registered location
                'menu_class'     => 'footer-menu', // CSS class for styling
                'container'      => false, // Prevents a div wrapping the menu
            ));
            ?>
        </nav>
        <div class="footer-text">
            <!-- Text for 'Tous Droits Réservés' will still be static -->
            <span>&copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?>. Tous Droits Réservés.</span>
        </div>
    </div>
</footer>

<?php wp_footer(); // Important for loading scripts ?>
</body>
</html>
