<?php
/**
 * -----------------------------------------------------------------------------
 * The template for displaying all pages
 * -----------------------------------------------------------------------------
 * 
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * 
 * @package Camel_Framework
 */

get_header();
?>
<div class="row">

<?php get_sidebar('left'); ?>

<?php if ( is_active_sidebar( 'sidebar-left' ) && ! is_active_sidebar( 'sidebar-right' ) ) : ?>
    <div class="col-9">
<?php elseif ( ! is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ): ?>
    <div class="col-9">
<?php elseif ( is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ) : ?>
    <div class="col-6">
<?php else : ?>
    <div class="col-12">
<?php endif ?>

        <main id="main" class="site-main">
            <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/page/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
        </main><!-- #main -->

<?php get_sidebar('right'); ?>
</div><!-- .row -->
<?php get_footer(); ?>
