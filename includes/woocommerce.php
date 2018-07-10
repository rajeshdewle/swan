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
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function camel_woocommerce_related_products_args( $args ) {
    $defaults = array( 'posts_per_page' => 3 );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'camel_woocommerce_related_products_args' );

/**
 * Cart Fragments.
 *
 * Ensure cart contents update when products are added to the cart via AJAX.
 *
 * @param array $fragments Fragments to refresh via AJAX.
 * @return array Fragments to refresh via AJAX.
 */
function camel_woocommerce_cart_link_fragment( $fragments ) {
    ob_start(); ?>
        <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'camel-framework' ); ?>">
            <?php
            $item_count_text = sprintf(
                /* translators: number of items in the mini cart. */
                _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'camel-framework' ),
                WC()->cart->get_cart_contents_count()
            ); ?>
            <span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
        </a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'camel_woocommerce_cart_link_fragment' );

/**
 * Customize product title in woocommerce loop.
 */
function camel_template_loop_product_title() {
    ?>
    <h5 class="pt-2 woocommerce-loop-product__title"><?php echo get_the_title(); ?></h5>
    <?php
}
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
add_action( 'woocommerce_shop_loop_item_title', 'camel_template_loop_product_title' );

/**
 * Add bootstrap form classes to checkout form.
 * @param  array $fields
 */
function camel_checkout_form_fields($fields) {
    foreach ($fields as &$fieldset) {
        foreach ($fieldset as &$field) {
            $field['class'][] = 'form-group d-block pb-3';
            $field['input_class'][] = 'form-control';
        }
    }
    return $fields;
}
add_filter('woocommerce_checkout_fields', 'camel_checkout_form_fields' );

/**
 * Added bootstrap classes to view cart button in cart widget
 */
function camel_widget_shopping_cart_button_view_cart() {
    echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="button wc-forward btn btn-success btn-sm btn-block" target="_blank">'. esc_html__( 'View Cart', 'camel-framework' ) .'</a>';
}
remove_action('woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_button_view_cart', 10);
add_action( 'woocommerce_widget_shopping_cart_buttons', 'camel_widget_shopping_cart_button_view_cart');

/**
 * Added bootstrap classes to view checkout button in cart widget
 */
function camel_widget_shopping_cart_proceed_to_checkout() {
    echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="button wc-forward btn btn-warning btn-sm btn-block" target="_blank">'. esc_html__( 'Checkout', 'camel-framework' ) .'</a>';
}
remove_action( 'woocommerce_widget_shopping_cart_buttons', 'woocommerce_widget_shopping_cart_proceed_to_checkout', 20);
add_action( 'woocommerce_widget_shopping_cart_buttons', 'camel_widget_shopping_cart_proceed_to_checkout');

/**
 * Added bootstrap classes to product list widget in sidebar
 */
function camel_woocommerce_before_widget_product_list() {
    return '<div class="product_list_widget">';
};
add_filter( 'woocommerce_before_widget_product_list', 'camel_woocommerce_before_widget_product_list', 10, 1 );

/**
 * Added bootstrap classes to product list widget in sidebar
 */
function camel_woocommerce_after_widget_product_list() {
    return "</div> <!-- .product_list_widget -->";
};
add_filter( 'woocommerce_after_widget_product_list', 'camel_woocommerce_after_widget_product_list', 10, 1 );

/**
 * Added bootstrap classes to product review list widget in sidebar
 */
function camel_before_widget_product_review_list() {
    return '<div class="product_list_widget">';
};
add_filter( 'woocommerce_before_widget_product_review_list', 'camel_before_widget_product_review_list', 10, 1 );

/**
 * Added bootstrap classes to product review list widget in sidebar
 */
function camel_after_widget_product_review_list() {
    return "</div> <!-- .product_list_widget --> ";
};
add_filter( 'woocommerce_after_widget_product_review_list', 'camel_after_widget_product_review_list', 10, 1 );

