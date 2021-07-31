<?php
/**
 * Aside Metabox class.
 *
 * This class is responsible for rendering the sidebar cookie ID.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Metabox;

use Carbon_Fields\Field;

/**
 * Aside Class.
 *
 * @since  1.0.0
 */
class Aside {

	/**
	 * Accumulates metabox fields.
	 *
	 * @access private
	 * @since  1.0.0
	 * @static
	 *
	 * @var array
	 */
	private static $fields;

	/**
	 * Method to render aside content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		self::cookie_id();

		return self::$fields;
	}

	/**
	 * Method to add slider shortcode metabox.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return static
	 */
	private static function cookie_id() {
		self::$fields = array();

		self::$fields[] = Field::make(
			'text',
			'merryll_cookie_id_display',
			''
		)
		->set_help_text( esc_html__( 'Cookie ID for this cookie.', 'merryll-consent-manager' ) )
		->set_attribute( 'readOnly', true )
		->set_default_value( self::get_id() );

		return new static();
	}

	/**
	 * Method to render shortcode name.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return string
	 */
	private static function get_id() {
		$post_id = isset( $_GET['post'] ) ? absint( wp_unslash( $_GET['post'] ) ) : '';

		if ( empty( $post_id ) ) {
			return;
		}

		return esc_html( str_replace( ' ', '-', strtolower( get_the_title( $post_id ) ) ) );
	}
}
