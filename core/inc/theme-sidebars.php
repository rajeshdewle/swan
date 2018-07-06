<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function camel_widgets_init()
{
    register_sidebar([
        'name'          => __('Left Sidebar', 'camel-framework'),
        'id'            => 'sidebar-left',
        'before_widget' => '<aside id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ]);

    register_sidebar([
        'name'          => __('Right Sidebar', 'camel-framework'),
        'id'            => 'sidebar-right',
        'before_widget' => '<aside id="%1$s" class="widget %2$s mb-4">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ]);
}

add_action('widgets_init', 'camel_widgets_init');
