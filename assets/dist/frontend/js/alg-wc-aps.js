/**
 * @summary Main JS of Ajax Product Search for WooCommerce
 *
 * @version   1.0.0
 * @since     1.0.0
 * @requires  jQuery.js
 */

/**
 * @summary Finds products using select2
 *
 * @version   1.0.1
 * @since     1.0.1
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

		minimum_input_length:function(input){
			if(typeof input.attr('multiple')!=="undefined"){
					return 0;
			}
			return 3;
		},

		closeOnSelect: function (input) {
			if(typeof input.attr('multiple')!=="undefined"){
					return false;
			}
			return true;
		},

		/**
		 * Activate select 2
		 */
		activate_select2: function () {
			var search_inputs = $(alg_wc_aps.search_input_css_selector);

			search_inputs.each(function () {
				var this_input = $(this);
				this_input.select2({
					minimumResultsForSearch: Infinity,
					maximumInputLength: 40,
					minimumInputLength: select2_product_finder.minimum_input_length(this_input),
					closeOnSelect:select2_product_finder.closeOnSelect(this_input),
					placeholder: this_input.attr('placeholder') || '',
					ajax: {
						cache:true,
						url: alg_wc_aps.ajaxurl,
						dataType: 'json',
						delay: 250,
						data: function (params) {
							var return_obj = {
								s: params.term, // search term
								action: alg_wc_aps.ajax_actions.search_products,
								page: params.page || 1
							};

							//Pass all data attributes to ajax
							this_input.each(function() {
								$.each(this.attributes, function() {
								    if(this.specified) {
								    	if(this.name.indexOf('data-')!=-1){
											return_obj[this.name.replace('data-','')] = this.value;
								    	}
								    }
								});
							});
							
							return return_obj;
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
							if(state.default){
								return '<div class="alg-wc-aps-default" style="font-weight:bold;text-transform:uppercase">'+state.text+'</div>';
							}else{
								return state.text;
							}
						}
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
				e.preventDefault();
				var redirect = false;

				if(typeof e.target.attributes["data-redirect"]!=="undefined"){
					redirect = true;
				}

				if(typeof e.target.attributes["multiple"]!=="undefined"){
					if(typeof e.params.data.default!=="undefined" && e.params.data.default==true){
						redirect=true;
					}else{
						redirect=false;
					}
				}

				if(redirect){
					window.location.href = e.params.data.permalink;
				}
			});

			search_inputs.on("change", function (e) {
				search_inputs.resize();
			});

		}

		

	};

	select2_product_finder.init();
});