<?php
/**
 * The admin controller class.
 *
 * The class is responsible for initializing all the modules of Admin Pages.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Base;

use Merryll\Merryll_Consent_Manager\Base\Base_Controller;

/**
 * Admin Controller Class.
 *
 * @since 1.0.0
 */
abstract class Abstract_Controller extends Base_Controller {

	/**
	 * Stores all the classes inside an array.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array Full list of classes
	 */
	abstract protected static function get_services();

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
	public function register() {
		foreach ( self::get_services() as $class ) {
			$service = self::instance( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Method to initialize a class.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @static
	 *
	 * @param  class $class class to instantiate.
	 * @return class new instance of the class
	 */
	protected static function instance( $class ) {
		$service = new $class();

		return $service;
	}
}
