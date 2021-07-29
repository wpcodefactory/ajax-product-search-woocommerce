<?php
/**
 * Live Search for WooCommerce - Product Searcher
 *
 * @version 2.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher' ) ) :

class Alg_WC_APS_Product_Searcher {

	/**
	 * ajax_manager.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @var     Alg_WC_APS_Product_Searcher_AJAX_Manager
	 */
	private $ajax_manager;

	/**
	 * scripts_manager.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @var     Alg_WC_APS_Product_Searcher_Scripts_Manager
	 */
	private $scripts_manager;

	/**
	 * shortcode_manager.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @var     Alg_WC_APS_Product_Searcher_Shortcode_Manager
	 */
	private $shortcode_manager;

	/**
	 * Informs the css class for the search input.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @var     string
	 */
	private $search_input_css_selector = '.alg-wc-aps-select';

	/**
	 * Initializes.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function init() {
		$this->init_ajax_manager();
		add_action( 'init',         array( $this, 'init_scripts_manager' ) );
		add_action( 'init',         array( $this, 'init_shortcode_manager' ) );
		add_action( 'widgets_init', array( $this, 'handle_widgets' ) );
	}

	/**
	 * Initializes widgets.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function handle_widgets() {
		register_widget( 'Alg_WC_APS_Product_Searcher_Widget_Search_Input' );
	}

	/**
	 * Initializes shortcode manager.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @return  Alg_WC_APS_Product_Searcher_Shortcode_Manager
	 */
	function init_shortcode_manager() {
		if ( ! ( $manager = $this->get_shortcode_manager() ) ) {
			$manager = new Alg_WC_APS_Product_Searcher_Shortcode_Manager();
			$this->set_shortcode_manager( $manager );
		}
		return $manager;
	}

	/**
	 * Initializes scripts manager.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @return  Alg_WC_APS_Product_Searcher_Scripts_Manager
	 */
	function init_scripts_manager() {
		if ( ! ( $scripts_manager = $this->get_scripts_manager() ) ) {
			$scripts_manager = new Alg_WC_APS_Product_Searcher_Scripts_Manager();
			$this->set_scripts_manager( $scripts_manager );
		}
		return $scripts_manager;
	}

	/**
	 * Initializes AJAX manager.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 */
	function init_ajax_manager() {
		if ( ! $this->get_ajax_manager() ) {
			$ajax_manager = new Alg_WC_APS_Product_Searcher_AJAX_Manager();
			$this->set_ajax_manager( $ajax_manager );
		}
	}

	/**
	 * Gets the default search value linking to a search page with an "s" query string.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @todo    [dev] removed `\WP_Query $query` in function params
	 */
	protected function get_default_search_value( $query, $result ) {
		$result['items'][] = array(
			'default'   => true,
			'id'        => get_the_ID(),
			'text'      => sprintf( alg_wc_aps_get_option( 'alg_wc_aps_texts_view_all_results',
				__( 'View all results (%d)', 'ajax-product-search-woocommerce' ), 'text' ), $query->found_posts ),
			'permalink' => add_query_arg( array( 's' => sanitize_text_field( $query->query_vars['s'] ), 'post_type' => 'product' ), get_home_url() ),
		);
		return $result;
	}

	/**
	 * Converts a wp_query result in a select 2 format result.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @todo    [dev] removed `\WP_Query $query` in function params
	 */
	function convert_products_search_result_to_select2( $query, $args = array() ) {
		$args                    = apply_filters( 'alg_wc_ajax_product_search_select2_default_args', $args );
		$is_default_search_value = apply_filters( 'alg_wc_ajax_product_search_select2_default_search_value', true, $args );
		$result                  = array( 'items' => array(), 'total_count' => 0 );
		if ( $query->have_posts() ) {
			if ( $is_default_search_value && 1 == $query->query_vars['paged'] && $query->max_num_pages > 1 ) {
				$result = $this->get_default_search_value( $query, $result );
			}
			while ( $query->have_posts() ) {
				$query->the_post();
				$result['items'][] = apply_filters( 'alg_wc_ajax_product_search_select2_item', array(
					'id'        => get_the_ID(),
					'text'      => get_the_title(),
					'permalink' => get_permalink( get_the_ID() ),
				), $args );
			}
			$result['total_count']    = $query->found_posts;
			$result['posts_per_page'] = $query->query_vars['posts_per_page'];
			wp_reset_postdata();
			if ( $is_default_search_value && $query->query_vars['paged'] == $query->max_num_pages && $query->max_num_pages > 1 ) {
				$result = $this->get_default_search_value( $query, $result );
			}
		}
		return $result;
	}

	/**
	 * Searches products.
	 *
	 * @version 1.0.8
	 * @since   1.0.0
	 */
	function search_products( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			's'                   => '',
			'paged'               => 1,
			'orderby'             => 'title',
			'order'               => 'asc',
			'posts_per_page'      => 6,
			'cache_results'       => false,
			'cache_timeout'       => 4,
			'alg_wc_pvbur_search' => true
		) );

		if ( true === $args['cache_results'] ) {
			$dynamic_key    = md5( sanitize_text_field( $args['s'] . '_' . sanitize_text_field( $args['paged'] ) ) );
			$transient_name = "alg-wc-aps-results_{$dynamic_key}";
			$timeout        = absint( sanitize_text_field( $args['cache_timeout'] ) );
			if ( false === ( $the_query = get_transient( $transient_name ) ) ) {
				$the_query = new WP_Query( $args );
				set_transient( $transient_name, $the_query, $timeout * HOUR_IN_SECONDS );
			}
		} else {
			$the_query = new WP_Query( $args );
		}

		return $the_query;
	}

	/**
	 * get_ajax_manager.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @return  Alg_WC_APS_Product_Searcher_AJAX_Manager
	 */
	function get_ajax_manager() {
		return $this->ajax_manager;
	}

	/**
	 * set_ajax_manager.
	 *
	 * @version 2.0.0
	 * @since   1.0.0
	 * @param   Alg_WC_APS_Product_Searcher_AJAX_Manager $ajax_manager
	 */
	function set_ajax_manager( Alg_WC_APS_Product_Searcher_AJAX_Manager $ajax_manager ) {
		$this->ajax_manager = $ajax_manager;
	}

	/**
	 * get_scripts_manager.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  Alg_WC_APS_Product_Searcher_AJAX_Manager
	 */
	function get_scripts_manager() {
		return $this->scripts_manager;
	}

	/**
	 * set_scripts_manager.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @param   Alg_WC_APS_Product_Searcher_Scripts_Manager $scripts_manager
	 */
	function set_scripts_manager( Alg_WC_APS_Product_Searcher_Scripts_Manager $scripts_manager ) {
		$this->scripts_manager = $scripts_manager;
	}

	/**
	 * get_search_input_css_selector.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  mixed
	 */
	function get_search_input_css_selector() {
		return $this->search_input_css_selector;
	}

	/**
	 * set_search_input_css_selector.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @param   mixed $search_input_css_selector
	 */
	function set_search_input_css_selector( $search_input_css_selector ) {
		$this->search_input_css_selector = $search_input_css_selector;
	}

	/**
	 * get_shortcode_manager.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @return  Alg_WC_APS_Product_Searcher_Shortcode_Manager
	 */
	function get_shortcode_manager() {
		return $this->shortcode_manager;
	}

	/**
	 * set_shortcode_manager.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @param   Alg_WC_APS_Product_Searcher_Shortcode_Manager $shortcode_manager
	 */
	function set_shortcode_manager( $shortcode_manager ) {
		$this->shortcode_manager = $shortcode_manager;
	}
}

endif;
