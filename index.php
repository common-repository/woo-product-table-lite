<?php
/*
 * Plugin Name: iThemelandCo Product Table for WooCommerce
 * Plugin URI:  https://ithemelandco.com/Plugins/Woocommerce-Product-Table
 * Description: Display all products as a table by shortcode. Powerful Searchable and Sortable and Template Manager -color,background,title,text color etc. Manage column for All Devices.
 * Version:     2.0.7
 * Author:      iThemelandCo
 * Author URI:  https://www.ithemelandco.com
 * License:     GPL
 */

/*

* V 1.4.0:
* Added: Category/Tag Link to archive page
* Added: Search Form Toggle(Always Show Search Form)
* Fixed: Fetch new columns in edit form

* V 1.3.0:
* Added: Compatible with Wootheme Woocommerce Brands Plugin
* Added: Compatible with Yith Woocommerce Brands Plugin
* Added: Compatible with iThemeland Woocommerce Brands Plugin
* Added: Compatible with Most of Custom Taxonomies available for WooCommerce

* V 1.2.0:
* Added: Compatible with TI WooCommerce Wishlist Plugin

* V 1.1.1:
* Fixed: ACF plugin compatibility issues

* V 1.1.0:
* Added: Compatible with Advanced Custom Fields(ACF) plugin


* V 1.0.6:
* Fixed: Currency Symbol issue
* Fixed: Responsive in Mobile

* V 1.0.5:
* Fixed: Order by some Fields
* Fixed: Session's issues
* Added: Copy shortcode to Clipboard
* Added: Choose image size

* V 1.0.4:
* Fixed: Display Attribute column data
* Fixed: Some Localization
* Fixed: Taxonomy/Category Multi-Select
* */

/**
 * TODO SECURITY
 */
defined('ABSPATH') || exit();

/**
 * TODO DEFINE
 */
if ( ! defined('PREFIX_ITPT')) {
    define('PREFIX_ITPT', 'itpt');
} // MAIN PREFIX
if ( ! defined('PREFIX_ITWPT')) {
    define('PREFIX_ITWPT', 'itwpt');
}
if ( ! defined('PREFIX_ITWPT_PLUGIN_NAME')) {
    define('PREFIX_ITWPT_PLUGIN_NAME', 'itwpt');
} // PLUGIN NAME
if ( ! defined('PREFIX_ITPT_PATH')) {
    define('PREFIX_ITPT_PATH', plugin_dir_path(__FILE__));
} // PLUGIN PATH
if ( ! defined('PREFIX_ITPT_URL')) {
    define('PREFIX_ITPT_URL', plugin_dir_url(__FILE__));
} // PLUGIN URL
if ( ! defined('PREFIX_ITWPT_IMAGE_URL')) {
    define('PREFIX_ITWPT_IMAGE_URL', trailingslashit(PREFIX_ITPT_URL . 'assets/image/'));
} // IMAGE FOLDER URL
if ( ! defined('PREFIX_ITWPT_CSS_URL')) {
    define('PREFIX_ITWPT_CSS_URL', trailingslashit(PREFIX_ITPT_URL . 'assets/css/'));
} // STYLE FOLDER URL
if ( ! defined('PREFIX_ITWPT_JS_URL')) {
    define('PREFIX_ITWPT_JS_URL', trailingslashit(PREFIX_ITPT_URL . 'assets/js/'));
} // SCRIPT FOLDER URL
if ( ! defined('PREFIX_ITWPT_FONTS_URL')) {
    define('PREFIX_ITWPT_FONTS_URL', trailingslashit(PREFIX_ITPT_URL . 'assets/fonts/'));
} // FONTS FOLDER URL
if ( ! defined('PREFIX_ITWPT_TEXTDOMAIN')) {
    define('PREFIX_ITWPT_TEXTDOMAIN', 'woo-product-table-lite');
} // TEXT DOMAIN

/**
 * TODO GLOBAL
 */
global $itwpt_rand;
global $itwpt_data;
global $itwpt_query;
global $itwpt_query_data;

