<?php
function motaphoto_enqueue_styles() {
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');

// Register Main Menu
function motaphoto_register_menus() {
    register_nav_menu('main-menu', __('Main Menu'));
}
add_action('after_setup_theme', 'motaphoto_register_menus');
