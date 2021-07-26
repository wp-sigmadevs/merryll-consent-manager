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
// use AuroraSlider\Admin\Aside;
use Merryll\Merryll_Consent_Manager\Admin\Tabs\Colors;
use Merryll\Merryll_Consent_Manager\Admin\Tabs\Settings;

/**
 * Admin Pages Class.
 *
 * @since  1.0.0
 */
class Admin_Pages {

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
				'title'       => esc_html__( 'Cookie Groups', 'merryll-consent-manager' ),
				'parent-page' => esc_url( 'edit.php?post_type=merryll_cookies' ),
				'page-slug'   => esc_attr( 'merryll-cookie-groups' ),
			),

			array(
				'title'       => esc_html__( 'Settings', 'merryll-consent-manager' ),
				'parent-page' => esc_url( 'edit.php?post_type=merryll_cookies' ),
				'page-slug'   => esc_attr( 'merryll-manager-settings' ),
			),
		);

		\add_action( 'admin_menu', array( $this, 'add_dashboard_menu' ) );
		\add_action( 'carbon_fields_register_fields', array( $this, 'page_list' ) );
		// \add_action( 'carbon_fields_container_slider_settings_after_sidebar', array( $this, 'aside' ) );
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
		add_submenu_page(
			'edit.php?post_type=merryll_cookies',
			esc_html__( 'Dashboard', 'merryll_consent_manager' ),
			esc_html__( 'Dashboard', 'merryll_consent_manager' ),
			'manage_options',
			'merryll_manager_dashboard',
			array( $this, 'create_dashboard' ),
			0
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
		?>
		<div id="merryll-dashboard" class="wrap">
			<h1>Welcome to merryll Consent Manager</h1>
		</div>
		<?php
	}

	/**
	 * Method to render settings page tab contents.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return mixed
	 */
	private function tabs() {
		$tabs = array(
			esc_html__( 'Settings', 'merryll-consent-manager' ) => Settings::class,
			esc_html__( 'Colors', 'merryll-consent-manager' )   => Colors::class,
		);

		return \apply_filters( 'merryll_manager_settings_tabs', $tabs );
	}

	/**
	 * Method to render admin pages using Carbon Fields.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function page_list() {
		if ( empty( $this->args ) ) {
			return;
		}

		$this->pages();
	}

	/**
	 * Method to render admin page list.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return object
	 */
	private function pages() {
		foreach ( $this->args as $admin_page ) {
			$page = Container::make( 'theme_options', $admin_page['title'] );
			$page->set_page_parent( $admin_page['parent-page'] )
				->set_page_file( $admin_page['page-slug'] )
				->set_classes( $admin_page['page-slug'] . '-page' );

			if ( 'merryll-manager-settings' === $admin_page['page-slug'] ) {
				foreach ( $this->tabs() as $tab_name => $tab_content ) {
					$page->add_tab( $tab_name, $tab_content::register() );
				}
			}
		}

		return $this;
	}

	/**
	 * Method to render settings page sidebar contents.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function aside() {
		$content = '';

		ob_start();
		Aside::register();
		$content .= ob_get_clean();

		echo \wp_kses_post( $content );
	}
}
