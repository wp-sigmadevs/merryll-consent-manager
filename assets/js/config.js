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

    this.config();
  }

  _createClass(MerryllConfig, [{
    key: "config",
    value: function config() {
      var klaroConfig = {
        version: 1,
        elementID: merryllSettings.elementID,
        noAutoLoad: false,
        htmlTexts: true,
        embedded: false,
        groupByPurpose: true,
        storageMethod: 'cookie',
        cookieName: merryllSettings.elementID,
        cookieExpiresAfterDays: merryllSettings.cookieExpires,
        "default": true,
        mustConsent: false,
        acceptAll: true,
        hideDeclineAll: false,
        noticeAsModal: false,
        additionalClass: 'merryll-modal',
        services: rhKlaroSettings.services,
        lang: "default",
        privacyPolicy: merryllSettings.privacyPolicyLink,
        translations: rhKlaroSettings.translations
      };
    }
  }]);

  return MerryllConfig;
}();

/* harmony default export */ var frontend_MerryllConfig = (MerryllConfig);
// CONCATENATED MODULE: ./src/js/frontend/Helpers.js
function _typeof(obj) { "@babel/helpers - typeof"; if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

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
      if (document.readyState !== 'loading') {
        fn();
      } else if (document.addEventListener) {
        document.addEventListener('DOMContentLoaded', fn);
      } else {
        document.attachEvent('onreadystatechange', function () {
          if (document.readyState !== 'loading') {
            fn();
          }
        });
      }
    }
  }, {
    key: "toArray",
    value: function toArray(nodelist) {
      return !nodelist.length || _typeof(nodelist) !== 'object' ? nodelist : [].slice.call(nodelist);
    }
  }, {
    key: "isEmptyObj",
    value: function isEmptyObj(obj) {
      return Object.keys(obj).length === 0 && obj.constructor === Object;
    }
  }]);

  return MerryllHelpers;
}();

/* harmony default export */ var Helpers = (MerryllHelpers);
// CONCATENATED MODULE: ./src/js/config.js


var merryllConsent = {};
merryllConsent = {
  run: function run() {
    new frontend_MerryllConfig();
  }
}; // MerryllHelpers.ready(merryllConsent.run());
// jQuery(document).ready(function($) {
// 	$(document).on('carbonFields.apiLoaded', function(e, api) {
// 		// Get the current value in the 'crb_text' field
// 		var value = api.getFieldValue('merryll_cookie_name');
// 		console.log('value:', value);
// 	});
// });

/***/ })
/******/ ]);