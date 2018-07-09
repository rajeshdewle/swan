<?php

// Theme Core
require_once get_template_directory() . '/includes/core.php';

// Theme Functions
require_once get_template_directory() . '/includes/functions.php';

// Theme Widgets
require_once get_template_directory() . '/includes/widgets.php';

// WooCommerce Setup
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/includes/woocommerce.php';
}
