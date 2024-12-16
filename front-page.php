<?php
/* Template Name: Front Page */
get_header();
?>

<main class="site-main">
    <!-- Hero Section -->
    <?php $hero_photo = get_random_photo_url(); ?>
    <section id="hero" class="hero-section" style="background-image: url('<?php echo esc_url($hero_photo); ?>'); background-size: cover; background-position: center;">
        <div class="overlay"></div>
        <div class="hero-content">
            <h1>PHOTOGRAPHE EVENT</h1>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="filter-section">
    <div class="filter-left">
        <div class="custom-dropdown" id="categories-dropdown">
            <div class="dropdown-selected" data-placeholder="CATÉGORIES">CATÉGORIES</div>
            <div class="dropdown-options">
            <?php
        // Exclude the "Uncategorized" category
        $categories = get_terms([
            'taxonomy'   => 'photo-category', 
            'hide_empty' => true, 
            'exclude'    => get_option('default_category'), 
        ]);

        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                echo "<div class='dropdown-option' data-value='{$category->slug}'>{$category->name}</div>";
            }
        }
        ?>
            </div>
        </div>
        
        <div class="custom-dropdown" id="formats-dropdown">
            <div class="dropdown-selected" data-placeholder="FORMATS">FORMATS</div>
            <div class="dropdown-options">
                <?php
                $formats = get_terms(['taxonomy' => 'photo-format', 'hide_empty' => true]);
                foreach ($formats as $format) {
                    echo "<div class='dropdown-option' data-value='{$format->slug}'>{$format->name}</div>";
                }
                ?>
            </div>
        </div>
    </div>
    
    <div class="filter-right">
        <div class="custom-dropdown" id="year-dropdown">
            <div class="dropdown-selected" data-placeholder="TRIER PAR">TRIER PAR</div>
            <div class="dropdown-options">
                <?php
                global $wpdb;
                $years = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'Année'");
                foreach ($years as $year) {
                    echo "<div class='dropdown-option' data-value='{$year}'>{$year}</div>";
                }
                ?>
            </div>
        </div>
    </div>
</section>

    




    <!-- Photo Gallery Section -->
    <section id="photo-gallery" class="photo-gallery">
        <?php
        $args = array(
            'post_type' => 'photo',
            'posts_per_page' => 8,
            'paged' => 1
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/photo_block'); // Include the photo block template
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
     
    </section>
    <button
	class="load-more"
    data-page="1"
    data-postid="<?php echo get_the_ID(); ?>"
    data-nonce="<?php echo wp_create_nonce('photo-load-more'); ?>"
    data-action="photo-load-more"
    data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>"
    >Charge Plus</button>
</main>

<?php get_footer(); ?>
