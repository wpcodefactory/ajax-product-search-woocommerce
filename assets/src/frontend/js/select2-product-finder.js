/**
 * @summary Finds products using select2
 *
 * @version   1.0.0
 * @since     1.0.0
 * @requires  jQuery.js
 */
jQuery(function ($) {
	var select2_product_finder = {

		/**
		 * Initiate
		 */
		init: function () {
			select2_product_finder.activate_select2();
		},

		/**
		 * Activate select 2
		 */
		activate_select2: function () {
			$(alg_wc_aps.search_input_css_selector).select2({
				minimumInputLength: 1,
				ajax: {
					url: alg_wc_aps.ajaxurl,
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							s: params.term, // search term
							action: alg_wc_aps.ajax_actions.search_products,
							page: params.page || 1
						};
					},
					processResults: function (data, params) {
						params.page = params.page || 1;
						return {
							results: data.data.items,
							pagination: {
								more: (params.page * data.data.posts_per_page) < data.data.total_count
							}
						};
					},
					cache: true
				},
				escapeMarkup: function (markup) {
					return markup;
				}
			});
		}

	};

	select2_product_finder.init();
});