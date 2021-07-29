<?php
/**
 * Live Search for WooCommerce - Search Section Settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  Algoritmika Ltd
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_AJAX_Product_Search_Settings_Search' ) ) :

class Alg_WC_AJAX_Product_Search_Settings_Search extends Alg_WC_AJAX_Product_Search_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function __construct() {
		$this->id   = 'search';
		$this->desc = __( 'Search', 'ajax-product-search-woocommerce' );
		parent::__construct();
	}

	/**
	 * get_settings.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function get_settings() {

		$cache_settings = array(
			array(
				'title'    => __( 'Cache', 'ajax-product-search-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_ajax_product_search_cache_options',
			),
			array(
				'title'    => __( 'Cache', 'ajax-product-search-woocommerce' ),
				'desc'     => '<strong>' . __( 'Enable', 'ajax-product-search-woocommerce' ) . '</strong>',
				'desc_tip' => __( 'Saves search results in a transient.', 'ajax-product-search-woocommerce' ) . ' ' .
					__( 'It helps improving search speed in high traffic sites.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_search_cache_enable',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'title'    => __( 'Cache timeout', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'hours', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'The amount of time results will be stored in transient (in hours).', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_search_cache_time',
				'default'  => '4',
				'type'     => 'number',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_cache_options',
			),
		);

		return array_merge( $cache_settings );
	}

}

endif;

return new Alg_WC_AJAX_Product_Search_Settings_Search();
