<?php
/**
 * -----------------------------------------------------------------------------
 * The template for displaying author page
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Camel_Framework
 */
get_header();
?>
<div class="row">

    <?php get_sidebar('left'); ?>

        <main id="main" class="site-main">

        <div class="media pb-4">
            <div class="mr-3"><?php echo get_avatar( get_the_author_meta('ID'), 60); ?></div>
                <div class="media-body">
                    <?php the_archive_title( '<h5 class="mt-0">', '</h5>' ); ?>
                    <?php the_archive_description(); ?>
                </div>
        </div>

            <div class="row">
                <?php while (have_posts()) :  the_post(); ?>
                    <?php
                        /*
                        * Include the Post-Type-specific template for the content.
                        * If you want to override this in a child theme, then include a file
                        * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                        */
                        get_template_part('template-parts/post/content', get_post_type());
                    ?>
                <?php endwhile; ?>
            </div> <!-- .row -->
        </main><!--- #main -->

<?php get_sidebar(); ?>
</div> <!-- .row -->
<?php get_footer(); ?>
