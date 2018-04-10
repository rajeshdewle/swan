<?php
/**
 * Templates Tags
 */

/**
 * Camel nav menu
 *
 * @param  array  $args
 * @return WP_Nav_Menu
 */
function camel_nav_menu($args = array()) {
    $args['walker'] = new Camel_Navwalker();

    return wp_nav_menu($args);
}
