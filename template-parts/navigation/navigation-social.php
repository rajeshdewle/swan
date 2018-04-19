<?php
/**
 * -----------------------------------------------------------------------------
 * Displays social navigation
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 *
 * @package Camel_Framework
 */
?>
<nav class="menu-social">
    <?php
        camel_nav_menu( array(
            'theme_location' => 'menu-social',
            'menu_id'        => 'social-menu',
            'menu_class'     => 'nav justify-content-center justify-content-md-end',
            'list_class'     => 'nav-item my-2 ml-3',
            'link_class'     => 'nav-link p-0',
        ) );
    ?>
</nav><!-- #site-navigation -->
