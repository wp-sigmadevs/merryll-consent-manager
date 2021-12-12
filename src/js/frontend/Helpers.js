class MerryllHelpers {
	static ready(fn) {
		document.addEventListener('DOMContentLoaded', fn);
	}

	static resize(fn) {
		window.addEventListener('resize', fn);
	}

	static load(fn) {
		window.addEventListener('load', fn);
	}
}

export default MerryllHelpers;
