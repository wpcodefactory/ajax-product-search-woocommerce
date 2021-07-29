<?php
/*
Plugin Name: Live Search for WooCommerce
Plugin URI: https://wpfactory.com/item/live-search-for-woocommerce/
Description: Provides an input with autocomplete feature to search WooCommerce products.
Version: 2.1.0
Author: Algoritmika Ltd
Author URI: https://algoritmika.com
Text Domain: ajax-product-search-woocommerce
Domain Path: /langs
WC requires at least: 3.0.0
WC tested up to: 5.5
*/

defined( 'ABSPATH' ) || exit;

if ( 'ajax-product-search-woocommerce.php' === basename( __FILE__ ) ) {
	/**
	 * Check if Pro plugin version is activated.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	$plugin = 'ajax-product-search-woocommerce-pro/ajax-product-search-woocommerce-pro.php';
	if (
		in_array( $plugin, (array) get_option( 'active_plugins', array() ), true ) ||
		( is_multisite() && array_key_exists( $plugin, (array) get_site_option( 'active_sitewide_plugins', array() ) ) )
	) {
		return;
	}
}

defined( 'ALG_WC_AJAX_PRODUCT_SEARCH_VERSION' ) || define( 'ALG_WC_AJAX_PRODUCT_SEARCH_VERSION', '2.1.0' );

defined( 'ALG_WC_AJAX_PRODUCT_SEARCH_FILE' )    || define( 'ALG_WC_AJAX_PRODUCT_SEARCH_FILE',    __FILE__ );

require_once( 'includes/class-alg-wc-ajax-product-search.php' );

if ( ! function_exists( 'alg_wc_ajax_product_search' ) ) {
	/**
	 * Returns the main instance of Alg_WC_AJAX_Product_Search to prevent the need to use globals.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function alg_wc_ajax_product_search() {
		return Alg_WC_AJAX_Product_Search::instance();
	}
}

add_action( 'plugins_loaded', 'alg_wc_ajax_product_search' );
