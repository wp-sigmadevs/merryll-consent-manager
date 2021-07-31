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
use Merryll\Merryll_Consent_Manager\Frontend\localize;

/**
 * Public Enqueue Class.
 *
 * @since  1.0.0
 */
class Public_Enqueue extends Enqueue {

	public $values;

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

		\add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 999 );
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

		// // Google Fonts.
		// $styles[] = array(
		// 'handle'    => 'innova-google-fonts',
		// 'asset_uri' => esc_url( apply_filters( 'innova_default_google_fonts', 'https://fonts.googleapis.com/css2?family=Poppins&family=Source+Sans+Pro:wght@600&display=swap' ) ),
		// 'version'   => null,
		// );

		// // FontAwesome 5 CSS.
		// $styles[] = array(
		// 'handle'    => 'fontawesome',
		// 'asset_uri' => $this->base->get_css_uri() . 'fontawesome.min.css',
		// 'version'   => '5.15.2',
		// );

		// // Bootstrap CSS.
		// $styles[] = array(
		// 'handle'    => 'bootstrap',
		// 'asset_uri' => $this->base->get_css_uri() . 'bootstrap.min.css',
		// 'version'   => '4.6.0',
		// );

		// // Swiper CSS.
		// $styles[] = array(
		// 'handle'    => 'swiper',
		// 'asset_uri' => $this->base->get_css_uri() . 'swiper.min.css',
		// 'version'   => '6.4.11',
		// );

		// // Main Stylesheet.
		// $styles[] = array(
		// 'handle'    => 'innova-stylesheet',
		// 'asset_uri' => get_stylesheet_uri(),
		// 'version'   => $this->base->get_theme_version(),
		// );

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
			'asset_uri'  => $this->get_plugin_url() . '/assets/js/config.js',
			'dependency' => array( 'jquery' ),
			'version'    => $this->get_plugin_version(),
		);

		// Klaro JS.
		$scripts[] = array(
			'handle'     => 'merryll-klaro-script',
			'asset_uri'  => $this->get_plugin_url() . '/assets/js/klaro.js',
			'dependency' => array( 'jquery' ),
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
		$this->register_scripts()->enqueue_scripts()->localize( Localize::register($this->values) );
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
	}
}
