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
<?php if (is_active_sidebar('sidebar-right')): ?>
    <div class="col-9">
<?php else: ?>
    <div class="col-12">
<?php endif ?>

    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) :
            the_post();

            get_template_part( 'template-parts/post/content', get_post_type() );

            the_post_navigation();

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>
    </main><!-- #main -->

<?php
get_sidebar(); ?>
</div><!-- .row -->
    <?php
get_footer();
