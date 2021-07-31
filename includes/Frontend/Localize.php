<?php
/**
 * Localization Class for frontend.
 *
 * This class localizes JS variables in the frontend.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Frontend;

use Merryll\Merryll_Consent_Manager\Frontend\Options_Values as Options;

/**
 * Localize Class.
 *
 * @since  1.0.0
 */
class Localize {

	/**
	 * Method to register frontend scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		return array(
			'handle'    => 'merryll-config',
			'js_object' => 'merryllSettings',
			'vars'      => self::data(),
		);
	}

	/**
	 * Method to build up data.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array
	 */
	private static function data() {
		return Options::get();
	}
}
