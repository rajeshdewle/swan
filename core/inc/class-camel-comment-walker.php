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
            $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
            $comment_class[] = $this->has_children ? 'parent' : '';
            $comment_class[] = 'media';
            ?>

            <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment_class, $comment ); ?>>
                <?php if ( 0 != $args['avatar_size'] ) : ?>
                    <?php echo get_avatar( $comment, $args['avatar_size'], null, null, array( 'class' => 'mr-3 rounded' ) ); ?>
                <?php endif; ?>
                <div class="media-body table-responsive">

                <article id="div-comment-<?php comment_ID(); ?>">

                    <div class="mb-4">
                        <div class="d-flex mt-0">
                            <h5 class="mr-2">
                                <?php
                                    /* translators: %s: comment author link */
                                    printf( __( '%s <span class="says">says:</span>', 'camel-framework' ),
                                        sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
                                    ); ?>
                            </h5><!-- .comment-author -->
                            <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                                <time datetime="<?php comment_time( 'c' ); ?>">
                                    <?php
                                        /* translators: 1: comment date, 2: comment time */
                                        printf( __( '%1$s at %2$s', 'camel-framework' ), get_comment_date( '', $comment ), get_comment_time() ); ?>
                                </time>
                            </a>
                        </div>

                        <div class="mt-1">
                            <?php comment_text(); ?>
                        </div>
                        <div class="mt-1 d-flex">
                            <?php edit_comment_link( __( 'Edit', 'camel-framework' ), '<span class="edit-link mr-2">', '</span>' ); ?>

                            <?php if ( '0' == $comment->comment_approved ) : ?>
                                <p class="mr-2"><?php _e( 'Your comment is awaiting moderation.', 'camel-framework' ); ?></p>
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

        /**
         * Ends the element output, if needed.
         *
         * @since 2.7.0
         *
         * @see Walker::end_el()
         * @see wp_list_comments()
         *
         * @param string     $output  Used to append additional content. Passed by reference.
         * @param WP_Comment $comment The current comment object. Default current comment.
         * @param int        $depth   Optional. Depth of the current comment. Default 0.
         * @param array      $args    Optional. An array of arguments. Default empty array.
         */
        public function end_el( &$output, $comment, $depth = 0, $args = array() ) {
            if ( ! empty( $args['end-callback'] ) ) {
                ob_start();
                call_user_func( $args['end-callback'], $comment, $args, $depth );
                $output .= ob_get_clean();
                return;
            }
            if ( 'div' == $args['style'] ) {
                $output .= "</div></div><!-- #comment-## -->\n";
            } else {
                $output .= "</li><!-- #comment-## -->\n";
            }
        }


    }
}
