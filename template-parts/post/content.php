<?php
/**
 * -----------------------------------------------------------------------------
 * Template part for displaying aside posts
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package Camel_Framework
 */
?>

<?php if (! is_singular()) : ?>

    <?php if ( is_active_sidebar( 'sidebar-left' ) && ! is_active_sidebar( 'sidebar-right' ) ) : ?>
        <div class="col-md-6 col-lg-4">
    <?php elseif ( ! is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ): ?>
        <div class="col-md-6 col-lg-4">
    <?php elseif ( is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ) : ?>
        <div class="col-lg-6 col-12">
    <?php else : ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
    <?php endif ?>

            <div class="pb-4 h-100">
                <div class="card h-100">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('thumbnail', array('class' => 'card-img-top')); // TODO : later we will make custom template tag ?>
                    <?php else: ?>
                        <img src="http://via.placeholder.com/250x200" class="card-img-top ">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">
                            <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php echo the_title(); ?></a>
                        </h5>
                        <?php the_excerpt() ?>
                        <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-primary mt-auto">
                            <?php esc_html_e( 'Read More', 'camel-framework' ); ?>
                        </a>
                    </div>
                </div><!-- .card -->
            </div>


        </div> <!-- depends on sidebar -->

<?php else : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header mb-2 border-bottom pb-2">
            <?php
            the_title('<h1 class="entry-title">', '</h1>');

            if ('post' === get_post_type()) :
                ?>
                <div class="entry-meta">
                    <?php
                    camel_posted_on();
                    camel_posted_by();
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->

        <?php camel_post_thumbnail(); ?>

        <div class="entry-content clearfix">
            <?php
            the_content(sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="sr-only"> "%s"</span>', 'camel-framework'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ));

            wp_link_pages(array(
                'before' => '<nav class="pagination align-items-center">' . esc_html__('Pages:', 'camel-framework'),
                'after'  => '</nav>',
            ));
            ?>
        </div><!-- .entry-content -->

         <div class="media pb-4 bg-light p-3 rounded mt-3">
            <div class="mr-3"><?php echo get_avatar( get_the_author_meta( 'ID' ), $size = '70', $default = '<path_to_url>', '', array('class' => 'rounded border', ) ); ?></div>
                <div class="media-body">
                <h5><?php the_author_posts_link(); ?></h5>
                <p><?php the_author_meta('description'); ?></p>
            </div><!-- .media-body -->
        </div><!-- .media -->

        <footer class="entry-footer">
            <?php camel_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->

<?php endif; ?>
