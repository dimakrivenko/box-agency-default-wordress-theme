<?php
/**
 * WooCommerce Widget Functions
 *
 * Widget related functions and widget registration.
 *
 * @package WooCommerce/Functions
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include widget classes.
include_once get_template_directory() . '/inc/woocommerce/widgets/ul-widget-price-range.php';

/**
 * Register Widgets.
 *
 * @since 2.3.0
 */
function ul_wc_register_widgets() {
	register_widget( 'UL_WC_Widget_Price_Filter' );
}
add_action( 'widgets_init', 'ul_wc_register_widgets' );