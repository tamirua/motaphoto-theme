<?php
get_header(); 

if (have_posts()) :
    while (have_posts()) :
        the_post(); 
        ?>

        <main class="photo-content">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="photo-title"><?php the_title(); ?></h1>

                <div class="photo-thumbnail">
                    <?php 
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('full', ['class' => 'photo-image']);
                    }
                    ?>
                </div>

                <div class="photo-details">
                    <p><strong>Type:</strong> <?php echo get_post_meta(get_the_ID(), 'type', true); ?></p>
                    <p><strong>Reference:</strong> <?php echo get_post_meta(get_the_ID(), 'reference', true); ?></p>
                    <p><strong>Categories:</strong> <?php the_terms(get_the_ID(), 'category', '', ', ', ''); ?></p>
                    <p><strong>Format:</strong> <?php the_terms(get_the_ID(), 'format', '', ', ', ''); ?></p>
                </div>

                <div class="photo-content">
                    <?php the_content(); ?>
                </div>
            </article>
        </main>

        <?php
    endwhile;
else :
    ?>
    <p>No photo found!</p>
    <?php
endif;

get_footer(); 
?>

