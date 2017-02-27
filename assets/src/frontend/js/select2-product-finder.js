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
			var search_inputs = $(alg_wc_aps.search_input_css_selector);

			search_inputs.each(function () {
				var this_input = $(this);
				this_input.select2({
					maximumInputLength: 20,
					minimumInputLength: 3,
					placeholder: this_input.attr('placeholder') || '',
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
					templateResult:function(state){
						if(typeof wc_aps_template_result === "function"){
							return wc_aps_template_result(state);
						}else{
							return state.text;
						}
						return '<span>AHA: </span>'+state.text;
					},
					escapeMarkup: function (markup) {
						return markup;
					},
					language: {
						inputTooShort: function (args) {
							var remainingChars = args.minimum - args.input.length;
							var message = alg_wc_aps.select2_args.inputTooShort;
							message = message.replace("%d", remainingChars);
							return message;
						},
						inputTooLong: function (args) {
							var overChars = args.input.length - args.maximum;
							var message = alg_wc_aps.select2_args.inputTooLong;
							message = message.replace("%d", overChars);
							return message;
						},
						errorLoading: function () {
							return alg_wc_aps.select2_args.errorLoading;
						},
						loadingMore: function () {
							return alg_wc_aps.select2_args.loadingMore;
						},
						searching: function () {
							return alg_wc_aps.select2_args.searching;
						},
						noResults: function () {
							return alg_wc_aps.select2_args.noResults;
						}
					}
				});
			});

			search_inputs.on('select2:select', function (e) {
				window.location.href = e.params.data.permalink;
			});

		}

	};

	select2_product_finder.init();
});