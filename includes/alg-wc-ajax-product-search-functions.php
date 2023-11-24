<?php
/**
 * Live Search for WooCommerce - Functions
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  WPFactory
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! function_exists( 'alg_wc_aps_get_option' ) ) {
	/**
	 * alg_wc_aps_get_option.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function alg_wc_aps_get_option( $option, $default = false, $validate = '' ) {
		$value = get_option( $option, $default );
		switch ( $validate ) {
			case 'bool':
				return filter_var( $value, FILTER_VALIDATE_BOOLEAN );
			case 'int':
				return filter_var( $value, FILTER_VALIDATE_INT );
			case 'text':
			case 'color':
				return sanitize_text_field( $value );
			default:
				return $value;
		}
	}
}
