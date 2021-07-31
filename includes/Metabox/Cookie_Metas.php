<?php
/**
 * Cookie Metabox Class.
 *
 * This class renders the user options contents in Cookie Posts.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Metabox;

use Carbon_Fields\Field;

/**
 * Cookie Groups Class.
 *
 * @since  1.0.0
 */
class Cookie_Metas {

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
			'textarea',
			'merryll_cookie_single_desc',
			esc_html__( 'Cookie Description', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter the cookie description.', 'merryll-consent-manager' ) );

		self::$fields[] = Field::make(
			'text',
			'merryll_cookie_single_domain',
			esc_html__( 'Cookie Path and Domain (Optional)', 'merryll-consent-manager' )
		)
		->set_default_value( '""' )
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'you an either only provide comma separated cookie name or regular expression (regex) or a list consisting of a name or regex, a path and a cookie domain. Example: "_gac", "_gac_*", "_gcl", "_gcl_au", "_gcl_*"', 'merryll-consent-manager' ) )
		->set_attribute( 'placeholder', 'Ex: "_gac", "_gac_*", "_gcl", "_gcl_au", "_gcl_*"' );

		self::$fields[] = Field::make(
			'select',
			'merryll_cookie_single_group',
			esc_html__( 'Cookie Group', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please select the corresponding cookie group.', 'merryll-consent-manager' ) )
		->add_options( self::groups() );

		self::$fields[] = Field::make(
			'text',
			'merryll_cookie_single_position',
			esc_html__( 'Cookie Priority', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'Please enter a numeric cookie position to prioritize for displaying. Example: 1.', 'merryll-consent-manager' ) )
		->set_attribute( 'placeholder', 'Ex: 1' );

		self::$fields[] = Field::make(
			'switch',
			'merryll_cookie_single_pre_sel',
			esc_html__( 'Pre-Selected?', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'If enabled, the cookie will be pre-selected in the frontend.', 'merryll-consent-manager' ) )
		->set_default_value( true );

		self::$fields[] = Field::make(
			'switch',
			'merryll_cookie_single_req',
			esc_html__( 'Required?', 'merryll-consent-manager' )
		)
		->set_classes( 'two-col flex-wrap justify-content-end' )
		->set_help_text( esc_html__( 'If enabled, system will not allow user to turn off the cookie.', 'merryll-consent-manager' ) )
		->set_default_value( false );

		return new static();
	}

	/**
	 * Method to get the cookie group list
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array
	 */
	private static function groups() {
		$groups     = carbon_get_theme_option( 'merryll_cookie_group' );
		$group_list = array();

		if ( empty( $groups ) ) {
			$group_list = array(
				'no' => esc_html__( 'No Cookie Groups found. Please create Cookie Groups first.', 'merryll-consent-manager' ),
			);

			return $group_list;
		}

		foreach ( $groups as $group ) {
			$group_list[ $group['merryll_cookie_group_id'] ] = $group['merryll_cookie_group_title'] . ' (ID: ' . $group['merryll_cookie_group_id'] . ')';
		}

		return $group_list;
	}
}
