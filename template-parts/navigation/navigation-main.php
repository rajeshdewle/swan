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
<nav id="site-navigation" class="main-navigation p-2">
    <button class="menu-toggle d-none d-sm-block d-md-none" aria-controls="primary-menu" aria-expanded="false">
        <?php esc_html_e( 'Main Menu', 'camel' ); ?>
    </button>

    <?php
        camel_nav_menu( array(
            'theme_location' => 'menu-main',
            'menu_id'        => 'main-menu',
            'menu_class'     => 'd-flex justify-content-between list-unstyled'
        ) );
    ?>
</nav><!-- #site-navigation -->
