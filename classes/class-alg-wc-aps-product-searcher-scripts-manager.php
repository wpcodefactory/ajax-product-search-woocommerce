<?php
/**
 * Ajax Product Search for WooCommerce  - Product searcher scripts manager
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher_Scripts_Manager' ) ) {
	class Alg_WC_APS_Product_Searcher_Scripts_Manager {

		/**
		 * Initializes.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function __construct() {
			add_action( 'alg-wc-aps-localize', array( $this, 'localize_scripts' ), 10, 2 );
		}

		/**
		 * Localizes scripts.
		 *
		 * Adds dynamic variables to javascript.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		public function localize_scripts( $localize_obj, $script ) {
			$alg_wc_aps                                = alg_ajax_product_search_for_wc();
			$localize_obj['ajax_actions']              = array(
				'search_products' => Alg_WC_APS_Product_Searcher_Ajax_Manager::ACTION_SEARCH_PRODUCTS,
			);
			$localize_obj['search_input_css_selector'] = $alg_wc_aps->get_searcher()->get_search_input_css_selector();

			return $localize_obj;
		}
	}
}