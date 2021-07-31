class MerryllHelpers {
	static ready(fn) {
		if (document.readyState !== 'loading') {
			fn();
		} else if (document.addEventListener) {
			document.addEventListener('DOMContentLoaded', fn);
		} else {
			document.attachEvent('onreadystatechange', function() {
				if (document.readyState !== 'loading') {
					fn();
				}
			});
		}
	}

	static toArray(nodelist) {
		return !nodelist.length || typeof nodelist !== 'object' ? nodelist : [].slice.call(nodelist);
	}

	static isEmptyObj(obj) {
		return Object.keys(obj).length === 0 && obj.constructor === Object;
	}
}

export default MerryllHelpers;
