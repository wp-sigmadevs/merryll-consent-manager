import MerryllConfig from './frontend/MerryllConfig';
import MerryllUtils from './frontend/Utils';
import MerryllHelpers from './frontend/Helpers';

let merryllConsent = {};

merryllConsent = {
	init: () => {
		return new MerryllConfig();
	},
	readyEvent: () => {
		MerryllHelpers.ready(MerryllUtils.ModalActions);
		MerryllHelpers.ready(MerryllUtils.assignHeight);
	},
	resizeEvent: () => {
		MerryllHelpers.resize(MerryllUtils.assignHeight);
	},
	loadEvent: () => {
		MerryllHelpers.load(MerryllUtils.bodyClass);
	}
};

window.klaroConfig = merryllConsent.init();
merryllConsent.readyEvent();
merryllConsent.resizeEvent();
merryllConsent.loadEvent();
