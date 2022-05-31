=== WPC Smart Wishlist for WooCommerce ===
Contributors: wpclever
Donate link: https://wpclever.net
Tags: woocommerce, woo, wpc, smart, wishlist
Requires at least: 4.0
Tested up to: 5.2.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

WPC Smart Wishlist is a simple but powerful tool that can help your customer save products for buy later.

== Description ==

WPC Smart Wishlist is a simple but powerful tool that can help your customer save products for buy later.

= Live demo =

Click to see [live demo](https://demo.wpclever.net/woosw/ "live demo")

= Features =

- Custom position for button
- Support shortcode
- Only show the wishlist button for products in selected categories (NEW)
- WPML integration

= Translators =

Available languages: English (Default)

If you have created your own language pack, or have an update for an existing one, you can send [gettext PO and MO file](http://codex.wordpress.org/Translating_WordPress "Translating WordPress") to [us](https://wpclever.net/contact "WPclever.net") so we can bundle it into WPC Smart Wishlist.

= Need more features? =

Please try other plugins from us

- [WPC Smart Compare](https://wordpress.org/plugins/woo-smart-compare/ "WPC Smart Compare")
- [WPC Smart Quick View](https://wordpress.org/plugins/woo-smart-quick-view/ "WPC Smart Quick View")

= Need support? =

Visit [plugin documentation website](https://wpclever.net "plugin documentation")

== Installation ==

1. Please make sure that you installed WooCommerce
2. Go to plugins in your dashboard and select "Add New"
3. Search for "WPC Smart Wishlist", Install & Activate it
4. Go to settings page to choose position and effect as you want

== Frequently Asked Questions ==

= How to integrate with my theme? =

To integrate with a theme, please use bellow filter to hide the default buttons.

`add_filter( 'woosw_button_position_archive', function() {
    return '0';
} );
add_filter( 'woosw_button_position_single', function() {
    return '0';
} );`

After that, use the shortcode to display the button where you want.

`echo do_shortcode('[woosw id="{product_id}"]');`

== Changelog ==

= 1.4.9 =
* Fixed: Copy wishlist link on iOS devices

= 1.4.8 =
* Added: Translation from Tusko Trush
* Fixed: Duplicate wishlist page

= 1.4.7 =
* Updated: Optimized the code

= 1.4.6 =
* Fixed: Button type don't change

= 1.4.5 =
* Added: Filter for button html 'woosw_button_html'
* Updated: Optimized the code

= 1.4.4 =
* Updated: Compatible with WooCommerce 3.6.x

= 1.4.3 =
* Added: Action when clicking on the added button: open wishlist popup or wishlist page
* Added: Auto close for the message popup
* Updated: Optimized the code

= 1.4.2 =
* Fixed: PHP warning

= 1.4.1 =
* Added: Only show the Wishlist button for products in selected categories
* Fixed: Button text can be translated

= 1.4.0 =
* Added: Copy URL to clipboard on the Wishlist page

= 1.3.9 =
* Added: Custom URL for Continue shopping button
* Updated: Compatible with WooCommerce 3.5.4 & WordPress 5.0.3

= 1.3.8 =
* Updated: Compatible with WooCommerce 3.5.3 & WordPress 5.0.2

= 1.3.7 =
* Updated: Change JS event touchstart to touch
* Updated: Optimized the code

= 1.3.6 =
* Fixed: Error when removing the last item
* Added: Filter for Wishlist URL & count

= 1.3.5 =
* Updated: Change default popup type to products list
* Updated: Compatible with WooCommerce 3.5.1

= 1.3.4 =
* Added: Just show message when adding to Wishlist
* Updated: Optimized the code

= 1.3.3 =
* Updated: Compatible with WooCommerce 3.5.0

= 1.3.2 =
* Updated: Optimize the code to reduce the loading time

= 1.3.1 =
* Fixed: Error when loading backend.css

= 1.3.0 =
* Added: Option to remove product after adding to cart
* Fixed: Error when remove the last item on the Wishlist

= 1.2.5 =
* Fixed: Error when WooCommerce is not active

= 1.2.4 =
* Fixed: JS trigger
* Updated: Compatible with WooCommerce 3.4.5

= 1.2.3 =
* Updated: Settings page style

= 1.2.2 =
* Added option to change the color
* Compatible with WooCommerce 3.4.2

= 1.2.1 =
* Add JS trigger when show/hide or changing the count

= 1.2.0 =
* Optimized the code

= 1.1.6 =
* Fix some minor CSS issues

= 1.1.5 =
* Fix the PHP notice

= 1.1.4 =
* Compatible with WooCommerce 3.3.5

= 1.1.3 =
* Compatible with WordPress 4.9.5

= 1.1.2 =
* Added: Button text for "added" state
* Added: WPML integration
* Fixed: Fix the height of popup to prevent blur

= 1.1.1 =
* Compatible with WordPress 4.9.4
* Compatible with WooCommerce 3.3.1

= 1.1.0 =
* Added: Auto create the Wishlist page with shortcode

= 1.0.4 =
* Fix share URLs

= 1.0.3 =
* Add share buttons on wishlist page

= 1.0.2 =
* Update wishlist page

= 1.0.1 =
* Update CSS

= 1.0 =
* Released