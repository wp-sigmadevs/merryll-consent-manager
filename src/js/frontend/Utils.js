class MerryllUtils {
	static ModalActions() {
		const merryllKlaro = document.querySelector('.merryll-modal');
		const merryllModal = merryllKlaro.getElementsByClassName('cookie-modal');
		const merryllButton = document.querySelector('.merryll-consent-btn');

		if (merryllModal.length > 0) {
			document.body.classList.add('merryll-modal-active');
		}

		if (merryllButton) {
			merryllButton.addEventListener('click', () => {
				document.body.classList.add('merryll-modal-active');
			});
		}

		document.addEventListener('click', function(e) {
			if (e.target && e.target.classList.contains('cm-btn-accept')) {
				document.body.classList.remove('merryll-modal-active');

				setTimeout(() => {
					merryllKlaro.style.height = 'auto';
				}, 700);
			}
		});

		merryllKlaro.removeAttribute('lang');

		const modal = new MutationObserver((mutationsList, observer) => {
			if (!merryllKlaro) {
				return;
			}

			if (mutationsList[0].nextSibling || mutationsList[0].nextSibling === null) {
				document.body.classList.remove('merryll-modal-active');
			}

			modal.disconnect();
		});

		modal.observe(merryllKlaro, { childList: true, subtree: true });
	}

	static assignHeight() {
		const merryllKlaro = document.querySelector('.merryll-modal');

		const modal = new MutationObserver((mutationsList, observer) => {
			if (!merryllKlaro) {
				return;
			}

			mutationsList.forEach((mutation) => {
				if (mutation.addedNodes[0] && mutation.addedNodes[0].classList.value === 'cookie-modal') {
					merryllKlaro.style.height = mutation.addedNodes[0].offsetHeight + 40 + 'px';
				}
			});
		});

		modal.observe(merryllKlaro, { childList: true, subtree: true });
	}

	static bodyClass() {
		document.body.classList.add('merryll-modal-loaded');
	}
}

export default MerryllUtils;
