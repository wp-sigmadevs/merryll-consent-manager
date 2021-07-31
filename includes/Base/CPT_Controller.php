<?php
/**
 * Custom Post Types initiator.
 *
 * This class registers custom post types required for Merryll Consent Manager.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Base;

use Merryll\Merryll_Consent_Manager\Lib\Custom_Post_Type;

/**
 * Custom Post Type Controller Class.
 *
 * @since  1.0.0
 */
class CPT_Controller {

	/**
	 * Accumulates Custom Post Types.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @var array
	 */
	public $custom_post_types = array();

	/**
	 * Method to register CPT.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		$this->define_cpt();

		if ( ! empty( $this->custom_post_types ) ) {
			$this->register_custom_post_types();
			add_action( 'admin_menu', array( $this, 'remove_add_new' ) );
			add_filter( 'manage_merryll_cookies_posts_custom_column', array( $this, 'admin_column' ) );
			add_filter( 'manage_merryll_cookies_posts_columns', array( $this, 'manage_columns' ) );
			add_filter( 'manage_merryll_cookies_posts_custom_column', array( $this, 'insert_data' ), 10, 2 );
		}
	}

	/**
	 * Method to define CPT.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return array
	 */
	private function define_cpt() {
		$this->custom_post_types = array(
			array(
				'name'   => __( 'merryll Cookie', 'merryll-consent-manager' ),
				'slug'   => 'merryll_cookies',
				'labels' => array(
					'name'         => __( 'Cookie List', 'merryll-consent-manager' ),
					'all_items'    => __( 'Cookie List', 'merryll-consent-manager' ),
					'edit_item'    => __( 'Edit Cookie', 'merryll-consent-manager' ),
					'view_item'    => __( 'View Cookie', 'merryll-consent-manager' ),
					'search_items' => __( 'Search Cookie', 'merryll-consent-manager' ),
					'not_found'    => __( 'No Cookies found', 'merryll-consent-manager' ),
				),
				'args'   => array(
					'menu_icon'          => 'dashicons-merryll-manager',
					'publicly_queryable' => false,
					'has_archive'        => false,
					'supports'           => array(
						'title',
					),
				),
			),
		);

		return $this->custom_post_types;
	}

	/**
	 * Method to loop through all the CPT definition and build up CPT.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register_custom_post_types() {
		foreach ( $this->custom_post_types as $post_type ) {
			new Custom_Post_Type(
				$post_type['name'],
				$post_type['slug'],
				! empty( $post_type['labels'] ) ? $post_type['labels'] : array(),
				! empty( $post_type['args'] ) ? $post_type['args'] : array()
			);
		}
	}

	/**
	 * Method to remove add new menu item.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function remove_add_new() {
		$page = remove_submenu_page( 'edit.php?post_type=merryll_cookies', 'post-new.php?post_type=merryll_cookies' );
	}

	/**
	 * Enabling the custom admin columns.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return array
	 */
	public function admin_column( $columns ) {
		isset( $columns['cookie_id'] ) ? __( 'Cookie ID', 'merryll-consent-manager' ) : '';
		isset( $columns['cookie_group'] ) ? __( 'Cookie Group', 'merryll-consent-manager' ) : '';
		isset( $columns['cookie_priority'] ) ? __( 'Priority', 'merryll-consent-manager' ) : '';

		return $columns;
	}

	/**
	 * Removing & re-ordering admin columns.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param array $columns Columns array.
	 *
	 * @return array
	 */
	public function manage_columns( $columns ) {
		$columns = array(
			'cb'              => $columns['cb'],
			'title'           => __( 'Title', 'merryll-consent-manager' ),
			'cookie_id'       => __( 'Cookie ID', 'merryll-consent-manager' ),
			'cookie_group'    => __( 'Cookie Group', 'merryll-consent-manager' ),
			'cookie_priority' => __( 'Priority', 'merryll-consent-manager' ),
			'date'            => __( 'Date', 'merryll-consent-manager' ),
		);

		return $columns;
	}

	/**
	 * Inserting data in the custom columns.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @param string $column Column name.
	 * @param int    $post_id Post ID.
	 *
	 * @return void
	 */
	public function insert_data( $column, $post_id ) {

		// Cookie ID.
		if ( 'cookie_id' === $column ) {
			echo esc_html( str_replace( ' ', '-', strtolower( get_the_title( $post_id ) ) ) );
		}

		// Cookie Group.
		if ( 'cookie_group' === $column ) {
			$group = carbon_get_post_meta( get_the_ID(), 'merryll_cookie_single_group' );

			if ( ! $group ) {
				echo esc_html__( 'N/A', 'merryll-consent-manager' );
			} else {
				echo esc_html( $group );
			}
		}

		// Cookie Priority.
		if ( 'cookie_priority' === $column ) {
			$priority = carbon_get_post_meta( $post_id, 'merryll_cookie_single_position' );

			if ( ! $priority ) {
				echo esc_html__( 'N/A', 'merryll-consent-manager' );
			} else {
				echo esc_html( $priority );
			}
		}
	}
}
