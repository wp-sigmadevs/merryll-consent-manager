<?php
/**
 * General Tab Class.
 *
 * This class renders the user options contents in Settings Tab.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Admin\Tabs;

use Carbon_Fields\Field;

/**
 * Settings Tab Class.
 *
 * @since  1.0.0
 */
class General {

	/**
	 * Accumulates settings fields.
	 *
	 * @access private
	 * @since  1.0.0
	 * @static
	 *
	 * @var array
	 */
	private static $fields;

	/**
	 * Registering the tab contents.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::settings();

		return self::$fields;
	}

	/**
	 * Method to add required fields.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	public static function settings() {
		self::$fields[] = Field::make(
			'separator',
			'merryll_settings_general_html',
			esc_html__( 'General Settings', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'switch',
			'merryll_enable_cookie',
			esc_html__( 'Enable merryll Cookie?', 'merryll_consent_manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please switch on to enable merryll cookie.', 'merryll_consent_manager' ) )
		->set_default_value( true );

		self::$fields[] = Field::make(
			'text',
			'merryll_cookie_name',
			esc_html__( 'Cookie Name', 'merryll_consent_manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter a unique name.', 'merryll_consent_manager' ) )
		->set_default_value( 'merryll' );

		self::$fields[] = Field::make(
			'text',
			'merryll_cookie_expire',
			esc_html__( 'Cookie expiration (Days)', 'merryll_consent_manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter cookie expiration days.', 'merryll_consent_manager' ) )
		->set_default_value( 90 );

		return new static();
	}
}
