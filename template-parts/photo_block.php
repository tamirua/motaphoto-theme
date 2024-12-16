
<article class="photo-block">
    <a href="<?php the_permalink(); ?>">
        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>" 
             alt="<?php the_title(); ?>" class="related-photo-image">
    </a>
    <div class="photo-hover-icons">
        <a href="<?php the_permalink(); ?>" class="icon-view">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_eye.png" 
                 alt="View Photo Info">
        </a>
        <!-- Icône plein écran pour l’ouverture de la lightbox -->
        <?php
            $categories = get_the_terms(get_the_ID(), 'category'); 
            $categories_list = $categories ? implode(', ', wp_list_pluck($categories, 'name')) : '';
        ?>
        <a href="#" class="icon-fullscreen fullscreen-trigger" 
        data-lightbox="gallery" 
        data-photo="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>"
        data-reference="<?php echo esc_html(get_post_meta(get_the_ID(), 'reference', true)); ?>"
        data-category="<?php echo esc_attr($categories_list); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Icon_fullscreen.png" alt="Fullscreen">
        </a>
    </div>
    <!-- Photo Information -->
    <div class="photo-info">
    <div class="photo-title"><?php the_title(); ?></div>
    <div class="photo-category"><?php the_terms(get_the_ID(), 'category', '', ', ', ''); ?></div>
        
    </div>
</article>
