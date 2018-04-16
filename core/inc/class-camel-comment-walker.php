<?php

if ( ! class_exists( 'Camel_CommentWalker' ) ) {
    class Camel_CommentWalker extends Walker_Comment {
        /**
     * Outputs a comment in the HTML5 format.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
        protected function html5_comment( $comment, $depth, $args ) {
            $tag = ( 'div' === $args['style'] ) ? 'div' : 'li'; ?>

            <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="media">
                <?php if ( 0 != $args['avatar_size'] ) : ?>
                <?php echo get_avatar( $comment, $args['avatar_size'], null, null, array( 'class' => 'mr-3' ) ); ?>
                <?php endif; ?>

                <div class="media-body mb-4">
                    <div class="d-flex mt-0">
                        <h5 class="mr-2">
                            <?php
                                /* translators: %s: comment author link */
                                printf( __( '%s <span class="says">says:</span>' ),
                                    sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
                                ); ?>
                        </h5><!-- .comment-author -->
                        <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                            <time datetime="<?php comment_time( 'c' ); ?>">
                                <?php
                                    /* translators: 1: comment date, 2: comment time */
                                    printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() ); ?>
                            </time>
                        </a>
                    </div>

                    <div class="mt-1">
                        <?php comment_text(); ?>
                    </div>
                    <div class="mt-1 d-flex">
                        <?php edit_comment_link( __( 'Edit' ), '<span class="edit-link mr-2">', '</span>' ); ?>

                        <?php if ( '0' == $comment->comment_approved ) : ?>
                            <p class="mr-2"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
                        <?php endif; ?>
                         <?php
                            comment_reply_link( array_merge( $args, array(
                                'add_below' => 'div-comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'before'    => '<div class="reply">',
                                'after'     => '</div>'
                            ) ) ); ?>
                    </div>
                </div><!-- .comment-content -->
            </article><!-- .comment-body -->
            <?php
        }
    }
}
