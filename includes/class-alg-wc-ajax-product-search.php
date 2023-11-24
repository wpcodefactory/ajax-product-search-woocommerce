<?php
/**
 * Live Search for WooCommerce - Main Class
 *
 * @version 2.1.0
 * @since   2.0.0
 *
 * @author  WPFactory
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Alg_WC_AJAX_Product_Search' ) ) :

final class Alg_WC_AJAX_Product_Search {

	/**
	 * Plugin version.
	 *
	 * @var   string
	 * @since 2.0.0
	 */
	public $version = ALG_WC_AJAX_PRODUCT_SEARCH_VERSION;

	/**
	 * @var   Alg_WC_AJAX_Product_Search The single instance of the class
	 * @since 2.0.0
	 */
	protected static $_instance = null;

	/**
	 * Main Alg_WC_AJAX_Product_Search Instance
	 *
	 * Ensures only one instance of Alg_WC_AJAX_Product_Search is loaded or can be loaded.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 *
	 * @static
	 * @return  Alg_WC_AJAX_Product_Search - Main instance
	 */
	static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Alg_WC_AJAX_Product_Search Constructor.
	 *
	 * @version 2.1.0
	 * @since   2.0.0
	 *
	 * @access  public
	 */
	function __construct() {

		// Check for active WooCommerce plugin
		if ( ! function_exists( 'WC' ) ) {
			return;
		}

		// Set up localisation
		add_action( 'init', array( $this, 'localize' ) );

		// Pro
		if ( 'ajax-product-search-woocommerce-pro.php' === basename( ALG_WC_AJAX_PRODUCT_SEARCH_FILE ) ) {
			require_once( 'pro/class-alg-wc-ajax-product-search-pro.php' );
		}

		// Include required files
		$this->includes();

		// Admin
		if ( is_admin() ) {
			$this->admin();
		}

	}

	/**
	 * localize.
	 *
	 * @version 2.1.0
	 * @since   2.1.0
	 */
	function localize() {
		load_plugin_textdomain( 'ajax-product-search-woocommerce', false, dirname( plugin_basename( ALG_WC_AJAX_PRODUCT_SEARCH_FILE ) ) . '/langs/' );
	}

	/**
	 * includes.
	 *
	 * @version 2.1.0
	 * @since   2.0.0
	 */
	function includes() {
		// Functions
		require_once( 'alg-wc-ajax-product-search-functions.php' );
		// Core
		$this->core = require_once( 'class-alg-wc-ajax-product-search-core.php' );
	}

	/**
	 * admin.
	 *
	 * @version 2.1.0
	 * @since   2.0.0
	 */
	function admin() {
		// Action links
		add_filter( 'plugin_action_links_' . plugin_basename( ALG_WC_AJAX_PRODUCT_SEARCH_FILE ), array( $this, 'action_links' ) );
		// Settings
		add_filter( 'woocommerce_get_settings_pages', array( $this, 'add_woocommerce_settings_tab' ) );
		// Version updated
		if ( alg_wc_aps_get_option( 'alg_wc_aps_version', '' ) !== $this->version ) {
			add_action( 'admin_init', array( $this, 'version_updated' ) );
		}
	}

	/**
	 * action_links.
	 *
	 * @version 2.1.0
	 * @since   2.0.0
	 *
	 * @param   mixed $links
	 * @return  array
	 */
	function action_links( $links ) {
		$custom_links = array();
		$custom_links[] = '<a href="' . admin_url( 'admin.php?page=wc-settings&tab=alg_wc_aps' ) . '">' . __( 'Settings', 'woocommerce' ) . '</a>';
		if ( 'ajax-product-search-woocommerce.php' === basename( ALG_WC_AJAX_PRODUCT_SEARCH_FILE ) ) {
			$custom_links[] = '<a target="_blank" style="font-weight: bold; color: green;" href="https://wpfactory.com/item/live-search-for-woocommerce/">' .
				__( 'Go Pro', 'ajax-product-search-woocommerce' ) . '</a>';
		}
		return array_merge( $custom_links, $links );
	}

	/**
	 * add_woocommerce_settings_tab.
	 *
	 * @version 2.1.0
	 * @since   2.0.0
	 */
	function add_woocommerce_settings_tab( $settings ) {
		$settings[] = require_once( 'settings/class-alg-wc-ajax-product-search-settings.php' );
		return $settings;
	}

	/**
	 * version_updated.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function version_updated() {
		update_option( 'alg_wc_aps_version', $this->version );
	}

	/**
	 * plugin_url.
	 *
	 * @version 2.1.0
	 * @since   2.0.0
	 *
	 * @return  string
	 */
	function plugin_url() {
		return untrailingslashit( plugin_dir_url( ALG_WC_AJAX_PRODUCT_SEARCH_FILE ) );
	}

	/**
	 * plugin_path.
	 *
	 * @version 2.1.0
	 * @since   2.0.0
	 *
	 * @return  string
	 */
	function plugin_path() {
		return untrailingslashit( plugin_dir_path( ALG_WC_AJAX_PRODUCT_SEARCH_FILE ) );
	}

}

endif;
