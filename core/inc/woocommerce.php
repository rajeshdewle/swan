<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Camel_Framework
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function camel_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'camel_woocommerce_setup' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Enqueue WooCommerce custom styles.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 */
function camel_woocommerce_style() {
    wp_enqueue_style('woocommerce-css', get_template_directory_uri() . '/assets/css/woocommerce.css');
}
add_action('wp_enqueue_scripts', 'camel_woocommerce_style');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function camel_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'camel_woocommerce_active_body_class' );

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function camel_woocommerce_products_per_page() {
	return 12;
}
add_filter( 'loop_shop_per_page', 'camel_woocommerce_products_per_page' );

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function camel_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'camel_woocommerce_thumbnail_columns' );

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function camel_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'camel_woocommerce_loop_columns' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function camel_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'camel_woocommerce_related_products_args' );

if ( ! function_exists( 'camel_woocommerce_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper.
	 *
	 * @return  void
	 */
	function camel_woocommerce_product_columns_wrapper() {
		$columns = camel_woocommerce_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}
add_action( 'woocommerce_before_shop_loop', 'camel_woocommerce_product_columns_wrapper', 40 );

if ( ! function_exists( 'camel_woocommerce_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close.
	 *
	 * @return  void
	 */
	function camel_woocommerce_product_columns_wrapper_close() {
		echo '</div>';
	}
}
add_action( 'woocommerce_after_shop_loop', 'camel_woocommerce_product_columns_wrapper_close', 40 );

/**
 * Remove default WooCommerce wrapper.
 *
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'camel_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 *
	function camel_woocommerce_wrapper_before() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
	}
}
add_action( 'woocommerce_before_main_content', 'camel_woocommerce_wrapper_before' );

if ( ! function_exists( 'camel_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 *
	function camel_woocommerce_wrapper_after() {
			?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'camel_woocommerce_wrapper_after' );
*/
/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'camel_woocommerce_header_cart' ) ) {
			camel_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'camel_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function camel_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		camel_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'camel_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'camel_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function camel_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'camel' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'camel' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'camel_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function camel_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php camel_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}

/*
function camel_product_loop_start() {
	?>
	<div class="row">
	<?php
}

add_filter('woocommerce_product_loop_start', 'camel_product_loop_start');

function camel_product_loop_end() {
	?>
	</div><!-- .row -->
	<?php
}

add_filter('woocommerce_product_loop_end', 'camel_product_loop_end');
*/
function camel_template_loop_product_title() {
	?>	
	<h5 class="pt-2 woocommerce-loop-product__title"><?php echo get_the_title(); ?></h5>
	<?php
}
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
add_action( 'woocommerce_shop_loop_item_title', 'camel_template_loop_product_title' );

add_filter('woocommerce_billing_fields', 'camel_billing_fields');

function camel_billing_fields( $fields ) {
	$fields['billing_first_name']['class'] = array( 'form-group d-block pt-3'  );
	$fields['billing_first_name']['input_class'] = array( 'form-control' );
	$fields['billing_last_name']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_last_name']['input_class'] = array( 'form-control' );
	$fields['billing_company']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_company']['input_class'] = array( 'form-control' );
	$fields['billing_country']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_country']['input_class'] = array( 'form-control' );
	$fields['billing_address_1']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_address_1']['input_class'] = array( 'form-control' );
	$fields['billing_address_2']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_address_2']['input_class'] = array( 'form-control' );
	$fields['billing_city']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_city']['input_class'] = array( 'form-control' );
	$fields['billing_postcode']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_postcode']['input_class'] = array( 'form-control' );
	$fields['billing_state']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_state']['input_class'] = array( 'form-control' );
	$fields['billing_email']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_email']['input_class'] = array( 'form-control' );
	$fields['billing_phone']['class'] = array( 'form-group d-block pt-3' );
	$fields['billing_phone']['input_class'] = array( 'form-control' );
  return $fields;
}

add_filter('woocommerce_shipping_fields', 'camel_shipping_fields');

function camel_shipping_fields( $fields ) {
	$fields['shipping_first_name']['class'] = array( 'form-group d-block pt-3'  );
	$fields['shipping_first_name']['input_class'] = array( 'form-control' );
	$fields['shipping_last_name']['class'] = array( 'form-group d-block pt-3' );
	$fields['shipping_last_name']['input_class'] = array( 'form-control' );
	$fields['shipping_company']['class'] = array( 'form-group d-block pt-3' );
	$fields['shipping_company']['input_class'] = array( 'form-control' );
	$fields['shipping_country']['class'] = array( 'form-group d-block pt-3' );
	$fields['shipping_country']['input_class'] = array( 'form-control' );
	$fields['shipping_address_1']['class'] = array( 'form-group d-block pt-3' );
	$fields['shipping_address_1']['input_class'] = array( 'form-control' );
	$fields['shipping_address_2']['class'] = array( 'form-group d-block pt-3' );
	$fields['shipping_address_2']['input_class'] = array( 'form-control' );
	$fields['shipping_city']['class'] = array( 'form-group d-block pt-3' );
	$fields['shipping_city']['input_class'] = array( 'form-control' );
	$fields['shipping_postcode']['class'] = array( 'form-group d-block pt-3' );
	$fields['shipping_postcode']['input_class'] = array( 'form-control' );
	$fields['shipping_state']['class'] = array( 'form-group d-block pt-3' );
	$fields['shipping_state']['input_class'] = array( 'form-control' );
  return $fields;
}


add_filter('woocommerce_checkout_fields', 'camel_order_fields');

function camel_order_fields( $fields ) {
	$fields['order']['order_comments']['class'] = array( 'form-group d-block pt-3' );
	$fields['order']['order_comments']['input_class'] = array( 'form-control' );
	return $fields;
}


remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10 );
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20 );

function camel_widget_shopping_cart_view_cart() {
    echo '<div class="d-flex"><div class="mr-2"><a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward btn btn-success btn-sm" target="_blank">'. esc_html__( 'View Order', 'woocommerce' ) .'</a></div>';
}

add_action( 'woocommerce_widget_shopping_cart_buttons', 'camel_widget_shopping_cart_view_cart', 10 );

function camel_widget_shopping_cart_proceed_to_checkout() {
    echo '<div><a href="' . esc_url( wc_get_checkout_url() ) . '" class="button wc-forward btn btn-warning btn-sm" target="_blank">'. esc_html__( 'Checkout', 'woocommerce' ) .'</a></div><div>';
}
add_action( 'woocommerce_widget_shopping_cart_buttons', 'camel_widget_shopping_cart_proceed_to_checkout', 20 );

 
function camel_woocommerce_before_widget_product_list() { 
    return '<div class="product_list_widget">'; 
};        
add_filter( 'woocommerce_before_widget_product_list', 'camel_woocommerce_before_widget_product_list', 10, 1 );


function camel_woocommerce_after_widget_product_list() { 
	return "</div> <!-- .product_list_widget -->"; 
};         
add_filter( 'woocommerce_after_widget_product_list', 'camel_woocommerce_after_widget_product_list', 10, 1 );


function camel_before_widget_product_review_list() { 
    return '<div class="product_list_widget">'; 
};        
add_filter( 'woocommerce_before_widget_product_review_list', 'camel_before_widget_product_review_list', 10, 1 );


function camel_after_widget_product_review_list() { 
	return "</div> <!-- .product_list_widget --> "; 
};         
add_filter( 'woocommerce_after_widget_product_review_list', 'camel_after_widget_product_review_list', 10, 1 );
