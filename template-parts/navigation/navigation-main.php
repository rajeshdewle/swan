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
<nav id="site-navigation" class="main-navigation">

            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Main Menu', 'camel' ); ?></button>

            <?php
            wp_nav_menu( array(
                'theme_location' => 'menu-main',
                'menu_id'        => 'main-menu',
            ) );
            ?>

</nav><!-- #site-navigation -->