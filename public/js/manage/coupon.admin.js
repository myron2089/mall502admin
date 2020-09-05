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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/lang/translation.js":
/*!*****************************************************!*\
  !*** ./resources/js/components/lang/translation.js ***!
  \*****************************************************/
/*! exports provided: trans */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "trans", function() { return trans; });
function trans(key) {
  var replace = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : {};
  console.log(key);
  var translation = key.split('.').reduce(function (t, i) {
    return t[i] || null;
  }, window.translations);

  for (var placeholder in replace) {
    translation = translation.replace(":".concat(placeholder), replace[placeholder]);
  }

  return translation;
}

/***/ }),

/***/ "./resources/js/components/manage/coupon.admin.js":
/*!********************************************************!*\
  !*** ./resources/js/components/manage/coupon.admin.js ***!
  \********************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _lang_translation_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../lang/translation.js */ "./resources/js/components/lang/translation.js");

/*
*
* Coupon admin
*
*/
//******************************* Show coupon details ****************//

$(document).on('click', '.couponDetails', function (e) {
  e.preventDefault(); // var today = new Date(); 
  //console.log(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate());

  var urlBase = this.getAttribute('data-base-url');
  var url = urlBase + this.getAttribute('data-url') + this.getAttribute('data-id');
  var modalId = this.getAttribute('data-target');
  var modal = document.querySelector('#' + modalId);
  var overlay = document.querySelector('.load-content-bg');
  overlay.classList.add("show");
  fetch(url, {
    method: 'GET',
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
      "X-Requested-With": "XMLHttpRequest",
      "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
    }
  }).then(function (response) {
    return response.json();
  })["catch"](function (error) {
    console.log('Error:', error);
  }).then(function (response) {
    if (response.success == true) {
      var cStart = new Date(response.data[0].couponStart);
      var cFinish = new Date(response.data[0].couponFinish);
      var host = window.location.host;
      var couponImg = document.getElementById('couponImage');
      couponImg.src = urlBase + "/" + response.data[0].couponImagen;
      document.getElementById('couponNoteDetail').value = response.data[0].couponNote;
      document.getElementById('couponEmailsDetail').value = response.data[0].couponEmail;
      document.getElementById('startDetail').value = cStart.getDate() + "-" + (cStart.getMonth() + 1) + "-" + cStart.getFullYear();
      document.getElementById('endDetail').value = cFinish.getDate() + "-" + (cFinish.getMonth() + 1) + "-" + cFinish.getFullYear();
      document.getElementById('couponProduct').value = response.data[0].productName;
      modal.classList.add("show");
    } else {
      Swal.fire({
        type: 'error',
        title: 'Oops...',
        text: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.an_error_has_ocurred')
      });
    }

    overlay.classList.remove("show");
  });
}); //**************** Send coupon after create it *************************//

$(document).on('click', '.couponSend', function (e) {
  e.preventDefault();
  var urlBase = this.getAttribute('data-base-url');
  var url = urlBase + this.getAttribute('data-url') + this.getAttribute('data-id');
  Swal.fire({
    title: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.label_email_address'),
    input: 'email',
    inputAttributes: {
      autocapitalize: 'off',
      required: 'true',
      autocomplete: 'off'
    },
    showCancelButton: true,
    cancelButtonText: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.btn_cancel'),
    confirmButtonText: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.btn_send_coupon'),
    showLoaderOnConfirm: true,
    preConfirm: function preConfirm(login) {
      return fetch(url + "/" + login).then(function (response) {
        console.log(response);

        if (!response.ok) {
          throw new Error(response.statusText);
        }

        return response.json();
      })["catch"](function (error) {
        Swal.showValidationMessage("Request failed: ".concat(error));
      });
    },
    allowOutsideClick: function allowOutsideClick() {
      return !Swal.isLoading();
    }
  }).then(function (result) {
    console.log(result.value);

    if (result.success == true) {
      Swal.fire({
        title: "enviado con exito"
      });
    }
  });
}); // Cancel coupon

$(document).on('click', '.couponCancel', function (e) {
  e.preventDefault();
  var urlBase = this.getAttribute('data-base-url');
  var url = urlBase + this.getAttribute('data-url') + this.getAttribute('data-id');
  var modalId = this.getAttribute('data-target');
  console.log(url);
  Swal.queue([{
    title: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.are_you_sure_cancel_coupon'),
    text: "You won't be able to revert this!",
    type: 'warning',
    showLoaderOnConfirm: true,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.btn_cancel'),
    confirmButtonText: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.yes_cancel_coupon'),
    allowOutsideClick: false,
    html: '<form>' + '<input id="couponCancelNote" name="couponCancelNote" class="swal2-input form-control"  maxlength="50"  placeholder="' + Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.add_note_reason_for_cancel') + '" autofocus required>' + '</form>',
    preConfirm: function preConfirm() {
      document.querySelector('.swal2-cancel').classList.add('hidden');
      var couponNote = document.getElementById('couponCancelNote').value;
      return fetch(url + "/" + couponNote).then(function (response) {
        return response.json();
      }).then(function (data) {
        return Swal.insertQueueStep({
          type: 'success',
          title: data.status,
          text: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.coupon_cancelled_successfully')
        });
      })["catch"](function () {
        Swal.showValidationMessage({
          type: 'error',
          title: Object(_lang_translation_js__WEBPACK_IMPORTED_MODULE_0__["trans"])('base.an_error_has_ocurred')
        });
      });
    }
  }]);
});

/***/ }),

/***/ 2:
/*!**************************************************************!*\
  !*** multi ./resources/js/components/manage/coupon.admin.js ***!
  \**************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\PROYECTOS\NUNTECHS\MALL 502\MallFront\resources\js\components\manage\coupon.admin.js */"./resources/js/components/manage/coupon.admin.js");


/***/ })

/******/ });