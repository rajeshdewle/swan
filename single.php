<?php
/**
 * -----------------------------------------------------------------------------
 * The template for displaying all single posts
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Camel_Framework
 */

get_header();
?>
<div class="row">

    <div class="<?php camel_sidebar_classes(); ?>">

        <main id="main">
            <?php
                while ( have_posts() ) :

                    the_post();

                    get_template_part( 'template-parts/post/content', get_post_format() );

                    camel_post_navigation();

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :

                        if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 

                        comments_template();
                        
                    endif;

                endwhile; // End of the loop.
            ?>
        </main><!-- #main -->

    </div>

    <?php get_sidebar(); ?>

</div><!-- .row -->

<?php get_footer(); ?>
