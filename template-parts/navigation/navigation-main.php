<?php
/**
 * -----------------------------------------------------------------------------
 * Displays main navigation
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 *
 * @package Camel_Framework
 */
?>
<nav class="menu-main navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">        
        <button class="navbar-toggler" type="button"  data-toggle="collapse" data-target="#menu-main" aria-controls="main-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php
            camel_nav_menu( array(
                'theme_location'  => 'menu-main',
                'container_id'    => 'menu-main',
                'container_class' => 'collapse navbar-collapse',
                'menu_class'      => 'navbar-nav mr-auto',
                'list_class'      => 'nav-item mr-2',
                'link_class'      => 'nav-link',
                'submenu_class'   => 'dropdown-menu'
            ) );
        ?>
    </div>
</nav><!-- #site-navigation -->
