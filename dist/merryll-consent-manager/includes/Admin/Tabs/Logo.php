<?php
/**
 * Logo Tab Class.
 *
 * This class renders the user options contents in Logo Tab.
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
class Logo {

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
			'merryll_settings_logo_html',
			esc_html__( 'Logo Settings', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'image',
			'merryll_top_logo',
			esc_html__( 'Upload Top Left Logo', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please upload the top left logo.', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'text',
			'merryll_top_right_text',
			esc_html__( 'Top Right Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the top right text.', 'merryll-consent-manager' ) )
		->set_default_value( '© merryll' );

		self::$fields[] = Field::make(
			'color',
			'merryll_top_right_text_color',
			esc_html__( 'Top Right Text Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please choose the top right text color.', 'merryll-consent-manager' ) )
		->set_default_value( '#3AB9EB' );

		self::$fields[] = Field::make(
			'text',
			'merryll_top_link',
			esc_html__( 'Top Logo Link', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the top logo link.', 'merryll-consent-manager' ) )
		->set_default_value( esc_url( get_home_url() ) );

		self::$fields[] = Field::make(
			'separator',
			'merryll_settings_poweredby_html',
			esc_html__( 'Powered By Settings', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'text',
			'merryll_poweredby_text',
			esc_html__( 'Footer Powered By Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please enter the footer powered by text.', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Cookie Button Entwicklung by merryll', 'merryll-consent-manager' ));

		self::$fields[] = Field::make(
			'color',
			'merryll_poweredby_text_color',
			esc_html__( 'Powered By Text Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please choose the powered by text color.', 'merryll-consent-manager' ) )
		->set_default_value( '#3AB9EB' );

		self::$fields[] = Field::make(
			'text',
			'merryll_poweredby_link',
			esc_html__( 'Footer Powered By Link', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the footer powered by link.', 'merryll-consent-manager' ) )
		->set_default_value( esc_url( 'https://merryll.de/' ) );

		return new static();
	}
}
