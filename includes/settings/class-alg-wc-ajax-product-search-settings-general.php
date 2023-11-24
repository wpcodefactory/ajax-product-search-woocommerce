<?php
/**
 * Live Search for WooCommerce - General Section Settings
 *
 * @version 2.0.0
 * @since   2.0.0
 * @author  WPFactory
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_AJAX_Product_Search_Settings_General' ) ) :

class Alg_WC_AJAX_Product_Search_Settings_General extends Alg_WC_AJAX_Product_Search_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function __construct() {
		$this->id   = '';
		$this->desc = __( 'General', 'ajax-product-search-woocommerce' );
		parent::__construct();
	}

	/**
	 * get_settings.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 * @todo    [dev] (maybe) better "Pro" text ("Advanced" section)
	 */
	function get_settings() {

		$plugin_settings = array(
			array(
				'title'    => __( 'Live Search Options', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'AJAX product search options.', 'ajax-product-search-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_ajax_product_search_plugin_options',
			),
			array(
				'title'    => __( 'Live Search', 'ajax-product-search-woocommerce' ),
				'desc'     => '<strong>' . __( 'Enable plugin', 'ajax-product-search-woocommerce' ) . '</strong>',
				'id'       => 'alg_wc_aps_enable',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_plugin_options',
			),
		);

		$general_settings = array(
			array(
				'title'    => __( 'General Options', 'ajax-product-search-woocommerce' ),
				'type'     => 'title',
				'id'       => 'alg_wc_ajax_product_search_general_options',
			),
			array(
				'title'    => __( 'Load Select2', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Enable', 'ajax-product-search-woocommerce' ),
				'desc_tip' => sprintf( __( 'Loads most recent version of <a target="_blank" href="%s">Select2</a>.', 'ajax-product-search-woocommerce' ), esc_url( 'https://select2.github.io/' ) ) . '<br />' .
					'* ' . __( 'Mark this only if you are not loading Select2 nowhere else. Select2 is responsible for improving the html select element.', 'ajax-product-search-woocommerce' ) . '<br />' .
					'* ' . __( 'It is required for this plugin to work. If you are uncertain, please leave it enabled.', 'ajax-product-search-woocommerce' ),
				'id'       => 'alg_wc_aps_select2_enable',
				'default'  => 'yes',
				'type'     => 'checkbox',
			),
			array(
				'title'    => 'Pro version',
				'enable'   => apply_filters( 'alg_wc_ajax_product_search_settings', true ),
				'type'     => 'alg_wc_aps_meta_box',
				'accordion' => array(
					'title' => __( 'Take a look on some of its features:', 'ajax-product-search-woocommerce' ),
					'items' => array(
						array(
							'trigger' => __( 'Display product thumbnail, price and categories on search results', 'ajax-product-search-woocommerce'),
							'img_src' => plugin_dir_url( __FILE__ ) . '../../assets/images/autocomplete.png',
						),
						array(
							'trigger' => __( 'Play with some styling options', 'ajax-product-search-woocommerce'),
							'img_src' => plugin_dir_url( __FILE__ ) . '../../assets/images/styling-options.gif',
						),
						array(
							'trigger' => __( 'A more complete search widget', 'ajax-product-search-woocommerce'),
							'img_src' => plugin_dir_url( __FILE__ ) . '../../assets/images/widget.png',
						),
						array(
							'trigger' => __( 'Select multiple results', 'ajax-product-search-woocommerce' ),
							'img_src' => plugin_dir_url( __FILE__ ) . '../../assets/images/multiple-selection.png',
						),
						array(
							'trigger' => __( 'Choose if you want to redirect on search result selection', 'ajax-product-search-woocommerce' ),
						),
						array(
							'trigger' => __( 'Support', 'ajax-product-search-woocommerce' ),
						),
					),
				),
				'call_to_action' => array(
					'href'  => 'https://wpfactory.com/item/live-search-for-woocommerce/',
					'label' => 'Upgrade to Pro version now',
				),
				'description' => __( 'Do you like the free version of this plugin? Imagine what the Pro version can do for you!', 'ajax-product-search-woocommerce' ) . '<br />' .
					sprintf( __( 'Check it out <a target="_blank" href="%1$s">here</a> or on this link: <a target="_blank" href="%1$s">%1$s</a>', 'ajax-product-search-woocommerce' ),
						esc_url( 'https://wpfactory.com/item/live-search-for-woocommerce/' ) ),
				'id'       => 'alg_wc_aps_cmb_pro',
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_general_options',
			),
		);

		$advanced_settings = array(
			array(
				'title'    => __( 'Advanced', 'ajax-product-search-woocommerce' ),
				'desc'     => apply_filters( 'alg_wc_ajax_product_search_settings',
					'Advanced settings are available in <a href="https://wpfactory.com/item/live-search-for-woocommerce/" target="_blank">Pro version</a> only.' ),
				'type'     => 'title',
				'id'       => 'alg_wc_ajax_product_search_advanced_options',
			),
			array(
				'title'    => __( 'Multiple selection', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Enable', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'Allows multiple value selection.', 'ajax-product-search-woocommerce' ) . '<br />' .
					'* ' . __( 'The search input will not automatically redirect to the selected search result.', 'ajax-product-search-woocommerce' ) . '<br />' .
					'* ' . sprintf( __( 'You can use the shortcode %s to turn on this feature on a separated field.', 'ajax-product-search-woocommerce' ),
						'<code>[alg_wc_aps_input multiple="true"]</code>' ),
				'id'       => 'alg_wc_aps_multi_value',
				'default'  => 'no',
				'type'     => 'checkbox',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'title'    => __( 'Automatic redirection', 'ajax-product-search-woocommerce' ),
				'desc'     => __( 'Enable', 'ajax-product-search-woocommerce' ),
				'desc_tip' => __( 'Redirects automatically to the selected search result.', 'ajax-product-search-woocommerce' ) . '<br />' .
					'* ' . __( 'It does not work with "Multiple selection".', 'ajax-product-search-woocommerce' ) . '<br />' .
					'* ' . sprintf( __( 'You can use the shortcode %s to turn off this feature on a separated field.', 'ajax-product-search-woocommerce' ),
						'<code>[alg_wc_aps_input redirect="false"]</code>' ),
				'id'       => 'alg_wc_aps_redirect',
				'default'  => 'yes',
				'type'     => 'checkbox',
				'custom_attributes' => apply_filters( 'alg_wc_ajax_product_search_settings', array( 'disabled' => 'disabled' ) ),
			),
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_ajax_product_search_advanced_options',
			),
		);

		return array_merge( $plugin_settings, $general_settings, $advanced_settings );
	}

}

endif;

return new Alg_WC_AJAX_Product_Search_Settings_General();
