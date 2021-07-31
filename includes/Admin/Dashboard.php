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
		?>
			<div class="license-form">
				<div class="cf-field cf-separator">
					<div class="cf-field__body">
						<h3>Provide Your License Key</h3>
					</div>
				</div>
				<div class="form-wrapper">
					<form action="?post_type=merryll_cookies&page=merryll_manager_dashboard" method="post" id="merryllLicenseForm">
						<div class="cf-container">
							<div class="cf-field cf-text two-col flex-wrap justify-content-end no-top-border">
								<div class="cf-field__head">
									<label class="cf-field__label" for="license-input">License Key <span>Please provide valid license key to unlock full plugin functionalities.</span></label>
								</div>
								<div class="cf-field__body">
									<input type="text" id="license-input" name="carbon_fields_compact_input[_merryll_modal_title]" class="cf-text__input" value="">
								</div>
								<button type="submit" class="button button-primary button-large">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php
	}
}
