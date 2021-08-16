<?php
/**
 * Floating Bar Tab Class.
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
class Bar {

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
			'merryll_settings_bar_html',
			esc_html__( 'Floating Bar', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'switch',
			'merryll_enable_float',
			esc_html__( 'Enable Floating Bar?', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'If enabled, a floating text bar will be enabled at the right edge of the screen to access the consent popup.', 'merryll-consent-manager' ) )
		->set_default_value( true );

		self::$fields[] = Field::make(
			'text',
			'merryll_float_text',
			esc_html__( 'Floating Bar Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the floating bar text.', 'merryll-consent-manager' ) )
		->set_default_value( 'Cookie-Einstellungen' )
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'merryll_enable_float',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		self::$fields[] = Field::make(
			'separator',
			'merryll_settings_bar_style_html',
			esc_html__( 'Floating Bar Colors', 'merryll-consent-manager' )
		)
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'merryll_enable_float',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		self::$fields[] = Field::make(
			'color',
			'merryll_float_bg_color',
			esc_html__( 'Background Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please enter the floating bar background Color.', 'merryll-consent-manager' ) )
		->set_default_value( '#2271b1' )
		->set_width( 50 )
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'merryll_enable_float',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		self::$fields[] = Field::make(
			'color',
			'merryll_float_text_color',
			esc_html__( 'Text Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please enter the floating bar text color.', 'merryll-consent-manager' ) )
		->set_default_value( '#ffffff' )
		->set_width( 50 )
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'merryll_enable_float',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		self::$fields[] = Field::make(
			'color',
			'merryll_float_bg_hover_color',
			esc_html__( 'Hover Background Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the floating bar hover background Color.', 'merryll-consent-manager' ) )
		->set_default_value( '#2271b1' )
		->set_width( 50 )
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'merryll_enable_float',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		self::$fields[] = Field::make(
			'color',
			'merryll_float_text_hover_color',
			esc_html__( 'Hover Text Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the floating bar hover text color.', 'merryll-consent-manager' ) )
		->set_default_value( '#ffffff' )
		->set_width( 50 )
		->set_conditional_logic(
			array(
				'relation' => 'AND',
				array(
					'field'   => 'merryll_enable_float',
					'value'   => true,
					'compare' => '=',
				),
			)
		);

		return new static();
	}
}
