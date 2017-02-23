<?php
/**
 * Ajax Product Search for WooCommerce - General Section Settings
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Settings_General' ) ) {

	class Alg_WC_APS_Settings_General extends Alg_WC_APS_Settings_Section {

		const OPTION_ENABLE_PLUGIN = 'alg_wc_aps_enable';
		const OPTION_SELECT2_ENABLE = 'alg_wc_aps_select2_enable';
		//const OPTION_METABOX_PRO   = 'alg_wc_cp_cmb_pro';

		/**
		 * Constructor.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function __construct( $handle_autoload = true ) {
			$this->id   = '';
			$this->desc = __( 'General', 'alg-ajax-product-search-for-wc' );
			parent::__construct( $handle_autoload );
		}

		/**
		 * get_settings.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function get_settings( $settings = null ) {
			$new_settings = array(
				array(
					'title'    => __( 'General Options', 'alg-ajax-product-search-for-wc' ),
					'type'     => 'title',
					'id'       => 'alg_wc_aps_opt',
				),
				/*array(
					'title'       => __( 'Pro', 'alg-ajax-product-search-for-wc' ),
					'type'        => 'meta_box',
					'show_in_pro' => false,
					'title'       => 'Pro version',
					'description' => $this->get_meta_box_pro_description(),
					'id'          => self::OPTION_METABOX_PRO,
				),*/
				array(
					'title'    => __( 'Enable Plugin', 'alg-ajax-product-search-for-wc' ),
					'desc'     => __( 'Enable "Ajax Product Search for WooCommerce" plugin', 'alg-ajax-product-search-for-wc' ),
					'id'       => self::OPTION_ENABLE_PLUGIN,
					'default'  => 'yes',
					'type'     => 'checkbox',
				),
				array(
					'title'    => __( 'Load Select2', 'alg-ajax-product-search-for-wc' ),
					'desc'     => sprintf( __( 'Loads most recent version of <a target="_blank" href="%s">Select2</a>', 'alg-ajax-product-search-for-wc' ), 'https://select2.github.io/' ),
					'desc_tip' => __( 'Mark this only if you are not loading Select2 nowhere else. Select2 is responsible for improving the html select element.', 'alg-ajax-product-search-for-wc' ).'<br />'.__( 'It is required for this plugin to work. If you are uncertain, please let it enabled.', 'alg-ajax-product-search-for-wc' ),
					'id'       => self::OPTION_SELECT2_ENABLE,
					'default'  => 'yes',
					'type'     => 'checkbox',
				),
				array(
					'type'     => 'sectionend',
					'id'       => 'alg_wc_aps_opt',
				),
			);

			return parent::get_settings( array_merge( $settings, $new_settings ) );
		}

		/**
		 * Gets meta box description.
		 *
		 * The description is about the pro version of the plugin
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		/*function get_meta_box_pro_description() {
			$presentation   = __( 'Do you like the free version of this plugin? Imagine what the Pro version can do for you!', 'alg-ajax-product-search-for-wc' );
			$url            = 'https://coder.fm/item/ajax-product-search-for-woocommerce/';
			$links          = sprintf( wp_kses( __( 'Check it out <a target="_blank" href="%s">here</a> or on this link: <a target="_blank" href="%s">%s</a>', 'alg-ajax-product-search-for-wc' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $url ), esc_url( $url ), esc_url( $url ) );
			$features_title = __( 'Take a look on some of its features:', 'alg-ajax-product-search-for-wc' );
			$features       = array(
				__( 'Style your buttons easily', 'alg-ajax-product-search-for-wc' ),
				__( 'Choose in real time which comparison list columns will be displayed on front-end', 'alg-ajax-product-search-for-wc' ),
				__( 'Sort products on the comparison list by any field', 'alg-ajax-product-search-for-wc' ),
			);
			$features_str   =
				"<ul style='list-style:square inside'>" .
				"<li>" . implode( "</li><li>", $features ) . "</li>" .
				"</ul>";

			$call_to_action = sprintf( __( '<a target="_blank" style="margin:9px 0 15px 0;" class="button-primary" href="%s">Upgrade to Pro version now</a> ', 'alg-ajax-product-search-for-wc' ), esc_url( $url ) );

			return "
				<p>{$presentation}<br/>
				{$links}</p>
				<strong>{$features_title}</strong>
				{$features_str}
				{$call_to_action}
			";
		}*/

	}
}