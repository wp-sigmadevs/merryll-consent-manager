<?php
/**
 * Main Metabox class.
 *
 * This class is responsible for creating the metaboxes with all the
 * necessary options for user interaction.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Metabox;

use Carbon_Fields\Container;
use Merryll\Merryll_Consent_Manager\Metabox\Aside;

/**
 * Metabox Class.
 *
 * @since  1.0.0
 */
class Metaboxes {

	/**
	 * Method to register metaboxes.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->args = array(
			'title'     => esc_html__( 'Cookie Information', 'merryll-consent-manager' ),
			'post-type' => esc_attr( 'merryll_cookies' ),
		);

		\add_action( 'carbon_fields_register_fields', array( $this, 'settings' ) );
		\add_action( 'carbon_fields_register_fields', array( $this, 'aside' ) );
	}

	/**
	 * Method to render metaboxes using Carbon Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function settings() {
		$settings = Container::make( 'post_meta', $this->args['title'] );
		$settings->where( 'post_type', '=', $this->args['post-type'] )
			->set_classes( 'merryll-metabox-settings' );

		$settings->add_fields( Cookie_Metas::register() );
	}

	/**
	 * Method to render post sidebar contents.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function aside() {
		if ( ! isset( $_GET['post'] ) ) {
			return;
		}

		$settings = Container::make( 'post_meta', esc_html__( 'Cookie ID', 'aurora-slider' ) );
		$settings->where( 'post_type', '=', $this->args['post-type'] )
			->set_context( 'side' )
			->set_classes( 'merryll-single-cookie-id' );

		$settings->add_fields( Aside::register() );
	}
}
