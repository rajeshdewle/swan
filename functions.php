<?php
/**
 * -----------------------------------------------------------------------------
 * camel framework functions and definitions
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Camel_Framework
 */

if (! function_exists('camel_setup')) :
    /**
    * Sets up theme defaults and registers support for various WordPress features.
    */
    function camel_setup() {
        /**
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on camel, use a find and replace
         * to change 'camel-framework' to the name of your theme in all the template files.
         */
        load_theme_textdomain('camel-framework', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /**
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /**
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // Register Nav Menus for Top, Social, Main & Footer
        register_nav_menus(array(
            'menu-top'      => __('Top Menu', 'camel-framework'),
            'menu-main'     => __('Main Menu', 'camel-framework'),
            'menu-social'   => __('Social Menu', 'camel-framework'),
            'menu-footer'   => __('Footer Menu', 'camel-framework'),
        ));

        /**
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /**
         * Enable support for Post Formats.
         *
         * @link https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        ));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('camel_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /**
         * Add support to enable the use of a custom logo.
         *
         * @link https://developer.wordpress.org/themes/functionality/custom-logo/
         */
        add_theme_support('custom-logo', array(
            'height'      => 100,
            'width'       => 400,
            'flex-height' => true,
            'flex-width'  => true,
        ));

        /**
         * Add custom header image support
         *
         * @link https://developer.wordpress.org/themes/functionality/custom-headers/
         */
        add_theme_support('custom-header', array(
            'default-text-color' => '000',
            'width'              => 1000,
            'height'             => 250,
            'flex-width'         => true,
            'flex-height'        => true,
            'wp-head-callback'   => 'camel_header_style',
        ));
    }
endif; // camel_setup

add_action('after_setup_theme', 'camel_setup');

if (! function_exists('camel_header_style')) {
    function camel_header_style() {
        $header_text_color = get_header_textcolor();
        if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
            return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
        <?php
        // Has the text been hidden?
        if ( ! display_header_text() ) :
            ?>
            .site-title,
            .site-description {
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }
        <?php
        // If the user has set a custom color for the text use that.
        else :
            ?>
            .site-title a,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }
        <?php endif; ?>
        </style>
        <?php
    }
}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function camel_content_width() {
    // This variable is intended to be overruled from themes.
    $GLOBALS['content_width'] = apply_filters('camel_content_width', 640);
}
add_action('after_setup_theme', 'camel_content_width', 0);


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function camel_widgets_init() {
    register_sidebar(array(
        'name'          => __('Left Sidebar', 'camel-framework'),
        'id'            => 'sidebar-left',
        'before_widget' => '<aside id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));

    register_sidebar(array(
        'name'          => __('Right Sidebar', 'camel-framework'),
        'id'            => 'sidebar-right',
        'before_widget' => '<aside id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ));
}

add_action('widgets_init', 'camel_widgets_init');


/**
 * Enqueue scripts and styles.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function camel_scripts() {
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/vendor/bootstrap/css/bootstrap.min.css', null, 4.1, false);

    wp_enqueue_style('camel-style', get_stylesheet_uri());

    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/vendor/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), 4.1, true);
}

add_action('wp_enqueue_scripts', 'camel_scripts');

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="page-link rounded"';
}


// Initialize camel core
require get_template_directory() . '/core/camel.php';

// Initialize about-us widget
require get_template_directory() . '/template-parts/widget/about.php';


function camel_gallery_shortcode( $attr ) {
    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        // 'ids' is explicitly ordered, unless you specify otherwise.
        if ( empty( $attr['orderby'] ) ) {
            $attr['orderby'] = 'post__in';
        }
        $attr['include'] = $attr['ids'];
    }

    /**
     * Filters the default gallery shortcode output.
     *
     * If the filtered output isn't empty, it will be used instead of generating
     * the default gallery template.
     *
     * @since 2.5.0
     * @since 4.2.0 The `$instance` parameter was added.
     *
     * @see gallery_shortcode()
     *
     * @param string $output   The gallery output. Default empty.
     * @param array  $attr     Attributes of the gallery shortcode.
     * @param int    $instance Unique numeric ID of this gallery shortcode instance.
     */
    $output = apply_filters( 'post_gallery', '', $attr, $instance );
    if ( $output != '' ) {
        return $output;
    }

    $html5 = current_theme_supports( 'html5', 'gallery' );
    $atts = shortcode_atts( array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post ? $post->ID : 0,
        'itemtag'    => $html5 ? 'figure'     : 'dl',
        'icontag'    => $html5 ? 'div'        : 'dt',
        'captiontag' => $html5 ? 'figcaption' : 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => '',
        'link'       => ''
    ), $attr, 'gallery' );

    $id = intval( $atts['id'] );

    if ( ! empty( $atts['include'] ) ) {
        $_attachments = get_posts( array( 'include' => $atts['include'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( ! empty( $atts['exclude'] ) ) {
        $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $atts['exclude'], 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    } else {
        $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $atts['order'], 'orderby' => $atts['orderby'] ) );
    }

    if ( empty( $attachments ) ) {
        return '';
    }

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
        }
        return $output;
    }

    $itemtag = tag_escape( $atts['itemtag'] );
    $captiontag = tag_escape( $atts['captiontag'] );
    $icontag = tag_escape( $atts['icontag'] );
    $valid_tags = wp_kses_allowed_html( 'post' );
    if ( ! isset( $valid_tags[ $itemtag ] ) ) {
        $itemtag = 'dl';
    }
    if ( ! isset( $valid_tags[ $captiontag ] ) ) {
        $captiontag = 'dd';
    }
    if ( ! isset( $valid_tags[ $icontag ] ) ) {
        $icontag = 'dt';
    }

    $columns = intval( $atts['columns'] );
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = '';

    /**
     * Filters whether to print default gallery styles.
     *
     * @since 3.1.0
     *
     * @param bool $print Whether to print default gallery styles.
     *                    Defaults to false if the theme supports HTML5 galleries.
     *                    Otherwise, defaults to true.
     */
    if ( apply_filters( 'use_default_gallery_style', ! $html5 ) ) {
        $gallery_style = "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
            }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
            /* see gallery_shortcode() in wp-includes/media.php */
        </style>\n\t\t";
    }

    $size_class = sanitize_html_class( $atts['size'] );
    $gallery_div = "<div id='$selector' class='row gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";

    /**
     * Filters the default gallery shortcode CSS styles.
     *
     * @since 2.5.0
     *
     * @param string $gallery_style Default CSS styles and opening HTML div container
     *                              for the gallery shortcode output.
     */
    $output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {

        $attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
        if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
            $image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
        } elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
            $image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
        } else {
            $image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
        }
        $image_meta  = wp_get_attachment_metadata( $id );

        $orientation = '';
        if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
            $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
        }

        switch ($columns) {
            case 1:
                $columnClass = 'col-12';
                break;

            case 2:
                $columnClass = 'col-6';
                break;

            case 3:
                $columnClass = 'col-4';
                break;

            case 4:
                $columnClass = 'col-3';
                break;

            case 6:
                $columnClass = 'col-2';
                break;

            default:
                $columnClass = 'col';
                break;
        }

        $output .= "<{$itemtag} class='gallery-item {$columnClass}'>";
        $output .= "
            <{$icontag} class='gallery-icon {$orientation}'>
                $image_output
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption' id='$selector-$id'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( ! $html5 && $columns > 0 && ++$i % $columns == 0 ) {
            $output .= '<br style="clear: both" />';
        }
    }

    if ( ! $html5 && $columns > 0 && $i % $columns !== 0 ) {
        $output .= "
            <br style='clear: both' />";
    }

    $output .= "
        </div>\n";

    return $output;
}

remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'camel_gallery_shortcode');


function camel_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="form-inline" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
            <div class="form-group">
                <label class="pass-label" for="' . $label . '">' . __( "Password:" ) . ' </label>
                <input type="password" class="form-control mx-sm-3" name="post_password" id="' . $label . '" placeholder="Password">
                <input type="submit" name="Submit" class="btn btn-primary" value="' . esc_attr__( "Submit" ) . '" />
            </div>
         </form>';
    return $o;
}
add_filter( 'the_password_form', 'camel_password_form' );