<?php
/**
 * Plugin Name: Bayeight Booking Plugin
 * Author: TVS
 * Author URI: 
 * Version: 1.0.2
 * Description: Bayeight Custom Booking Plugin.
 * Text-Domain: bayeight-booking-plugin
 */

if( ! defined( 'ABSPATH' ) ) : exit(); endif; // No direct access allowed.

/**
 * Define plugin constants
 */
define( 'WPRK_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'WPRK_URL', trailingslashit( plugins_url('/', __FILE__) ) );

/**
 * Loading Necessary Scripts
 */
add_action( 'admin_enqueue_scripts', 'load_scripts' );
function load_scripts() {
    // wp_enqueue_style( 'wp-react-chart-admin', WPRK_URL . 'css/app.css', array(), wp_rand(), 'all' ); // phpcs:ignore
    wp_enqueue_script( 'wp-react-chart-admin', WPRK_URL . 'dist/bundle.js', array( 'jquery', 'wp-element' ), wp_rand(), true ); // phpcs:ignore
    wp_localize_script( 'wp-react-chart-admin', 'appLocalizer', [
        'apiUrl' => home_url( '/wp-json' ),
        'nonce'  => wp_create_nonce( 'wp_rest' ),
    ] );
}

require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/strayd0g/wp-booking-plugin',
	__FILE__,
	'wp-booking-app'
);

//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');


require_once WPRK_PATH . 'classes/class-create-admin-menu.php';
require_once WPRK_PATH . 'classes/class-create-settings-routes.php';
require_once WPRK_PATH . 'lib/booking.php';
