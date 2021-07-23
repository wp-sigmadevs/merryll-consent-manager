<?php
/**
 * Settings Links Class.
 *
 * This class creates a settings link in the plugins menu.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Base;

use Merryll\Merryll_Consent_Manager\Base\Base_Controller;

/**
 * Settings Links Class.
 *
 * @since  1.0.0
 */
class Settings_Links extends Base_Controller {

	/**
	 * Custom Settings link.
	 *
	 * @access private
	 * @since  1.0.0
	 *
	 * @var array
	 */
	private $custom_settings_link = '';

	/**
	 * Method to register settings link.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->custom_settings_link = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( 'edit.php?post_type=merryll_cookies&page=merryll-cookies-settings' ),
			esc_html__( 'Settings', 'merryll-consent-manager' )
		);

		\add_filter( 'plugin_action_links_' . $this->get_plugin(), array( $this, 'settings_link' ) );
	}

	/**
	 * Method to add custom settings link.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param  mixed $links default links.
	 * @return array modified links.
	 */
	public function settings_link( $links ) {
		array_push( $links, $this->custom_settings_link );

		return $links;
	}
}
