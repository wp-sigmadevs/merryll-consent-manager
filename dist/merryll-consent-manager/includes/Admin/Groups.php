<?php
/**
 * Cookie Groups Class.
 *
 * This class renders the user options contents in Cookie Groups Page.
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
class Groups {

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
			'merryll_cookie_groups_html',
			esc_html__( 'Add Cookie Groups', 'merryll-consent-manager' )
		);

		self::$fields[] = Field::make(
			'complex',
			'merryll_cookie_group',
			''
		)
		->set_collapsed( true )
		->setup_labels(
			array(
				'plural_name'   => 'New',
				'singular_name' => 'New',
			)
		)
		->add_fields(
			array(
				Field::make(
					'text',
					'merryll_cookie_group_title',
					esc_html__( 'Group Title', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enter the cookie group title. Example: Analyse.', 'merryll-consent-manager' ) ),

				Field::make(
					'text',
					'merryll_cookie_group_id',
					esc_html__( 'Group ID', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enter the cookie group identifier ID in lowercase. Example: analytics.', 'merryll-consent-manager' ) ),

				Field::make(
					'textarea',
					'merryll_cookie_group_desc',
					esc_html__( 'Group Description', 'merryll-consent-manager' )
				)
				->set_classes( 'two-col flex-wrap justify-content-end' )
				->set_help_text( esc_html__( 'Please enter the cookie group description.', 'merryll-consent-manager' ) ),
			)
		)
		->set_header_template(
			'
			<% if (merryll_cookie_group_title) { %>
				Name: <%- merryll_cookie_group_title %>, ID: <%- merryll_cookie_group_id %>
			<% } %>
		'
		);

		return new static();
	}
}
