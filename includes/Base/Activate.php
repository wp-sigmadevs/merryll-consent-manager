<?php
/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Base;

/**
 * Plugin Activation Class.
 *
 * @since  1.0.0
 */
class Activate {

	/**
	 * Method to run on plugin activation.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function activate() {
		\flush_rewrite_rules();

		if ( ! \get_option( '_merryll_md5_check' ) ) {
			\update_option( '_merryll_md5_check', false );
		}

		if ( ! \get_option( '_merryll_initial_settings_flag' ) ) {
			\update_option( '_merryll_initial_settings_flag', true );
		}

		if ( '1' !== \get_option( '_merryll_initial_settings_flag' ) ) {
			self::save_settings();
		}
	}

	/**
	 * Method to save settings on plugin activation.
	 *
	 * @since  1.0.0
	 * @access public
	 * @static
	 *
	 * @return void
	 */
	public static function save_settings() {
		$settings = array();

		$settings = array(
			'_merryll_cookie_group|merryll_cookie_group_title|0|0|value' => 'Werbung',
			'_merryll_cookie_group|merryll_cookie_group_id|0|0|value'    => 'ads',
			'_merryll_cookie_group|merryll_cookie_group_desc|0|0|value'  => 'Wir benutzen Dienste von Drittanbietern, die Daten sammeln, um personalisierte Werbung anzuzeigen, die Ihren Bedürfnissen am besten entsprechen.',
			'_merryll_cookie_group|merryll_cookie_group_title|1|0|value' => 'Analyse',
			'_merryll_cookie_group|merryll_cookie_group_id|1|0|value'    => 'analytics',
			'_merryll_cookie_group|merryll_cookie_group_desc|1|0|value'  => 'Wir benutzen Dienste Dritter, die personenbezogene Daten sammeln, um uns bei der Verbesserung unserer Dienste zu unterstützen.',

			'_merryll_cookie_list|merryll_cookie_single_name|0|0|value' => 'merryll Kampagnen Tracking',
			'_merryll_cookie_list|merryll_cookie_single_id|0|0|value' => 'merryll-kampagnen-tracking',
			'_merryll_cookie_list|merryll_cookie_single_desc|0|0|value' => 'merryll Cookie für Online Marketing und Analyse der Wirksamkeit auf der Website. Erzeugung von statistischen Daten wie der Besucher die Internetseite nutzen.',
			'_merryll_cookie_list|merryll_cookie_single_domain|0|0|value' => 'campaignId',
			'_merryll_cookie_list|merryll_cookie_single_group|0|0|value' => 'analytics',
			'_merryll_cookie_list|merryll_cookie_single_pre_sel|0|0|value' => 'yes',

			'_merryll_cookie_list|merryll_cookie_single_name|1|0|value' => 'Google Analytics',
			'_merryll_cookie_list|merryll_cookie_single_id|1|0|value' => 'google-analytics',
			'_merryll_cookie_list|merryll_cookie_single_desc|1|0|value' => 'Analyse und Erhebung von Daten der Besucher.',
			'_merryll_cookie_list|merryll_cookie_single_domain|1|0|value' => '_ga, _gid, _gat, __gads, /^_gac_, .*$/i, /^_gat_, .*$/i',
			'_merryll_cookie_list|merryll_cookie_single_group|1|0|value' => 'analytics',
			'_merryll_cookie_list|merryll_cookie_single_pre_sel|1|0|value' => 'yes',

			'_merryll_cookie_list|merryll_cookie_single_name|2|0|value' => 'Google Ads Conversion',
			'_merryll_cookie_list|merryll_cookie_single_id|2|0|value' => 'google-ads-conversion',
			'_merryll_cookie_list|merryll_cookie_single_desc|2|0|value' => 'Analyse und Erhebung von Daten über Besucherinteraktionen.',
			'_merryll_cookie_list|merryll_cookie_single_domain|2|0|value' => '_gac, _gac_*, _gcl, _gcl_au, _gcl_*',
			'_merryll_cookie_list|merryll_cookie_single_group|2|0|value' => 'analytics',
			'_merryll_cookie_list|merryll_cookie_single_pre_sel|2|0|value' => 'yes',

			'_merryll_cookie_list|merryll_cookie_single_name|3|0|value' => 'Google Remarketing Pixel',
			'_merryll_cookie_list|merryll_cookie_single_id|3|0|value' => 'google-remarketing-pixel',
			'_merryll_cookie_list|merryll_cookie_single_desc|3|0|value' => 'Personalisierte Werbung Domainübergreifend.',
			'_merryll_cookie_list|merryll_cookie_single_domain|3|0|value' => '',
			'_merryll_cookie_list|merryll_cookie_single_group|3|0|value' => 'ads',
			'_merryll_cookie_list|merryll_cookie_single_pre_sel|3|0|value' => 'yes',

			'_merryll_cookie_list|merryll_cookie_single_name|4|0|value' => 'Facebook Remarketing Pixel',
			'_merryll_cookie_list|merryll_cookie_single_id|4|0|value' => 'facebook-remarketing-pixel',
			'_merryll_cookie_list|merryll_cookie_single_desc|4|0|value' => 'Personalisierte Werbung Domainübergreifend.',
			'_merryll_cookie_list|merryll_cookie_single_domain|4|0|value' => '',
			'_merryll_cookie_list|merryll_cookie_single_group|4|0|value' => 'ads',
			'_merryll_cookie_list|merryll_cookie_single_pre_sel|4|0|value' => 'yes',
		);

		foreach ( $settings as $key => $value ) {
			if ( ! \get_option( $key ) ) {
				\update_option( $key, $value );
			}
		}
	}
}
