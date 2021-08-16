<?php
/**
 * Main enqueue Class.
 *
 * This class registers all scripts & styles required for Merryll Consent Manager.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Base;

use Merryll\Merryll_Consent_Manager\Base\Base_Controller;

/**
 * Enqueue Class.
 *
 * @since  1.0.0
 */
class Enqueue extends Base_Controller {

	/**
	 * Holds script file name suffix.
	 *
	 * @access protected
	 * @since  1.0.0
	 *
	 * @var string
	 */
	protected $suffix = null;

	/**
	 * Accumulates scripts.
	 *
	 * @access protected
	 * @since  1.0.0
	 *
	 * @var array
	 */
	protected $enqueues = array();

	/**
	 * Class Constructor.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();

		$this->suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	}

	/**
	 * Method to register scripts.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void|class
	 */
	protected function register_scripts() {

		if ( empty( $this->enqueues ) ) {
			return;
		}

		$wp_register_function = '';

		foreach ( $this->enqueues as $type => $enqueue ) {
			$wp_register_function = '\wp_register_' . $type;

			foreach ( $enqueue as $key ) {
				if ( isset( $key['load_in_footer'] ) ) {
					$load_in_footer = (bool) $key['load_in_footer'];
				} else {
					$load_in_footer = (bool) true;
				}

				$wp_register_function(
					isset( $key['handle'] ) ? $key['handle'] : '',
					isset( $key['asset_uri'] ) ? $key['asset_uri'] : '',
					isset( $key['dependency'] ) ? $key['dependency'] : array(),
					isset( $key['version'] ) ? $key['version'] : null,
					( 'style' === $type ) ? 'all' : $load_in_footer
				);
			}
		}

		return $this;
	}

	/**
	 * Method to enqueue scripts.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void|class
	 */
	protected function enqueue_scripts() {

		if ( empty( $this->enqueues ) ) {
			return;
		}

		$wp_enqueue_function = '';

		foreach ( $this->enqueues as $type => $enqueue ) {
			$wp_enqueue_function = '\wp_enqueue_' . $type;

			foreach ( $enqueue as $key ) {
				$wp_enqueue_function( $key['handle'] );
			}
		}

		return $this;
	}

	/**
	 * Method to localize script.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @param array $args Localize args.
	 * @return void
	 */
	protected function localize( array $args ) {
		\wp_localize_script(
			$args['handle'],
			$args['js_object'],
			$args['vars']
		);
	}
}
