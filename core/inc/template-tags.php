<?php
/**
 * -----------------------------------------------------------------------------
 * Template tags
 * -----------------------------------------------------------------------------
 *
 * @package Camel_Framework
 */

/**
 * Camel nav menu
 *
 * @param  array  $args
 * @return WP_Nav_Menu
 */
function camel_nav_menu($args = array()) {
    $args['walker'] = new Camel_Navwalker();

    return wp_nav_menu($args);
}

if ( ! function_exists( 'camel_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function camel_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x( 'Posted on %s', 'post date', 'camel' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
    }
endif;

if ( ! function_exists( 'camel_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function camel_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'camel' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    }
endif;

if ( ! function_exists( 'camel_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function camel_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'camel' ) );
            if ( $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<div class="cat-links mb-4">' . esc_html__( 'Posted in %1$s', 'camel' ) . '</div>', $categories_list ); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '<span><span class="badge badge-primary badge-pill mr-1">', '</span><span class="badge badge-primary badge-pill mr-1">', '</span></span>' );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<div class="tags-links mb-4">' . esc_html__( 'Tagged %1$s', 'camel' ) . '</div>', $tags_list ); // WPCS: XSS OK.
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'camel' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'camel' ),
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
    }
endif;

if ( ! function_exists( 'camel_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function camel_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail('post-thumbnail', array( 'class' => 'w-100 h-100 mb-2' )); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

        <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
            <?php
            the_post_thumbnail( 'post-thumbnail', array(
                'alt' => the_title_attribute( array(
                    'echo' => false,
                ) ),
            ) ); ?>
        </a>

        <?php
        endif; // End is_singular().
    }
endif;

if (! function_exists('camel_comment_form')) {
    function camel_comment_form() {
        $commenter = wp_get_current_commenter();
        $req      = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );
        $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;

        $args = array(
            'class_submit' => 'btn btn-primary',
            'comment_field' => '<div class="form-group"><label for="comment">' . __( 'Comment', 'camel' ) . '</label><textarea id="comment" name="comment" cols="45" rows="5" class="form-control" aria-required="true"></textarea></div>',
            'fields' => array(
                'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'camel' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
                'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'camel' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
                'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'camel' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'
            )
        );
        return comment_form($args);
    }
}


if (! function_exists('camel_posts_pagination')) {
    function camel_posts_pagination() {
        if ( is_singular() ) {
            return;
        }

        global $wp_query;

        /** Stop execution if there's only 1 page */
        if ( $wp_query->max_num_pages <= 1 ) {
            return;
        }

        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $max   = intval( $wp_query->max_num_pages );

        /** Add current page to the array */
        if ( $paged >= 1 ) {
            $links[] = $paged;
        }

        /** Add the pages around the current page to the array */
        if ( $paged >= 3 ) {
            $links[] = $paged - 1;
            $links[] = $paged - 2;
        }

        if ( ( $paged + 2 ) <= $max ) {
            $links[] = $paged + 2;
            $links[] = $paged + 1;
        } ?>

        <nav class="my-4">
            <ul class="pagination justify-content-center">

                <?php $previous_link_class = (! get_previous_posts_link()) ? 'disabled': ''; ?>

                <li class="page-item <?php echo $previous_link_class ?>">
                    <?php if (get_previous_posts_link()) : ?>
                        <?php echo get_previous_posts_link('« Previous') ?>
                    <?php else : ?>
                        <a class="page-link" href="#" tabindex="-1">« Previous</a>
                    <?php endif; ?>
                </li>

                <!-- Link to first page, plus ellipses if necessary -->
                <?php if ( ! in_array( 1, $links ) ) : ?>
                    <?php
                        $classes = array();
                        $classes[] = 1 == $paged ? 'active' : '';
                        $classes[] = 'page-item';
                    ?>

                    <li class="<?php echo implode(' ', $classes); ?>">
                        <a href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>" class="page-link">1</a>
                    </li>

                    <?php if ( ! in_array( 2, $links ) ) : ?>
                        <li class="page-item">…</li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Link to current page, plus 2 pages in either direction if necessary -->
                <?php sort( $links ); ?>
                <?php foreach ( (array) $links as $link ) : ?>
                    <?php
                        $classes = array();
                        $classes[] = ($paged == $link) ? 'active' : '';
                        $classes[] = 'page-item';
                    ?>

                    <li class="<?php echo implode(' ', $classes); ?>">
                        <a href="<?php echo esc_url( get_pagenum_link( $link ) ); ?>" class="page-link"><?php echo $link; ?></a>
                    </li>
                <?php endforeach; ?>

                <!-- Link to last page, plus ellipses if necessary -->
                <?php if ( ! in_array( $max, $links ) ) : ?>
                    <?php if ( ! in_array( $max - 1, $links ) ) : ?>
                        <li class="page-item">…</li>
                    <?php endif; ?>

                    <?php
                        $classes = array();
                        $classes[] = ($paged == $max) ? 'active' : '';
                        $classes[] = 'page-item';
                    ?>

                    <li class="<?php echo implode(' ', $classes); ?>">
                        <a href="<?php echo esc_url( get_pagenum_link( $max ) ); ?>" class="page-link"><?php echo $max; ?></a>
                    </li>
                <?php endif; ?>

                <!-- Next Post Link -->
                <?php $next_link_class = (! get_next_posts_link()) ? 'disabled': ''; ?>

                <li class="page-item <?php echo $next_link_class; ?>">
                    <?php if (get_next_posts_link()) : ?>
                        <?php echo get_next_posts_link('Next »'); ?>
                    <?php else : ?>
                        <a class="page-link" href="#" tabindex="-1">Next »</a>
                    <?php endif; ?>
                </li>

            </ul>
        </nav>

        <?php
    }
}
