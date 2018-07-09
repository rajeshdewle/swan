<?php
/**
 * -----------------------------------------------------------------------------
 * Login form
 * -----------------------------------------------------------------------------
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	Camel_Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( is_user_logged_in() ) {
    return;
}

?>


<form class="woocommerce-form woocommerce-form-login login" method="post" <?php echo ( $hidden ) ? 'style="display:none;"' : ''; ?>>
	<div class="p-4 border rounded mb-3 col-12">
	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php echo ( $message ) ? wpautop( wptexturize( $message ) ) : ''; // @codingStandardsIgnoreLine ?>

	<p class="form-row form-row-first mb-3">
		<label for="username"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input type="text" class="input-text form-control" name="username" id="username" autocomplete="username" />
	</p>
	<p class="form-row form-row-last mb-3">
		<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
		<input class="input-text form-control" type="password" name="password" id="password" autocomplete="current-password" />
	</p>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form' ); ?>

		<p class="form-row mb-3">
			<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
			<button type="submit" class="button btn btn-primary" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
			<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
			<div class="form-check">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline form-check-label">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox form-check-input" name="rememberme" type="checkbox" id="rememberme" value="forever" /><span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
			</div>
		</p>

	<p class="lost_password">
		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_login_form_end' ); ?>
	</div> <!-- .p-4 border rounded mb-3 col-12 col-sm-6 -->
</form>
