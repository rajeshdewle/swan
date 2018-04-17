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
    <button class="menu-toggle d-none d-sm-block d-md-none" aria-controls="primary-menu" aria-expanded="false">
        <?php esc_html_e( 'Footer Menu', 'camel' ); ?>
    </button>

    <?php
        camel_nav_menu( array(
            'theme_location' => 'menu-footer',
            'container_class' => 'w-100',
            'menu_id'        => 'main-menu',
            'menu_class'     => 'navbar-nav justify-content-center',
            'list_class'      => 'nav-item',
            'link_class'      => 'nav-link p-4',
            'depth'          => 1
        ) );
    ?>
</nav><!-- #site-navigation -->
