<?php
/**
 * Ajax Product Search for WooCommerce - Texts Settings
 *
 * @version 1.0.9
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Settings_Texts' ) ) {

	class Alg_WC_APS_Settings_Texts extends Alg_WC_APS_Settings_Section {

		const OPTION_INPUT_TOO_SHORT        = 'alg_wc_aps_texts_input_too_short';
		const OPTION_INPUT_TOO_LONG         = 'alg_wc_aps_texts_input_too_long';
		const OPTION_ERROR_LOADING          = 'alg_wc_aps_texts_error_loading';
		const OPTION_LOADING_MORE           = 'alg_wc_aps_texts_loading_more';
		const OPTION_NO_RESULTS             = 'alg_wc_aps_texts_no_results';
		const OPTION_SEARCHING              = 'alg_wc_aps_texts_searching';
		const OPTION_VIEW_ALL_RESULTS       = 'alg_wc_aps_texts_view_all_results';
		const OPTION_PLACEHOLDER            = 'alg_wc_aps_texts_placeholder';

		/**
		 * Constructor.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function __construct( $handle_autoload = true ) {
			$this->id   = 'texts';
			$this->desc = __( 'Texts', 'ajax-product-search-woocommerce' );
			parent::__construct( $handle_autoload );
		}

		/**
		 * get_settings.
		 *
		 * @version 1.0.9
		 * @since   1.0.0
		 */
		function get_settings( $settings = null ) {
			$new_settings = array(
				array(
					'title' => __( 'Text Options', 'ajax-product-search-woocommerce' ),
					'type'  => 'title',
					'id'    => 'alg_wc_aps_txts_opt',
				),
				array(
					'title'    => __( 'Input too short', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Text displayed when input is not long enough to start searching', 'ajax-product-search-woocommerce' ),
					'desc_tip' => __( '%d is going to be replaced by the amount of characters missing to start searching', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_INPUT_TOO_SHORT,
					'default'  => __( 'Please enter %d or more characters', 'ajax-product-search-woocommerce' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'Input too long', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Text displayed when input exceeded the maximum characters allowed', 'ajax-product-search-woocommerce' ),
					'desc_tip' => __( '%d is going to be replaced by the amount of characters missing to start searching', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_INPUT_TOO_LONG,
					'default'  => __( 'Please delete %d or more characters', 'ajax-product-search-woocommerce' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'Error loading', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Text displayed when some error occurs', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_ERROR_LOADING,
					'default'  => __( 'Error loading results', 'ajax-product-search-woocommerce' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'Loading more', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Text displayed when there are more results to be loaded', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_LOADING_MORE,
					'default'  => __( 'Loading more...', 'ajax-product-search-woocommerce' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'View all results', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Text displayed with a link pointing to a page showing all search results', 'ajax-product-search-woocommerce' ),
					'desc_tip' => __( '%d is going to be replaced by search results amount', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_VIEW_ALL_RESULTS,
					'default'  => __( 'View all results (%d)', 'ajax-product-search-woocommerce' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'No results', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Text displayed when there are no found results', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_NO_RESULTS,
					'default'  => __( 'No results found', 'ajax-product-search-woocommerce' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'Loading', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Text displayed when products are being searched', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_SEARCHING,
					'default'  => __( 'Loading...', 'ajax-product-search-woocommerce' ),
					'type'     => 'textarea',
				),
				array(
					'title'    => __( 'Search products', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Search input placeholder', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_PLACEHOLDER,
					'default'  => __( 'Search products', 'ajax-product-search-woocommerce' ),
					'type'     => 'textarea',
				),
				array(
					'type' => 'sectionend',
					'id'   => 'alg_wc_aps_txts_opt',
				),
			);

			return parent::get_settings( array_merge( $settings, $new_settings ) );
		}
	}
}