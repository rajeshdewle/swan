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
        $post_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $post_time_string = sprintf( $post_time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            '<span class="mr-2">' . esc_html_x( 'Posted on %s', 'post date', 'camel-framework' ) . '</span>',
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $post_time_string . '</a>'
        );

        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $update_time_string = '<time class="updated" datetime="%1$s">%2$s</time>';

            $update_time_string = sprintf( $update_time_string,
                esc_attr( get_the_modified_date( DATE_W3C ) ),
                esc_html( get_the_modified_date() )
            );

            $updated_on = sprintf(
                /* translators: %s: updated date. */
                '<span class="mr-2">' . esc_html_x( 'Updated on %s', 'update date', 'camel-framework' ) . '</span>',
                '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $update_time_string . '</a>'
            );
        }

        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            echo '<span class="posted-on">' . $posted_on . $updated_on . '</span>'; // WPCS: XSS OK.
        } else {
            echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
        }

    }
endif;

if ( ! function_exists( 'camel_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function camel_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'camel-framework' ),
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
            $categories_list = get_the_category_list( ', ');
            if ( $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<div class="cat-links my-3">' . esc_html__( 'Posted in %1$s', 'camel-framework' ) . '</div>', $categories_list ); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '<span><span class="badge badge-primary badge-pill mr-1">', '</span><span class="badge badge-primary badge-pill mr-1">', '</span></span>' );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<div class="tags-links mb-3">' . esc_html__( 'Tagged %1$s', 'camel-framework' ) . '</div>', $tags_list ); // WPCS: XSS OK.
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'camel-framework' ),
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
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'camel-framework' ),
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
            'comment_field' => '<div class="form-group"><label for="comment">' . __( 'Comment', 'camel-framework' ) . '</label><textarea id="comment" name="comment" cols="45" rows="5" class="form-control" aria-required="true"></textarea></div>',
            'fields' => array(
                'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'camel-framework' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
                'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'camel-framework' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
                'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'camel-framework' ) . '</label> ' .
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

        $current_page = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
        $last_page   = intval( $wp_query->max_num_pages );

        /** Add current page to the array */
        if ( $current_page >= 1 ) {
            $links[] = $current_page;
        }

        /** Add the pages around the current page to the array */
        if ( $current_page >= 3 ) {
            $links[] = $current_page - 1;
            $links[] = $current_page - 2;
        }

        if ( ( $current_page + 2 ) <= $last_page ) {
            $links[] = $current_page + 2;
            $links[] = $current_page + 1;
        } ?>

        <nav class="my-4">
            <ul class="pagination justify-content-center">

                <?php $previous_link_class = (! get_previous_posts_link()) ? 'disabled': ''; ?>

                <li class="page-item mr-auto <?php echo $previous_link_class ?>">
                    <?php if (get_previous_posts_link()) : ?>
                        <?php echo get_previous_posts_link('Previous') ?>
                    <?php else : ?>
                        <a class="page-link rounded" href="#" tabindex="-1">
                            <?php esc_html_e( 'Previous', 'camel-framework' ); ?>
                        </a>
                    <?php endif; ?>
                </li>

                <!-- Link to first page, plus ellipses if necessary -->
                <?php if ( ! in_array( 1, $links ) ) : ?>
                    <?php
                        $classes = array();
                        $classes[] = 1 == $current_page ? 'active' : '';
                        $classes[] = 'page-item mx-1';
                    ?>

                    <li class="<?php echo implode(' ', $classes); ?>">
                        <a href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>" class="page-link rounded">1</a>
                    </li>

                    <?php if ( ! in_array( 2, $links ) ) : ?>
                        <li class="page-item mx-1">...</li>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Link to current page, plus 2 pages in either direction if necessary -->
                <?php sort( $links ); ?>
                <?php foreach ( (array) $links as $page_number ) : ?>
                    <?php
                        $classes = array();
                        $classes[] = ($current_page == $page_number) ? 'active' : '';
                        $classes[] = 'page-item mx-1';
                    ?>

                    <li class="<?php echo implode(' ', $classes); ?>">
                        <a href="<?php echo esc_url( get_pagenum_link( $page_number ) ); ?>" class="page-link rounded"><?php echo $page_number; ?></a>
                    </li>
                <?php endforeach; ?>

                <!-- Link to last page, plus ellipses if necessary -->
                <?php if ( ! in_array( $last_page, $links ) ) : ?>
                    <?php if ( ! in_array( $last_page - 1, $links ) ) : ?>
                        <li class="page-item mx-1">...</li>
                    <?php endif; ?>

                    <?php
                        $classes = array();
                        $classes[] = ($current_page == $last_page) ? 'active' : '';
                        $classes[] = 'page-item mx-1';
                    ?>

                    <li class="<?php echo implode(' ', $classes); ?>">
                        <a href="<?php echo esc_url( get_pagenum_link( $last_page ) ); ?>" class="page-link rounded"><?php echo $last_page; ?></a>
                    </li>
                <?php endif; ?>

                <!-- Next Post Link -->
                <?php $next_link_class = (! get_next_posts_link()) ? 'disabled': ''; ?>

                <li class="page-item ml-auto <?php echo $next_link_class; ?>">
                    <?php if (get_next_posts_link()) : ?>
                        <?php echo get_next_posts_link('Next'); ?>
                    <?php else : ?>
                        <a class="page-link rounded" href="#" tabindex="-1">
                            <?php esc_html_e( 'Next', 'camel-framework' ); ?>
                        </a>
                    <?php endif; ?>
                </li>

            </ul>
        </nav>

        <?php
    }
}

