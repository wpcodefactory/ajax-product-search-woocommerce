=== Live Search for WooCommerce ===
Contributors: algoritmika, anbinder, karzin
Tags: woocommerce, live search, product search, woocommerce search, ajax search, ajax, search products, search, autocomplete, products, woo commerce
Requires at least: 4.4
Tested up to: 5.8
Stable tag: 2.1.0
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Provides an input with autocomplete feature to search WooCommerce products.

== Description ==

**Live Search for WooCommerce** is a plugin where users can search WooCommerce products using an autocomplete feature.

= Features =

* Search WooCommerce products using an AJAX autocomplete feature.
* Search using an infinite scroll pagination when results are too many.
* Customize all texts that will be displayed on search input.
* Saves results in cache improving search speed and saving bandwidth.

= More =

* We are open to your suggestions and feedback.
* Please visit the [Live Search for WooCommerce plugin page](https://wpfactory.com/item/live-search-for-woocommerce/).
* Thank you for using or trying out one of our plugins!

== Frequently Asked Questions ==

= Are there any widgets available? =

Yes, **Live Product Search** - Displays the search input.

= Are there shortcodes available? =

Yes, `[alg_wc_aps_input placeholder="Search..."]` - Displays the search input (with customizable input placeholder string param).

= Is there a Pro version? =

Yes, it's located [here](https://wpfactory.com/item/live-search-for-woocommerce/ "Live Search for WooCommerce Pro").

= What can I do in the Pro version? =

**Take a look on some of its features:**

* Display product thumbnail on search results.
* Display product price on search results.
* Display product categories on search results.
* Option to select multiple results.
* Choose if you want to redirect on search result selection or not.
* Support.

= Can I see what the Pro version is capable of? =

Start by visiting plugin settings at "WooCommerce > Settings > Live Search".

= How can I contribute? Is there a GitHub repository? =

If you are interested in contributing - head over to the Live Search for WooCommerce plugin [GitHub repository](https://github.com/algoritmika/ajax-product-search-woocommerce "Live Search for WooCommerce plugin GitHub repository") to find out how you can pitch in.

== Installation ==

1. Upload the entire plugin folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the "Plugins" menu in WordPress.
3. Start by visiting plugin settings at "WooCommerce > Settings > Live Search".

== Screenshots ==

1. Search products using an Autocomplete feature
2. Choose to turn on/off the plugin by its own panel on admin
3. Customize all texts that will be displayed on search input
4. Saves results in cache improving search speed and saving bandwidth

== Changelog ==

= 2.1.0 - 29/07/2021 =
* Dev - Admin settings descriptions updated.
* Dev - Localisation - `load_plugin_textdomain()` is called on `init` action now.
* Dev - Code refactoring.
* WC tested up to: 5.5.
* Tested up to: 5.8.

= 2.0.0 - 31/10/2019 =
* Dev - Major code refactoring.
* Plugin renamed to "Live Search for WooCommerce" (from "Ajax Product Search for WooCommerce by Algoritmika").
* WC tested up to: 3.7.
* Tested up to: 5.2.

= 1.0.9 - 10/12/2018 =
* Create text for input placeholder

= 1.0.8 - 09/12/2018 =
* Search only for 'publish' post_status
* Update WC tested up to
* Update WP tested up to

= 1.0.7 - 25/07/2018 =
* Make compatible with Product Visibility by User Role for WooCommerce plugin
* Update WooCommerce requirement
* Remove package-lock.json

= 1.0.6 - 17/08/2017 =
* Add option to change width
* Add option to change placeholder text color

= 1.0.5 - 09/08/2017 =
* Fix shortcode echoing
* Add class 'alg-wc-aps-dropdown' to select 2 dropdown
* Add class 'alg-wc-aps-select' to select 2

= 1.0.4 - 20/04/2017 =
* Fix thumbnail style option
* Fix metabox about pro
* Fix gitignore to not exclude important folders
* Update coder.fm url

= 1.0.3 - 10/04/2017 =
* Better plugin description
* Change redirect option on widget to true by default

= 1.0.2 - 09/03/2017 =
* Fix plugin's old slug on some places
* Escape widget's placeholder text
* Add option to select multiple results
* Add option to redirect on search result selection
* New parameter 'multiple' for shortcode
* New parameter 'redirect' for shortcode

= 1.0.1 - 07/03/2017 =
* Improve performance. Loading admin fields only on admin
* Better plugin description
* Screenshots

= 1.0.0 - 02/03/2017 =
* Initial Release.

== Upgrade Notice ==

= 1.0.0 =
This is the first release of the plugin.
