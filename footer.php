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
<!-- Lightbox  -->
<div id="lightbox-overlay" class="lightbox-overlay" style="display: none;">
    <button id="close-lightbox" class="close-lightbox"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/close.png" alt="close button"></button>        <!-- Photo Display -->
    <button id="prev-arrow" class="prev-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow précédente.png" alt="arrow précédente"></button>
    <button id="next-arrow" class="next-arrow"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow suivante.png" alt="arrow suivante"></button>
    <p id="lightbox-reference" class="lightbox-reference"></p>
    <p id="lightbox-category" class="lightbox-category"></p>
    <div class="lightbox-container">
        <img id="lightbox-image" src="" alt="Lightbox Image">
    </div>
</div>





<?php get_template_part('template-parts/contact-modal'); ?>

<?php wp_footer(); // Important for loading scripts ?>
</body>
</html>
