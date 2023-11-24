<?php
/**
 * Live Search for WooCommerce - Section Settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  WPFactory
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_AJAX_Product_Search_Settings_Section' ) ) :

class Alg_WC_AJAX_Product_Search_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function __construct() {
		add_filter( 'woocommerce_get_sections_alg_wc_aps',              array( $this, 'settings_section' ) );
		add_filter( 'woocommerce_get_settings_alg_wc_aps_' . $this->id, array( $this, 'get_settings' ), PHP_INT_MAX );
	}

	/**
	 * settings_section.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function settings_section( $sections ) {
		$sections[ $this->id ] = $this->desc;
		return $sections;
	}

}

endif;
