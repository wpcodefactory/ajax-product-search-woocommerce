<?php
/**
 * Ajax Product Search for WooCommerce Pro - Search Settings
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Settings_Search' ) ) {

	class Alg_WC_APS_Settings_Search extends Alg_WC_APS_Settings_Section {

		const OPTION_CACHE_ENABLE = 'alg_wc_aps_search_cache_enable';
		const OPTION_CACHE_TIME   = 'alg_wc_aps_search_cache_time';

		/**
		 * Constructor.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function __construct( $handle_autoload = true ) {
			$this->id   = 'search';
			$this->desc = __( 'Search', 'ajax-product-search-woocommerce' );
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
					'title'    => __( 'Cache', 'ajax-product-search-woocommerce' ),
					'type'     => 'title',
					'id'       => 'alg_wc_aps_search_cache_opt',
				),
				array(
					'title'    => __( 'Enable cache', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'Saves search results in a transient', 'ajax-product-search-woocommerce' ),
					'desc_tip' => __( 'It helps improving search speed in high traffic sites', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_CACHE_ENABLE,
					'default'  => 'yes',
					'type'     => 'checkbox',
				),
				array(
					'title'    => __( 'Cache timeout', 'ajax-product-search-woocommerce' ),
					'desc'     => __( 'The amount of time results will be stored in transient (in hours)', 'ajax-product-search-woocommerce' ),
					'id'       => self::OPTION_CACHE_TIME,
					'default'  => '4',
					'type'     => 'number',
				),
				array(
					'type'     => 'sectionend',
					'id'       => 'alg_wc_aps_search_cache_opt',
				),
			);

			return parent::get_settings( array_merge( $settings, $new_settings ) );

		}

	}
}