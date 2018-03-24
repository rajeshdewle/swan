<?php
/**
 * camel framework functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package camel_framework
 */

if ( ! function_exists('camel_setup') ) :
    //Sets up theme defaults and registers support for various WordPress features.
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