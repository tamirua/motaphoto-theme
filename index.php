<?php
// Basic template structure for index.php
get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
else :
    echo 'No posts found.';
endif;

get_footer();
?>
