<?php
/**
 * -----------------------------------------------------------------------------
 * Displays main navigation
 * -----------------------------------------------------------------------------
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 *
 * @package Camel_Framework
 */
?>
<nav>
    <?php
        camel_nav_menu( array(
            'theme_location' => 'menu-social',
            'menu_id'        => 'social-menu',
            'menu_class'     => 'list-unstyled list-inline',
            'list_class'     => 'list-inline-item',
        ) );
    ?>
</nav><!-- #site-navigation -->
