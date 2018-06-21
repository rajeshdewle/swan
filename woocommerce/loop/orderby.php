<?php
/**
 * -----------------------------------------------------------------------------
 * Show options for ordering
 * -----------------------------------------------------------------------------
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 *
 * @package Camel_Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
    <form class="woocommerce-ordering" method="get">
        <div class="form-row align-items-center">
            <div class="col-auto my-1">
                <select name="orderby" class="orderby custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
                        <option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="hidden" name="paged" value="1" />
                <?php wc_query_string_form_fields( null, array( 'orderby', 'submit', 'paged', 'product-page' ) ); ?>
            </div><!-- .col-auto -->
        </div><!-- .form-row -->
    </form>
</div><!-- .d-flex -->