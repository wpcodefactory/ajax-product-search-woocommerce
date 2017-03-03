<?php
/**
 * Ajax Product Search for WooCommerce  - Product searcher shortcode manager
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher_Shortcode_Manager' ) ) {
	class Alg_WC_APS_Product_Searcher_Shortcode_Manager {

		const TAG_SEARCH_INPUT = 'alg_wc_aps_input';

		/**
		 * Initializes.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function __construct() {
			add_shortcode( self::TAG_SEARCH_INPUT, array( $this, 'create_search_input' ) );
		}

		/**
		 * Creates the search input.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		public function create_search_input( $atts ) {
			$alg_wc_aps = alg_ajax_product_search_for_wc();
			$class      = str_replace( ".", "", $alg_wc_aps->get_searcher()->get_search_input_css_selector() );

			$atts = shortcode_atts( array(
				'placeholder' => __( 'Search products', 'ajax-product-search-woocommerce' ),
				'class'       => $class,
				'style'       => 'width:100%;',
			), $atts, self::TAG_SEARCH_INPUT );

			// Default attributes
			$placeholder = esc_attr( sanitize_text_field( $atts['placeholder'] ) );
			$class       = esc_attr( sanitize_text_field( $atts['class'] ) );
			$style       = esc_attr( sanitize_text_field( $atts['style'] ) );

			// Cache option
			$cache      = esc_attr( filter_var( get_option( Alg_WC_APS_Settings_Search::OPTION_CACHE_ENABLE, true ), FILTER_VALIDATE_BOOLEAN ) );
			$cache_time = esc_attr( filter_var( get_option( Alg_WC_APS_Settings_Search::OPTION_CACHE_TIME, true ), FILTER_VALIDATE_INT ) );

			echo "
			<select data-cache_timeout='{$cache_time}' data-cache_results='{$cache}' placeholder='{$placeholder}' class='{$class}' style='{$style}'>
			</select>
			";
		}
	}
}