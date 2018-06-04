<?php
/**
 * Widget Name: Popular Post Widget
 * Description: A widget to show popular post.
 */

// The popular post widget class
class Camel_Popular_Posts_Widget extends WP_Widget {
     /**
     * Register widget with WordPress.
     */
    public function __construct() {
        parent::__construct(
            'camel_popular_posts', // Widget ID
            'Camel Popular Posts', // Widget Name
            array( 'description' => __( 'A widget to display popular posts by number of comments.', 'camel-framework' ), ) // Widget Descriptions
        );
    }

    /**
     * Front-end display of widget.
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {
        extract( $args );
    	$title = apply_filters( 'widget_title', $instance['title'] );
		$number = $instance['number'];
        $query = new WP_Query( array( 'showposts' => $number, 'orderby' => 'comment_count', 'order' => 'DESC', 'ignore_sticky_posts' => 1 ) );

        echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;	?>
			<ul>
            <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
			    <li>
                    <a href="<?php echo get_permalink() ?>"><?php the_title(); ?></a>
                </li>
			<?php endwhile; endif;?>
			</ul>

	    <?php echo $after_widget;
    }

    /**
     * Back-end widget form.
     * @param array $instance Previously saved values from database.
     */
    function form( $instance ) {
		$defaults = array( 'title' => __('Popular Posts', 'camel-framewok'), 'number' => __('5', 'camel-framewok') );
		$instance = wp_parse_args( $instance, $defaults ); ?>
        <p>
		    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'camel-framewok'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<p>
		    <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e('Number of Post:', 'camel-framewok'); ?></label>
		    <input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" value="<?php echo $instance['number']; ?>" style="width:100%;" type="number"/>
        </p><?php
    }

    /**
     * Sanitize widget form values as they are saved.
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     * @return array Updated safe values to be saved.
     */
    public function update( $new_instance, $old_instance ) {
	    $instance = array();
	    //The strip_tags() function strips a string from HTML, XML, and PHP tags.
	    $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['number'] = strip_tags( $new_instance['number'] );

	    return $instance;
	}
}
// function to register popular post widget
add_action( 'widgets_init', function() { register_widget( 'camel_popular_posts_widget' ); } );
