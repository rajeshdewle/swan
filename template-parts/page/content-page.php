<?php
/**
 * -----------------------------------------------------------------------------
 * Template part for displaying page content in page.php
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Camel_Framework
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <?php camel_post_thumbnail(); ?>

    <div class="entry-content clearfix">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<nav class="pagination align-items-center">' . esc_html__('Pages:', 'camel-framework'),
            'after'  => '</nav>',
        ));
        ?>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Edit <span class="sr-only">%s</span>', 'camel-framework' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
