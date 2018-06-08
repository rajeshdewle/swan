<?php
/**
 * Widget Name: About Us
 * Description: A widget to show popular post.
 */

class About_Us_Widget extends WP_Widget {

    public function __construct() {
        add_action('admin_enqueue_scripts', array($this, 'scripts')); // Add Widget scripts

        parent::__construct(
            'about-us-widget', // Widget ID
            __( 'Camel About Us Widget', 'camel-framework' ), // Widget Name
            array( 'description' => __('About Us widget for displaying user profile in the sidebar.', 'camel-framework') ) // Widget description
        );
    }

    public function scripts() {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();
        wp_enqueue_script('admin', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'));
    }

    // Display Widget on Front-page
    public function widget( $args, $instance ) {

        extract($args);

        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
		$title = apply_filters('widget_title', $instance['title']);
		$image =  $instance['image'];
		$about_textarea =  $instance['about_textarea'];
		$about_url =  $instance['about_url'];


		$before_widget = str_replace('class="', 'class="'. 'camel_About_Us_Widget' . ' ', $before_widget); // Add custom class

		echo $before_widget;

		echo '<div class="widget-text">'; // display widget

		if ($title) {
			echo $before_title . $title . $after_title;
		}

        ob_start();

        echo $args['before_widget'];

        ?>

        <?php if ($image) : ?>
            <img src="<?php echo esc_url($image); ?>" alt="">
        <?php endif; ?>

        <?php
        echo $args['after_widget'];

        ob_end_flush();

		if ($about_textarea) {
			echo '<p class="pt-2">'.$about_textarea.'</p>';
		}

		if ($about_url) {
			echo '<a href="'. $about_url .'" class="footer-about-lmore">Learn more</a>';
		}

		echo "</div>";

		echo $after_widget;
	}

    //Display the options form in the admin-area
    public function form( $instance ) {

        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';

        $defaults = array(
			'title' => __( 'About Us', 'camel-framework' ),
			'image' => site_url().'/wp-content/themes/camel-framework/assets/images/camel-logo.png',
			'about_textarea' => __('Camel framework is a beautiful open source WordPress Framework by Camel Team.', 'camel-framework'),
			'about_url' => '#',
         );

        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = ($instance) ? esc_attr($instance['title']) : '';
		$image = ($instance) ? esc_attr($instance['image']) : '';
		$about_textarea = ($instance) ? esc_attr($instance['about_textarea']) : '';
		$about_url = ($instance) ? esc_attr($instance['about_url']) : '';
    ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" class="title">
                <?php _e('Title:', 'camel-framework'); ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;  ?>" />
        </p>

        <!-- Upload Image-->
        <p>
            <label for="<?php echo $this->get_field_id( 'image' ); ?>">
                <?php _e( 'Image:', 'camel-framework' ); ?>
            </label>

            <img style="max-width:100%;display:block;margin:1rem 0;" src="<?php echo esc_url( $image ); ?>" />

            <input type="hidden" class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_url( $image ); ?>" />
            <input type="submit" class="upload_image_button button" name="<?php echo $this->get_field_name( 'uploader_button' ); ?>" id="<?php echo $this->get_field_id( 'uploader_button' ); ?>" value="<?php _e( 'Select an Image', 'camel-framework' ); ?>"); return false;" />
        </p>

        <!-- About textbox -->
        <p>
            <label for="<?php echo $this->get_field_id('about_textarea'); ?>">
                <?php _e( 'Description:', 'camel-framework' ); ?> <i>(max 20 words)</i>
            </label>

            <textarea cols="30" rows="7" class="widefat" id="<?php echo $this->get_field_id('about_textarea'); ?>" name="<?php echo $this->get_field_name('about_textarea'); ?>"><?php echo $about_textarea; ?></textarea>
        </p>

        <!-- About learn more link -->
        <p>
            <label for="<?php echo $this->get_field_id('about_url'); ?>">
                <?php _e( 'Learn more URL:', 'camel-framework' ); ?>
            </label>

            <input type="text" cols="30" rows="7" id="<?php echo $this->get_field_id('about_url'); ?>" name="<?php echo $this->get_field_name('about_url'); ?>" value="<?php echo $about_url; ?>">
        </p>
        <hr>

    <?php
    }

    // widgt update
    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        // update fields
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['about_textarea'] = strip_tags($new_instance['about_textarea']);
        $instance['about_url'] = strip_tags($new_instance['about_url']);

        return $instance;
    }

}

    // Hook to register widget in dashboard
add_action( 'widgets_init', function() { register_widget( 'About_Us_Widget' ); });