/**
 * TODO GLOBAL SVG
 */
global $itwpt_svg;
$itwpt_svg = array(
    'itwpt.svg'          => '<svg id="e445785c-1570-48b9-aa6e-6559780a7525" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path style="fill:#FFFFFF;" d="M183.3,173.7H169.1V114.6h0a12.8,12.8,0,0,0-12.8-12.8H98.7V42.7h0A12.8,12.8,0,0,0,85.9,29.9H26.8V17.2a12.8,12.8,0,1,0-25.5,0V42.7h0v71.9h0v71.9A12.7,12.7,0,0,0,14,199.2H183.3a12.8,12.8,0,1,0,0-25.5Zm-39.7-46.4v46.4H98.7V127.3Zm-116.8,0H73.2v46.4H26.8ZM73.2,55.4v46.4H26.8V55.4Z"/></svg>',
    'columns.svg'        => '<svg id="Layer" enable-background="new 0 0 64 64" height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m50 8h-36c-3.309 0-6 2.691-6 6v36c0 3.309 2.691 6 6 6h36c3.309 0 6-2.691 6-6v-36c0-3.309-2.691-6-6-6zm-12 4v40h-12v-40zm-26 38v-36c0-1.103.897-2 2-2h8v40h-8c-1.103 0-2-.897-2-2zm40 0c0 1.103-.897 2-2 2h-8v-40h8c1.103 0 2 .897 2 2z"/></svg>',
    'query.svg'          => '<svg enable-background="new 0 0 505.141 505.141" version="1.1" viewBox="0 0 505.141 505.141" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="m417.36 299.3c-9.376-47.128-50.738-81.07-98.79-81.067-26.727-0.074-52.373 10.55-71.218 29.503-33.977 33.979-39.219 87.227-12.522 127.18 26.698 39.953 77.9 55.482 122.29 37.092 44.393-18.391 69.614-65.579 60.237-112.71zm-82.414 101.98c-39.273 7.813-78.597-13.206-93.921-50.2-15.324-36.995-2.382-79.663 30.913-101.91 33.294-22.247 77.667-17.877 105.98 10.437 15.791 15.707 24.644 37.078 24.584 59.35 1e-3 40.044-28.284 74.511-67.558 82.323z"/><path d="m496.6 461.41l-66.98-66.971c36.263-53.306 29.512-124.86-16.082-170.45-8.101-8.042-17.188-15.025-27.044-20.782v-119.28c1e-3 -47.062-84.773-83.934-193.05-83.934s-193.05 36.872-193.05 83.934v302.16c0 47.062 84.774 83.934 193.05 83.934 40.05 0.524 79.933-5.254 118.19-17.123 2.308 0.117 4.608 0.336 6.941 0.336 26.925 0.054 53.237-8.042 75.474-23.225l67.013 67.013c6.269 6.795 15.757 9.608 24.716 7.328s15.949-9.286 18.208-18.251-0.576-18.444-7.386-24.697zm-303.15-444.63c105.44 0 176.26 34.724 176.26 67.148s-70.824 67.148-176.26 67.148-176.26-34.725-176.26-67.149c0-32.423 70.823-67.147 176.26-67.147zm-176.26 101.92c29.872 29.234 96.709 49.16 176.26 49.16s146.39-19.926 176.26-49.16v76.019c-16.221-6.67-33.594-10.092-51.133-10.072-47.927-0.144-92.242 25.452-116.06 67.038-3.005 0.05-5.984 0.109-9.065 0.109-51.401 0-100.27-8.897-134.11-24.433-26.784-12.129-42.152-27.698-42.152-42.714v-65.947zm0 100.86c10.286 9.699 22.199 17.512 35.194 23.082 35.916 16.493 87.351 25.944 141.07 25.944h0.655c-10.669 26.662-12.56 56.032-5.397 83.842-49.647-0.537-96.575-9.233-129.37-24.341-26.784-12.129-42.152-27.698-42.152-42.714v-65.813zm176.26 233.68c-105.44 0-176.26-34.724-176.26-67.148v-65.813c10.286 9.699 22.199 17.512 35.194 23.082 35.916 16.493 87.351 25.944 141.07 25.944h0.646c14.395 35.671 43.446 63.422 79.738 76.17-26.474 5.239-53.4 7.839-80.385 7.765zm148.05-19.052c-54.983 10.933-110.03-18.496-131.48-70.29s-3.326-111.53 43.288-142.67 108.74-25.021 148.37 14.622c22.109 21.99 34.501 51.912 34.413 83.095-5e-3 56.06-39.608 104.31-94.592 115.24zm143.27 50.972l-0.067-0.025c-3.27 3.232-8.531 3.232-11.801 0l-65.586-65.586c2.098-1.855 4.197-3.651 6.228-5.649s3.769-4.104 5.615-6.194l65.612 65.612c1.597 1.556 2.498 3.692 2.498 5.922s-0.901 4.364-2.499 5.92z"/><path d="m277.38 293.77c2.226 0 4.36-0.885 5.934-2.459l16.787-16.787c3.181-3.293 3.135-8.528-0.102-11.766-3.238-3.238-8.473-3.283-11.766-0.102l-16.787 16.787c-2.4 2.401-3.117 6.01-1.819 9.146 1.299 3.135 4.359 5.18 7.753 5.181z"/><path d="m330.2 271.05l-58.754 58.754c-3.277 3.278-3.277 8.591 0 11.868 3.278 3.277 8.591 3.277 11.868 0l58.754-58.754c3.181-3.293 3.135-8.529-0.102-11.766s-8.472-3.282-11.766-0.102z"/><path d="m36.401 182.22c1.609 1.532 3.737 2.402 5.959 2.434 1.097-0.013 2.18-0.241 3.19-0.672 1.017-0.426 1.953-1.022 2.77-1.763 0.741-0.816 1.337-1.753 1.763-2.77 0.43-1.009 0.658-2.093 0.671-3.189-0.033-2.222-0.902-4.35-2.434-5.959-0.816-0.741-1.753-1.337-2.77-1.763-3.13-1.275-6.717-0.584-9.149 1.763-1.532 1.609-2.401 3.737-2.434 5.959 0.013 1.097 0.241 2.18 0.671 3.189 0.427 1.018 1.023 1.954 1.763 2.771z"/><path d="m36.401 282.94c1.609 1.532 3.737 2.402 5.959 2.434 1.097-0.013 2.18-0.241 3.19-0.672 1.017-0.426 1.953-1.022 2.77-1.763 0.741-0.816 1.337-1.753 1.763-2.77 0.43-1.009 0.658-2.093 0.671-3.19-0.033-2.222-0.902-4.35-2.434-5.959-0.816-0.741-1.753-1.337-2.77-1.763-3.13-1.275-6.717-0.584-9.149 1.763-1.532 1.609-2.401 3.737-2.434 5.959 0.013 1.097 0.241 2.18 0.671 3.19 0.427 1.018 1.023 1.955 1.763 2.771z"/><path d="m45.55 369.98c-3.13-1.275-6.717-0.584-9.149 1.763-1.532 1.609-2.401 3.737-2.434 5.959 0.013 1.097 0.241 2.18 0.671 3.19 0.426 1.017 1.022 1.953 1.763 2.77 1.609 1.532 3.737 2.402 5.959 2.434 1.097-0.013 2.18-0.241 3.19-0.671 1.017-0.426 1.953-1.022 2.77-1.763 0.741-0.816 1.337-1.753 1.763-2.77 0.43-1.009 0.658-2.093 0.671-3.19-0.033-2.222-0.902-4.35-2.434-5.959-0.816-0.741-1.753-1.337-2.77-1.763z"/><path d="m75.935 75.541c1.069-1e-3 2.128-0.203 3.122-0.596l41.967-16.787c4.306-1.724 6.4-6.613 4.675-10.92-1.724-4.306-6.613-6.4-10.92-4.675l-41.967 16.787c-3.743 1.491-5.898 5.431-5.135 9.387s4.229 6.812 8.258 6.804z"/><path d="m68.182 97.492c-0.856 2.056-0.861 4.368-0.012 6.427 0.847 2.06 2.479 3.698 4.535 4.555 2.056 0.856 4.368 0.861 6.427 0.011l142.69-58.754c4.288-1.766 6.332-6.674 4.566-10.962s-6.674-6.332-10.962-4.566l-142.69 58.754c-2.06 0.848-3.698 2.479-4.555 4.535z"/></svg>',
    'search.svg'         => '<svg enable-background="new 0 0 56.966 56.966" version="1.1" viewBox="0 0 56.966 56.966" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="m55.146 51.887l-13.558-14.101c3.486-4.144 5.396-9.358 5.396-14.786 0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c0.571 0.593 1.339 0.92 2.162 0.92 0.779 0 1.518-0.297 2.079-0.837 1.192-1.147 1.23-3.049 0.083-4.242zm-31.162-45.887c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z"/></svg>',
    'template.svg'       => '<svg height="484pt" viewBox="0 -2 484.61088 484" width="484pt" xmlns="http://www.w3.org/2000/svg"><path d="m416 381.707031v-45.121093l34.226562 34.222656c5.019532 5.199218 12.457032 7.285156 19.449219 5.453125 6.992188-1.828125 12.453125-7.289063 14.285157-14.28125 1.828124-6.992188-.257813-14.429688-5.457032-19.449219l-62.503906-62.503906v-127.722656c0-8.835938-7.164062-16-16-16h-24c3.441406 0 6.496094-2.207032 7.585938-5.472657l8-24c.273437-.867187.394531-1.777343.359374-2.6875 13.800782-10.3125 19.449219-28.304687 14.015626-44.65625-5.4375-16.351562-20.730469-27.382812-37.960938-27.382812s-32.523438 11.03125-37.957031 27.382812c-5.433594 16.351563.210937 34.34375 14.015625 44.65625-.039063.910157.085937 1.820313.359375 2.6875l8 24c1.085937 3.265625 4.140625 5.472657 7.582031 5.472657h-56v16h96v111.722656l-66.710938-66.722656c-3.171874-3-8.136718-3-11.3125 0l-16.96875 16.976562c-3.121093 3.125-3.121093 8.1875 0 11.3125l94.992188 94.992188v55.71875h-320v-160h48c8.835938 0 16-7.164063 16-16v-48h104v-16h-104v-44.597657c18.046875-2.550781 36.4375-1.078125 53.847656 4.308594 15.402344 4.890625 53.25 19.761719 72.121094 52.3125 5.214844 8.972656 8.652344 18.863281 10.121094 29.136719 3.847656 32.09375-8.117188 64.054687-32.089844 85.738281v-22.898437h-16v40c0 4.417968 3.582031 8 8 8h40v-16h-18.398438c26.113282-25.160157 38.824219-61.164063 34.296876-97.144532-1.738282-12.289062-5.84375-24.125-12.089844-34.855468-21.664063-37.375-63.953125-54.078126-81.441406-59.632813-18.882813-5.828125-38.789063-7.566406-58.398438-5.09375v-59.273437c0-8.835938-7.164062-16-16-16h-111.96875c-8.835938 0-16 7.164062-16 16v184c0 8.835937 7.164062 16 16 16h48v165.402343l-62.472656 85.894531c-1.765625 2.433594-2.019532 5.65625-.65625 8.335938 1.367187 2.679688 4.121094 4.367188 7.128906 4.367188h464c3.011719 0 5.765625-1.6875 7.128906-4.367188 1.367188-2.679688 1.113282-5.902344-.65625-8.335938zm-48-333.402343c13.257812 0 24 10.746093 24 24 0 13.253906-10.742188 24-24 24-13.253906 0-24-10.746094-24-24 0-13.253907 10.746094-24 24-24zm4.898438 64-2.664063 8h-4.464844l-2.664062-8zm95.46875 244.367187c.003906 1.0625-.417969 2.082031-1.175782 2.824219-1.558594 1.5625-4.09375 1.5625-5.652344 0l-122.59375-122.589844 5.65625-5.65625 122.597657 122.589844c.75.753906 1.171875 1.773437 1.167969 2.832031zm-140.734376-142.398437 5.65625 5.65625-5.65625 5.65625-5.65625-5.65625zm-311.632812-197.96875h112v184h-112zm187.816406 448 9.601563-24h53.167969l9.597656 24zm89.601563 0-13.984375-34.976563c-1.21875-3.035156-4.160156-5.023437-7.433594-5.023437h-64c-3.269531 0-6.214844 1.988281-7.429688 5.023437l-13.984374 34.976563h-162.871094l52.359375-72h327.855469l52.359374 72zm0 0"/><path d="m80 400.304688h32v16h-32zm0 0"/><path d="m128 400.304688h32v16h-32zm0 0"/><path d="m176 400.304688h32v16h-32zm0 0"/><path d="m56 432.304688h32v16h-32zm0 0"/><path d="m104 432.304688h32v16h-32zm0 0"/><path d="m152 432.304688h32v16h-32zm0 0"/><path d="m296 432.304688h32v16h-32zm0 0"/><path d="m344 432.304688h32v16h-32zm0 0"/><path d="m392 432.304688h32v16h-32zm0 0"/><path d="m224 400.304688h32v16h-32zm0 0"/><path d="m272 400.304688h32v16h-32zm0 0"/><path d="m320 400.304688h32v16h-32zm0 0"/><path d="m368 400.304688h32v16h-32zm0 0"/><path d="m376 352.304688h16v16h-16zm0 0"/><path d="m352 352.304688h16v16h-16zm0 0"/><path d="m376 328.304688h16v16h-16zm0 0"/><path d="m392 168.304688c0-4.417969-3.582031-8-8-8h-24v16h16v16h16zm0 0"/><path d="m376 200.304688h16v16h-16zm0 0"/><path d="m336 160.304688h16v16h-16zm0 0"/><path d="m112 24.304688h-80c-4.417969 0-8 3.582031-8 8v48c0 4.417968 3.582031 8 8 8h80c4.417969 0 8-3.582032 8-8v-48c0-4.417969-3.582031-8-8-8zm-8 48h-64v-32h64zm0 0"/><path d="m112 144.304688h-80c-4.417969 0-8 3.582031-8 8v32c0 4.417968 3.582031 8 8 8h80c4.417969 0 8-3.582032 8-8v-32c0-4.417969-3.582031-8-8-8zm-8 32h-64v-16h64zm0 0"/><path d="m24 96.304688h32v16h-32zm0 0"/><path d="m64 96.304688h56v16h-56zm0 0"/><path d="m24 120.304688h96v16h-96zm0 0"/><path d="m360 .304688h16v24h-16zm0 0"/><path d="m396.285156 32.714844 16.972656-16.972656 11.3125 11.316406-16.972656 16.96875zm0 0"/><path d="m416 64.304688h24v16h-24zm0 0"/><path d="m296 64.304688h24v16h-24zm0 0"/><path d="m311.433594 27.058594 11.308594-11.316406 16.976562 16.964843-11.3125 11.316407zm0 0"/><path d="m360 64.304688h16v16h-16zm0 0"/><path d="m189.863281 328.015625c13.355469 3.691406 14.738281 5.066406 18.402344 18.402344.957031 3.46875 4.113281 5.871093 7.710937 5.871093 3.597657 0 6.753907-2.402343 7.710938-5.871093 3.691406-13.359375 5.074219-14.738281 18.402344-18.402344 3.46875-.957031 5.871094-4.109375 5.871094-7.710937 0-3.597657-2.402344-6.753907-5.871094-7.710938-13.351563-3.6875-14.738282-5.0625-18.402344-18.398438-.957031-3.472656-4.113281-5.875-7.710938-5.875-3.597656 0-6.753906 2.402344-7.710937 5.875-3.6875 13.359376-5.074219 14.734376-18.402344 18.398438-3.46875.957031-5.871093 4.113281-5.871093 7.710938 0 3.601562 2.402343 6.753906 5.871093 7.710937zm26.136719-12.023437c1.253906 1.609374 2.703125 3.058593 4.3125 4.3125-1.609375 1.253906-3.058594 2.703124-4.3125 4.3125-1.253906-1.609376-2.699219-3.058594-4.3125-4.3125 1.613281-1.253907 3.058594-2.703126 4.3125-4.3125zm0 0"/><path d="m208.289062 226.441406c.957032 3.46875 4.113282 5.871094 7.710938 5.871094 3.601562 0 6.757812-2.402344 7.714844-5.871094 3.6875-13.359375 5.070312-14.734375 18.398437-18.398437 3.46875-.957031 5.871094-4.113281 5.871094-7.714844 0-3.597656-2.402344-6.753906-5.871094-7.710937-13.351562-3.6875-14.734375-5.0625-18.398437-18.398438-.957032-3.472656-4.113282-5.875-7.714844-5.875-3.597656 0-6.753906 2.402344-7.710938 5.875-3.6875 13.359375-5.070312 14.734375-18.398437 18.398438-3.472656.957031-5.875 4.113281-5.875 7.710937 0 3.601563 2.402344 6.757813 5.875 7.714844 13.308594 3.664062 14.710937 5.0625 18.398437 18.398437zm7.710938-30.449218c1.253906 1.609374 2.703125 3.058593 4.3125 4.3125-1.609375 1.253906-3.058594 2.703124-4.3125 4.3125-1.253906-1.609376-2.699219-3.058594-4.3125-4.3125 1.613281-1.253907 3.058594-2.703126 4.3125-4.3125zm0 0"/><path d="m159.714844 218.175781c-.957032-3.46875-4.113282-5.871093-7.714844-5.871093-3.597656 0-6.753906 2.402343-7.710938 5.871093-5.902343 21.386719-9.03125 24.511719-30.398437 30.402344-3.472656.957031-5.875 4.113281-5.875 7.710937 0 3.597657 2.402344 6.753907 5.875 7.710938 21.390625 5.90625 24.519531 9.035156 30.398437 30.402344.957032 3.46875 4.113282 5.871094 7.710938 5.871094 3.601562 0 6.757812-2.402344 7.714844-5.871094 5.902344-21.386719 9.03125-24.511719 30.398437-30.402344 3.46875-.957031 5.871094-4.113281 5.871094-7.710938 0-3.597656-2.402344-6.753906-5.871094-7.710937-21.367187-5.871094-24.511719-9.015625-30.398437-30.402344zm-7.714844 51.640625c-3.144531-5.683594-7.828125-10.363281-13.511719-13.511718 5.683594-3.144532 10.367188-7.828126 13.511719-13.511719 3.148438 5.683593 7.832031 10.367187 13.511719 13.511719-5.679688 3.148437-10.363281 7.828124-13.511719 13.511718zm0 0"/></svg>',
    'settings.svg'       => '<svg enable-background="new 0 0 480.3 480.3" version="1.1" viewBox="0 0 480.3 480.3" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="m254.15 234.1v-220.6c0-7.5-6-13.5-13.5-13.5s-13.5 6-13.5 13.5v220.6c-31.3 6.3-55 34-55 67.2s23.7 60.9 55 67.2v98.2c0 7.5 6 13.5 13.5 13.5s13.5-6 13.5-13.5v-98.2c31.3-6.3 55-34 55-67.2 0-33.1-23.6-60.9-55-67.2zm-13.5 108.7c-22.9 0-41.5-18.6-41.5-41.5s18.6-41.5 41.5-41.5 41.5 18.6 41.5 41.5-18.6 41.5-41.5 41.5z"/><path d="m88.85 120.9v-107.4c0-7.5-6-13.5-13.5-13.5s-13.5 6-13.5 13.5v107.4c-31.3 6.3-55 34-55 67.2s23.7 60.9 55 67.2v211.4c0 7.5 6 13.5 13.5 13.5s13.5-6 13.5-13.5v-211.5c31.3-6.3 55-34 55-67.2s-23.7-60.8-55-67.1zm-13.5 108.7c-22.9 0-41.5-18.6-41.5-41.5s18.6-41.5 41.5-41.5 41.5 18.6 41.5 41.5-18.7 41.5-41.5 41.5z"/><path d="m418.45 120.9v-107.4c0-7.5-6-13.5-13.5-13.5s-13.5 6-13.5 13.5v107.4c-31.3 6.3-55 34-55 67.2s23.7 60.9 55 67.2v211.5c0 7.5 6 13.5 13.5 13.5s13.5-6 13.5-13.5v-211.6c31.3-6.3 55-34 55-67.2s-23.6-60.8-55-67.1zm-13.5 108.7c-22.9 0-41.5-18.6-41.5-41.5s18.6-41.5 41.5-41.5 41.5 18.6 41.5 41.5-18.6 41.5-41.5 41.5z"/></svg>',
    'localization.svg'   => '<svg enable-background="new 0 0 188.111 188.111" version="1.1" viewBox="0 0 188.111 188.111" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="m94.052 0c-51.862 1e-3 -94.052 42.194-94.051 94.055 0 51.862 42.191 94.056 94.051 94.057 51.864-1e-3 94.059-42.194 94.059-94.056-1e-3 -51.863-42.195-94.056-94.059-94.056zm0 173.11c-43.589-1e-3 -79.051-35.465-79.051-79.057-1e-3 -43.59 35.461-79.053 79.051-79.054 43.593 0 79.059 35.464 79.059 79.056-1e-3 43.59-35.466 79.054-79.059 79.055z"/><path d="m94.053 50.851c-23.821 2e-3 -43.202 19.384-43.202 43.204 0 23.824 19.381 43.206 43.203 43.206 23.823 0 43.205-19.382 43.205-43.205 0-23.824-19.382-43.205-43.206-43.205zm1e-3 71.41c-15.551 0-28.203-12.653-28.203-28.206 0-15.55 12.652-28.203 28.203-28.204 15.553 0 28.205 12.653 28.205 28.205s-12.653 28.205-28.205 28.205z"/><circle cx="94.055" cy="94.056" r="16.229"/></svg>',
    'quantity-left.svg'  => '<svg id="a3e487be-7f79-4204-a359-8214158d8480" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.8 114.9"><title>Down</title><path d="M17.3,29a.1.1,0,0,1-.1.1A35.6,35.6,0,0,0,1.3,48.9,29.3,29.3,0,0,0,1.3,66,35.2,35.2,0,0,0,17.2,85.8a.1.1,0,0,1,.1.1,34.8,34.8,0,0,1,17.5,29V0A34.8,34.8,0,0,1,17.3,29Zm6.2,36.6a.9.9,0,0,1-1.2,0l-7.5-7.5a.9.9,0,0,1,0-1.2l7.5-7.5a.8.8,0,0,1,1.2,0,.9.9,0,0,1,0,1.2l-6.9,6.9,6.9,6.9A.9.9,0,0,1,23.5,65.6Z"/></svg>',
    'quantity-right.svg' => '<svg id="b8a71c39-0e05-462c-8959-9223df911598" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 34.8 114.9"><title>Up</title><path d="M0,0V114.9a35.1,35.1,0,0,1,17.5-29,.1.1,0,0,1,.1-.1A35.2,35.2,0,0,0,33.5,66a27.7,27.7,0,0,0,0-17.1A35.6,35.6,0,0,0,17.6,29.1a.1.1,0,0,1-.1-.1A35.1,35.1,0,0,1,0,0ZM11.3,64.4l6.9-6.9-6.9-6.9a.9.9,0,0,1,0-1.2.7.7,0,0,1,1.2,0L20,56.9a.7.7,0,0,1,0,1.2l-7.5,7.5a.8.8,0,0,1-1.2-1.2Z"/></svg>',
    'fls_popup.svg'      => '<svg id="ed7971b3-0509-42b5-8af4-523372433584" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 127.1 63.6"><path d="M63.6,0H0A63.6,63.6,0,0,1,63.6,63.6,63.5,63.5,0,0,1,127.1,0Z"/></svg>',
    'close_popup.svg'    => '<svg id="ad12f846-d42d-4fd3-b39d-fb568bc8e8ff" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48.3 182.8"><path d="M21.2,51.6l-.5.3a48,48,0,0,0,0,79l.5.3a62.8,62.8,0,0,1,27.1,51.6V0A62.8,62.8,0,0,1,21.2,51.6Z"/><path d="M25.3,91.4,34,82.7a.9.9,0,0,0,0-1.2.8.8,0,0,0-1.1,0l-8.8,8.8-8.7-8.8a.8.8,0,0,0-1.1,0,.9.9,0,0,0,0,1.2L23,91.4l-8.7,8.7a.9.9,0,0,0,0,1.2.8.8,0,0,0,.6.2l.5-.2,8.7-8.7,8.8,8.7.5.2.6-.2a.9.9,0,0,0,0-1.2Z"/></svg>'
);

