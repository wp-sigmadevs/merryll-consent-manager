<?php
/**
 * Cookies Class.
 *
 * This class renders the user options contents in Cookies Page.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Admin;

use Carbon_Fields\Field;

/**
 * Cookie Groups Class.
 *
 * @since  1.0.0
 */
class Cookies {

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
			'merryll_cookie_list_html',
			esc_html__( 'Add Cookies', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'complex',
			'merryll_cookie_list',
			''
		)
		->set_collapsed( true )
		->setup_labels(
			array(
				'plural_name'   => esc_html__( 'New', 'merryll-consent-manager' ),
				'singular_name' => esc_html__( 'New', 'merryll-consent-manager' ),
			)
		)
		->add_fields(
			array(
				Field::make(
					'text',
					'merryll_cookie_single_name',
					esc_html__( 'Cookie Title', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enter the cookie title. Example: Google Analytics.', 'merryll-consent-manager' ) ),

				Field::make(
					'text',
					'merryll_cookie_single_id',
					esc_html__( 'Cookie ID', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enter the cookie ID in all lowercase and with dash(-). Example: google-analytics.', 'merryll-consent-manager' ) )
				->set_attribute( 'placeholder', 'Ex: google-analytics' ),

				Field::make(
					'textarea',
					'merryll_cookie_single_desc',
					esc_html__( 'Cookie Description', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enter the cookie description.', 'merryll-consent-manager' ) ),

				Field::make(
					'text',
					'merryll_cookie_single_domain',
					esc_html__( 'Cookie Pattern (Optional)', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enter cookie name or regular expression (regex) or a list consisting of a name or regex separated by comma and a space. Example: for Google Analytics: _ga, _gid, _gat, __gads, /^_gac_, .*$/i, /^_gat_, .*$/i', 'merryll-consent-manager' ) )
				->set_attribute( 'placeholder', 'Ex: _ga, _gid, _gat, __gads, /^_gac_, .*$/i, /^_gat_, .*$/i' ),

				Field::make(
					'select',
					'merryll_cookie_single_group',
					esc_html__( 'Cookie Group', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please select the associated cookie group.', 'merryll-consent-manager' ) )
				->add_options( self::groups() ),

				Field::make(
					'switch',
					'merryll_cookie_single_pre_sel',
					esc_html__( 'Pre-Selected?', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'If enabled, the cookie will be pre-selected in the frontend.', 'merryll-consent-manager' ) )
				->set_default_value( true ),

				Field::make(
					'switch',
					'merryll_cookie_single_gtm',
					esc_html__( 'Configured via Google Tag Manager?', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enable if this service is configured via Google Tag Manager.', 'merryll-consent-manager' ) )
				->set_default_value( false ),

				Field::make(
					'text',
					'merryll_cookie_single_custom',
					esc_html__( 'Custom Trigger Event Name (In Google Tag Manager)', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enter the custom trigger event name for google tag manager. Please note that, this event name must match with the custom trigger name in google tag manager console. Example: for Google Analytics: loadgtm-analytics', 'merryll-consent-manager' ) )
				->set_attribute( 'placeholder', 'Ex: loadgtm-analytics' )
				->set_conditional_logic(
					array(
						'relation' => 'AND',
						array(
							'field'   => 'merryll_cookie_single_gtm',
							'value'   => true,
							'compare' => '=',
						),
					)
				),

				// Field::make(
				// 'switch',
				// 'merryll_cookie_single_req',
				// esc_html__( 'Required?', 'merryll-consent-manager' )
				// )
				// ->set_classes( 'two-col flex-wrap justify-content-end' )
				// ->set_help_text( esc_html__( 'If enabled, system will not allow user to turn off the cookie.', 'merryll-consent-manager' ) )
				// ->set_default_value( false ),
			)
		)
		->set_header_template(
			'
			<% if (merryll_cookie_single_name) { %>
				Name: <%- merryll_cookie_single_name %>, ID: <%- merryll_cookie_single_id %>, Group: <%- merryll_cookie_single_group %>
			<% } %>
		'
		);

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
