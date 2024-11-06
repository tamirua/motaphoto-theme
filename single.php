<?php get_header(); ?>

<div id="content" class="site-content">

    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    <div class="entry-meta">
                        <?php
                        echo 'Published on: ' . get_the_date();
                        ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();
                    ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        ?>
        <p><?php esc_html_e( 'No posts found.', 'twentytwentyone-child' ); ?></p>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
