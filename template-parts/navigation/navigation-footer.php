<?php
/**
 * -----------------------------------------------------------------------------
 * Displays footer navigation
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 *
 * @package Camel_Framework
 */
?>
<nav class="menu-footer navbar navbar-expand-lg navbar-light">
    <?php
        camel_nav_menu( array(
            'theme_location' => 'menu-footer',
            'container_class' => 'w-100',
            'menu_id'        => 'main-menu',
            'menu_class'     => 'nav justify-content-center',
            'list_class'      => 'nav-item mx-2 my-1',
            'link_class'      => 'nav-link p-0',
            'depth'          => 1
        ) );
    ?>
</nav><!-- #site-navigation -->
