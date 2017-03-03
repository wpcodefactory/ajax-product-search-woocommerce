<?php
/**
 * Ajax Product Search for WooCommerce  - Product searcher
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_APS_Product_Searcher' ) ) {
	class Alg_WC_APS_Product_Searcher {

		/**
		 * @var Alg_WC_APS_Product_Searcher_Ajax_Manager
		 */
		private $ajax_manager;

		/**
		 * @var Alg_WC_APS_Product_Searcher_Scripts_Manager
		 */
		private $scripts_manager;

		/**
		 * @var Alg_WC_APS_Product_Searcher_Shortcode_Manager
		 */
		private $shortcode_manager;

		/**
		 * Informs the css class for the search input
		 *
		 * @var string
		 */
		private $search_input_css_selector = '.alg-wc-aps-select';

		/**
		 * Initializes.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		public function init() {
			$this->init_ajax_manager();
			add_action( 'init', array( $this, 'init_scripts_manager' ) );
			add_action( 'init', array( $this, 'init_shortcode_manager' ) );
			add_action( 'widgets_init', array( $this, 'handle_widgets' ) );
		}

		/**
		 * Initializes Widgets.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		public function handle_widgets() {
			register_widget( 'Alg_WC_APS_Product_Searcher_Widget_Search_Input' );
		}

		/**
		 * Initializes shortcode manager.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 * @return Alg_WC_APS_Product_Searcher_Shortcode_Manager
		 */
		public function init_shortcode_manager() {
			$manager = $this->get_shortcode_manager();
			if ( ! $manager ) {
				$manager = new Alg_WC_APS_Product_Searcher_Shortcode_Manager();
				$this->set_shortcode_manager( $manager );
			}

			return $manager;
		}

		/**
		 * Initializes scripts manager.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 * @return Alg_WC_APS_Product_Searcher_Scripts_Manager
		 */
		public function init_scripts_manager() {
			$scripts_manager = $this->get_scripts_manager();
			if ( ! $scripts_manager ) {
				$scripts_manager = new Alg_WC_APS_Product_Searcher_Scripts_Manager();
				$this->set_scripts_manager( $scripts_manager );
			}

			return $scripts_manager;
		}

		/**
		 * Initializes Ajax manager.
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		public function init_ajax_manager() {
			$ajax_manager = $this->get_ajaxManager();
			if ( ! $ajax_manager ) {
				$ajax_manager = new Alg_WC_APS_Product_Searcher_Ajax_Manager();
				$this->set_ajaxManager( $ajax_manager );
			}
		}

		/**
		 * Gets the default search value linking to a search page with an "s" query string
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		protected function get_default_search_value( \WP_Query $query, $result ) {
			$search_permalink = add_query_arg( array(
				's'         => sanitize_text_field( $query->query_vars['s'] ),
				'post_type' => 'product',
			), get_home_url() );

			$result['items'][] = array(
				'default'   => true,
				'id'        => get_the_ID(),
				'text'      => sprintf( sanitize_text_field( get_option( Alg_WC_APS_Settings_Texts::OPTION_VIEW_ALL_RESULTS ) ), $query->found_posts ),
				'permalink' => $search_permalink,
			);

			return $result;
		}

		/**
		 * Converts a wp_query result in a select 2 format result
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		public function convert_products_search_result_to_select2( \WP_Query $query, $args = array() ) {
			$result = array( 'items' => array(), 'total_count' => 0 );
			if ( $query->have_posts() ) {
				if ( $query->query_vars['paged'] == 1 && $query->max_num_pages > 1 ) {
					$result = $this->get_default_search_value( $query, $result );
				}
				while ( $query->have_posts() ) {
					$query->the_post();
					$result['items'][] = array(
						'id'        => get_the_ID(),
						'text'      => get_the_title(),
						'permalink' => get_permalink( get_the_ID() ),
					);
				}
				$result['total_count']    = $query->found_posts;
				$result['posts_per_page'] = $query->query_vars['posts_per_page'];
				wp_reset_postdata();
				if ( $query->query_vars['paged'] == $query->max_num_pages && $query->max_num_pages > 1 ) {
					$result = $this->get_default_search_value( $query, $result );
				}
			}

			return $result;
		}

		/**
		 * Searches products
		 *
		 * @version 1.0.0
		 * @since   1.0.0
		 */
		public function search_products( $args = array() ) {
			$args = wp_parse_args( $args, array(
				'post_type'      => 'product',
				's'              => '',
				'paged'          => 1,
				'orderby'        => 'title',
				'order'          => 'asc',
				'posts_per_page' => 6,
				'cache_results'  => false,
				'cache_timeout'  => 4,
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
		 * @return Alg_WC_APS_Product_Searcher_Ajax_Manager
		 */
		public function get_ajaxManager() {
			return $this->ajax_manager;
		}

		/**
		 * @param Alg_WC_APS_Product_Searcher_Ajax_Manager $ajax_manager
		 */
		public function set_ajaxManager( Alg_WC_APS_Product_Searcher_Ajax_Manager $ajax_manager ) {
			$this->ajax_manager = $ajax_manager;
		}

		/**
		 * @return Alg_WC_APS_Product_Searcher_Ajax_Manager
		 */
		public function get_scripts_manager() {
			return $this->scripts_manager;
		}

		/**
		 * @param Alg_WC_APS_Product_Searcher_Scripts_Manager $scripts_manager
		 */
		public function set_scripts_manager( Alg_WC_APS_Product_Searcher_Scripts_Manager $scripts_manager ) {
			$this->scripts_manager = $scripts_manager;
		}

		/**
		 * @return mixed
		 */
		public function get_search_input_css_selector() {
			return $this->search_input_css_selector;
		}

		/**
		 * @param mixed $search_input_css_selector
		 */
		public function set_search_input_css_selector( $search_input_css_selector ) {
			$this->search_input_css_selector = $search_input_css_selector;
		}

		/**
		 * @return Alg_WC_APS_Product_Searcher_Shortcode_Manager
		 */
		public function get_shortcode_manager() {
			return $this->shortcode_manager;
		}

		/**
		 * @param Alg_WC_APS_Product_Searcher_Shortcode_Manager $shortcode_manager
		 */
		public function set_shortcode_manager( $shortcode_manager ) {
			$this->shortcode_manager = $shortcode_manager;
		}
	}
}