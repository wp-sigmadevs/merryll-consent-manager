import MerryllConfig from './frontend/MerryllConfig';
import MerryllHelpers from './frontend/Helpers';

let merryllConsent = {};

merryllConsent = {
	run: () => {
		new MerryllConfig();
	}
};

// MerryllHelpers.ready(merryllConsent.run());

// jQuery(document).ready(function($) {
// 	$(document).on('carbonFields.apiLoaded', function(e, api) {
// 		// Get the current value in the 'crb_text' field
// 		var value = api.getFieldValue('merryll_cookie_name');
// 		console.log('value:', value);
// 	});
// });
