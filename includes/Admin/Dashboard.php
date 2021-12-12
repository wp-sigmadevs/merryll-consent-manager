<?php
/**
 * Dashboard Class.
 *
 * This class renders the user options contents in Dashboard Page.
 *
 * @package Merryll_Consent_Manager
 * @since   1.0.0
 */

namespace Merryll\Merryll_Consent_Manager\Admin;

use Carbon_Fields\Field;
use Merryll\Merryll_Consent_Manager\Base\Base_Controller;

/**
 * Dashboard Class.
 *
 * @since  1.0.0
 */
class Dashboard extends Base_Controller {

	/**
	 * Registering the dashboard contents.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @return void
	 */
	public function register() {
		?>
		<div id="merryll-dashboard" class="wrap">
			<?php
			$this->banner();
			$this->license();
			?>
		</div>
		<?php
	}

	/**
	 * Rendering banner.
	 *
	 * @since  1.0.0
	 * @access private
	 *
	 * @return void
	 */
	private function banner() {
		?>
			<div class="header-banner">
				<h1>merryll Consent Manager</h1>
				<div class="logo-container">
					<img src="<?php echo esc_url( $this->get_plugin_url() ); ?>/assets/images/merryll-logo.png" alt="merryll">
				</div>
			</div>
		<?php
	}

	/**
	 * Rendering license form.
	 *
	 * @since  1.0.0
	 * @access private
	 * @static
	 *
	 * @return void
	 */
	private function license() {

		$message      = '';
		$input        = '';
		$class        = '';
		$notice       = '';
		$notice_class = '';

		if ( isset( $_POST['form_submitted'] ) ) {
			if ( isset( $_POST['license_input'] ) ) {
				$md5  = md5( $_POST['license_input'] );
				$json = json_decode( \wp_remote_get( $this->get_plugin_url() . 'md5.json' )['body'], true );

				if ( in_array( $md5, $json['md5'], true ) ) {
					\update_option( '_merryll_md5_check', true );
					$message = esc_html__( 'Valid', 'merryll-consent-manager' );
					$input   = '••••••••••••••••••••';
					$class   = 'key-success';
					?>
					<script type="text/javascript">location.reload();</script>
					<?php
				} else {
					\update_option( '_merryll_md5_check', false );
					$message = esc_html__( 'Invalid', 'merryll-consent-manager' );
					$class   = 'key-failure';
				}
			}
		}

		if ( '1' === \get_option( '_merryll_md5_check' ) ) {
			$message      = esc_html__( 'Valid', 'merryll-consent-manager' );
			$input        = '••••••••••••••••••••';
			$class        = 'key-success';
			$notice       = __( '<b>Status: </b>merryll Cookie is not enabled. Please enable it from <b>merryll Cookie</b> <img src="' . $this->get_plugin_url() . 'assets/images/arrow-right.png" alt="Arrow"> <b>Settings</b> <img src="' . $this->get_plugin_url() . 'assets/images/arrow-right.png" alt="Arrow"> <b>General</b>.', 'merryll-consent-manager' );
			$notice_class = 'warning';

			if ( carbon_get_theme_option( 'merryll_enable_cookie' ) ) {
				$notice       = __( '<b>Status: </b>merryll Cookie is enabled.', 'merryll-consent-manager' );
				$notice_class = 'success';
			}
		}
		?>
			<div class="license-form postbox">
				<div class="cf-field cf-separator">
					<div class="cf-field__body">
						<h3><?php echo esc_html__( 'Provide Your License Key', 'merryll-consent-manager' ); ?></h3>
					</div>
				</div>
				<div class="form-wrapper">
					<form action="?page=merryll_cookie" method="POST" id="merryllLicenseForm" autocomplete="off">
						<div class="cf-container">
							<div class="cf-field cf-text two-col flex-wrap justify-content-end no-top-border">
								<div class="cf-field__head">
									<label class="cf-field__label" for="license-input">
										<?php
										echo sprintf(
											'%1$s<span>%2$s</span>',
											esc_html__( 'License Key', 'merryll-consent-manager' ),
											esc_html__( 'Please provide valid license key to unlock full plugin functionalities.', 'merryll-consent-manager' )
										);
										?>
									</label>
								</div>
								<div class="cf-field__body">
									<input type="text" id="license-input" name="license_input" class="cf-text__input" value="<?php echo isset( $_POST['license_input'] ) ? $_POST['license_input'] : $input; ?>" required>
									<input type="hidden" name="form_submitted" value="1">
									<?php
									if ( ! empty( $message ) ) {
										echo '<div class="message ' . $class . '"><span>' . $message . '</span></div>';
									}
									?>
								</div>
								<button type="submit" class="button button-primary button-large">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php
			if ( ! empty( $notice ) ) {
				?>
				<div class="merryll-notice <?php echo esc_attr( $notice_class ); ?>">
					<p><?php echo $notice; ?></p>
				</div>
				<?php
			}
	}
}
