<?php
/**
 * -----------------------------------------------------------------------------
 * The right sidebar containing the main widget area
 * -----------------------------------------------------------------------------
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * 
 * @package Camel_Framework
 */
?>
    </div> <!-- .col-9 or .col-12 -->

<?php if (is_active_sidebar( 'sidebar-right' )) : ?>
    <div class="col-md-4">
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar( 'sidebar-right' ); ?>
        </aside><!-- #secondary -->
    </div><!-- .col-3 -->
<?php endif; ?>