<?php
get_header(); // Include the header.php file

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
    
        <article id="post-<?php the_ID(); ?>" <?php post_class('page'); ?>>
            <header class="entry-header">
                <h1 class="entry-title"><?php the_title(); ?></h1>
                <div class="entry-meta">
                    <span class="posted-on">Published on <?php echo get_the_date(); ?></span>
                </div>
            </header>

            <div class="entry-content">
                <?php the_post_thumbnail('large'); // Display featured image ?>
                <?php the_content(); ?>
            </div>

            <footer class="entry-footer">
                <div class="tags"><?php the_tags('<span class="tag-links">', ', ', '</span>'); ?></div>
            </footer>
        </article>

    <?php
    endwhile; // End of the loop.
else :
    echo '<p>No content found</p>';
endif;

get_sidebar(); // Include the sidebar.php file
get_footer(); // Include the footer.php file
