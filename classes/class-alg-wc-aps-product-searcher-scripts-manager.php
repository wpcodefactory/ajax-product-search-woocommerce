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
			$alg_wc_aps                                    = alg_ajax_product_search_for_wc();
			$localize_obj['ajax_actions']                  = array(
				'search_products' => Alg_WC_APS_Product_Searcher_Ajax_Manager::ACTION_SEARCH_PRODUCTS,
			);
			$localize_obj['search_input_css_selector']     = $alg_wc_aps->get_searcher()->get_search_input_css_selector();
			$localize_obj['select2_args']['inputTooShort'] = sanitize_text_field( get_option( Alg_WC_APS_Settings_Texts::OPTION_INPUT_TOO_SHORT ) );
			$localize_obj['select2_args']['inputTooLong']  = sanitize_text_field( get_option( Alg_WC_APS_Settings_Texts::OPTION_INPUT_TOO_LONG ) );
			$localize_obj['select2_args']['errorLoading']  = sanitize_text_field( get_option( Alg_WC_APS_Settings_Texts::OPTION_ERROR_LOADING ) );
			$localize_obj['select2_args']['loadingMore']   = sanitize_text_field( get_option( Alg_WC_APS_Settings_Texts::OPTION_LOADING_MORE ) );
			$localize_obj['select2_args']['noResults']     = sanitize_text_field( get_option( Alg_WC_APS_Settings_Texts::OPTION_NO_RESULTS ) );
			$localize_obj['select2_args']['searching']     = sanitize_text_field( get_option( Alg_WC_APS_Settings_Texts::OPTION_SEARCHING ) );

			return $localize_obj;
		}
	}
}