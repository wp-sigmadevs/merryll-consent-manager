<?php
/**
 * Localization Class for frontend.
 *
 * This class localizes JS variables in the frontend.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Frontend;

use Merryll\Merryll_Consent_Manager\Base\Base_Controller;

/**
 * Localize Class.
 *
 * @since  1.0.0
 */
class Localize extends Base_Controller {

	/**
	 * Method to register frontend scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function register() {
		return array(
			'handle'    => 'merryll-config',
			'js_object' => 'merryllSettings',
			'vars'      => self::data(),
		);
	}

	/**
	 * Method to build up data.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array
	 */
	private static function data() {
		return array(
			'elementID'         => self::validate( 'merryll_cookie_name' ),
			'cookieExpires'     => self::validate( 'merryll_cookie_expire' ),
			'privacyPolicyLink' => self::privacy_url(),
			'purposePlural'     => esc_html__( 'Zwecke', 'merryll-consent-manager' ),
			'services'          => self::get_services(),
			'additionalClass'   => self::custom_classes(),
			'logo'              => esc_url( self::image_url() ),
			'copyright'         => self::validate( 'merryll_top_right_text' ),
			'poweredByLink'     => esc_url( self::validate( 'merryll_poweredby_link' ) ),
			'clientUrl'         => esc_url( self::validate( 'merryll_top_link' ) ),
			'translations'      => array(
				'default' => array(
					'acceptAll'      => self::validate( 'merryll_acc_all_btn_text' ),
					'acceptSelected' => self::validate( 'merryll_acc_sel_btn_text' ),
					'decline'        => self::validate( 'merryll_reject_btn_text' ),
					'consentModal'   => array(
						'title'       => self::validate( 'merryll_modal_title' ),
						'description' => self::validate( 'merryll_modal_desc' ),
					),
					'privacyPolicy'  => array(
						'name' => self::validate( 'merryll_privacy_name' ),
						'text' => self::validate( 'merryll_privacy_text' ),
					),
					'purposeItem'    => array(
						'service'  => esc_html__( 'Dienst', 'merryll-consent-manager' ),
						'services' => esc_html__( 'Dienste', 'merryll-consent-manager' ),
					),
					'purposes'       => self::get_purposes(),
					'poweredBy'      => self::validate( 'merryll_poweredby_text' ),
					'save'           => self::validate( 'merryll_save_btn_text' ),
					'service'        => array(
						'disableAll' => array(
							'title'       => self::validate( 'merryll_modal_deactivation_title' ),
							'description' => self::validate( 'merryll_modal_deactive_desc' ),
						),
						'purpose'    => esc_html__( 'Zweck', 'merryll-consent-manager' ),
					),
				),
			),
		);
	}

	/**
	 * Validate the passed value.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @param string $id Settings ID.
	 * @param string $type Type of field.
	 *
	 * @return string
	 */
	private static function validate( $id, $type = 'string' ) {
		$check = carbon_get_theme_option( $id );

		if ( 'array' === $type ) {
			return ! empty( $check ) ? $check : array();
		}

		return ! empty( $check ) ? esc_html( $check ) : '';
	}

	/**
	 * Getting the privacy policy URL.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return string
	 */
	private static function privacy_url() {
		$url     = '';
		$page_id = self::validate( 'merryll_privacy_selector' );

		if ( empty( $page_id ) || 'no' === $page_id ) {
			return '#';
		}

		if ( 'custom' === $page_id ) {
			$url = self::validate( 'merryll_privacy_selector_custom' );
		} else {
			$url = get_page_link( $page_id );
		}

		return ! empty( $url ) ? esc_url( $url ) : '#';
	}

	/**
	 * Get the cookie groups.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array
	 */
	private static function get_purposes() {
		$groups   = carbon_get_theme_option( 'merryll_cookie_group' );
		$purposes = array();

		if ( empty( $groups ) ) {
			return $purposes;
		}

		foreach ( $groups as $group ) {
			$purposes[ esc_html( $group['merryll_cookie_group_id'] ) ] = array(
				'title'       => esc_html( $group['merryll_cookie_group_title'] ),
				'description' => esc_html( $group['merryll_cookie_group_desc'] ),
			);
		}

		return $purposes;
	}

	/**
	 * Get the cookies.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return array
	 */
	private static function get_services() {
		$cookies  = carbon_get_theme_option( 'merryll_cookie_list' );
		$services = array();

		if ( empty( $cookies ) ) {
			return $services;
		}

		foreach ( $cookies as $cookie ) {
			$cookie_domain = $cookie['merryll_cookie_single_domain'];
			$cookie_arr    = array( '' );

			if ( ! empty( $cookie_domain ) ) {
				$cookie_arr = explode( ', ', $cookie_domain );
			}

			$services[] = array(
				'name'        => esc_html( $cookie['merryll_cookie_single_id'] ),
				'title'       => esc_html( $cookie['merryll_cookie_single_name'] ),
				'default'     => esc_html( $cookie['merryll_cookie_single_pre_sel'] ),
				'required'    => false,
				'description' => esc_html( $cookie['merryll_cookie_single_desc'] ),
				'cookies'     => $cookie_arr,
				'purposes'    => array(
					esc_html( $cookie['merryll_cookie_single_group'] ),
				),
				'onlyOnce'    => true,
				'optOut'      => false,
				'customEvent' => esc_html( $cookie['merryll_cookie_single_custom'] ),
			);
		}

		return $services;
	}

	/**
	 * Custom CSS Classes.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return string
	 */
	private static function custom_classes() {
		$classes = array(
			'merryll-modal',
		);

		$button_type = carbon_get_theme_option( 'merryll_btn_type' );
		$top_url     = carbon_get_theme_option( 'merryll_top_link' );

		$classes[] = ! empty( $button_type ) ? $button_type . '-btn' : 'standard-btn';
		$classes[] = ! empty( $top_url ) ? 'has-client-url' : 'no-client-url';

		return esc_attr( implode( ' ', $classes ) );
	}

	/**
	 * Retrieve Image URL.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return string
	 */
	private static function image_url() {
		$image_id = self::validate( 'merryll_top_logo' );

		if ( empty( $image_id ) ) {
			return '';
		}

		return wp_get_attachment_image_src( $image_id, 'full' )[0];
	}
}
