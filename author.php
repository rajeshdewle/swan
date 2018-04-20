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

    <?php get_sidebar(); ?>

    <div class="<?php camel_sidebar_classes(); ?>">

        <main id="main" class="site-main">

            <?php if (have_posts()) : ?>

                <div class="media pb-4">
                    <div class="mr-3"><?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '60', $default = '<path_to_url>', '', array('class' => 'rounded', ) ); ?></div>
                        <div class="media-body">
                            <?php the_archive_title( '<h5 class="mt-0">', '</h5>' ); ?>
                            <?php the_archive_description(); ?>
                        </div><!-- .media-body -->
                </div><!-- .media -->

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

                <?php camel_posts_pagination(); ?>

            <?php else : ?>

                <?php  get_template_part('template-parts/post/content', 'none'); ?>

            <?php endif; ?>

        </main><!--- #main -->
    </div>
<?php get_sidebar(); ?>
</div> <!-- .row -->
<?php get_footer(); ?>
