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

/***/ "./resources/js/productos.js":
/*!***********************************!*\
  !*** ./resources/js/productos.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// evento para manejo de paginacion por ajax
window.paginacionProducto = function (route, page, id_update) {
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
}; // evento para actualizar label de la imagen al dar de alta un producto


window.actualizaLabelImagen = function (elem, id_label, id_img) {
  var input = $(elem);
  label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  $(id_label).html(label);
  readURL(elem, id_img);
};

function readURL(input, id) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(id).attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
} // agrego una materia prima a la lista


window.agregarMPAlProducto = function () {
  var mod = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : false;
  var id_body = arguments.length > 1 ? arguments[1] : undefined;
  id_body = "#body_mp";

  if (mod) {
    id_body = "#body_mp_mod";
  } // recupero el ultimo id agregado -> es incremental


  var id = $(id_body).children().last().attr('id').replace('mp_tr_', '');
  var new_id = Number(id) + 1; // recupero primer tr para hacer una copia

  var cant = $(id_body).children().length;
  var html = '<tr id="mp_tr_' + new_id + '">';
  html += $(id_body).children().first().html(); // reemplazo por el nuevo id en todos lados donde figura 1

  html = html.replace(/mp\[1]/g, 'mp[' + new_id + ']');
  html = html.replace(/mp\.1/g, 'mp.' + new_id);
  html = html.replace(/mp_1/g, 'mp_' + new_id);
  html = html.replace(/is-invalid/g, ''); // armmo la fila y la agrego

  html += "</tr>";
  $(id_body).append(html); // agrego boton para eliminar fila

  $(id_body).children().last().find('.td_button').html('<button type="button" class="btn btn-danger btn-sm" onclick="eliminarMPDelProducto(this)"> - </button>');
}; // elimino una materia prima de la lista


window.eliminarMPDelProducto = function (elem) {
  $(elem).parent().parent().remove();
}; // insertamos un producto en la base de datos (actualiza listado)


window.insertarProducto = function (elem, route) {
  elem.preventDefault();
  var fd = new FormData(document.getElementById('producto_form_alta'));
  fd.append('file_name', $('#lbl_imagen').html());
  $('.is-invalid').removeClass('is-invalid'); // ACTUALIZO DATOS

  $.ajax({
    url: route,
    //data: {'_method':'PUT','_token':csrf_token},
    data: fd,
    type: 'POST',
    dataType: 'json',
    processData: false,
    contentType: false,
    success: function success(data) {
      $('#producto_form_alta').trigger("reset");
      $('#lbl_imagen').html('Seleccioanr imagen...');
      $('#img_upload').attr('src', ''); // actualizo listado de productos

      $('#list_ajax').html(data.view_list);
    }
  }).fail(function (data) {
    errors = data.responseJSON.errors;

    for (var err in errors) {
      $('#' + err.replace(/\./g, '_')).addClass('is-invalid');
      var id_error = '#' + err.replace(/\./g, '_') + '_err';
      $(id_error).html(errors[err][0]);
    }
  });
}; // mostrar panel para modificar un producto


window.abrirModificarProducto = function (elem, event, route) {
  event.preventDefault(); // recupero la vista con los campos para editar

  $.ajax({
    url: route,
    data: {},
    type: 'GET',
    dataType: 'json',
    processData: false,
    contentType: false,
    success: function success(data) {
      // ciclo las materias primas cargadas para cargarlas en la interface
      var productos_mp = data.productos_mp;
      cant = productos_mp.length;

      for (var i = 0; i < cant; i++) {
        var id = productos_mp[i].materia_prima_id;
        var cantidad = productos_mp[i].cantidad;

        if (i == 0) {
          // agrego listado a interface (dejo el seteo del primer elemento para el final)
          var html = data.view_form;
          $('#mod_producto').html(html);
          $('#id_mod_producto').modal('show');
        } else {
          agregarMPAlProducto(true, '#body_mp_mod');
          $('#mp_' + (i + 1) + '_materia_prima_id_mod').val(id);
          $('#mp_' + (i + 1) + '_cantidad_mod').val(cantidad);
        }
      } // seteo primer elemento


      $('#mp_1_materia_prima_id_mod').val(productos_mp[0].materia_prima_id);
      $('#mp_1_cantidad_mod').val(productos_mp[0].cantidad);
    }
  });
}; // modifica el producto


window.modificarProducto = function (elem, event, id, route) {
  event.preventDefault();
  route = route.replace(':id', id);
  var fd = new FormData(elem);
  fd.append('file_name', $('#lbl_imagen_mod').html());
  var src_img = $('#img_upload_mod').attr('src'); // ACTUALIZO DATOS

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
      $('#body_list_producto > #' + id + ' > td').eq(0).html(data.nombre);
      $('#body_list_producto > #' + id + ' > td').eq(1).html(data.descripcion);
      $('#body_list_producto > #' + id + ' > td > img').attr('src', src_img); // cierro modal

      $('#btn_cancelar_producto').click();
    }
  }).fail(function (data) {
    errors = data.responseJSON.errors;

    for (var err in errors) {
      $('input[name=' + err + ']').addClass('is-invalid'); //.invalid-feedback

      $('input[name=' + err + ']').parent().find('.invalid-feedback').html(errors[err]);
    }
  });
}; // eliminar un producto -> abre ventana de confirmacion


window.eliminarProducto = function (id, route) {
  $('#id_elim_producto').modal('show');
  $('input[name=_id_elim]').val(id);
  $('#form_elim_producto').attr('action', route);
  $(document).on('click', '#btn_elim_confirmar', function (e) {
    $('#form_elim_producto').submit();
  });
};

/***/ }),

/***/ 1:
/*!*****************************************!*\
  !*** multi ./resources/js/productos.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\laragon\www\proyecto-2-iaw\resources\js\productos.js */"./resources/js/productos.js");


/***/ })

/******/ });