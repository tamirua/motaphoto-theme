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
            <select id="categories-filter">
                <option value="">CATEGORIES</option>
                <option value="">Réception</option>
                <option value="">Concert</option>
                <option value="">Mariage</option>
                <option value="">Télévision</option>
                <?php
                $categories = get_terms(['taxonomy' => 'category', 'hide_empty' => true]);
                foreach ($categories as $category) {
                    echo "<option value='{$category->slug}'>{$category->name}</option>";
                }
                ?>
            </select>
            <select id="formats-filter">
                <option value="">FORMATS</option>
                <option value="">Paysage</option>
                <option value="">Portrait</option>
                <?php
                $formats = get_terms(['taxonomy' => 'format', 'hide_empty' => true]);
                foreach ($formats as $format) {
                    echo "<option value='{$format->slug}'>{$format->name}</option>";
                }
                ?>
            </select>
        </div>

        <div class="filter-right">
            <select id="year-filter">
                <option value="">TRIER PAR</option>
                <?php
                global $wpdb;
                $years = $wpdb->get_col("SELECT DISTINCT meta_value FROM $wpdb->postmeta WHERE meta_key = 'Année'");
                foreach ($years as $year) {
                    echo "<option value='{$year}'>{$year}</option>";
                }
                ?>
            </select>
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
        <!-- Dynamic images will be appended here -->
    </section>

    <button id="load-more" class="load-more" data-page="1">Charge Plus</button>
</main>

<?php get_footer(); ?>
