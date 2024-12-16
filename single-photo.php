<?php
/*
* Template Name: single-photo
* Template Post Type: photo
*/

get_header(); 
//Je déclare pour le bouton de contact pour insérer les données de référence
if (have_posts()) :
    while (have_posts()) :
        the_post(); 
        $photo_reference = get_post_meta(get_the_ID(), 'reference', true); // Assuming 'reference' is stored in post meta
        ?>

        <main class="single-photo-container" id="single-photo-container">
            <article id="post-<?php the_ID(); ?>" <?php post_class('photo-main'); ?>>
                <div class="photo-description">
                    <h2><?php
                        $title = get_the_title();
                        
                        // Divisez le titre en deux parties au premier espace
                        $title_parts = explode(' ', $title, 2);  
                        
                        
                        if (count($title_parts) == 2) {
                            echo esc_html($title_parts[0]) . '<br>' . esc_html($title_parts[1]);
                        } else {
                            echo esc_html($title); 
                        }
                        ?></h2>
                    <p><span>Référence&ensp;:</span> <?php echo esc_html(get_post_meta(get_the_ID(), 'reference', true)); ?></p>
                    <p><span>Categories&ensp;:</span> <?php the_terms(get_the_ID(), 'category', '', ', ', ''); ?></p>
                    <p><span>Format&ensp;:</span>
                    <?php
                        // Récupère et affiche le format de la photo
                        $terms = get_the_terms(get_the_ID(), 'photo-format');
                        if ($terms && !is_wp_error($terms)) {
                            foreach ($terms as $term) {
                                echo $term->name . ' ';
                            }
                        }
                        ?>
                    <p><span>Type:&ensp;</span> <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
                    <p><span>Année:&ensp;</span> <?php echo get_the_date( 'Y' );  ?></p>
                    <hr>
                </div>
                <div class="photo-thumbnail">
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', ['class' => 'photo-image']);
                    }
                    ?>
                </div>
            </article>
            <article class="photo-interactions">
                <div class="photo-contact">
                    <div class="photo-content">
                        <p>Cette photo vous intéresse ?</p>
                    </div>
                    <button class="contact-button" data-photo-ref="<?php echo esc_attr($photo_reference); ?>">
                        Contact
                    </button>
                </div>

            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();

            $prev_thumbnailurl = $prev_post ? get_the_post_thumbnail_url($prev_post->ID, 'thumbnail') : get_template_directory_uri() . '/assets/images/default-thumbnail.png';
            $next_thumbnailurl = $next_post ? get_the_post_thumbnail_url($next_post->ID, 'thumbnail') : get_template_directory_uri() . '/assets/images/default-thumbnail.png';
            ?>
            <div class="photo-navigation">
                <div class="photo-arrows">
                    <?php if ($prev_post): ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="arrow-left">
                            <img src="<?php echo esc_url($prev_thumbnailurl); ?>" alt="Thumbnail for <?php echo esc_attr(get_the_title($prev_post->ID)); ?>" class="photo-card-image-left" loading="lazy">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arrow-prev.png" alt="Previous" class="arrow-icon">
                        </a>
                    <?php endif; ?>

                    <?php if ($next_post): ?>
                        <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="arrow-right">
                            <img src="<?php echo esc_url($next_thumbnailurl); ?>" alt="Thumbnail for <?php echo esc_attr(get_the_title($next_post->ID)); ?>" class="photo-card-image-right" loading="lazy">
                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/arrow-next.png" alt="Next" class="arrow-icon">
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            </article>
            <div class="modal-container">
                <?php get_template_part('templates_parts/contact-modal'); // Include the contact modal ?>
            </div>
            <?php endwhile;
        else : ?>
            <p>No photo found!</p>
        <?php endif;?>

        <hr>

        <section class="related-photos">
            <h3>VOUS AIMEREZ AUSSI</h3>
            <div class="related-photos-container">
                <?php
                $categories = wp_get_post_terms(get_the_ID(), 'category', ['fields' => 'ids']);
                $related_query = new WP_Query([
                    'post_type' => 'photo',
                    'posts_per_page' => 2,
                    'post__not_in' => [get_the_ID()],
                    'tax_query' => [
                        [
                            'taxonomy' => 'category',
                            'field'    => 'id',
                            'terms'    => $categories,
                        ],
                    ],
                ]);

                if ($related_query->have_posts()) :
                    while ($related_query->have_posts()) :
                        $related_query->the_post();
                        get_template_part('template-parts/photo_block'); // Include the photo block template
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No related photos found!</p>';
                endif;
                ?>
            </div>
        </section>
        </main>

      

<?php get_footer(); ?>








