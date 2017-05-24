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
/******/ 	return __webpack_require__(__webpack_require__.s = 69);
/******/ })
/************************************************************************/
/******/ ({

/***/ 39:
/***/ (function(module, exports) {

var modal_add_account = document.getElementById('add_account_modal');
var modal_mask = document.querySelector('.modal-mask');
var add_img_button = document.querySelector('.modal-body .add_img');

/*Image add*/
add_img_button.addEventListener('click', function () {

    var images_list = document.querySelector('.modal-body .images');

    images_list.style.display = 'block';

    var account_image = document.querySelectorAll('.modal-body .images ul li');
    account_image.forEach(function (item) {
        item.addEventListener('click', function () {
            var img = document.createElement('img');
            img.src = this.children[0].attributes[0].value;
            img.style.width = '40px';

            add_img_button.innerText = '';
            add_img_button.appendChild(img);
            document.querySelector('input[name="pic"]').value = this.children[0].attributes[0].value;
            images_list.style.display = 'none';
        });
    });
});

/*Open modal window add account*/
modal_add_account.addEventListener('click', function () {
    modal_mask.style.display = 'table';
});

/*Close modal window add account*/
document.querySelector('.modal-default-button').addEventListener('click', function () {
    modal_mask.style.display = 'none';
    document.getElementById('title').value = '';
    document.getElementById('total_sum').value = '';
    document.getElementById('currency').value = 'UAH';
    document.querySelector('.add_img').innerText = 'Add image';
    document.querySelector('input[name="pic"]').value = '';
});

window.addEventListener("keydown", function (e) {
    if (e.keyCode == 27) {
        modal_mask.style.display = 'none';
    }
}, true);

/*Total sum in accounts*/
var total_sum = 0;
document.querySelectorAll('.account_sum').forEach(function (item) {
    if (item.nextElementSibling.innerText != 'UAH') {
        var reg = /\W[0-9]*\W[0-9]*\s/;
        var sum = item.innerText.match(reg)[0].substr(1);
        total_sum += +sum;
    } else {
        total_sum += +item.innerText;
    }
});
document.querySelector('.total span').innerText = total_sum;
if (total_sum < 0) {
    document.querySelector('.total span').style.color = 'red';
} else {
    document.querySelector('.total span').style.color = 'green';
}

/***/ }),

/***/ 69:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(39);


/***/ })

/******/ });