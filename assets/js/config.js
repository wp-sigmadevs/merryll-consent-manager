var rhKlaroSettings = {
    acceptAll: "1",
    mustConsent: "1",
    privacyPolicy: "https://stroeer-online-marketing.de/datenschutzerklaerung/",
    services: [
        { name: "stroeer-kampagnen-tracking", title: "Str\u00f6er Kampagnen Tracking", cookies: ["campaignId"], default: true, onlyOnce: true, optOut: false, purposes: ["analytics"], required: false },
        { name: "google-ads-conversion", title: "Google Ads Conversion", cookies: ["_gac", "_gac_*", "_gcl", "_gcl_au", "_gcl_*"], default: false, onlyOnce: true, optOut: false, purposes: ["analytics"], required: false },
        { name: "google-remarketing-pixel", title: "Google Remarketing Pixel", cookies: [""], default: false, onlyOnce: true, optOut: false, purposes: ["ads"], required: false },
        { name: "facebook-remarketing-pixel", title: "Facebook Remarketing Pixel", cookies: [""], default: false, onlyOnce: true, optOut: false, purposes: ["ads"], required: false },
        { name: "google-analytics", title: "Google Analytics", cookies: ["_ga", "_gid", "_gat", "__gads", "/^_gac_", ".*$/i", "/^_gat_", ".*$/i"], default: false, onlyOnce: true, optOut: false, purposes: ["analytics"], required: false },
    ],
    translations: {
        default: {
            acceptAll: "Alle akzeptieren",
            acceptSelected: "Ausgew\u00e4hlte akzeptieren",
            app: {
                disableAll: { description: "Benutzen Sie diesen Schalter, um alle Anwendungen zu aktivieren/deaktivieren.", title: "Alle Anwendungen" },
                optOut: { description: "Diese Anwendung wird standardm\u00e4\u00dfig geladen (aber Sie k\u00f6nnen sich davon abmelden).", title: "(Opt-out)" },
                purpose: "Zweck",
                required: { description: "Diese Anwendung ist immer erforderlich.", title: "(erforderlich)" },
            },
            consentModal: {
                description:
                    "Wir verwenden f\u00fcr den Betrieb notwendige Cookies. Mit Ihrer Einwilligung kommen zus\u00e4tzliche Tracking-Technologien (Cookies, Tags, Pixel etc.) zum Einsatz, die Daten zur Optimierung, Personalisierung, Lokalisierung und Analyse unseres Angebots sowie f\u00fcr Werbung erheben und an den jeweiligen Anbieter weitergegeben und dort zusammengef\u00fchrt werden k\u00f6nnen.",
                title: "Diese Internetseite verwendet Cookies und Tracking",
            },
            decline: "Ablehnen",
            poweredBy: "Angetrieben von Klaro",
            privacyPolicy: { name: "Datenschutzerkl\u00e4rung", text: "Informationen dazu finden Sie in unserer {privacyPolicy}." },
            purposeItem: { service: "Dienst", services: "Dienste" },
            purposes: {
                ads: { description: "Wir benutzen Dienste von Drittanbietern, die Daten sammeln, um personalisierte Werbung anzuzeigen, die Ihren Bed\u00fcrfnissen am besten entsprechen.", title: "Werbung" },
                analytics: { description: "Wir benutzen Dienste Dritter, die personenbezogene Daten sammeln, um uns bei der Verbesserung unserer Dienste zu unterst\u00fctzen.", title: "Analyse" },
                chat: { description: "Wir benutzen Dienste von Drittanbietern, um Ihnen ein Chat-System anbieten zu k\u00f6nnen.", title: "Chat" },
                none: { title: "Nicht verf\u00fcgbar" },
                security: { description: "Wir benutzen Dienste von Drittanbietern, die unsere Website sch\u00fctzen.", title: "Sicherheit" },
                styling: { description: "Wir benutzen Dienste von Drittanbietern, um verschiedene Gestaltungselemente auf unserer Website hinzuzuf\u00fcgen.", title: "Gestaltung" },
                title: "Zwecke",
            },
            save: "Speichern",
            service: {
                disableAll: {
                    description:
                        "Durch das Deaktivieren aller Dienste werden wir keine personenbezogenen Daten sammeln, benutzen oder \u00fcbertragen, bis Sie uns Ihre explizite Einwilligung erteilen. Allerdings verhindert das, dass wir Ihnen die bestm\u00f6gliche Erfahrung auf unserer Website geben k\u00f6nnen.",
                    title: "Alle deaktivieren",
                },
                purpose: "Zweck",
            },
            "stroeer-kampagnen-tracking": { description: "Cookie von Str\u00f6er Online Marketing zur Website-Analyse und Werbewirksamkeitsermittlung. Erzeugt statistische Daten dar\u00fcber, wie der Besucher die Website nutzt." },
            "google-ads-conversion": { description: "Erhebung von Besucherinteraktionen" },
            "google-remarketing-pixel": { description: "Domain\u00fcbergreifende personalisierte Werbung" },
            "facebook-remarketing-pixel": { description: "Domain\u00fcbergreifende personalisierte Werbung" },
            "google-analytics": { description: "Erhebung von Besucherstatistiken" },
        },
    },
};

var klaroConfig = {
    acceptAll: rhKlaroSettings.acceptAll,
    services: rhKlaroSettings.services,
    cookieName: "consentManager",
    cookieExpiresAfterDays: 90,
    default: true,
    elementID: "consentManager",
    lang: "default",
    noticeAsModal: true,
    // mustConsent: rhKlaroSettings.mustConsent,
    mustConsent: rhKlaroSettings.mustConsent,
    privacyPolicy: rhKlaroSettings.privacyPolicy,
    callback: function (consent, service) {
        // console.log('User consent for service ' + service.name + ': consent=' + consent);
        console.log(klaroConfig);
        // loadConsents();
    },
    translations: rhKlaroSettings.translations,
};
document.addEventListener("DOMContentLoaded", function () {
    const checkExist = new MutationObserver(function (mutations, me) {
        console.log(mutations);
        const klaro = document.querySelector(".klaro");
        if (!klaro) {
            return;
        }
        klaro.removeAttribute("lang");
        setBodyPadding(klaro.querySelector(".cm-modal"));
        if (isHigherThanScreen()) {
            klaro.classList.add("is-higher");
        }
        checkExist.disconnect();
    });
    checkExist.observe(document, { childList: true, subtree: true });
});
window.addEventListener("resize", function () {
    setBodyPadding(document.querySelector(".klaro .cm-modal"));
    if (isHigherThanScreen()) {
        document.querySelector(".klaro").classList.add("is-higher");
    } else {
        document.querySelector(".klaro").classList.remove("is-higher");
    }
});
function isHigherThanScreen() {
    const modal = document.querySelector(".klaro .cm-modal");
    if (!modal) {
        return false;
    }
    return window.innerHeight - 40 <= modal.offsetHeight;
}
function setBodyPadding(modal) {
    if (modal === null || typeof modal === "undefined") {
        return;
    }
    if (window.matchMedia("(min-width: 680px)").matches) {
        document.body.style.removeProperty("padding-bottom");
        return;
    }
    document.body.style.removeProperty("padding-bottom");
    document.body.style.paddingBottom = modal.offsetHeight + "px";
}
