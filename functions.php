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

// Theme Setup
require get_template_directory() . '/core/inc/theme-setup.php';

// Theme Header Style
require get_template_directory() . '/core/inc/theme-header-style.php';

// Sidebar setup
require get_template_directory() . '/core/inc/theme-sidebars.php';

// Theme scripts
require get_template_directory() . '/core/inc/theme-scripts.php';

// Shortcodes
require get_template_directory() . '/core/inc/theme-shortcodes.php';

// Hooks
require get_template_directory() . '/core/inc/theme-hooks.php';

// Initialize camel core
require get_template_directory() . '/core/camel.php';
