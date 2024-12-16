<?php
get_header(); 
?>

<main id="main" class="site-main">
    <div class="empty-content">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                 
            endwhile;
        else :
            echo '<p>Aucun contenu trouvé.</p>';
        endif;
        ?>
    </div>
</main>

<?php
get_footer(); 
?>

