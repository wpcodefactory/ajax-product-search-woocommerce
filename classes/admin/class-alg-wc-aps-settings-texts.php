<?php
/**
 * Ajax Product Search for WooCommerce - Texts Settings
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Settings_Texts' ) ) {

	class Alg_WC_APS_Settings_Texts extends Alg_WC_APS_Settings_Section {

		const OPTION_INPUT_TOO_SHORT = 'alg_wc_aps_texts_input_too_short';
		const OPTION_INPUT_TOO_LONG  = 'alg_wc_aps_texts_input_too_long';
		const OPTION_ERROR_LOADING   = 'alg_wc_aps_texts_error_loading';
		const OPTION_LOADING_MORE    = 'alg_wc_aps_texts_loading_more';
		const OPTION_NO_RESULTS      = 'alg_wc_aps_texts_no_results';
		const OPTION_SEARCHING       = 'alg_wc_aps_texts_searching';

		/**
		 * Constructor.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function __construct( $handle_autoload = true ) {
			$this->id   = 'texts';
			$this->desc = __( 'Texts', 'alg-ajax-product-search-for-wc' );
			parent::__construct( $handle_autoload );
		}

		/**
		 * get_settings.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function get_settings( $settings = null ) {
			$new_settings = array(
				array(
					'title' => __( 'Text Options', 'alg-ajax-product-search-for-wc' ),
					'type'  => 'title',
					'id'    => 'alg_wc_aps_txts_opt',
				),
				array(
					'title'    => __( 'Input too short', 'alg-ajax-product-search-for-wc' ),
					'desc'     => __( 'Text displayed when input is not long enough to start searching', 'alg-ajax-product-search-for-wc' ),
					'desc_tip' => __( '%d is going to be replaced by the amount of characters missing to start searching', 'alg-ajax-product-search-for-wc' ),
					'id'       => self::OPTION_INPUT_TOO_SHORT,
					'default'  => __( 'Please enter %d or more characters', 'alg-ajax-product-search-for-wc' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'Input too long', 'alg-ajax-product-search-for-wc' ),
					'desc'     => __( 'Text displayed when input exceeded the maximum characters allowed', 'alg-ajax-product-search-for-wc' ),
					'desc_tip' => __( '%d is going to be replaced by the amount of characters missing to start searching', 'alg-ajax-product-search-for-wc' ),
					'id'       => self::OPTION_INPUT_TOO_LONG,
					'default'  => __( 'Please delete %d or more characters', 'alg-ajax-product-search-for-wc' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'Error loading', 'alg-ajax-product-search-for-wc' ),
					'desc'     => __( 'Text displayed when some error occurs', 'alg-ajax-product-search-for-wc' ),
					'id'       => self::OPTION_ERROR_LOADING,
					'default'  => __( 'Error loading results', 'alg-ajax-product-search-for-wc' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'Loading more', 'alg-ajax-product-search-for-wc' ),
					'desc'     => __( 'Text displayed when there are more results to be loaded', 'alg-ajax-product-search-for-wc' ),
					'id'       => self::OPTION_LOADING_MORE,
					'default'  => __( 'Loading more', 'alg-ajax-product-search-for-wc' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'No results', 'alg-ajax-product-search-for-wc' ),
					'desc'     => __( 'Text displayed when there are no found results', 'alg-ajax-product-search-for-wc' ),
					'id'       => self::OPTION_NO_RESULTS,
					'default'  => __( 'No results found', 'alg-ajax-product-search-for-wc' ),
					'type'     => 'textarea',

				),
				array(
					'title'    => __( 'Loading', 'alg-ajax-product-search-for-wc' ),
					'desc'     => __( 'Text displayed when products are being searched', 'alg-ajax-product-search-for-wc' ),
					'id'       => self::OPTION_SEARCHING,
					'default'  => __( 'Loading...', 'alg-ajax-product-search-for-wc' ),
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