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
<div class="bg-light">
    <div class="container">        
        <nav class="menu-main navbar navbar-expand-lg navbar-light pl-0 pr-0">
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
    </div> <!-- .container -->
</nav><!-- #site-navigation -->
</div> <!-- .bg-light -->