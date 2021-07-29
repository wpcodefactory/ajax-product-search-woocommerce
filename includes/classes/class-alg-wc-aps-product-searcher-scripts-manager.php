<?php
/**
 * Live Search for WooCommerce - Product Searcher Scripts Manager
 *
 * @version 2.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher_Scripts_Manager' ) ) :

class Alg_WC_APS_Product_Searcher_Scripts_Manager {

	/**
	 * Initializes.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @todo    [dev] (maybe) maybe move this to core
	 */
	function __construct() {
		add_action( 'alg-wc-aps-localize', array( $this, 'localize_scripts' ), 10, 2 );
		do_action( 'alg_wc_ajax_product_search_after_scripts' );
	}

	/**
	 * Localizes scripts.
	 *
	 * Adds dynamic variables to javascript.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function localize_scripts( $localize_obj, $script ) {
		$localize_obj['ajax_actions']                  = array( 'search_products' => 'alg_wc_aps_search_products' );
		$localize_obj['search_input_css_selector']     = alg_wc_ajax_product_search()->core->get_searcher()->get_search_input_css_selector();
		$localize_obj['select2_args']['inputTooShort'] = alg_wc_aps_get_option( 'alg_wc_aps_texts_input_too_short',
			__( 'Please enter %d or more characters', 'ajax-product-search-woocommerce' ), 'text' );
		$localize_obj['select2_args']['inputTooLong']  = alg_wc_aps_get_option( 'alg_wc_aps_texts_input_too_long',
			__( 'Please delete %d or more characters', 'ajax-product-search-woocommerce' ), 'text' );
		$localize_obj['select2_args']['errorLoading']  = alg_wc_aps_get_option( 'alg_wc_aps_texts_error_loading',
			__( 'Error loading results', 'ajax-product-search-woocommerce' ), 'text' );
		$localize_obj['select2_args']['loadingMore']   = alg_wc_aps_get_option( 'alg_wc_aps_texts_loading_more',
			__( 'Loading more...', 'ajax-product-search-woocommerce' ), 'text' );
		$localize_obj['select2_args']['noResults']     = alg_wc_aps_get_option( 'alg_wc_aps_texts_no_results',
			__( 'No results found', 'ajax-product-search-woocommerce' ), 'text' );
		$localize_obj['select2_args']['searching']     = alg_wc_aps_get_option( 'alg_wc_aps_texts_searching',
			__( 'Loading...', 'ajax-product-search-woocommerce' ), 'text' );
		return $localize_obj;
	}

}

endif;
