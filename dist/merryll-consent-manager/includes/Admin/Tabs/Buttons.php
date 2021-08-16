<?php
/**
 * Buttons Tab Class.
 *
 * This class renders the user options contents in Cookie Box Tab.
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
class Buttons {

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
			'merryll_settings_btn_html',
			esc_html__( 'Consent Button Settings', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'select',
			'merryll_btn_type',
			esc_html__( 'Button Type', 'merryll-consent-manager' )
		)
		->add_options(
			array(
				'standard'     => esc_html__( 'Standard', 'merryll-consent-manager' ),
				'slight-round' => esc_html__( 'Slightly Rounded', 'merryll-consent-manager' ),
				'round'        => esc_html__( 'Rounded', 'merryll-consent-manager' ),
			)
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please select the functionality for the left button', 'merryll-consent-manager' ) )
		->set_default_value( 'standard' );

		self::$fields[] = Field::make(
			'separator',
			'merryll_settings_btn_text_html',
			esc_html__( 'Button Texts', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'text',
			'merryll_acc_all_btn_text',
			esc_html__( 'Accept-All Button Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please enter the accept-all button text', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Alle Akzeptieren', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'text',
			'merryll_acc_sel_btn_text',
			esc_html__( 'Accept-Selected Button Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the accept-selected button text', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Ausgewählte Akzeptieren', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'text',
			'merryll_reject_btn_text',
			esc_html__( 'Reject-All Button Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the reject-all button text', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Alle Ablehne', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'text',
			'merryll_save_btn_text',
			esc_html__( 'Save Button Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the save button text', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Speichern', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'separator',
			'merryll_settings_btn_color_html',
			esc_html__( 'Button Colors', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'html',
			'merryll_acc_all_html',
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border section-title' )
		->set_html( sprintf( '<h4>%s</h4>', esc_html__( 'Accept-All Button Color', 'merryll-consent-manager' ) ) );

		self::$fields[] = Field::make(
			'color',
			'merryll_acc_all_btn_color',
			esc_html__( 'Background Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please choose the accept-all button color', 'merryll-consent-manager' ) )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		self::$fields[] = Field::make(
			'color',
			'merryll_acc_all_btn_hover_color',
			esc_html__( 'Hover Background Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please choose the accept-all button hover color', 'merryll-consent-manager' ) )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		self::$fields[] = Field::make(
			'html',
			'merryll_acc_sel_html',
		)
		->set_classes( 'two-col flex-wrap justify-content-end top-border section-title' )
		->set_html( sprintf( '<h4>%s</h4>', esc_html__( 'Accept-Selected Button Color', 'merryll-consent-manager' ) ) );

		self::$fields[] = Field::make(
			'color',
			'merryll_acc_sel_btn_color',
			esc_html__( 'Background Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please choose the accept-selected button color', 'merryll-consent-manager' ) )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		self::$fields[] = Field::make(
			'color',
			'merryll_acc_sel_btn_hover_color',
			esc_html__( 'Hover Background Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please choose the accept-selected button hover color', 'merryll-consent-manager' ) )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		self::$fields[] = Field::make(
			'html',
			'merryll_rej_all_html',
		)
		->set_classes( 'two-col flex-wrap justify-content-end top-border section-title' )
		->set_html( sprintf( '<h4>%s</h4>', esc_html__( 'Reject-All Button Color', 'merryll-consent-manager' ) ) );

		self::$fields[] = Field::make(
			'color',
			'merryll_reject_btn_color',
			esc_html__( 'Background Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please choose the reject-all button color', 'merryll-consent-manager' ) )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		self::$fields[] = Field::make(
			'color',
			'merryll_reject_btn_hover_color',
			esc_html__( 'Hover Background Color', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please choose the reject-all button hover color', 'merryll-consent-manager' ) )
		->set_width( 50 )
		->set_default_value( '#ff5f17' );

		return new static();
	}
}
