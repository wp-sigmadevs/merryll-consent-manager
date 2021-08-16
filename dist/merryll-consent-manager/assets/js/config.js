/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// CONCATENATED MODULE: ./src/js/frontend/MerryllConfig.js
function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var MerryllConfig = /*#__PURE__*/function () {
  function MerryllConfig() {
    _classCallCheck(this, MerryllConfig);

    return this.config();
  }

  _createClass(MerryllConfig, [{
    key: "config",
    value: function config() {
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
        "default": true,
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
  }, {
    key: "serviceList",
    value: function serviceList() {
      var services = [];
      merryllSettings.services.forEach(function (service) {
        services.push({
          name: service.name,
          title: service.title,
          "default": service["default"],
          required: service.required,
          description: service.description,
          cookies: service.cookies,
          purposes: service.purposes,
          onlyOnce: service.onlyOnce,
          optOut: service.optOut,
          callback: function callback(state, app) {
            if (service.customEvent) {
              if (state !== false) {
                dataLayer.push({
                  event: service.customEvent
                });
              }
            }
          }
        });
      });
      return services;
    }
  }]);

  return MerryllConfig;
}();

/* harmony default export */ var frontend_MerryllConfig = (MerryllConfig);
// CONCATENATED MODULE: ./src/js/frontend/Utils.js
function Utils_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function Utils_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function Utils_createClass(Constructor, protoProps, staticProps) { if (protoProps) Utils_defineProperties(Constructor.prototype, protoProps); if (staticProps) Utils_defineProperties(Constructor, staticProps); return Constructor; }

var MerryllUtils = /*#__PURE__*/function () {
  function MerryllUtils() {
    Utils_classCallCheck(this, MerryllUtils);
  }

  Utils_createClass(MerryllUtils, null, [{
    key: "ModalActions",
    value: function ModalActions() {
      var merryllKlaro = document.querySelector('.merryll-modal');
      var merryllModal = merryllKlaro.getElementsByClassName('cookie-modal');
      var merryllButton = document.querySelector('.merryll-consent-btn');

      if (merryllModal.length > 0) {
        document.body.classList.add('merryll-modal-active');
      }

      if (merryllButton) {
        merryllButton.addEventListener('click', function () {
          document.body.classList.add('merryll-modal-active');
        });
      }

      document.addEventListener('click', function (e) {
        if (e.target && e.target.classList.contains('cm-btn-accept')) {
          document.body.classList.remove('merryll-modal-active');
        }
      });
      merryllKlaro.removeAttribute('lang');
      var modal = new MutationObserver(function (mutationsList, observer) {
        if (!merryllKlaro) {
          return;
        }

        if (mutationsList[0].nextSibling || mutationsList[0].nextSibling === null) {
          document.body.classList.remove('merryll-modal-active');
        }

        modal.disconnect();
      });
      modal.observe(merryllKlaro, {
        childList: true,
        subtree: true
      });
    }
  }, {
    key: "assignHeight",
    value: function assignHeight() {
      var merryllKlaro = document.querySelector('.merryll-modal');
      var modal = new MutationObserver(function (mutationsList, observer) {
        if (!merryllKlaro) {
          return;
        }

        mutationsList.forEach(function (mutation) {
          if (mutation.addedNodes[0] && mutation.addedNodes[0].classList.value === 'cookie-modal') {
            merryllKlaro.style.height = mutation.addedNodes[0].offsetHeight + 40 + 'px';
          }
        });
      });
      modal.observe(merryllKlaro, {
        childList: true,
        subtree: true
      });
    }
  }, {
    key: "bodyClass",
    value: function bodyClass() {
      document.body.classList.add('merryll-modal-loaded');
    }
  }]);

  return MerryllUtils;
}();

/* harmony default export */ var Utils = (MerryllUtils);
// CONCATENATED MODULE: ./src/js/frontend/Helpers.js
function Helpers_classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function Helpers_defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function Helpers_createClass(Constructor, protoProps, staticProps) { if (protoProps) Helpers_defineProperties(Constructor.prototype, protoProps); if (staticProps) Helpers_defineProperties(Constructor, staticProps); return Constructor; }

var MerryllHelpers = /*#__PURE__*/function () {
  function MerryllHelpers() {
    Helpers_classCallCheck(this, MerryllHelpers);
  }

  Helpers_createClass(MerryllHelpers, null, [{
    key: "ready",
    value: function ready(fn) {
      document.addEventListener('DOMContentLoaded', fn);
    }
  }, {
    key: "resize",
    value: function resize(fn) {
      window.addEventListener('resize', fn);
    }
  }, {
    key: "load",
    value: function load(fn) {
      window.addEventListener('load', fn);
    }
  }]);

  return MerryllHelpers;
}();

/* harmony default export */ var Helpers = (MerryllHelpers);
// CONCATENATED MODULE: ./src/js/config.js



var merryllConsent = {};
merryllConsent = {
  init: function init() {
    return new frontend_MerryllConfig();
  },
  readyEvent: function readyEvent() {
    Helpers.ready(Utils.ModalActions);
    Helpers.ready(Utils.assignHeight);
  },
  resizeEvent: function resizeEvent() {
    Helpers.resize(Utils.assignHeight);
  },
  loadEvent: function loadEvent() {
    Helpers.load(Utils.bodyClass);
  }
};
window.klaroConfig = merryllConsent.init();
merryllConsent.readyEvent();
merryllConsent.resizeEvent();
merryllConsent.loadEvent();

/***/ })
/******/ ]);