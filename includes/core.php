<?php

// Camel Nav Walker
require_once get_template_directory() . '/includes/core/class-camel-nav-walker.php';

// Camel Comment Walker
require_once get_template_directory() . '/includes/core/class-camel-comment-walker.php';

// Template tags
require_once get_template_directory() . '/includes/core/template-tags.php';

// Customizer
require_once get_template_directory() . '/includes/core/customizer.php';

// Load WooCommerce compatibility file.
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/includes/core/woocommerce.php';
}
