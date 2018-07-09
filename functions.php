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

// Initialize camel core
require get_template_directory() . '/includes/camel.php';

// WooCommerce Setup
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/includes/woocommerce.php';
}
