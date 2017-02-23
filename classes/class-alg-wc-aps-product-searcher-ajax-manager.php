<?php
/**
 * Ajax Product Search for WooCommerce  - Product searcher Ajax Manager
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher_Ajax_Manager' ) ) {
	class Alg_WC_APS_Product_Searcher_Ajax_Manager {

		const ACTION_SEARCH_PRODUCTS = 'alg_wc_aps_search_products';

		function __construct() {
			$action = Alg_WC_APS_Product_Searcher_Ajax_Manager::ACTION_SEARCH_PRODUCTS;
			add_action( "wp_ajax_nopriv_{$action}", array( $this, 'search_products' ) );
			add_action( "wp_ajax_{$action}", array( $this, 'search_products' ) );
		}

		public function search_products() {
			if ( ! isset( $_GET['action'] ) || $_GET['action'] != self::ACTION_SEARCH_PRODUCTS ) {
				return;
			}
			if ( ! isset( $_GET['s'] ) ) {
				return;
			}

			$search_string = sanitize_text_field( $_GET['s'] );
			$paged         = intval( sanitize_text_field( $_GET['page'] ) );
			$alg_wc_aps    = alg_ajax_product_search_for_wc();
			$search_result = $alg_wc_aps->get_searcher()->search_products( array(
				's'     => $search_string,
				'paged' => $paged,
			) );

			$search_result_select_2 = $alg_wc_aps->get_searcher()->convert_products_search_result_to_select2( $search_result );
			wp_send_json_success( $search_result_select_2 );
		}

	}
}