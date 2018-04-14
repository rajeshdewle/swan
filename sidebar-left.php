<?php
/**
 * -----------------------------------------------------------------------------
 * The left sidebar containing the main widget area
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 * @package Camel_Framework
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) {
    return;
}
?>

    <div class="col-3">
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'sidebar-left' ); ?>
        </aside><!-- #secondary -->
    </div><!-- .col-3 -->