<?php
/**
 * The core plugin class.
 *
 * The main handler class responsible for initializing Merryll Consent Manager.
 * This class registers all the core modules required to run the plugin.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager;

/**
 * Plugin Initialization Class.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Stores all the core classes inside an array.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array Full list of classes
	 */
	private static function get_services() {
		return array(
			Base\Locale::class,
			Base\CF_Controller::class,
			Base\CPT_Controller::class,
			Base\Settings_Links::class,
			Base\Admin_Controller::class,
			Base\Public_Controller::class,
			Base\Metabox_Controller::class,
		);
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class ) {
			$service = self::instance( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Method to initialize the class.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @param  class $class class from the services array.
	 * @return class new instance of the class
	 */
	private static function instance( $class ) {
		$service = new $class();

		return $service;
	}
}
