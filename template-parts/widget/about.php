<?php
/**
* About Us widget.
*/
class About_Us_Widget extends WP_Widget {

    public function __construct() {

    // Add Widget scripts
    add_action('admin_enqueue_scripts', array($this, 'scripts'));

    parent::__construct(

    // Widget ID
    'about-us-widget', 

    /// Widget Name
    'Camel About Us Widget',

    // Widget description
    array( 'description' => 'About Us widget for displaying user profile in sidebar.' ) 

);

}

    public function scripts()
    {
        wp_enqueue_script( 'media-upload' );
        wp_enqueue_media();
        wp_enqueue_script('our_admin', get_template_directory_uri() . '/assets/js/admin.js', array('jquery'));
    }

    // Display Widget on Front-page
    public function widget( $args, $instance ) {

        extract($args);

        $image = ! empty( $instance['image'] ) ? $instance['image'] : '';
 
		$title = apply_filters('widget_title', $instance['title']);

		$image =  $instance['image'];
		
		$about_textarea =  $instance['about_textarea'];

		$about_url =  $instance['about_url'];

        //Add custom class
        	
		$before_widget = str_replace('class="', 'class="'. 'camel_About_Us_Widget' . ' ', $before_widget);

		echo $before_widget;

		//display widget
		echo '<div class="widget-text">';

		if ($title) {
			echo $before_title . $title . $after_title;
		}

        ob_start();
            echo $args['before_widget'];
        ?>
        
        <?php if($image): ?>
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
			'title' => 'About Us',
			'image' => site_url().'/wp-content/themes/camel-framework/assets/images/camel-logo.svg',
			'about_textarea' => 'Camel framework is a beautiful open source WordPress Framework by Camel Team.',
			'about_url' => '#',
         );
         
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        if ($instance){
			$title = esc_attr($instance['title']);

			//Mmage
			$image = esc_attr($instance['image']);

			//Textarea
			$about_textarea = esc_attr($instance['about_textarea']);

			//Link
			$about_url = esc_attr($instance['about_url']);
		}

		else
		{
			$title = '';
			$image = '';
			$about_textarea = '';
			$about_url = '';
		}

    ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>" class="title">
                <?php _e('Title:', 'camel_About_Us_Widget'); ?>
            </label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" 
            name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title;  ?>" />
        </p>

        <!-- Upload Image-->
        <p>    
            <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
             <button class="upload_image_button button button-primary">Upload Image</button>
        </p>

        <!-- About textbox -->
        <p>
            <label for="<?php echo $this->get_field_id('about_textarea'); ?>">
                About describtion <i>(max 20 words)</i>
            </label>

            <textarea cols="30" rows="7" class="widefat" id="<?php echo $this->get_field_id('about_textarea'); ?>"  
            name="<?php echo $this->get_field_name('about_textarea'); ?>"
            ><?php echo $about_textarea; ?></textarea>

        </p>

        <!-- About learn more link -->
        <p>
            <label for="<?php echo $this->get_field_id('about_url'); ?>">
                Learn more url
            </label>

            <input type="text" cols="30" rows="7" id="<?php echo $this->get_field_id('about_url'); ?>"  
            name="<?php echo $this->get_field_name('about_url'); ?>"
            value="<?php echo $about_url; ?>";
            >
        </p>

        <hr>
    
    <?php
}

    // widgt update
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        //fields
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['image'] = strip_tags($new_instance['image']);
        $instance['about_textarea'] = strip_tags($new_instance['about_textarea']);
        $instance['about_url'] = strip_tags($new_instance['about_url']);
        return $instance;
    }
    
}

    // Hook to register widget in dashboard
    add_action( 'widgets_init', function() {
    
        register_widget( 'About_Us_Widget' );

    });

?>
