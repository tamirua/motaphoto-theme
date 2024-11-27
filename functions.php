<?php
function motaphoto_enqueue_styles() {
    wp_enqueue_style('motaphoto-style', get_stylesheet_uri());

    wp_enqueue_script('mota-photo-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);
     // Enqueue the Load More script
    wp_enqueue_script('photo-gallery-load-more',get_template_directory_uri() . '/assets/js/gallery-load-more.js', array('jquery'),'1.0',true);

    // Pass data to the Load More script
    wp_localize_script('photo-gallery-load-more','galleryLoadMore',array('ajax_url' => admin_url('admin-ajax.php'), // AJAX URL for WordPress
    'nonce'    => wp_create_nonce('photo_gallery_load_more_nonce') // Security nonce
        )
    );
}
add_action('wp_enqueue_scripts', 'motaphoto_enqueue_styles');

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



/*function load_photos_api_endpoint() {
    register_rest_route('photo/v1', '/gallery', [
        'methods' => WP_REST_Server::READABLE,
        'callback' => 'fetch_photos',
        'args' => [
            'page' => [
                'default' => 1,
                'validate_callback' => 'is_numeric',
            ],
            'category' => [
                'validate_callback' => 'is_string',
            ],
            'format' => [
                'validate_callback' => 'is_string',
            ],
            'order' => [
                'default' => 'desc',
                'validate_callback' => function ($param) {
                    return in_array(strtolower($param), ['asc', 'desc']);
                },
            ],
        ],
        'permission_callback' => '__return_true',
    ]);
}
add_action('rest_api_init', 'load_photos_api_endpoint');*/


/*function gallery_load_more_init() {

    // Pass data to the JavaScript file
    wp_localize_script(
        'photo-gallery-load-more',
        'galleryLoadMore',
        array(
            'ajax_url' => admin_url('admin-ajax.php'), // AJAX URL for WordPress
            'nonce' => wp_create_nonce('photo_gallery_load_more_nonce') // Security nonce
        )
    );
}
add_action('wp_enqueue_scripts', 'gallery_load_more_init');


// Ensure the file is accessed via WordPress only
if (!defined('ABSPATH')) {
    exit;
}*/

// Your existing code...

// Add the AJAX handler for the Load More functionality
function photo_gallery_load_more_handler() {
    // Verify nonce for security
    check_ajax_referer('photo_gallery_load_more_nonce', 'nonce');

    // Get the page number from the AJAX request
    $page = isset($_POST['page']) ? absint($_POST['page']) : 1;

    // Query for photos
    $args = array(
        'post_type' => 'photo', 
        'posts_per_page' => 8,  
        'paged' => $page
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start(); // Start output buffering

        while ($query->have_posts()) {
            $query->the_post();
            ?>
            <div class="gallery-item">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('medium'); // Display post thumbnail ?>
                    <h3><?php the_title(); ?></h3>
                </a>
            </div>
            <?php
        }

        wp_reset_postdata();
        echo ob_get_clean(); // Return the buffered content
    } else {
        echo ''; // No more items
    }

    wp_die(); // End AJAX response
}
add_action('wp_ajax_photo_gallery_load_more', 'photo_gallery_load_more_handler');
add_action('wp_ajax_nopriv_photo_gallery_load_more', 'photo_gallery_load_more_handler');

// Your other code...





function register_photo_post_type() {
    // Register custom post type
    register_post_type('photo', [
        'label' => 'Photos',
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
    ]);

    
    add_action( 'init', 'my_custom_taxonomy' );
    
    // Register Category Taxonomy
    register_taxonomy('category', 'photo', [
        'labels' => [
            'name' => 'Categories',
            'singular_name' => 'Category',
        ],
        'hierarchical' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => ['slug' => 'category'],
    ]);
}
add_action('init', 'register_photo_post_type');






