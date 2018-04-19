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
?>

<?php if (is_active_sidebar( 'sidebar-left' )) : ?>
    <div class="col-sm-4 col-md-4 col-lg-3">
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'sidebar-left' ); ?>
        </aside><!-- #secondary -->
    </div><!-- .col-3 -->
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-left' ) && ! is_active_sidebar( 'sidebar-right' ) ) : ?>
    <div class="col-md-8 col-lg-9">
<?php elseif ( ! is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ): ?>
    <div class="col-md-8 col-lg-9">
<?php elseif ( is_active_sidebar( 'sidebar-left' ) && is_active_sidebar( 'sidebar-right' ) ) : ?>
    <div class="col-sm-4 col-lg-6">
<?php else : ?>
    <div class="col-sm-12">
<?php endif ?>

