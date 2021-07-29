<?php
/**
 * Live Search for WooCommerce - Settings
 *
 * @version 2.1.0
 * @since   2.0.0
 *
 * @author  Algoritmika Ltd
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_AJAX_Product_Search_Settings' ) ) :

class Alg_WC_AJAX_Product_Search_Settings extends WC_Settings_Page {

	/**
	 * Constructor.
	 *
	 * @version 2.1.0
	 * @since   2.0.0
	 */
	function __construct() {
		$this->id    = 'alg_wc_aps';
		$this->label = __( 'Live Search', 'ajax-product-search-woocommerce' );
		parent::__construct();
		add_action( 'woocommerce_admin_field_' . 'alg_wc_aps_meta_box', array( $this, 'add_aps_meta_box' ), 10, 2 );
		// Sections
		require_once( 'class-alg-wc-ajax-product-search-settings-section.php' );
		require_once( 'class-alg-wc-ajax-product-search-settings-general.php' );
		require_once( 'class-alg-wc-ajax-product-search-settings-texts.php' );
		require_once( 'class-alg-wc-ajax-product-search-settings-search.php' );
		require_once( 'class-alg-wc-ajax-product-search-settings-style.php' );
	}

	/**
	 * Creates `alg_wc_aps_meta_box` meta box.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 *
	 * @todo    [maybe] (dev) clean up all related to `alg_wc_aps_meta_box`
	 */
	function add_aps_meta_box( $value ) {
		// Don't show metabox if enable = false
		if ( ( isset( $value['enabled'] ) && false == $value['enabled'] ) || ( isset( $value['enable'] ) && false == $value['enable'] ) ) {
			return;
		}
		$option_description    = isset( $value['description'] ) ? '<p>' . $value['description'] : '' . '</p>';
		$option_accordion      = $this->get_accordion( $value );
		$option_call_to_action = $this->get_call_to_action( $value );
		$option_accordion_str  = ! empty( $option_accordion ) ? $option_accordion : '';
		$option_title          = $value['title'];
		$option_id             = esc_attr( $value['id'] );
		echo '
			<tr><th scope="row" class="titledesc">' . $option_title . '</th><td>
			<div id="poststuff">
				<div id="' . $option_id . '" class="postbox">
					<div class="inside">
						' . $option_description . $option_accordion_str . $option_call_to_action. '
					</div>
				</div>
			</div></td></tr>
		';
		$style = $this->get_inline_style();
		$js    = $this->get_inline_js();
		echo $style . $js;
	}

	/**
	 * Gets the html for the accordion.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	private function get_accordion( $value ) {
		$accordion = isset( $value['accordion'] ) ? $value['accordion'] : false;
		if ( ! $accordion ) {
			return '';
		}
		$items = ! empty( $accordion['items'] ) ? $accordion['items'] : false;
		if ( ! $items ) {
			return '';
		}
		$title = ! empty( $accordion['title'] ) ? $accordion['title'] : '';
		$final_items = " <ul class='alg-wc-aps-meta-box-admin-accordion' > ";
		foreach ( $items as $item ) {
			$li_class = 'item';
			if ( ! empty( $item['hidden_content'] ) ) {
				$li_class    .= ' accordion-item';
				$trigger     = ! empty( $item['trigger'] ) ? '<span class="trigger">' . esc_html( $item['trigger'] ) . '</span>' : '';
				$final_items .= " <li class='" . esc_attr( $li_class ) . "' >{$trigger}<div class='details-container' > " . esc_html( $item['hidden_content'] ) . " </div></li> ";
			} else {
				$trigger     = ! empty( $item['trigger'] ) ? '<span class="trigger">' . esc_html( $item['trigger'] ) . '</span>' : '';
				$img         = ! empty( $item['img_src'] ) ? '<div class="img-container"><img src="' . esc_attr( $item['img_src'] ) . '"></div>' : '';
				$description = ! empty( $item['description'] ) ? '<div class="desc_container">' . $item['description'] . '</div>' : '';
				if ( ! empty( $img ) || ! empty( $description ) ) {
					$li_class .= ' accordion-item';
				}
				$final_items .= " <li class='" . esc_attr( $li_class ) . "' >{$trigger}<div class='details-container' >{$description}{$img}</div ></li> ";
			}
		}
		$final_items .= '</ul>';
		return "
			<div class='alg-wc-aps-meta-box-admin-accordion-title' >
				<strong>{$title}</strong >
			</div>
			{$final_items}
		";
	}

	/**
	 * Gets the button.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	private function get_call_to_action( $value ) {
		$call_to_action = isset( $value['call_to_action'] ) ? $value['call_to_action'] : false;
		if ( ! $call_to_action ) {
			return '';
		}
		$args = wp_parse_args( $call_to_action, array(
			'href'   => '',
			'label'  => 'Check it',
			'href'   => '',
			'target' => '_blank',
			'class'  => 'button-primary',
		) );
		if ( empty( $args['href'] ) ) {
			return '';
		}
		return sprintf( "<a target='%s' class='%s alg-wc-aps-meta-box-call-to-action' href='%s'>%s</a>",
			esc_attr( $args['target'] ), esc_attr( $args['class'] ), esc_url( $args['href'] ), esc_html( $args['label'] ) );
	}

	/**
	 * Gets the style for the metabox.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function get_inline_style() {
		$style = '
			<style>
				.alg-wc-aps-meta-box-admin-accordion .details-container{
					display:none;
					margin-top:10px;
					margin-bottom:15px;
					background:#f9f9f9;
					padding:13px;
				}
				.alg-wc-aps-meta-box-admin-accordion .desc_container{
					color:#999;
				}
				.alg-wc-aps-meta-box-admin-accordion .accordion-item .trigger{
					color:#0073aa;
					cursor:pointer;
				}
				.alg-wc-aps-meta-box-admin-accordion .img-container img{
					border:4px solid #ddd;
					margin-top:10px;
					max-width:100%;
				}
				.alg-wc-aps-meta-box-admin-accordion .accordion-item .trigger:hover{
				text-decoration: underline;
				}
				.alg-wc-aps-meta-box-admin-accordion .item:not(.accordion-item):before{
					width:8px;
					height:8px;
					content:" ";
					display:inline-block;
					background:#000;
					margin-right:8px;
				}
				.alg-wc-aps-meta-box-admin-accordion .accordion-item:before{
					content:" ";
					width: 0;
					height: 0;
					border-left: 5px solid transparent;
					border-right: 5px solid transparent;
					border-top: 9px solid #0073aa;
					display:inline-block;
					margin-right:7px;
					transition:all 0.3s ease-in-out;
					transform: rotate(-90deg);
				}
				.alg-wc-aps-meta-box-admin-accordion .accordion-item.active:before{
				transform: rotate(0deg);
					transform-origin: 50% 50%;
				}
				.alg-wc-aps-meta-box-admin-accordion-title{
					margin-top:23px;
				}
				.alg-wc-aps-meta-box-call-to-action{
					margin:17px 0 15px 0 !important;
				}
			</style>
		';
		return $style;
	}

	/**
	 * Gets the inline js for the metabox
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function get_inline_js() {
		$js = "
			<script>
				jQuery(document).ready(function($){
					$('.alg-wc-aps-meta-box-admin-accordion .accordion-item .trigger').on('click',function(){
						if($(this).parent().hasClass('active')){
							$(this).parent().removeClass('active');
							$(this).parent().find('.details-container').slideUp();
						}else{
							$('.alg-wc-aps-meta-box-admin-accordion .accordion-item .details-container').slideUp();
							$('.alg-wc-aps-meta-box-admin-accordion .accordion-item').removeClass('active');
							$(this).parent().addClass('active');
							$(this).parent().find('.details-container').slideDown();
						}
					})
				})
			</script>
		";
		return $js;
	}

	/**
	 * get_settings.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function get_settings() {
		global $current_section;
		return array_merge( apply_filters( 'woocommerce_get_settings_' . $this->id . '_' . $current_section, array() ), array(
			array(
				'title'     => __( 'Reset Settings', 'ajax-product-search-woocommerce' ),
				'type'      => 'title',
				'id'        => $this->id . '_' . $current_section . '_reset_options',
			),
			array(
				'title'     => __( 'Reset section settings', 'ajax-product-search-woocommerce' ),
				'desc'      => '<strong>' . __( 'Reset', 'ajax-product-search-woocommerce' ) . '</strong>',
				'desc_tip'  => __( 'Check the box and save changes to reset.', 'ajax-product-search-woocommerce' ),
				'id'        => $this->id . '_' . $current_section . '_reset',
				'default'   => 'no',
				'type'      => 'checkbox',
			),
			array(
				'type'      => 'sectionend',
				'id'        => $this->id . '_' . $current_section . '_reset_options',
			),
		) );
	}

	/**
	 * maybe_reset_settings.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function maybe_reset_settings() {
		global $current_section;
		if ( alg_wc_aps_get_option( $this->id . '_' . $current_section . '_reset', 'no', 'bool' ) ) {
			foreach ( $this->get_settings() as $value ) {
				if ( isset( $value['id'] ) ) {
					$id = explode( '[', $value['id'] );
					delete_option( $id[0] );
				}
			}
			add_action( 'admin_notices', array( $this, 'admin_notices_settings_reset_success' ), PHP_INT_MAX );
		}
	}

	/**
	 * admin_notices_settings_reset_success.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function admin_notices_settings_reset_success() {
		echo '<div class="notice notice-success is-dismissible"><p><strong>' .
			__( 'Your settings have been reset.', 'ajax-product-search-woocommerce' ) . '</strong></p></div>';
	}

	/**
	 * save.
	 *
	 * @version 2.0.0
	 * @since   2.0.0
	 */
	function save() {
		parent::save();
		$this->maybe_reset_settings();
	}

}

endif;

return new Alg_WC_AJAX_Product_Search_Settings();
