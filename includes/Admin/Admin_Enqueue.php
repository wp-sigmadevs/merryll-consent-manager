<?php
/**
 * Scripts Enqueue Class for Admin pages.
 *
 * This class enqueues required styles & scripts in the admin pages.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Admin;

use Merryll\Merryll_Consent_Manager\Base\Enqueue;

/**
 * Admin Enqueue Class.
 *
 * @since  1.0.0
 */
class Admin_Enqueue extends Enqueue {

	/**
	 * Method to register admin scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->scripts_list();

		if ( empty( $this->scripts_list() ) ) {
			return;
		}

		\add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
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
			'handle'    => 'merryll-admin-styles',
			'asset_uri' => $this->get_plugin_url() . '/assets/css/admin' . $this->suffix . '.css',
			'version'   => $this->get_plugin_version(),
		);

		$this->enqueues['style'] = apply_filters( 'merryll_admin_styles', $styles, 10, 1 );

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
			'handle'    => 'merryll-admin-scripts',
			'asset_uri' => $this->get_plugin_url() . '/assets/js/admin' . $this->suffix . '.js',
			'version'   => $this->get_plugin_version(),
		);

		$this->enqueues['script'] = apply_filters( 'merryll_admin_scripts', $scripts, 10, 1 );

		return $this;
	}

	/**
	 * Method to enqueue scripts only on Merryll Consent Manager pages.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @param  mixed $hook list of admin pages.
	 * @return void
	 */
	public function enqueue( $hook ) {
		$screen         = \get_current_screen();
		$post_type_name = 'merryll_cookies';
		if ( $post_type_name === $screen->post_type ) {
			$this->register_scripts()->enqueue_scripts();
		}
	}
}
