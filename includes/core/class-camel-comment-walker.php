<?php
/**
 * -----------------------------------------------------------------------------
 * Camel Framework Theme Comment Walker
 * -----------------------------------------------------------------------------
 *
 * @package Camel_Framework
 */

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
            $comment_class[] = $this->has_children ? 'd-md-flex align-items-md-start' : 'media';
            ?>

            <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $comment_class, $comment ); ?>>
                <?php if ( 0 != $args['avatar_size'] ) : ?>
                    <?php
                        $avatarClass = ($this->has_children) ? 'mr-3 rounded d-none d-md-block' : 'mr-3 rounded';
                    ?>
                    <?php echo get_avatar( $comment, $args['avatar_size'], null, null, array( 'class' => $avatarClass ) ); ?>
                <?php endif; ?>
                <div class="table-responsive">

                <article id="div-comment-<?php comment_ID(); ?>" class="media-body <?php echo ($this->has_children) ? 'd-flex d-md-block' : ''; ?>">
                    <?php if ($this->has_children) : ?>
                        <?php if ( 0 != $args['avatar_size'] ) : ?>
                            <?php echo get_avatar( $comment, $args['avatar_size'], null, null, array( 'class' => 'mr-3 rounded d-flex d-md-none' ) ); ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <div class="mb-4">
                        <div class="d-flex align-items-center mt-0">
                            <span class="mr-2">
                                <?php
                                    /* translators: %s: comment author link */
                                    printf( __( '%s <small class="says">says on</small>', 'camel-framework' ),
                                        sprintf( '<b class="fn">%s</b>', get_comment_author_link( $comment ) )
                                    ); ?>
                            </span><!-- .comment-author -->
                            <a href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
                                <small>
                                    <time datetime="<?php comment_time( 'c' ); ?>">
                                        <?php
                                            /* translators: 1: comment date, 2: comment time */
                                            printf( __( '%1$s at %2$s', 'camel-framework' ), get_comment_date( '', $comment ), get_comment_time() ); ?>
                                    </time>
                                </small>
                            </a>
                        </div>

                        <div class="mt-1 w-100">
                            <?php comment_text(); ?>
                        </div>
                        <div class="mt-1 d-flex">
                            <?php edit_comment_link( __( 'Edit', 'camel-framework' ), '<small class="edit-link mr-2">', '</small>' ); ?>

                            <?php if ( '0' == $comment->comment_approved ) : ?>
                                <p class="mr-2"><?php _e( 'Your comment is awaiting moderation.', 'camel-framework' ); ?></p>
                            <?php endif; ?>
                             <?php
                                comment_reply_link( array_merge( $args, array(
                                    'add_below' => 'div-comment',
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before'    => '<small class="reply">',
                                    'after'     => '</small>'
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

        /**
     * Outputs a pingback comment.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment The comment object.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function ping( $comment, $depth, $args ) {
        $tag = ( 'div' == $args['style'] ) ? 'div' : 'li'; ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( '', $comment ); ?>>
        <div class="media-body table-responsive mb-2">
            <div class="comment-body">
                <?php _e( 'Pingback:', 'camel-framework' ); ?> <?php comment_author_link( $comment ); ?> <?php edit_comment_link( __( 'Edit', 'camel-framework' ), '<span class="edit-link">', '</span>' ); ?>
            </div>
<?php
    }


    }
}
