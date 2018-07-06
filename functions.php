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


add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes()
{
    return 'class="page-link rounded"';
}


// Initialize camel core
require get_template_directory() . '/core/camel.php';


// Shortcodes
require get_template_directory() . '/core/inc/theme-shortcodes.php';


/**
 * Password form for password protected post
 *
 * @return void
 */
function camel_password_form()
{
    global $post;
    $label = 'pwbox-'.(empty($post->ID) ? rand() : $post->ID);
    $o = '<form class="form-inline" action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post">
            <div class="form-group">
                <label class="password" for="' . $label . '">' . __("Password:", "camel-framework") . ' </label>
                <input type="password" class="form-control mx-sm-3" name="post_password" id="' . $label . '" placeholder="Password">
                <input type="submit" name="Submit" class="btn btn-primary" value="' . __("Submit", "camel-framework") . '" />
            </div>
         </form>';
    return $o;
}
add_filter('the_password_form', 'camel_password_form');


function camel_add_custom_table_class($content)
{
    return str_replace('<table>', '<table class="table">', $content);
}
add_filter('the_content', 'camel_add_custom_table_class');
