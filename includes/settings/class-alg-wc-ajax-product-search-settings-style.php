<?php
/**
 * Live Search for WooCommerce - Style Section Settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  WPFactory
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_AJAX_Product_Search_Settings_Style' ) ) :

class Alg_WC_AJAX_Product_Search_Settings_Style extends Alg_WC_AJAX_Product_Search_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function __construct() {
		$this->id   = 'style';
		$this->desc = __( 'Style', 'ajax-product-search-woocommerce' );
		parent::__construct();
	}

	/**
	 * get_settings.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 * @todo    [dev] (maybe) better "Pro" text
	 * @todo    [dev] (maybe) double check all default values for colors in "General Style" and "Search Results Style" sections to match the defaults in free version
	 */
	function get_settings() {

		$style_settings = array(
			array(
				'title'    => __( 'Style Options', 'ajax-product-search-woocommerce' ),
				'desc'     => apply_filters( 'alg_wc_ajax_product_search_settings',
					'Styling options are available in <a href="https://wpfactory.com/item/live-search-for-woocommerce/" target="_blank">Pro version</a> only.', 'style' ),
				'type'     => 'title',
				'id'       => 'alg_wc_ajax_product_search_style_options',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_style_options',
			),
		);

		$search_results_template_settings = array(
			array(
				'title'    => __( 'Search Results Template', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Options regarding the search results template.', 'ajax-product-search-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_ajax_product_search_results_template_options',
			),
			array(
				'title'    => __( 'Thumbnail', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Enable', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'Shows the product thumbnail.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_template_thumb_enable',
				'default'  => 'no',
				'type'     => 'checkbox',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'title'    => __( 'Price', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Enable', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'Shows the product price.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_template_price_enable',
				'default'  => 'no',
				'type'     => 'checkbox',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'title'    => __( 'Category', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Enable', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'Shows the product category.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_template_category_enable',
				'default'  => 'no',
				'type'     => 'checkbox',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_results_template_options',
			),
		);

		$general_style_settings = array(
			array(
				'title'    => __( 'General Style ', 'ajax-product-search-woocommerce' ),
				'type'     => 'title',
				'desc'     => __( 'General style options.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_ajax_product_search_general_style_options',
			),
			array(
				'title'    => __( 'Placeholder color', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'Placeholder text color.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_style_placeholder_color',
				'default'  => '#6d6d6d',
				'type'     => 'color',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_general_style_options',
			),
		);

		$search_results_style_settings = array(
			array(
				'title'    => __( 'Search Results Style', 'ajax-product-search-woocommerce' ),
				'type'     => 'title',
				'desc'     => __( 'Options regarding the search results style.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_ajax_product_search_results_style_options',
			),
			array(
				'title'    => __( 'Alignment', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'General alignment of search results.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_style_sr_align',
				'default'  => 'left',
				'type'     => 'select',
				'options'  => array(
					'left'  => __( 'Left', 'ajax-product-search-woocommerce' ),
					'right' => __( 'Right', 'ajax-product-search-woocommerce' ),
				),
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'title'    => __( 'Text color', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'Text color of search results.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_style_sr_txt_color',
				'default'  => '#6d6d6d',
				'type'     => 'color',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'title'    => __( 'Text color - hover', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'Text color of search result when mouse is over it.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_style_sr_txt_hover_color',
				'default'  => '#fff',
				'type'     => 'color',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'title'    => __( 'Background color - hover', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'The background color of a search result when mouse is over it.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_style_sr_hover_bkg_color',
				'default'  => '#5897fb',
				'type'     => 'color',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_results_style_options',
			),
		);

		return array_merge( $style_settings, $search_results_template_settings, $general_style_settings, $search_results_style_settings );
	}

}

endif;

return new Alg_WC_AJAX_Product_Search_Settings_Style();
