class MerryllConfig {
	constructor() {
		return this.config();
	}

	config() {
		return {
			version: 1,
			acceptAll: true,
			noAutoLoad: false,
			htmlTexts: true,
			embedded: false,
			groupByPurpose: true,
			disablePoweredBy: true,
			storageMethod: 'cookie',
			cookieName: merryllSettings.elementID,
			cookieExpiresAfterDays: merryllSettings.cookieExpires,
			default: true,
			hideDeclineAll: false,
			noticeAsModal: false,
			additionalClass: merryllSettings.additionalClass,
			services: this.serviceList(),
			elementID: merryllSettings.elementID,
			lang: 'default',
			mustConsent: true,
			privacyPolicy: merryllSettings.privacyPolicyLink,
			translations: merryllSettings.translations
		};
	}

	serviceList() {
		let services = [];
		merryllSettings.services.forEach((service) => {
			services.push({
				name: service.name,
				title: service.title,
				default: service.default,
				required: service.required,
				description: service.description,
				cookies: service.cookies,
				purposes: service.purposes,
				onlyOnce: service.onlyOnce,
				optOut: service.optOut,
				callback: (state, app) => {
					if (service.customEvent) {
						if (state !== false) {
							dataLayer.push({ event: service.customEvent });
						}
					}
				}
			});
		});

		return services;
	}
}

export default MerryllConfig;
