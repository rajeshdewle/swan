<?php

// Camel Nav Walker
require_once get_template_directory() . '/core/inc/class-camel-nav-walker.php';

// Camel Comment Walker
require_once get_template_directory() . '/core/inc/class-camel-comment-walker.php';

// Template tags
require_once get_template_directory() . '/core/inc/template-tags.php';

// Customizer
require_once get_template_directory() . '/core/inc/customizer.php';

// Widgets
require_once get_template_directory() . '/template-parts/widget/widget-about-us.php';
require_once get_template_directory() . '/template-parts/widget/widget-popular-post.php';

// Load WooCommerce compatibility file.
if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '/core/inc/woocommerce.php';
}