/**
 * TODO GLOBAL INCLUDE
 */
include 'include/admin_functions.php';
include 'include/front_shortcode.php';
include 'include/front-function.php';
include 'include/ajax_functions.php';
include 'include/Template-Shop-Override.php';
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

/**
 * TODO ADMIN
 */
if (is_admin()) {

    /**
     * TODO GLOBAL VARIABLES
     */
    global $admin_form;
    global $admin_template_selector;
    global $admin_template_form;
    global $general;

    /**
     * TODO ADMIN INCLUDES
     */
    add_action("init", "Itwpt_add_taxonomies");
    function Itwpt_add_taxonomies()
    {
        include 'include/admin_forms_taxonomies.php';
        include 'include/admin_forms.php';

        $admin_form['query']['fields']  = array_merge($admin_form['query']['fields'], $options_taxonomy);
        $admin_form['search']['fields'] = array_merge($admin_form['search']['fields'], $options_taxonomy_search_field);

    }

    include 'include/admin_page.php';
    include 'include/admin_add_page.php';
    include 'include/admin_template_page.php';
    include 'include/admin_general_page.php';

    /**
     * TODO ADMIN MENU
     */
    add_action('admin_menu', 'Itwpt_Add_Menu'); // FUNCTION IN FILE admin_functions.php

}

