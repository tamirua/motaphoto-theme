<?php
/*
* Template Name: single-photo
* Template Post Type: photo
*/

get_header(); 

if (have_posts()) :
    while (have_posts()) :
        the_post(); 
        $photo_reference = get_post_meta(get_the_ID(), 'reference', true); // Assuming 'reference' is stored in post meta
        ?>

        <main class="single-photo-container">
            <article id="post-<?php the_ID(); ?>" <?php post_class('photo-main'); ?>>
                <div class="photo-description">
                    <h2><?php echo esc_html(get_the_title()); ?></h2>
                    <p><span>Type:</span> <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
                    <p><span>Référence:</span> <?php echo esc_html(get_post_meta(get_the_ID(), 'reference', true)); ?></p>
                    <p><span>Categories:</span> <?php the_terms(get_the_ID(), 'category', '', ', ', ''); ?></p>
                    <p><span>Format:</span> <?php echo get_post_meta(get_the_ID(), 'Format', true); ?></p>
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
                    <button id="contact-button" data-photo-ref="<?php echo esc_attr($photo_reference); ?>">
                        Contact
                    </button>
                </div>
                <div class="photo-nav">
                    <div class="photo-nav-prev">
                        <?php previous_post_link('%link', '&larr; Previous Photo'); ?>
                    </div>
                    <div class="photo-nav-next">
                        <?php next_post_link('%link', 'Next Photo &rarr;'); ?>
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








