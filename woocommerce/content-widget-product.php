<?php
/**
 * -----------------------------------------------------------------------------
 * The template for displaying product widget entries.
 * -----------------------------------------------------------------------------
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package Camel_Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="media mb-2">
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>

	<a class="mr-3" href="<?php echo esc_url( $product->get_permalink() ); ?>">
		<?php echo $product->get_image( array( 84, 84 ) ); ?>
	</a>

	<div class="media-body">

		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<h5 class="product-title mt-0"><?php echo $product->get_name(); ?></h5>
		</a>

		<?php if ( ! empty( $show_rating ) ) : ?>
			<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
		<?php endif; ?>

		<?php echo $product->get_price_html(); ?>

	</div> <!-- .media-body -->

	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</div> <!-- .media -->
