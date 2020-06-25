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

/***/ "./resources/js/mp.js":
/*!****************************!*\
  !*** ./resources/js/mp.js ***!
  \****************************/
/*! no static exports found */
/***/ (function(module, exports) {

// evento para manejo de paginacion por ajax
window.paginacionMP = function (route, page, id_update) {
  $.ajax({
    url: route,
    data: {
      page: page
    },
    type: 'GET',
    dataType: 'json',
    success: function success(data) {
      $(id_update).html(data.view_list);
    }
  });
}; // recupero informacion para editar la mp


window.abrirModificarMP = function (event, id, route) {
  event.preventDefault(); // recupero la vista con los campos para editar

  $.ajax({
    url: route,
    data: {},
    type: 'GET',
    dataType: 'html',
    success: function success(data) {
      $('#mod_mp').html(data);
      $('#id_mod_mp').modal('show');
    }
  });
}; // modificar una materia prima


window.modificarMP = function (e, id, route) {
  e.preventDefault();
  var fd = new FormData(document.getElementById('mp_form_modi')); // ACTUALIZO DATOS

  $.ajax({
    url: route,
    //data: {'_method':'PUT','_token':csrf_token},
    data: fd,
    type: 'POST',
    dataType: 'json',
    processData: false,
    contentType: false,
    success: function success(data) {
      // actualizo info en la lista
      $('#body_list_mp > #' + id + ' > td').eq(0).html(data.nombre);
      $('#body_list_mp > #' + id + ' > td').eq(1).html(data.categoria);
      $('#body_list_mp > #' + id + ' > td').eq(2).html(data.uni_medida);
      $('#body_list_mp > #' + id + ' > td').eq(3).html(data.cantidad); // cierro modal

      $('#btn-cancelar-mp').click();
    }
  }).fail(function (data) {
    console.log(data.responseJSON.errors);
    errors = data.responseJSON.errors;

    for (var err in errors) {
      $('input[name=' + err + ']').addClass('is-invalid'); //.invalid-feedback

      $('input[name=' + err + ']').parent().find('.invalid-feedback').html(errors[err]);
    }
  });
}; // recupero informacion para eliminar la mp
//$(document).on('click', '.elim_mp', function(e) {


window.eliminarMP = function (id, route) {
  $('#id_elim_mp').modal('show');
  $('input[name=_id_elim]').val(id); //var route = "{{ route('materias-primas.destroy',':id') }}";
  //route = route.replace(':id',id.trim());

  console.log(route);
  $('#form_elim_mp').attr('action', route);
  $(document).on('click', '#btn_elim_confirmar', function (e) {
    $('#form_elim_mp').submit();
  });
};

/***/ }),

/***/ 2:
/*!**********************************!*\
  !*** multi ./resources/js/mp.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\proyecto-2-iaw\resources\js\mp.js */"./resources/js/mp.js");


/***/ })

/******/ });