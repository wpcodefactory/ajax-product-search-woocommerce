<?php
/**
 * Ajax Product Search for WooCommerce  - Search input Widget
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher_Widget_Search_Input' ) ) {
	class Alg_WC_APS_Product_Searcher_Widget_Search_Input extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		function __construct() {
			parent::__construct(
				'alg_wc_aps_search_input', // Base ID
				esc_html__( 'Ajax Product Search Input', 'ajax-product-search-woocommerce' ), // Name
				array( 'description' => esc_html__( 'An input that searches WooCommerce products using an autocomplete feature', 'ajax-product-search-woocommerce' ), ) // Args
			);
		}

		/**
		 * Front-end display of widget.
		 *
		 * @see     WP_Widget::widget()
		 * @version 1.0.0
		 * @since   1.0.0
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			echo $args['before_widget'];
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			}
			$alg_wc_aps = alg_ajax_product_search_for_wc();
			$input      = do_shortcode( "[" . Alg_WC_APS_Product_Searcher_Shortcode_Manager::TAG_SEARCH_INPUT . " placeholder='{$instance['placeholder']}' ]" );
			echo $input;
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.
		 *
		 * @see     WP_Widget::form()
		 * @version 1.0.0
		 * @since   1.0.0
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$title       = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$placeholder = ! empty( $instance['placeholder'] ) ? $instance['placeholder'] : '';
			?>
            <p>
                <label
                        for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'ajax-product-search-woocommerce' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                       placeholder="<?php echo esc_attr( __( 'Search products', 'ajax-product-search-woocommerce' ) ); ?>"
                       value="<?php echo esc_attr( $title ); ?>">
            </p>

            <p>
                <label
                        for="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"><?php esc_attr_e( 'Placeholder:', 'ajax-product-search-woocommerce' ); ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'placeholder' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'placeholder' ) ); ?>" type="text"
                       placeholder="<?php echo esc_attr( __( 'Search products', 'ajax-product-search-woocommerce' ) ); ?>"
                       value="<?php echo esc_attr( $placeholder ); ?>">
            </p>
			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see     WP_Widget::update()
		 * @version 1.0.0
		 * @since   1.0.0
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {
			$instance                = array();
			$instance['title']       = ( ! empty( $new_instance['title'] ) ) ? strip_tags( sanitize_text_field( $new_instance['title'] ) ) : '';
			$instance['placeholder'] = ( ! empty( $new_instance['placeholder'] ) ) ? strip_tags( sanitize_text_field( $new_instance['placeholder'] ) ) : '';

			return $instance;
		}
	}
}