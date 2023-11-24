<?php
/**
 * Live Search for WooCommerce - Texts Section Settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  WPFactory
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_AJAX_Product_Search_Settings_Texts' ) ) :

class Alg_WC_AJAX_Product_Search_Settings_Texts extends Alg_WC_AJAX_Product_Search_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function __construct() {
		$this->id   = 'texts';
		$this->desc = __( 'Texts', 'ajax-product-search-woocommerce' );
		parent::__construct();
	}

	/**
	 * get_settings.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function get_settings() {

		$texts_settings = array(
			array(
				'title'    => __( 'Text Options', 'ajax-product-search-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_ajax_product_search_texts_options',
			),
			array(
				'title'    => __( 'Input too short', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Text displayed when input is not long enough to start searching', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( '%d is going to be replaced by the amount of characters missing to start searching.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_texts_input_too_short',
				'default'  => __( 'Please enter %d or more characters', 'ajax-product-search-woocommerce' ),
				'type'     => 'textarea',

			),
			array(
				'title'    => __( 'Input too long', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Text displayed when input exceeded the maximum characters allowed', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( '%d is going to be replaced by the amount of characters missing to start searching.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_texts_input_too_long',
				'default'  => __( 'Please delete %d or more characters', 'ajax-product-search-woocommerce' ),
				'type'     => 'textarea',

			),
			array(
				'title'    => __( 'Error loading', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Text displayed when some error occurs', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_texts_error_loading',
				'default'  => __( 'Error loading results', 'ajax-product-search-woocommerce' ),
				'type'     => 'textarea',

			),
			array(
				'title'    => __( 'Loading more', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Text displayed when there are more results to be loaded', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_texts_loading_more',
				'default'  => __( 'Loading more...', 'ajax-product-search-woocommerce' ),
				'type'     => 'textarea',

			),
			array(
				'title'    => __( 'View all results', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Text displayed with a link pointing to a page showing all search results', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( '%d is going to be replaced by search results amount.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_texts_view_all_results',
				'default'  => __( 'View all results (%d)', 'ajax-product-search-woocommerce' ),
				'type'     => 'textarea',

			),
			array(
				'title'    => __( 'No results', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Text displayed when there are no found results', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_texts_no_results',
				'default'  => __( 'No results found', 'ajax-product-search-woocommerce' ),
				'type'     => 'textarea',

			),
			array(
				'title'    => __( 'Loading', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Text displayed when products are being searched', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_texts_searching',
				'default'  => __( 'Loading...', 'ajax-product-search-woocommerce' ),
				'type'     => 'textarea',
			),
			array(
				'title'    => __( 'Search products', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Search input placeholder', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_texts_placeholder',
				'default'  => __( 'Search products', 'ajax-product-search-woocommerce' ),
				'type'     => 'textarea',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_texts_options',
			),
		);

		return array_merge( $texts_settings );
	}

}

endif;

return new Alg_WC_AJAX_Product_Search_Settings_Texts();
