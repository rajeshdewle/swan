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
<?php if (is_active_sidebar('sidebar-right')): ?>
    <div class="col-9">
<?php else: ?>
    <div class="col-12">
<?php endif ?>

        <main id="main" class="site-main">
        <?php
        if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'camel' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </header><!-- .page-header -->

            <div class="row">
            <?php
            /* Start the Loop */
            while ( have_posts() ) :
                the_post();

                /**
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
                 */
                get_template_part('template-parts/post/content', get_post_type());

            endwhile;

            the_posts_navigation();

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>
            </div><!-- .row -->
        </main><!-- #main -->


<?php get_sidebar(); ?>
</div><!-- .row -->
<?php get_footer(); ?>
