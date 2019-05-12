<?php
/**
 *  WooCommerce Templates Hooks
 *
 */


/**
 * Header
 *
 * @see ul_woocommerce_header()
 */
add_action( 'ul_woocommerce_header', 'ul_header_search', 5 );
add_action( 'ul_woocommerce_header', 'ul_header_account', 10 );
add_action( 'ul_woocommerce_header', 'ul_header_cart', 15 );


/**
 * Cart fragment
 *
 * @see ul_cart_link_fragment()
 */
if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '2.3', '>=' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'ul_cart_link_fragment' );
} else {
	add_filter( 'add_to_cart_fragments', 'ul_cart_link_fragment' );
}

// remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );

// Show caterory in ploduct list
add_action('ul_woocommerce_show_categories', 'ul_show_categories', 5);

// Custom woocommerce breadcrumb
add_action('custom_woocommerce_breadcrumb', 'woocommerce_breadcrumb', 5);

// Product single image in list
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('woocommerce_before_shop_loop_item_title', 'ul_template_loop_product_thumbnail', 15);

// Cart total block
remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10);
add_action('ul_cart_total_block', 'woocommerce_cart_totals', 5);

// Product list top block
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
add_action('ul_woocommerce_output_all_notices', 'woocommerce_output_all_notices', 10);
add_action('ul_woocommerce_result_count', 'woocommerce_result_count', 10);
add_action('ul_woocommerce_catalog_ordering', 'woocommerce_catalog_ordering', 10);

