<?php
/**
 * -----------------------------------------------------------------------------
 * Displays top navigation
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 *
 * @package Camel_Framework
 */
?>
<nav class="menu-top">
    <?php
        camel_nav_menu( array(
            'theme_location' => 'menu-top',
            'menu_id'        => 'top-menu',
            'depth'          => 1,
            'menu_class'     => 'nav justify-content-center justify-content-sm-start',
            'list_class'     => 'nav-item mr-3 my-2',
            'link_class'     => 'nav-link p-0',
        ) );
    ?>
</nav><!-- #site-navigation -->
