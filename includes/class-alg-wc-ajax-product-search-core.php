<?php
/**
 * Live Search for WooCommerce - Core Class
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  Algoritmika Ltd
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_AJAX_Product_Search_Core' ) ) :

class Alg_WC_AJAX_Product_Search_Core {

	/**
	 * searcher.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @var     Alg_WC_APS_Product_Searcher
	 */
	private $searcher;

	/**
	 * Constructor.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function __construct() {
		if ( alg_wc_aps_get_option( 'alg_wc_aps_enable', 'yes', 'bool' ) ) {
			// Scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 11 );
			// Classes
			require_once( 'classes/class-alg-wc-aps-product-searcher.php' );
			require_once( 'classes/class-alg-wc-aps-product-searcher-ajax-manager.php' );
			require_once( 'classes/class-alg-wc-aps-product-searcher-widget-search-input.php' );
			require_once( 'classes/class-alg-wc-aps-product-searcher-scripts-manager.php' );
			require_once( 'classes/class-alg-wc-aps-product-searcher-shortcode-manager.php' );
			// Initialize products searcher
			$searcher = new Alg_WC_APS_Product_Searcher();
			$this->set_searcher( $searcher );
			$searcher->init();
		}
		// Core loaded
		do_action( 'alg_wc_ajax_product_search_core_loaded' );
	}

	/**
	 * Load scripts and styles.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function enqueue_scripts() {

		// Main js file
		wp_enqueue_script( 'alg-wc-aps',
			alg_wc_ajax_product_search()->plugin_url() . '/assets/js/alg-wc-aps' . ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min' ) . '.js',
			array( 'jquery' ),
			alg_wc_ajax_product_search()->version,
			true
		);
		wp_localize_script( 'alg-wc-aps', 'alg_wc_aps', apply_filters( 'alg-wc-aps-localize', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ), 'alg-wc-aps' ) );

		// Select2
		if ( alg_wc_aps_get_option( 'alg_wc_aps_select2_enable', 'yes', 'bool' ) ) {
			// Disable WooCommerce select 2 from some pages because it's old and conflicts with this plugin
			if ( is_checkout() || is_account_page() ) {
				wp_dequeue_script( 'select2' );
				wp_dequeue_style(  'select2' );
			}
			// Load select2
			wp_enqueue_script( 'alg-wc-aps-select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.min.js', array( 'jquery' ), false, true );
			wp_enqueue_style(  'alg-wc-aps-select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css',    array(),           false );
		}

	}

	/**
	 * get_searcher.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  Alg_WC_APS_Product_Searcher
	 */
	function get_searcher() {
		return $this->searcher;
	}

	/**
	 * set_searcher.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @param   Alg_WC_APS_Product_Searcher $searcher
	 */
	function set_searcher( $searcher ) {
		$this->searcher = $searcher;
	}

}

endif;

return new Alg_WC_AJAX_Product_Search_Core();
