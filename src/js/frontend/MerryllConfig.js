class MerryllConfig {
	constructor() {
		this.config();
	}

	config() {
		const klaroConfig = {
			version: 1,
			elementID: merryllSettings.elementID,
			noAutoLoad: false,
			htmlTexts: true,
			embedded: false,
			groupByPurpose: true,
			storageMethod: 'cookie',
			cookieName: merryllSettings.elementID,
			cookieExpiresAfterDays: merryllSettings.cookieExpires,
			default: true,
			mustConsent: false,
			acceptAll: true,
			hideDeclineAll: false,
			noticeAsModal: false,
			additionalClass: 'merryll-modal',
			services: rhKlaroSettings.services,
			lang: "default",
			privacyPolicy: merryllSettings.privacyPolicyLink,
			translations: rhKlaroSettings.translations,
		};
	}
}

export default MerryllConfig;
