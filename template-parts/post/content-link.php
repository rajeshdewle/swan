<?php
/**
 * -----------------------------------------------------------------------------
 * Template part for displaying link posts
 * -----------------------------------------------------------------------------
 * 
 * A link to another site.
 * Themes may wish to use the first <a href=””> tag in the post content as the external link for that post.
 * An alternative approach could be if the post consists only of a URL,
 * then that will be the URL and the title (post_title) will be the name attached to the anchor for it.
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

            <div class="card mb-4">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('thumbnail', array('class' => 'card-img-top h-100')); // TODO : later we will make custom template tag ?>
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php echo the_title(); ?></a>
                    </h5>
                    <p class="card-text"><?php the_excerpt() ?></p>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-primary">Read More</a>
                </div>
            </div><!-- .card -->

        </div> <!-- depends on sidebar -->

<?php else : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header mb-2">
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

        <div class="entry-content">
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
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'camel-framework'),
                'after'  => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php camel_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->

<?php endif; ?>