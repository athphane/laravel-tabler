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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/admin.js":
/*!*******************************!*\
  !*** ./resources/js/admin.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * Redirects the page
 */
window.redirectPage = function (redirect_url) {
  if (redirect_url) {
    if (redirect_url.indexOf('#') === 0) {
      window.location.hash = redirect_url;
      window.location.reload();
    } else {
      window.location.replace(redirect_url);
    }
  } else {
    window.location.reload();
  }
};

$(document).ready(function () {
  // check all boxes when select all clicked
  $('input[type="checkbox"][data-all]').on('change', function (e) {
    e.preventDefault();
    var select_all_name = $(this).data('all');
    var is_checked = $(this).prop('checked');
    $('input[type="checkbox"][data-check="' + select_all_name + '"]').each(function () {
      $(this).prop('checked', is_checked);
    });
  }); // uncheck select all when one box unchecked

  $('input[type="checkbox"][data-check]').on('change', function (e) {
    e.preventDefault();
    var is_checked = $(this).prop('checked');

    if (!is_checked) {
      var select_all_name = $(this).data('check');
      var select_all = $('input[type="checkbox"][data-all="' + select_all_name + '"]');

      if (select_all) {
        select_all.prop('checked', false);
      }
    }
  }); //Iniate Select2 Plugin

  $('.select2-basic').select2({
    theme: 'bootstrap4'
  }); // Index sort

  $('[data-sort-field]').click(function (e) {
    e.preventDefault(); //find the parent form

    var parent_form_selector = $(this).closest('[data-form-sortable]').data('form-sortable');
    var parent_form = $('form' + parent_form_selector);

    if (parent_form) {
      var field = $(this).data('sort-field');
      var order = $(this).find('i').hasClass('fa-chevron-down') ? 'ASC' : 'DESC';
      parent_form.find('[name="orderby"]').val(field);
      parent_form.find('[name="order"]').val(order);
      parent_form.submit();
    }
  }); // delete record

  $('.delete-link').click(function (e) {
    e.preventDefault();
    var request_url = $(this).data('request-url');
    var redirect_url = $(this).data('redirect-url');
    swal.fire({
      title: 'Are you sure?',
      text: 'You will not be able to undo this delete operation!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!'
    }).then(function (result) {
      if (result.value) {
        axios["delete"](request_url).then(function (response) {
          swal.fire({
            title: 'Deleted!',
            text: 'The record has been deleted',
            icon: 'success',
            showConfirmButton: false,
            timer: 1000
          }).then(function () {
            redirectPage(redirect_url);
          });
        })["catch"](function (error) {
          console.log(error.response.data);
          var message = error.response.data.message;
          swal.fire({
            title: 'Error!',
            text: message || 'An error occurred while deleting',
            icon: 'error'
          });
        });
      }
    });
  });
});

/***/ }),

/***/ 1:
/*!*************************************!*\
  !*** multi ./resources/js/admin.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\tabler\resources\js\admin.js */"./resources/js/admin.js");


/***/ })

/******/ });