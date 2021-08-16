<?php
/**
 * Base Controller.
 *
 * This class defines all the necessary paths, URLs' and other
 * required information that acts as an constant.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Base;

/**
 * Plugin Base Controller Class.
 *
 * @since  1.0.0
 */
class Base_Controller {

	/**
	 * Plugin Path.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $plugin_path;

	/**
	 * Plugin URL.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $plugin_url;

	/**
	 * Plugin Version.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $plugin_version;

	/**
	 * Plugin File.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $plugin;

	/**
	 * Plugin Text Domain.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @var string
	 */
	private $plugin_textdomain;

	/**
	 * Class constructor.
	 *
	 * @since  1.0.0
	 * @access protected
	 *
	 * @return void
	 */
	public function __construct() {
		$this->plugin            = \plugin_basename( dirname( __FILE__, 3 ) ) . '/merryll-consent-manager.php';
		$this->plugin_path       = \plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url        = \plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin_version    = '1.0.0';
		$this->plugin_textdomain = 'merryll-consent-manager';
	}

	/**
	 * Plugin File.
	 *
	 * @access protected
	 * @return string
	 *
	 * @since 1.0.0
	 */
	protected function get_plugin() {
		return $this->plugin;
	}

	/**
	 * Plugin Path.
	 *
	 * @access protected
	 * @return string
	 *
	 * @since 1.0.0
	 */
	protected function get_plugin_path() {
		return $this->plugin_path;
	}

	/**
	 * Plugin URL.
	 *
	 * @access protected
	 * @return string
	 *
	 * @since 1.0.0
	 */
	protected function get_plugin_url() {
		return $this->plugin_url;
	}

	/**
	 * Plugin Version.
	 *
	 * @access protected
	 * @return string
	 *
	 * @since 1.0.0
	 */
	protected function get_plugin_version() {
		return $this->plugin_version;
	}

	/**
	 * Plugin Version.
	 *
	 * @access protected
	 * @return string
	 *
	 * @since 1.0.0
	 */
	protected function get_plugin_textdomain() {
		return $this->plugin_textdomain;
	}

	/**
	 * Method to initialize a class.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @static
	 *
	 * @param  class $class class to instantiate.
	 * @return class new instance of the class
	 */
	protected static function instance( $class ) {
		$service = new $class();

		return $service;
	}
}
