/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
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
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
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
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 58);
/******/ })
/************************************************************************/
/******/ ({

/***/ 39:
/***/ (function(module, exports) {

/*Disactive one of accounts*/
document.getElementById('account_from').addEventListener('change', function () {
    var account_from_value = this.value;
    var currency = this.options[this.selectedIndex].dataset.currency;

    document.querySelector('span.currency_from').innerText = currency;

    document.querySelectorAll('#account_to option').forEach(function (item) {

        if (item.value == account_from_value || item.value == '') {
            item.setAttribute('disabled', '');
        } else {
            item.removeAttribute('disabled');
        }
    });

    if (document.querySelector('span.currency_from').innerText != document.querySelector('span.currency_to').innerText) {
        document.querySelector('span.currency_from').style.color = 'red';
        document.querySelector('span.currency_to').style.color = 'red';
        document.querySelector('.warning').style.display = 'block';
    } else {
        document.querySelector('span.currency_from').style.color = '#2ab27b';
        document.querySelector('span.currency_to').style.color = '#2ab27b';
        document.querySelector('.warning').style.display = 'none';
        document.querySelector('form input[name="currency"]').value = document.querySelector('span.currency_from').innerText;
    }
});

document.getElementById('account_to').addEventListener('change', function () {
    var account_from_value = this.value;
    document.querySelectorAll('#account_from option').forEach(function (item) {
        if (item.value == account_from_value || item.value == '') {
            item.setAttribute('disabled', '');
        } else {
            item.removeAttribute('disabled');
        }
    });

    document.querySelector('span.currency_to').innerText = this.options[this.selectedIndex].dataset.currency;

    if (document.querySelector('span.currency_from').innerText != document.querySelector('span.currency_to').innerText) {
        document.querySelector('span.currency_from').style.color = 'red';
        document.querySelector('span.currency_to').style.color = 'red';
        document.querySelector('.warning').style.display = 'block';
    } else {
        document.querySelector('span.currency_from').style.color = '#2ab27b';
        document.querySelector('span.currency_to').style.color = '#2ab27b';
        document.querySelector('.warning').style.display = 'none';
        document.querySelector('form input[name="currency"]').value = document.querySelector('span.currency_from').innerText;
    }
});

/*Refresh selects accounts*/
document.querySelector('span.refresh').addEventListener('click', function () {

    document.getElementById('account_from').value = '';
    document.getElementById('account_to').value = '';
    document.querySelector('span.currency_from').innerText = '';
    document.querySelector('span.currency_to').innerText = '';
    document.querySelector('.warning').style.display = 'none';

    document.querySelectorAll('#account_from option').forEach(function (item) {
        if (item.value == '') {
            item.setAttribute('disabled', '');
            item.setAttribute('selected', '');
        } else {
            item.removeAttribute('disabled');
            item.removeAttribute('selected');
        }
    });

    document.querySelectorAll('#account_to option').forEach(function (item) {
        if (item.value == '') {
            item.setAttribute('disabled', '');
            item.setAttribute('selected', '');
        } else {
            item.removeAttribute('disabled');
            item.removeAttribute('selected');
        }
    });
});

/*Show modal*/
document.querySelector('.add_transfer').addEventListener('click', function () {
    document.querySelector('.modal_bg').style.display = 'block';
});

/*Close modal*/
document.getElementById('exit_modal').addEventListener('click', function () {
    document.querySelector('.modal_bg').style.display = 'none';
    document.getElementById('account_from').value = '';
    document.getElementById('account_to').value = '';
    document.querySelector('.warning').style.display = 'none';
    document.querySelector('span.currency_from').innerText = '';
    document.querySelector('span.currency_to').innerText = '';

    document.querySelectorAll('#account_from option').forEach(function (item) {
        if (item.value == '') {
            item.setAttribute('disabled', '');
            item.setAttribute('selected', '');
        } else {
            item.removeAttribute('disabled');
            item.removeAttribute('selected');
        }
    });

    document.querySelectorAll('#account_to option').forEach(function (item) {
        if (item.value == '') {
            item.setAttribute('disabled', '');
            item.setAttribute('selected', '');
        } else {
            item.removeAttribute('disabled');
            item.removeAttribute('selected');
        }
    });

    document.getElementById('total_sum').value = '';
});

/***/ }),

/***/ 58:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(39);


/***/ })

/******/ });