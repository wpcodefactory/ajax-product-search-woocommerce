<?php
/**
 * Live Search for WooCommerce - Product Searcher AJAX Manager
 *
 * @version 2.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher_AJAX_Manager' ) ) :

class Alg_WC_APS_Product_Searcher_AJAX_Manager {

	/**
	 * Initializes.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @todo    [dev] (maybe) maybe move this to core
	 */
	function __construct() {
		$action = 'alg_wc_aps_search_products';
		add_action( "wp_ajax_nopriv_{$action}", array( $this, 'search_products' ) );
		add_action( "wp_ajax_{$action}",        array( $this, 'search_products' ) );
	}

	/**
	 * Searches products.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function search_products() {
		if ( ! isset( $_GET['action'] ) || 'alg_wc_aps_search_products' != $_GET['action'] || ! isset( $_GET['s'] ) ) {
			return;
		}
		// Search results
		$search_result = alg_wc_ajax_product_search()->core->get_searcher()->search_products( array(
			// Parameters from javascript
			's'             => sanitize_text_field( $_GET['s'] ),
			'cache_results' => isset( $_GET['cache_results'] ) ? filter_var( sanitize_text_field( $_GET['cache_results'] ), FILTER_VALIDATE_BOOLEAN ) : false,
			'paged'         => isset( $_GET['page'] )          ? intval( sanitize_text_field( $_GET['page'] ) )                                       : 1,
		) );
		// Search results in select 2 format
		$search_result_select_2 = alg_wc_ajax_product_search()->core->get_searcher()->convert_products_search_result_to_select2( $search_result,
			apply_filters( 'alg_wc_ajax_product_search_select2_args', array() ) );
		wp_send_json_success( $search_result_select_2 );
	}
}

endif;
