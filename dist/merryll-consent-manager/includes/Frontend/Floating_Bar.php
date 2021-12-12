<?php
/**
 * Floating Bar Class.
 * This Class renders a floating button to access the consent modal.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Frontend;

/**
 * Floating Bar Class.
 *
 * @since v1.0.0
 */
class Floating_Bar {

	/**
	 * Registering button.
	 *
	 * @access public
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function register() {
		add_action( 'wp_footer', array( $this, 'render' ), 99 );
	}

	/**
	 * Render the button.
	 *
	 * @access public
	 * @return void
	 *
	 * @since 1.0.0
	 */
	public function render() {
		$enable = esc_html( carbon_get_theme_option( 'merryll_float_text' ) );

		if ( ! $enable ) {
			return;
		}

		echo '<div class="merryll-consent-btn" onclick="return klaro.show();">';
			echo '<div class="floating-bar">';
				echo '<p>' . esc_html( carbon_get_theme_option( 'merryll_float_text' ) ) . '</p>';
			echo '</div>';
		echo '</div>';
	}
}
