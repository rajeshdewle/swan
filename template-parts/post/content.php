<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Camel_Framework
 */

?>

<?php if (! is_singular()) : ?>
    <?php if (is_active_sidebar('sidebar-right')): ?>
        <div class="col-4 pb-4">
    <?php else :?>
        <div class="col-3">
    <?php endif ?>

        <div class="card">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail(); // TODO : later we will make custom template tag ?>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title">
                    <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php echo the_title(); ?></a>
                </h5>
                <p class="card-text"><?php the_excerpt() ?></p>
                <a href="<?php echo esc_url(get_permalink()); ?>" class="btn btn-primary">Read More</a>
            </div>
        </div>
    </div>

<?php else : ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
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
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'camel'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ));

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'camel'),
                'after'  => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
            <?php camel_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </article><!-- #post-<?php the_ID(); ?> -->

<?php endif; ?>
