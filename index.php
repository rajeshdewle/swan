<?php
/**
 * -----------------------------------------------------------------------------
 * The main template file.
 * -----------------------------------------------------------------------------
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
            <main id="main">
                <?php if (have_posts()) : ?>

                    <?php if (is_home() && ! is_front_page()) : ?>
                        <header>
                            <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                        </header>
                    <?php endif; ?>

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

<?php get_sidebar(); ?>
        </div><!-- .row -->
<?php get_footer(); ?>
