

<?php
function motaphoto_enqueue_assets() {
    wp_enqueue_style('motaphoto-style', get_template_directory_uri() . '/style.css', [], filemtime(get_template_directory() . '/style.css'));

    wp_enqueue_script('mota-photo-scripts', get_template_directory_uri() . '/assets/js/scripts.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/scripts.js'), true);

    wp_enqueue_script('photo-load-more', get_template_directory_uri() . '/assets/js/load-more.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/load-more.js'), true);

    wp_enqueue_script('filter-photos', get_template_directory_uri() . '/assets/js/filter-photos.js', ['jquery'], filemtime(get_template_directory() . '/assets/js/filter-photos.js'), true);
    wp_localize_script('filter-photos', 'ajaxurl', admin_url('admin-ajax.php'));

    wp_enqueue_script('lightbox-script', get_template_directory_uri() . '/assets/js/lightbox.js', [], filemtime(get_template_directory() . '/assets/js/lightbox.js'), true);

    wp_localize_script('photo-load-more', 'galleryLoadMore', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('photo_load_more_nonce'),
    ));
    
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_assets');


// Register Main Menu
function motaphoto_register_menus() {
    register_nav_menu('main-menu', __('Main Menu'));

    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'motaphoto_register_menus');



//single photo pour single-photo.php 
function custom_template_hierarchy($template) {
    if (is_singular('photo')) {//Vérifiez si la publication actuelle est une seule publication « photo ».
        $template = locate_template('single-photo.php');
    }
    return $template;
}
add_filter('single_template', 'custom_template_hierarchy');



//Télécharger la photo d’arrière-plan dans la section Héros
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

//load more button 
/*function photo_load_more() {
    
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
add_action('wp_ajax_nopriv_photo-load-more', 'photo_load_more');*/

//test

function photo_load_more() {
    // Vérifier la sécurité du nonce
    if (!isset($_REQUEST['nonce']) || !wp_verify_nonce($_REQUEST['nonce'], 'photo-load-more')) {
        wp_send_json_error("Unauthorized request.", 403);
    }

    // Vérifiez si la valeur paginée est fournie
    if (!isset($_POST['paged'])) {
        wp_send_json_error("Missing page number.", 400);
    }

    $paged = intval($_POST['paged']); 
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8, 
        'paged' => $paged,     
    ];

    $query = new WP_Query($args);

    // Vérifier le nombre total de pages
    $max_pages = $query->max_num_pages;

    if ($query->have_posts()) {
        ob_start();
        // Boucle à travers les posts
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/photo_block'); // Include the photo block template
        }
        wp_reset_postdata();

        $html = ob_get_clean(); // Obtenir la sortie HTML des blocs photo

        // Envoyez la réponse avec le HTML et des informations supplémentaires pour la page suivante
        wp_send_json_success([
            'html' => $html,
            'next_page' => $paged + 1, 
            'max_pages' => $max_pages  
        ]);
    } else {
        wp_send_json_error("No more photos found.", 404); 
    }
}
add_action('wp_ajax_photo-load-more', 'photo_load_more');
add_action('wp_ajax_nopriv_photo-load-more', 'photo_load_more');







//Cette fonction gère le filtrage des photos en fonction de critères sélectionnés par l’utilisateur.
//'catégorie', 'format' et 'année' d’une requête AJAX.
function filter_photos_ajax() {

    //Récupération et nettoyage des entrés utilisateur à partir de la requête AJAX
    $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
    $format = isset($_POST['format']) ? sanitize_text_field($_POST['format']) : '';
    $year = isset($_POST['year']) ? sanitize_text_field($_POST['year']) : '';

    //Initialiser les arguments de requête pour récupérer les articles 'photo'
    $args = [
        'post_type' => 'photo',
        'posts_per_page' => 8,
    ];
  
    $tax_query = [];
    if ($category) {
        $tax_query[] = [
            'taxonomy' => 'photo-category',
            'field'    => 'slug',
            'terms'    => $category,    
            
        ];

    }
    if ($format) {
        $tax_query[] = [
            'taxonomy' => 'photo-format',
            'field'    => 'slug',
            'terms'    => $format,
        ];
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }



    if ($year) {
        $args['date_query'] = [
            [
                'year' => $year,
            ],
        ];
    }
    //Exécuter la requête avec les arguments spécifiés
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        //Boucle à travers les posts
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/photo_block'); 
        }
        wp_reset_postdata();

        wp_send_json_success(ob_get_clean());
    } else {
        wp_send_json_error('No photos found');
    }
}
add_action('wp_ajax_filter_photos', 'filter_photos_ajax');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_ajax');




















