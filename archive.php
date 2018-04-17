<?php
/**
 * -----------------------------------------------------------------------------
 * The template for archive all pages
 * -----------------------------------------------------------------------------
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Camel_Framework
 */


get_header();
?>
<div class="row">

    <?php get_sidebar('left'); ?>

        <main id="main">
            <?php if (have_posts()) : ?>

                <header class="page-header mb-4">
                    <?php
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        the_archive_description( '<div class="archive-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->


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
                </div><!-- .row -->

                <?php the_posts_navigation(); ?>

            <?php else : ?>

                <?php  get_template_part('template-parts/post/content', 'none'); ?>

            <?php endif; ?>
        </main>

    <?php get_sidebar('right'); ?>

</div><!-- .row -->

<?php get_footer(); ?>
