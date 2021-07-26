<?php
/**
 * Settings Tab Class.
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
class Settings {

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
	 * Method to add settings fields under settings tab.
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
	 * Method to add settings.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	public static function settings() {
		self::$fields[] = Field::make(
			'switch',
			'aurora_first_name',
			esc_html__( 'First Name', 'aurora-slider' )
		)
		->set_help_text( 'Enter your first name' )
		->set_default_value( true );

		self::$fields[] = Field::make(
			'text',
			'aurora_last_name',
			esc_html__( 'Last Name', 'aurora-slider' )
		)
		->set_help_text( 'Enter your last name' )
		->set_attribute( 'placeholder', 'Ex. John Doe' );

		return new static();
	}
}
