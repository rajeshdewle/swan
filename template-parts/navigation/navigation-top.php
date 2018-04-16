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
<nav class="p-2">
    <?php
        camel_nav_menu( array(
            'theme_location' => 'menu-top',
            'menu_id'        => 'top-menu',
            'depth'          => 1,
            'menu_class'     => 'list-unstyled list-inline',
            'list_class'     => 'list-inline-item',
        ) );
    ?>
</nav><!-- #site-navigation -->
