<?php


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
            'gallery',
            'link',
            'image',
            'quote',
            'status',
            'video',
            'audio',
            'chat',
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
