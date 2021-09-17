<?php
/**
 * Scripts Enqueue Class for frontend.
 *
 * This class enqueues required styles & scripts in the frontend.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Frontend;

use Merryll\Merryll_Consent_Manager\Base\Enqueue;
use Merryll\Merryll_Consent_Manager\Frontend\Localize;

/**
 * Public Enqueue Class.
 *
 * @since  1.0.0
 */
class Public_Enqueue extends Enqueue {

	/**
	 * Method to register frontend scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		if ( ! \get_option( '_merryll_enable_cookie' ) ) {
			return;
		}

		$this->scripts_list();

		if ( empty( $this->scripts_list() ) ) {
			return;
		}

		\add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 98 );
		\add_filter( 'script_loader_tag', array( $this, 'add_defer_attr' ), 10, 2 );
	}

	/**
	 * Method to build up scripts & styles list.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return mixed
	 */
	private function scripts_list() {
		$this->get_styles()->get_scripts();

		return $this->enqueues;
	}

	/**
	 * Method to build up styles list.
	 *
	 * @since  1.0.0
	 * @access Private
	 *
	 * @return Object
	 */
	private function get_styles() {
		$styles = array();

		// Main Stylesheet.
		$styles[] = array(
			'handle'    => 'merryll-consent-stylesheet',
			'asset_uri' => $this->get_plugin_url() . 'assets/css/frontend.min.css',
			'version'   => $this->get_plugin_version(),
		);

		$this->enqueues['style'] = apply_filters( 'merryll_frontend_styles', $styles, 10, 1 );

		return $this;
	}

	/**
	 * Method to build up scripts list.
	 *
	 * @since  1.0.0
	 * @access Private
	 *
	 * @return Object
	 */
	private function get_scripts() {
		$scripts = array();

		// Config JS.
		$scripts[] = array(
			'handle'     => 'merryll-config',
			'asset_uri'  => $this->get_plugin_url() . 'assets/js/config.min.js',
			'dependency' => array(),
			'version'    => $this->get_plugin_version(),
		);

		// Klaro JS.
		$scripts[] = array(
			'handle'     => 'merryll-klaro-script',
			'asset_uri'  => $this->get_plugin_url() . 'assets/js/klaro.min.js',
			'dependency' => array(),
			'version'    => '0.7.18',
		);

		$this->enqueues['script'] = apply_filters( 'merryll_frontend_scripts', $scripts, 10, 1 );

		return $this;
	}

	/**
	 * Method to enqueue only styles in the frontend.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function enqueue() {
		$this->register_scripts()->enqueue_scripts()->localize( Localize::register() );
	}

	/**
	 * Method to add 'defer' attribute in the scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param string $tag Tag for the enqueued script.
	 * @param string $handle The script's registered handle.
	 * @return string
	 */
	public function add_defer_attr( $tag, $handle ) {
		if ( ( 'merryll-config' === $handle ) || ( 'merryll-klaro-script' === $handle ) ) {
			return str_replace( ' src', ' defer src', $tag );
		}

		return $tag;
	}
}
