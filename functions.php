<?php
function motaphoto_enqueue_assets() {
    // Enqueue main stylesheet
    wp_enqueue_style('motaphoto-style', get_template_directory_uri() . '/style.css');

    // Enqueue general scripts
    wp_enqueue_script('mota-photo-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), null, true);

    // Enqueue Load More script
    wp_enqueue_script('photo-load-more', get_template_directory_uri() . '/assets/js/load-more.js', array('jquery'), '1.0', true);

    // Enqueue Lightbox script
    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', [], filemtime(get_template_directory() . '/assets/js/lightbox.js'), true);

    // Pass AJAX data to the Load More script
    wp_localize_script('photo-load-more', 'galleryLoadMore', array(
        'ajax_url' => admin_url('admin-ajax.php'), // AJAX URL
        'nonce'    => wp_create_nonce('photo_load_more_nonce'), // Security nonce
    ));
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_assets');


// Register Main Menu
function motaphoto_register_menus() {
    register_nav_menu('main-menu', __('Main Menu'));

    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'motaphoto_register_menus');




function custom_template_hierarchy($template) {
    if (is_singular('photo')) {
        $template = locate_template('single-photo.php');
    }
    return $template;
}
add_filter('single_template', 'custom_template_hierarchy');

//upload background photo on hero section
function get_random_photo_url() {
    $photo_query = new WP_Query([
        'post_type' => 'photo',
        'posts_per_page' => 1,
        'orderby' => 'rand',
    ]);

    if ($photo_query->have_posts()) {
        $photo_query->the_post();
        $url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    } else {
        $url = get_template_directory_uri() . '/assets/images/default-hero.jpg'; // Fallback
    }

    wp_reset_postdata();

    return $url;
}




function photo_load_more() {
    
    if (
        ! isset($_REQUEST['nonce']) || 
        ! wp_verify_nonce($_REQUEST['nonce'], 'photo-load-more')
    ) {
        wp_send_json_error("Unauthorized request.", 403);
    }

    
    if (! isset($_POST['paged'])) {
        wp_send_json_error("Missing page number.", 400);
    }

    $paged = intval($_POST['paged']);
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
        'paged' => $paged,
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/photo_block');
        }
        wp_reset_postdata();

        $html = ob_get_clean();
        wp_send_json_success($html);
    } else {
        wp_send_json_error("No more photos found.", 404);
    }
}
add_action('wp_ajax_photo-load-more', 'photo_load_more');
add_action('wp_ajax_nopriv_photo-load-more', 'photo_load_more');









