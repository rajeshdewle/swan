<?php
/**
 * -----------------------------------------------------------------------------
 * The template for displaying search results pages
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
        <?php
        if ( have_posts() ) : ?>

            <header class="page-header mb-4">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'camel-framework' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
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

                <?php camel_posts_pagination(); ?>

            <?php else : ?>

                <?php  get_template_part('template-parts/post/content', 'none'); ?>

            <?php endif; ?>
        </main><!-- #main -->
    </div>

<?php get_sidebar(); ?>
</div><!-- .row -->
<?php get_footer(); ?>