/**
 * TODO SHORTCODE
 */
add_action('plugin_loaded', 'Itwpt_plugin_load');
function Itwpt_plugin_load()
{

    load_plugin_textdomain(PREFIX_ITWPT_TEXTDOMAIN, false,
        dirname(plugin_basename(__FILE__)) . '/languages/');

    // MAIN SHORTCODE
    add_shortcode('it_woo_product_table', 'Itwpt_Shortcode');

}

/**
 * TODO SEARCH TITLE
 */
add_filter('posts_where', 'Itwpt_search_title_func', 10, 2);
function Itwpt_search_title_func($where, $wp_query)
{

    global $wpdb;
    if ($wpse18703_title = $wp_query->get('search_title')) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql($wpdb->esc_like($wpse18703_title)) . '%\'';
    }

    return $where;

}


add_action('woocommerce_init', 'Itwpt_force_non_logged_user_wc_session');
function Itwpt_force_non_logged_user_wc_session()
{
    if (is_user_logged_in() || is_admin()) {
        return;
    }

//	if ( ! WC()->session->has_session() ) {
//		WC()->session->set_customer_session_cookie( true );
//	}

    if (isset(WC()->session)) {
        if ( ! WC()->session->has_session()) {
            WC()->session->set_customer_session_cookie(true);
        }
    }

}

add_action( 'wp_enqueue_scripts', 'Itwpt_yith_wcan_enqueue_script', 15 );
function Itwpt_yith_wcan_enqueue_script(){
    wp_dequeue_script( 'yith-wcan-script' );
}

/**
 * TODO ACTIVATION AND DEACTIVATION
 */
register_activation_hook(__FILE__, 'Itwpt_Activation');
register_deactivation_hook(__FILE__, 'Itwpt_Deactivation');
