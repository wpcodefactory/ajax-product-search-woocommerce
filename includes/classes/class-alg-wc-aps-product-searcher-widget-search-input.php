<?php
/**
 * Live Search for WooCommerce - Search Input Widget
 *
 * @version 2.0.0
 * @since   1.0.0
 * @author  WPFactory.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher_Widget_Search_Input' ) ) :

class Alg_WC_APS_Product_Searcher_Widget_Search_Input extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function __construct() {
		parent::__construct(
			'alg_wc_aps_search_input', // Base ID
			esc_html__( 'Live Product Search', 'ajax-product-search-woocommerce' ), // Name
			array( 'description' => esc_html__( 'An input that searches WooCommerce products using AJAX.', 'ajax-product-search-woocommerce' ) ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @param   array $args     Widget arguments.
	 * @param   array $instance Saved values from database.
	 * @see     WP_Widget::widget()
	 */
	function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		$placeholder = ! empty( $instance['placeholder'] ) ? esc_html( sanitize_text_field( $instance['placeholder'] ) ) :
			alg_wc_aps_get_option( 'alg_wc_aps_texts_placeholder', __( 'Search products', 'ajax-product-search-woocommerce' ), 'text' );
		$params      = apply_filters( 'alg_wc_ajax_product_search_widget_params', '', $instance );
		$input       = do_shortcode( "[alg_wc_aps_input {$params} placeholder='{$placeholder}']" );
		echo $input;
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @param   array $instance Previously saved values from database.
	 * @see     WP_Widget::form()
	 * @todo    [dev] removed: `placeholder="<?php echo esc_attr( __( 'Search products', 'ajax-product-search-woocommerce' ) ); ?>"`
	 */
	function form( $instance ) {
		$title       = ! empty( $instance['title'] )       ? $instance['title']       : '';
		$placeholder = ! empty( $instance['placeholder'] ) ? $instance['placeholder'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'ajax-product-search-woocommerce' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
				value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"><?php esc_attr_e( 'Placeholder:', 'ajax-product-search-woocommerce' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'placeholder' ) ); ?>" type="text"
				placeholder="<?php echo esc_attr( alg_wc_aps_get_option( 'alg_wc_aps_texts_placeholder', __( 'Search products', 'ajax-product-search-woocommerce' ), 'text' ) ); ?>"
				value="<?php echo esc_attr( $placeholder ); ?>">
		</p>
		<?php
		do_action( 'alg_wc_ajax_product_search_after_widget_form', $instance, $this );
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @param   array $new_instance Values just sent to be saved.
	 * @param   array $old_instance Previously saved values from database.
	 * @return  array Updated safe values to be saved.
	 * @see     WP_Widget::update()
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array(
			'title'       => ( ! empty( $new_instance['title'] ) )       ? strip_tags( sanitize_text_field( $new_instance['title'] ) )       : '',
			'placeholder' => ( ! empty( $new_instance['placeholder'] ) ) ? strip_tags( sanitize_text_field( $new_instance['placeholder'] ) ) : '',
		);
		return apply_filters( 'alg_wc_ajax_product_search_widget_update', $instance, $new_instance, $old_instance );
	}
}

endif;
