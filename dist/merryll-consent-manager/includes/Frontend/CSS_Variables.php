<?php
/**
 * CSS Variables Class.
 * This Class assigns CSS custom properties.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Frontend;

/**
 * CSS Variables Class.
 *
 * @since v1.0.0
 */
class CSS_Variables {

	/**
	 * Variables to include.
	 *
	 * @access private
	 * @var array
	 * @since 1.0.0
	 */
	private $variables = array();

	/**
	 * Registering settings.
	 *
	 * @access public
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function register() {
		$this->fonts()->colors()->buttons()->floating_bar();

		if ( empty( $this->variables ) ) {
			return;
		}

		add_action( 'wp_enqueue_scripts', array( $this, 'print' ), 99 );
	}

	/**
	 * Add inline style for variables.
	 *
	 * @access public
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function print() {
		$plugin_vars  = '';
		$plugin_vars .= '
			:root{
				--merryll-public-heading-font-size:' . $this->variables['fonts']['heading-size'] . ';
				--merryll-public-font-size:' . $this->variables['fonts']['size'] . ';
				--merryll-public-modal-bg:' . $this->variables['colors']['bg'] . ';
				--merryll-public-modal-text:' . $this->variables['colors']['text'] . ';
				--merryll-public-modal-link:' . $this->variables['colors']['link'] . ';
				--merryll-public-modal-link-hover:' . $this->variables['colors']['hover'] . ';
				--merryll-public-modal-switch-on:' . $this->variables['colors']['switch'] . ';
				--merryll-public-modal-divider:' . $this->variables['colors']['divider'] . ';
				--merryll-public-acc-all-btn-bg:' . $this->variables['buttons']['acc-all-bg'] . ';
				--merryll-public-acc-all-btn-bg-hover:' . $this->variables['buttons']['acc-all-hover'] . ';
				--merryll-public-acc-sel-btn-bg:' . $this->variables['buttons']['acc-sel'] . ';
				--merryll-public-acc-sel-btn-bg-hover:' . $this->variables['buttons']['acc-sel-hover'] . ';
				--merryll-public-rej-btn-bg:' . $this->variables['buttons']['rej-all'] . ';
				--merryll-public-rej-btn-bg-hover:' . $this->variables['buttons']['rej-all-hover'] . ';
				--merryll-public-consent-btn-bg:' . $this->variables['bar']['bg'] . ';
				--merryll-public-consent-btn-hover-bg:' . $this->variables['bar']['hover-bg'] . ';
				--merryll-public-consent-btn-text:' . $this->variables['bar']['text'] . ';
				--merryll-public-consent-btn-hover-text:' . $this->variables['bar']['hover-text'] . ';
		}';

		wp_add_inline_style( 'merryll-consent-stylesheet', str_replace( array( "\r", "\n", "\t" ), '', $plugin_vars ) );
	}


	/**
	 * Colors.
	 *
	 * @access private
	 * @return object
	 *
	 * @since 1.0.0
	 */
	private function colors() {
		$this->variables['colors']['bg']      = self::validate( '_merryll_bg_color' );
		$this->variables['colors']['text']    = self::validate( '_merryll_text_color' );
		$this->variables['colors']['link']    = self::validate( '_merryll_link_color' );
		$this->variables['colors']['hover']   = self::validate( '_merryll_link_hover_color' );
		$this->variables['colors']['switch']  = self::validate( '_merryll_switch_on_color' );
		$this->variables['colors']['divider'] = self::validate( '_merryll_divider_color' );

		return $this;
	}

	/**
	 * Fonts.
	 *
	 * @access private
	 * @return object
	 *
	 * @since 1.0.0
	 */
	private function fonts() {
		$this->variables['fonts']['heading-size'] = self::validate( '_merryll_heading_font_size' );
		$this->variables['fonts']['size']         = self::validate( '_merryll_font_size' );

		return $this;
	}

	/**
	 * Buttons.
	 *
	 * @access private
	 * @return object
	 *
	 * @since 1.0.0
	 */
	private function buttons() {
		$this->variables['buttons']['acc-all-bg']    = self::validate( '_merryll_acc_all_btn_color' );
		$this->variables['buttons']['acc-all-hover'] = self::validate( '_merryll_acc_all_btn_hover_color' );
		$this->variables['buttons']['acc-sel']       = self::validate( '_merryll_acc_sel_btn_color' );
		$this->variables['buttons']['acc-sel-hover'] = self::validate( '_merryll_acc_sel_btn_hover_color' );
		$this->variables['buttons']['rej-all']       = self::validate( '_merryll_reject_btn_color' );
		$this->variables['buttons']['rej-all-hover'] = self::validate( '_merryll_reject_btn_hover_color' );

		return $this;
	}


	/**
	 * Floating Bar.
	 *
	 * @access private
	 * @return object
	 *
	 * @since 1.0.0
	 */
	private function floating_bar() {
		$this->variables['bar']['bg']         = self::validate( '_merryll_float_bg_color' );
		$this->variables['bar']['hover-bg']   = self::validate( '_merryll_float_bg_hover_color' );
		$this->variables['bar']['text']       = self::validate( '_merryll_float_text_color' );
		$this->variables['bar']['hover-text'] = self::validate( '_merryll_float_text_hover_color' );

		return $this;
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
		$check = get_option( $id );

		if ( 'array' === $type ) {
			return ! empty( $check ) ? $check : array();
		}

		return ! empty( $check ) ? esc_html( $check ) : '';
	}
}
