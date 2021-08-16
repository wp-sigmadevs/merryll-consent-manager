<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Base;

/**
 * Plugin Activation Class.
 *
 * @since  1.0.0
 */
class Activate {

	/**
	 * Method to run on plugin activation.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function activate() {
		\flush_rewrite_rules();

		if ( ! \get_option( '_merryll_md5_check' ) ) {
			\update_option( '_merryll_md5_check', false );
		}
	}
}
