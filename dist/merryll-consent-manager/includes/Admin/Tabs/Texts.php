<?php
/**
 * Texts Tab Class.
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
class Texts {

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
			'merryll_modal_top_html',
			esc_html__( 'Consent Modal Top Texts', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'text',
			'merryll_modal_title',
			esc_html__( 'Consent Modal Top Title', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please enter the consent modal main title', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Diese Internetseite verwendet Cookies und Tracking', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'textarea',
			'merryll_modal_desc',
			esc_html__( 'Consent Modal Top Description', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the consent modal main description', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Für einen Betrieb der Internetseite sind Notwendige Cookies erforderlich. Mit Ihrer Einwilligung kommen zusätzliche Tracking- Technologien (Cookies, Tags, Pixel etc.) zum Einsatz, die Daten zur Optimierung, Personalisierung, Lokalisierung und Analyse unseres Angebots sowie für Werbung erheben und an den jeweiligen Anbieter weitergegeben und dort zusammengeführt werden können.', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'separator',
			'merryll_modal_bottom_html',
			esc_html__( 'Consent Modal Deactivation Texts', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'text',
			'merryll_modal_deactivation_title',
			esc_html__( 'Consent Modal Deactivation Title', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please enter the consent modal Deactivation title', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Alle deaktivieren', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'textarea',
			'merryll_modal_deactive_desc',
			esc_html__( 'Consent Modal Deactivation Description', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the consent modal deactivation description', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Durch das Deaktivieren aller Dienste werden wir keine personenbezogenen Daten sammeln, benutzen oder übertragen, bis Sie uns Ihre explizite Einwilligung erteilen. Allerdings verhindert das, dass wir Ihnen die bestmögliche Erfahrung auf unserer Website geben können.', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'separator',
			'merryll_modal_other_html',
			esc_html__( 'Other Texts', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'text',
			'merryll_modal_service_singular',
			esc_html__( 'Service Singular Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end no-top-border' )
		->set_help_text( esc_html__( 'Please enter the service singular text', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Dienst', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'text',
			'merryll_modal_service_plural',
			esc_html__( 'Service Plural Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the service plural text', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Dienste', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'text',
			'merryll_modal_purpose_text',
			esc_html__( 'Purpose Singular Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the purpose singular text', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Zweck', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'text',
			'merryll_modal_purpose_plural',
			esc_html__( 'Purpose Plural Text', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the purpose plural text', 'merryll-consent-manager' ) )
		->set_default_value( esc_html__( 'Zwecke', 'merryll-consent-manager' ) );

		return new static();
	}
}
