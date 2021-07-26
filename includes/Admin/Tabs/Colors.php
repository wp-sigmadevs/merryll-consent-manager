<?php
/**
 * Colors Tab Class.
 *
 * This class renders the user options contents in Colors Tab.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Admin\Tabs;

use Carbon_Fields\Field;

/**
 * Colors Tab Class.
 *
 * @since  1.0.0
 */
class Colors {

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
	 * Method to add settings fields under colors tab.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::colors();

		return self::$fields;
	}

	/**
	 * Method to add color settings.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function colors() {
		self::$fields[] = Field::make(
			'color',
			'aurora_primary_color',
			esc_html__( 'Primary Color', 'aurora-slider' )
		)
		->set_help_text( 'Enter your Primary Color' )
		->set_default_value( '#e9e9a1' );

		self::$fields[] = Field::make(
			'color',
			'aurora_secondary_color',
			esc_html__( 'Secondary Color', 'aurora-slider' )
		)
		->set_help_text( 'Enter your Secondary Color' )
		->set_default_value( '##ff0000' );

		return new static();
	}
}
