<?php
/**
 * Main Admin Pages class.
 *
 * This class is responsible for creating the settings pages with all the
 * necessary options for user interaction.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Admin;

use Carbon_Fields\Container;
use Merryll\Merryll_Consent_Manager\Admin\Groups;
use Merryll\Merryll_Consent_Manager\Admin\Cookies;
use Merryll\Merryll_Consent_Manager\Admin\Tabs\Bar;
use Merryll\Merryll_Consent_Manager\Admin\Dashboard;
use Merryll\Merryll_Consent_Manager\Admin\Tabs\Texts;
use Merryll\Merryll_Consent_Manager\Admin\Tabs\General;
use Merryll\Merryll_Consent_Manager\Admin\Tabs\Buttons;
use Merryll\Merryll_Consent_Manager\Admin\Tabs\Privacy;
use Merryll\Merryll_Consent_Manager\Base\Base_Controller;
use Merryll\Merryll_Consent_Manager\Admin\Tabs\Appearance;

/**
 * Admin Pages Class.
 *
 * @since  1.0.0
 */
class Pages extends Base_Controller {

	/**
	 * Admin Page args.
	 *
	 * @access private
	 * @since  1.0.0
	 *
	 * @var array
	 */
	private $args = array();

	/**
	 * Method to register settings page.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->args = array(
			array(
				'title'     => esc_html__( 'Cookie Groups', 'merryll-consent-manager' ),
				'page-slug' => esc_attr( 'merryll-cookie-groups' ),
				'fields'    => Groups::class,
			),

			array(
				'title'     => esc_html__( 'Cookies', 'merryll-consent-manager' ),
				'page-slug' => esc_attr( 'merryll-cookie-list' ),
				'fields'    => Cookies::class,
			),

			array(
				'title'     => esc_html__( 'Cookie Box', 'merryll-consent-manager' ),
				'page-slug' => esc_attr( 'merryll-cookie-box' ),
				'tabs'      => $this->cookie_box_tabs(),
			),

			array(
				'title'     => esc_html__( 'Settings', 'merryll-consent-manager' ),
				'page-slug' => esc_attr( 'merryll-manager-settings' ),
				'tabs'      => $this->settings_tabs(),
			),
		);

		\add_action( 'admin_menu', array( $this, 'add_dashboard_menu' ) );
		\add_action( 'admin_menu', array( $this, 'top_level_menu_label' ), 11 );

		if ( '1' !== \get_option( '_merryll_md5_check' ) ) {
			return;
		}

		\add_action( 'carbon_fields_register_fields', array( $this, 'pages' ) );
	}

	/**
	 * Changing the top level menu label.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function top_level_menu_label() {
		global $menu;
		$menu[40][0] = esc_html__( 'merryll Cookie', 'merryll-consent-manager' );

		echo '';
	}

	/**
	 * Method to add dashboard menu.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function add_dashboard_menu() {
		add_menu_page(
			esc_html__( 'Dashboard', 'merryll-consent-manager' ),
			esc_html__( 'Dashboard', 'merryll-consent-manager' ),
			'manage_options',
			'merryll_cookie',
			array( $this, 'create_dashboard' ),
			'dashicons-merryll-manager',
			40
		);
	}

	/**
	 * Method to render dashboard page.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function create_dashboard() {
		$this->instance( Dashboard::class )->register();
	}

	/**
	 * Method to render settings page tab contents.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return mixed
	 */
	private function settings_tabs() {
		$tabs = array(
			esc_html__( 'General', 'merryll-consent-manager' ) => General::class,
			esc_html__( 'Floating Bar', 'merryll-consent-manager' ) => Bar::class,
			esc_html__( 'Privacy Policy', 'merryll-consent-manager' ) => Privacy::class,
		);

		return \apply_filters( 'merryll_manager_settings_tabs', $tabs );
	}

	/**
	 * Method to render cookie box page tab contents.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return mixed
	 */
	private function cookie_box_tabs() {
		$tabs = array(
			esc_html__( 'Texts', 'merryll-consent-manager' )   => Texts::class,
			esc_html__( 'Appearance', 'merryll-consent-manager' )  => Appearance::class,
			esc_html__( 'Buttons', 'merryll-consent-manager' ) => Buttons::class,
		);

		return \apply_filters( 'merryll_manager_cookie_box_tabs', $tabs );
	}

	/**
	 * Method to render admin pages using Carbon Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function pages() {
		if ( empty( $this->args ) ) {
			return;
		}

		$this->setup_submenu_pages();
	}

	/**
	 * Method to setup submenu pages.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return object
	 */
	private function setup_submenu_pages() {
		foreach ( $this->args as $admin_page ) {
			$page = Container::make( 'theme_options', $admin_page['title'] );
			$page->set_page_parent( 'merryll_cookie' );
			$page->set_page_file( $admin_page['page-slug'] );
			$page->set_classes( 'merryll-admin-page' );

			if ( ! empty( $admin_page['tabs'] ) ) {
				foreach ( $admin_page['tabs']as $tab_name => $tab_content ) {
					$page->add_tab( $tab_name, $tab_content::register() );
				}
			}

			if ( ! empty( $admin_page['fields'] ) ) {
				$page->add_fields( $admin_page['fields']::register() );
			}
		}

		return $this;
	}
}
