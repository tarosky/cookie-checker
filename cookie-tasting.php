<?php
/*
 * Plugin Name: Cookie Tasting
 * Plugin URI: https://wordpress.org/plugins/cookie-tasting/
 * Description: Detect user login only with cookie. The best helper for cached WordPress sites.
 * Author: Tarosky INC.
 * Version: 1.0.5
 * Author URI: https://tarosky.co.jp
 * License: GPL3 or later
 * Text Domain: cookie
 * Domain Path: /languages/
 *
 * @package cookie
 */


defined( 'ABSPATH' ) || die();

/**
 * Get plugin version.
 *
 * @return string
 */
function cookie_tasting_version() {
	static $info = null;
	if ( is_null( $info ) ) {
		$info = get_file_data( __FILE__, [
			'version' => 'Version',
		] );
	}
	return $info['version'];
}

/**
 * Initialize Cookie setting.
 */
function cookie_tasting_init() {
	// Load autoloader
	require __DIR__ . '/vendor/autoload.php';
	// Load text domain.
	load_plugin_textdomain( 'cookie', false, basename( __DIR__ ) . '/languages' );
	// Includes all hooks.
	$include_dir = __DIR__ . '/includes';
	foreach ( scandir( $include_dir ) as $file ) {
		if ( preg_match( '#^[^._].*\.php$#u', $file ) ) {
			require $include_dir . '/' . $file;
		}
	}
}
add_action( 'plugins_loaded', 'cookie_tasting_init' );
