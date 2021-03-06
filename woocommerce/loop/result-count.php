<?php
/**
 * -----------------------------------------------------------------------------
 * Result Count
 * -----------------------------------------------------------------------------
 *
 * Shows text: Showing x - x of x results.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/result-count.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 *
 * @package Camel_Framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="d-flex justify-content-between align-items-center mb-2">
	<div class="woocommerce-result-count">
		<?php
		if ( $total <= $per_page || -1 === $per_page ) {
			/* translators: %d: total results */
			printf( _n( 'Showing the single result', 'Showing all %d results', $total, 'camel-framework' ), $total );
		} else {
			$first = ( $per_page * $current ) - $per_page + 1;
			$last  = min( $total, $per_page * $current );
			/* translators: 1: first result 2: last result 3: total results */
			printf( _nx( 'Showing the single result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'camel-framework' ), $first, $last, $total );
		}
		?>
	</div><!-- .woocommerce-result-count -->