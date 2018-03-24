<?php
/**
 * camel framework functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package camel_framework
 */

if ( ! function_exists('camel_setup') ) :
    /**
    * Sets up theme defaults and registers support for various WordPress features.
    */
    function camel_setup() {
        // Register Nav Menus for Top, Social, Main & Footer
        register_nav_menus( array(
            'menu-top'   => __( 'Top Menu', 'camel' ),
            'menu-main' => __( 'Main Menu', 'camel' ),
            'menu-social' => __( 'Social Menu', 'camel' ),
            'menu-footer' => __( 'Footer Menu', 'camel' ),
        ) );
    }
endif; // camel_setup
add_action( 'after_setup_theme', 'camel_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function camel_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Left Sidebar', 'theme_name' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
 
    register_sidebar( array(
        'name'          => __( 'Right Sidebar', 'theme_name' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        'after_widget'  => '</li></ul>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'camel_widgets_init' );