if (! function_exists('camel_post_navigation')) {
    function camel_post_navigation($args = array()) {
        $args = wp_parse_args( $args, array(
            'prev_text'          => '%title',
            'next_text'          => '%title',
            'in_same_term'       => false,
            'excluded_terms'     => '',
            'taxonomy'           => 'category',
            'screen_reader_text' => __( 'Posts navigation', 'camel-framework' ),
        ) );

        $navigation = '';

        $previous = get_previous_post_link(
            '<div class="nav-previous col-sm-6">%link</div>',
            $args['prev_text'],
            $args['in_same_term'],
            $args['excluded_terms'],
            $args['taxonomy']
        );

        $next = get_next_post_link(
            '<div class="nav-next col-sm-6 text-right">%link</div>',
            $args['next_text'],
            $args['in_same_term'],
            $args['excluded_terms'],
            $args['taxonomy']
        );

        // Only add markup if there's somewhere to navigate to.
        if ( $previous || $next ) {

            $links = $previous . $next;
            $class = 'posts-navigation';
            $screen_reader_text = $args['screen_reader_text'];

            if ( empty( $screen_reader_text ) ) {
                $screen_reader_text = __( 'Posts navigation', 'camel-framework');
            }

            $template = '
            <nav class="navigation %1$s my-4" role="navigation">
                <h2 class="sr-only">%2$s</h2>
                <div class="nav-links row">%3$s</div>
            </nav>';

            $template = apply_filters( 'navigation_markup_template', $template, $class );

            $navigation = sprintf( $template, sanitize_html_class( $class ), esc_html( $screen_reader_text ), $links );
        }

        echo $navigation;
    }
}


function camel_sidebar_classes() {
    if ( is_active_sidebar( 'sidebar-left' ) && ! is_active_sidebar( 'sidebar-right' ) ) {
        echo 'order-md-2 col-md-8 col-lg-9';
    } elseif ( ! is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ) {
        echo 'order-2 col-md-8 col-lg-9';
    } elseif ( is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ) {
        echo 'order-sm-2 order-md-2 col-sm-4 col-lg-6';
    } else {
        echo 'order-2 col-sm-12';
    }
}


function camel_link_pages( $args = array () ) {
    $defaults = array(
        'before'      => '<p>' . __('Pages:', 'camel-framework'),
        'after'       => '</p>',
        'before_link' => '',
        'after_link'  => '',
        'current_before' => '',
        'current_after' => '',
        'link_before' => '',
        'link_after'  => '',
        'pagelink'    => '%',
        'echo'        => 1
    );

    $r = wp_parse_args( $args, $defaults );
    $r = apply_filters( 'wp_link_pages_args', $r );
    extract( $r, EXTR_SKIP );

    global $page, $numpages, $multipage, $more, $pagenow;

    if ( ! $multipage ) {
        return;
    }

    $output = $before;

    for ( $i = 1; $i < ( $numpages + 1 ); $i++ ) {
        $j       = str_replace( '%', $i, $pagelink );
        $output .= ' ';

        if ( $i != $page || ( ! $more && 1 == $page ) ) {
            $output .= "{$before_link}" . _camel_link_page( $i ) . "{$link_before}{$j}{$link_after}</a></li>{$after_link}";
        } else {
            $output .= "{$current_before}{$link_before}<li class='page-item mx-1'><a class='page-link rounded'>{$j}</a></li>{$link_after}{$current_after}";
        }
    }

    print $output . $after;
}

function _camel_link_page( $i ) {
    global $wp_rewrite;
    $post = get_post();
    $query_args = array();

    if ( 1 == $i ) {
        $url = get_permalink();
    } else {
        if ( '' == get_option('permalink_structure') || in_array($post->post_status, array('draft', 'pending')) )
            $url = add_query_arg( 'page', $i, get_permalink() );
        elseif ( 'page' == get_option('show_on_front') && get_option('page_on_front') == $post->ID )
            $url = trailingslashit(get_permalink()) . user_trailingslashit("$wp_rewrite->pagination_base/" . $i, 'single_paged');
        else
            $url = trailingslashit(get_permalink()) . user_trailingslashit($i, 'single_paged');
    }

    if ( is_preview() ) {
        if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
            $query_args['preview_id'] = wp_unslash( $_GET['preview_id'] );
            $query_args['preview_nonce'] = wp_unslash( $_GET['preview_nonce'] );
        }

        $url = get_preview_post_link( $post, $query_args, $url );
    }

    return '<li class="page-item mx-1"><a class="page-link rounded" href="' . esc_url( $url ) . '">';
}
