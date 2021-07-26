<?php
/**
 * The public controller class.
 *
 * The class is responsible for initializing all the modules for frontend view.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Base;

use Merryll\Merryll_Consent_Manager\Frontend\Shortcodes;
use Merryll\Merryll_Consent_Manager\Frontend\Public_Enqueue;
use Merryll\Merryll_Consent_Manager\Base\Base_Controller;

/**
 * Public Controller Class.
 *
 * @since 1.0.0
 */
class Public_Controller extends Base_Controller {

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
			// Shortcodes::class,
			Public_Enqueue::class,
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
		if ( is_admin() ) {
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
