<?php
/**
 * -----------------------------------------------------------------------------
 * The sidebar containing the main widget area
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Camel_Framework
 */

?>
<?php if (is_active_sidebar('sidebar-left')) {
    ?>
    <div class="order-1 col-sm-4 col-md-4 col-lg-3">
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'sidebar-left' ); ?>
        </aside><!-- #secondary -->
    </div><!-- .col-3 -->
<?php
} ?>

<?php if (is_active_sidebar('sidebar-right')) {
        ?>
    <div class="order-3 col-sm-4 col-md-4 col-lg-3">
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'sidebar-right' ); ?>
        </aside><!-- #secondary -->
    </div><!-- .col-3 -->
<?php
    } ?>


