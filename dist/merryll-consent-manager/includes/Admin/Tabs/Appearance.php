<?php
/**
 * Appearance Tab Class.
 *
 * This class renders the user options contents in Appearance Tab.
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
class Appearance {

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
	private static function settings() {
		self::$fields[] = Field::make(
			'separator',
			'merryll_settings_fonts_html',
			esc_html__( 'Font Settings', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'text',
			'merryll_heading_font_size',
			esc_html__( 'Heading Font Size', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please enter the desired heading font size.', 'merryll-consent-manager' ) )
		->set_default_value( '24px' );

		self::$fields[] = Field::make(
			'text',
			'merryll_heading_letter_sp',
			esc_html__( 'Heading Letter Spacing', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the desired heading letter spacing.', 'merryll-consent-manager' ) )
		->set_default_value( '0px' );

		self::$fields[] = Field::make(
			'text',
			'merryll_font_size',
			esc_html__( 'Body Font Size', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the desired body font size.', 'merryll-consent-manager' ) )
		->set_default_value( '15px' );

		self::$fields[] = Field::make(
			'text',
			'merryll_body_letter_sp',
			esc_html__( 'Body Letter Spacing', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the desired body letter spacing.', 'merryll-consent-manager' ) )
		->set_default_value( '0.8px' );

		self::$fields[] = Field::make(
			'separator',
			'merryll_settings_colors_html',
			esc_html__( 'Color Settings', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'color',
			'merryll_bg_color',
			esc_html__( 'Background Color', 'merryll-consent-manager' )
		)
		->set_help_text( esc_html__( 'Please choose the modal background color', 'merryll-consent-manager' ) )
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_width( 50 )
		->set_default_value( '#08204a' );

		self::$fields[] = Field::make(
			'color',
			'merryll_text_color',
			esc_html__( 'Text Color', 'merryll-consent-manager' )
		)
		->set_help_text( esc_html__( 'Please choose the text color', 'merryll-consent-manager' ) )
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_width( 50 )
		->set_default_value( '#ffffff' );

		self::$fields[] = Field::make(
			'color',
			'merryll_link_color',
			esc_html__( 'Link Color', 'merryll-consent-manager' )
		)
		->set_help_text( esc_html__( 'Please choose the link color', 'merryll-consent-manager' ) )
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		self::$fields[] = Field::make(
			'color',
			'merryll_link_hover_color',
			esc_html__( 'Link Hover Color', 'merryll-consent-manager' )
		)
		->set_help_text( esc_html__( 'Please choose the link hover color', 'merryll-consent-manager' ) )
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		self::$fields[] = Field::make(
			'color',
			'merryll_switch_on_color',
			esc_html__( 'Selection Switch On Color', 'merryll-consent-manager' )
		)
		->set_help_text( esc_html__( 'Please choose the switch on color', 'merryll-consent-manager' ) )
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		self::$fields[] = Field::make(
			'color',
			'merryll_divider_color',
			esc_html__( 'Divider Color', 'merryll-consent-manager' )
		)
		->set_help_text( esc_html__( 'Please choose the divider color', 'merryll-consent-manager' ) )
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_width( 50 )
		->set_default_value( '#dddddd' );

		return new static();
	}
}
