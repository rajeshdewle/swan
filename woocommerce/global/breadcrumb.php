<?php
/**
 * -----------------------------------------------------------------------------
 * Shop breadcrumb
 * -----------------------------------------------------------------------------
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/breadcrumb.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * 
 * @package		Camel_Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) { ?>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<?php
			foreach ( $breadcrumb as $key => $crumb ) {
				if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
					echo '<li class="breadcrumb-item"><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
				} else {
					echo '<li class="breadcrumb-item active" aria-current="page">' . esc_html( $crumb[0] ) . '</li>';
				}
			}
			?>
		</ol>
	</nav>
<?php
}