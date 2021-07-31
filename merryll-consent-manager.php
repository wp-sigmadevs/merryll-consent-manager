<?php
/**
 * Plugin Name: merryll Consent Manager
 * Plugin URI: https://github.com/wp-sigmadevs/merryll-consent-manager/
 * Description: An elegant way to make your website ready for GDPR regulations.
 * Version: 1.0.0
 * Author: merryll Media
 * Author URI: https://merryll.de/
 * License: GPLv2 or later
 * Text Domain: merryll-consent-manager
 * Domain Path: /languages/
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

// If this file is called directly, abort!!!
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! version_compare( PHP_VERSION, '5.6', '>=' ) ) {
	add_action( 'admin_notices', 'merryll_fail_php_version' );
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	deactivate_plugins( plugin_basename( __FILE__ ) );
	exit;
} elseif ( ! version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
	add_action( 'admin_notices', 'merryll_fail_wp_version' );
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
	deactivate_plugins( plugin_basename( __FILE__ ) );
	exit;
}

// Autoloading plugin files.
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

/**
 * Plugin activation.
 */
function activate_merryll_consent_manager() {
	\Merryll\Merryll_Consent_Manager\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_merryll_consent_manager' );

/**
 * Plugin deactivation.
 */
function deactivate_merryll_consent_manager() {
	\Merryll\Merryll_Consent_Manager\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_merryll_consent_manager' );

/**
 * Initialize all the core classes of the plugin.
 */
if ( class_exists( 'Merryll\Merryll_Consent_Manager\\Plugin' ) ) {
	\Merryll\Merryll_Consent_Manager\Plugin::register_services();
}

/**
 * Admin notice for minimum PHP version.
 *
 * Warns user when the site doesn't have the minimum required PHP version.
 *
 * @since 1.0.0
 * @return void
 */
function merryll_fail_php_version() {
	/* translators: %s: PHP version */
	$message      = sprintf( esc_html__( 'Merryll Consent Manager requires PHP version %s+, plugin is currently NOT RUNNING.', 'merryll-consent-manager' ), '5.6' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}

/**
 * Admin notice for minimum WordPress version.
 *
 * Warns user when the site doesn't have the minimum required WordPress version.
 *
 * @since 1.0.0
 * @return void
 */
function merryll_fail_wp_version() {
	/* translators: %s: WordPress version */
	$message      = sprintf( esc_html__( 'Merryll Consent Manager requires WordPress version %s+. Because you are using an earlier version, the plugin is currently NOT RUNNING.', 'merryll-consent-manager' ), '5.0' );
	$html_message = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
	echo wp_kses_post( $html_message );
}




// $string = "n9whWg%#&4%Z6YjbpF%E";
// $md5 = md5($string);
// echo $string;
// echo "<br>";
// // echo "Hex formed by md5 function is ".$md5;
// $json = json_decode(\file_get_contents($this->get_plugin_path() . '/md5.json'), true);

// if($md5 === $json['md5']) {
// 	echo '<br>success';
// }
