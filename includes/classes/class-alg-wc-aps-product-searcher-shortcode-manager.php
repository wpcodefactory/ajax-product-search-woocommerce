<?php
/**
 * Live Search for WooCommerce - Product Searcher Shortcode Manager
 *
 * @version 2.0.0
 * @since   1.0.0
 * @author  WPFactory.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher_Shortcode_Manager' ) ) :

class Alg_WC_APS_Product_Searcher_Shortcode_Manager {

	/**
	 * Initializes.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @todo    [dev] (maybe) maybe move this to core
	 */
	function __construct() {
		add_shortcode( 'alg_wc_aps_input', array( $this, 'create_search_input' ) );
	}

	/**
	 * Creates the search input.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function create_search_input( $atts ) {

		$atts = shortcode_atts( apply_filters( 'alg_wc_ajax_product_search_shortcode_atts', array(
			'placeholder' => alg_wc_aps_get_option( 'alg_wc_aps_texts_placeholder', __( 'Search products', 'ajax-product-search-woocommerce' ), 'text' ),
			'class'       => str_replace( '.', '', alg_wc_ajax_product_search()->core->get_searcher()->get_search_input_css_selector() ),
			'style'       => 'width:100%;',
		) ), $atts, 'alg_wc_aps_input' );

		// Default attributes
		$placeholder = esc_attr( sanitize_text_field( $atts['placeholder'] ) );
		$class       = esc_attr( sanitize_text_field( $atts['class'] ) );
		$style       = esc_attr( sanitize_text_field( $atts['style'] ) );

		// Cache option
		$cache       = esc_attr( alg_wc_aps_get_option( 'alg_wc_aps_search_cache_enable', 'yes', 'bool' ) );
		$cache_time  = esc_attr( alg_wc_aps_get_option( 'alg_wc_aps_search_cache_time', 4, 'int' ) );

		// Extra params
		$params      = apply_filters( 'alg_wc_ajax_product_search_shortcode_params', "data-redirect='true' style='{$style}'", $atts );

		return "<select {$params} data-cache_timeout='{$cache_time}' data-cache_results='{$cache}' placeholder='{$placeholder}' class='{$class}'></select>";

	}
}

endif;
