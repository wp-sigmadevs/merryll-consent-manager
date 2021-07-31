<?php
/**
 * Options Values Class.
 *
 * This class fetches the options values from database.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Frontend;

/**
 * Localize Class.
 *
 * @since  1.0.0
 */
class Options_Values {

	/**
	 * Method to get options values.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return array
	 */
	public static function get() {
		return array(
			'elementID'             => self::validate( 'merryll_cookie_name' ),
			'cookieExpires'         => self::validate( 'merryll_cookie_expire' ),
			'privacyPolicyLink'     => self::privacy_url(),
			'privacyPolicyName'     => self::validate( 'merryll_privacy_name' ),
			'privacyPolicyText'     => self::validate( 'merryll_privacy_text' ),
			'acceptAllText'         => self::validate( 'merryll_acc_all_btn_text' ),
			'acceptSelectedText'    => self::validate( 'merryll_acc_sel_btn_text' ),
			'declineText'           => self::validate( 'merryll_reject_btn_text' ),
			'saveText'              => self::validate( 'merryll_save_btn_text' ),
			'modalTitle'            => self::validate( 'merryll_modal_title' ),
			'modalDescription'      => self::validate( 'merryll_modal_desc' ),
			'disableAllTitle'       => self::validate( 'merryll_modal_deactivation_title' ),
			'disableAllDescription' => self::validate( 'merryll_modal_deactive_desc' ),
			'serviceSingular'       => self::validate( 'merryll_modal_service_singular' ),
			'servicePlural'         => self::validate( 'merryll_modal_service_plural' ),
			'purposeSingular'       => self::validate( 'merryll_modal_purpose_text' ),
			'purposePlural'         => self::validate( 'merryll_modal_purpose_plural' ),
			'purposes'              => self::get_purposes(),
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

		return ! empty( $check ) ? $check : '';
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
}
