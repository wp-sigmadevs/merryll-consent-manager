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

use Merryll\Merryll_Consent_Manager\Admin\Admin_Page;
use Merryll\Merryll_Consent_Manager\Admin\Admin_Enqueue;
use Merryll\Merryll_Consent_Manager\Base\Base_Controller;

/**
 * Admin Controller Class.
 *
 * @since 1.0.0
 */
class Admin_Controller extends Base_Controller {

	/**
	 * Stores all the classes inside an array.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array Full list of classes
	 */
	private static function get_services() {
		return array(
			// Admin_Page::class,
			// Admin_Enqueue::class,
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
	public function register() {
		if ( ! is_admin() ) {
			return;
		}

		foreach ( self::get_services() as $class ) {
			$service = Base_Controller::instance( $class );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}
}
