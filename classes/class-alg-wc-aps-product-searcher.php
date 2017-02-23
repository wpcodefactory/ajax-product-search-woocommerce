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
		 * @var Alg_WC_APS_Product_Searcher_Ajax_Manager
		 */
		private $scripts_manager;

		private $search_input_css_selector = '.alg-wc-aps-select';

		public function init() {
			$this->init_ajax();
			//add_action( 'init', array( $this, 'get_search_input_css_class_by_admin' ) );
			add_action( 'init', array( $this, 'init_scripts_manager' ) );
		}

		/*public function get_search_input_css_class_by_admin(){

		}*/

		/*public function enqueue_scripts() {
			$scripts_manager = $this->init_scripts_manager();
			$scripts_manager->enqueue_scripts();
		}*/

		public function init_scripts_manager(){
			$scripts_manager = $this->get_scripts_manager();
			if ( ! $scripts_manager ) {
				$scripts_manager = new Alg_WC_APS_Product_Scripts_Manager();
			}
			return $scripts_manager;
		}

		public function init_ajax() {
			$ajax_manager = $this->get_ajaxManager();
			if ( ! $ajax_manager ) {
				$ajax_manager = new Alg_WC_APS_Product_Searcher_Ajax_Manager();
				$this->set_ajaxManager( $ajax_manager );
			}

		}

		public function convert_products_search_result_to_select2( \WP_Query $query ) {
			$result = array( 'items' => array(), 'total_count' => 0 );
			if ( $query->have_posts() ) {
				while ( $query->have_posts() ) {
					$query->the_post();
					$result['items'][] = array(
						'id'   => get_the_ID(),
						'text' => get_the_title(),
					);
				}
				$result['total_count']    = $query->found_posts;
				$result['posts_per_page'] = $query->query_vars['posts_per_page'];
				wp_reset_postdata();
			}

			return $result;
		}

		public function search_products( $args = array() ) {
			$args = wp_parse_args( $args, array(
				'post_type'      => 'product',
				's'              => '',
				'paged'          => 1,
				'posts_per_page' => 6,
			) );

			$the_query = new WP_Query( $args );

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
		public function set_ajaxManager( $ajax_manager ) {
			$this->ajax_manager = $ajax_manager;
		}

		/**
		 * @return Alg_WC_APS_Product_Searcher_Ajax_Manager
		 */
		public function get_scripts_manager() {
			return $this->scripts_manager;
		}

		/**
		 * @param Alg_WC_APS_Product_Searcher_Ajax_Manager $scripts_manager
		 */
		public function set_scripts_manager( $scripts_manager ) {
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



	}
}