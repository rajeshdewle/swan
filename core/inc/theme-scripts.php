<?php

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
