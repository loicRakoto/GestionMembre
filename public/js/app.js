/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

$(document).ready(function () {
  fetchData();
  function fetchData() {
    $.ajax({
      url: '/fetchData',
      dataType: 'json',
      method: 'GET',
      success: function success(fetching) {
        $('tbody#bodyMembre').html('');
        $.each(fetching, function (key, Item) {
          $('tbody#bodyMembre').append('\
                    <tr>\
                        <th scope="row">' + Item.id + '</th>\
                        <td>' + Item.Nom + '</td>\
                        <td>' + Item.Prenom + '</td>\
                        <td>' + Item.Filliere + '</td>\
                        <td>' + Item.Adresse + '</td>\
                        <td>' + Item.Promotion + '</td>\
                        <td>\
                            <a href="#" id="' + Item.id + '" class="modification"><i class="fa-solid fa-pencil" style="color: rgb(25 103 58);"></i></a> \
                            <a href="#" id="' + Item.id + '" class="delete" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-user-slash" style="color: rgb(219, 25, 25)"></i></a>\
                        </td>\
                    </tr > \
                  ');
        });
      }
    });
  }
  $('#search').keyup(function (e) {
    var value = $(this).val();
    // var data = value.serialize();

    $.ajax({
      url: 'membre/search',
      data: {
        "id": value
      },
      method: 'GET',
      dataType: 'JSON',
      success: function success(e) {
        $('tbody').html('');
        $.each(e, function (key, Item) {
          $('tbody#bodyMembre').append('\
                    <tr>\
                        <th scope="row">' + Item.id + '</th>\
                        <td>' + Item.Nom + '</td>\
                        <td>' + Item.Prenom + '</td>\
                        <td>' + Item.Filliere + '</td>\
                        <td>' + Item.Adresse + '</td>\
                        <td>' + Item.Promotion + '</td>\
                        <td>\
                            <a href="#" id="' + Item.id + '" class="modification"><i class="fa-solid fa-pencil" style="color: rgb(25 103 58);"></i></a> \
                            <a href="#" id="' + Item.id + '" class="delete" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-user-slash" style="color: rgb(219, 25, 25)"></i></a>\
                        </td>\
                    </tr > \
                  ');
        });
      }
    });
  });
  $(document).on('click', '.modification', function (e) {
    e.preventDefault();
    var token = $("[name='_token']").val();
    var recup = $(this).attr('id');
    $.ajax({
      url: 'membre/edit',
      method: 'GET',
      data: {
        recup: recup,
        token: token
      },
      dataType: 'json',
      success: function success(ex) {
        $("[name='idmember']").val(ex.id);
        $("[name='nom']").val(ex.Nom);
        $("[name='prenom']").val(ex.Prenom);
        $("[name='filliere']").val(ex.Filliere);
        $("[name='adresse']").val(ex.Adresse);
        $("[name='promotion']").val(ex.Promotion);
        $('input#btn').val('Modifier');
      }
    });
  });
  $(document).on('click', '.delete', function (e) {
    e.preventDefault();
    var recup = $(this).attr('id');
    $('.idhide').attr('id', recup);
  });
  $(document).on('click', '#delbtn', function (e) {
    e.preventDefault();
    var token = $("[name='_token']").val();
    var id = $('.idhide').attr('id');
    $.ajax({
      url: 'membre/delete',
      method: 'GET',
      data: {
        id: id,
        token: token
      },
      dataType: 'json',
      success: function success(ex) {
        fetchData();
        $('#deleteModal').modal('hide');
        $('.afferror').html('');
        $('.afferror').removeClass('alert alert-danger');
        $('.afferror').addClass('alert alert-success');
        $('.afferror').append('<li> Suppression effectuer </li>');
        fetchData();
        $('#formMembre')[0].reset();
        $("[name='idmember']").val('');
        $('input#btn').val('Enregistrer');
      }
    });
  });
  $('#formMembre').submit(function (e) {
    e.preventDefault();
    // var data = $(this).serializeArray();
    // var jsondata = JSON.stringify(data);

    var faire = $("[name='idmember']").val();
    if (faire == '') {
      //AJOUT

      var jsondata = {
        'nom': $("[name='nom']").val(),
        'prenom': $("[name='prenom']").val(),
        'filliere': $("[name='filliere']").val(),
        'adresse': $("[name='adresse']").val(),
        'promotion': $("[name='promotion']").val()
      };
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Content-Type': 'application/json'
        }
      });
      $.ajax({
        url: '/membre/add',
        data: JSON.stringify(jsondata),
        dataType: 'json',
        contentType: 'application/json',
        type: 'POST',
        success: function success(e) {
          // console.log(e);

          if (e.status == 400) {
            $('.afferror').html('');
            $('.afferror').removeClass('alert alert-success');
            $('.afferror').addClass('alert alert-danger');
            $.each(e.messageError, function (key, Err) {
              $('.afferror').append('<li>' + Err + '</li>');
            });
          } else {
            $('.afferror').html('');
            $('.afferror').removeClass('alert alert-danger');
            $('.afferror').addClass('alert alert-success');
            $('.afferror').append('<li> Ajout réussie </li>');
            fetchData();
            $('#formMembre')[0].reset();
            $("[name='idmember']").val('');
          }
        }
      });
    } else {
      //MODIFICATION
      var id = $("[name='idmember']").val();
      var token = $("[name='_token']").val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          'Content-Type': 'application/json'
        }
      });
      var value = {
        'id': id,
        'token': token,
        'nom': $("[name='nom']").val(),
        'prenom': $("[name='prenom']").val(),
        'filliere': $("[name='filliere']").val(),
        'adresse': $("[name='adresse']").val(),
        'promotion': $("[name='promotion']").val()
      };
      $.ajax({
        url: 'membre/update',
        method: 'POST',
        data: JSON.stringify(value),
        dataType: 'json',
        success: function success(e) {
          if (e.status == 400) {
            $('.afferror').html('');
            $('.afferror').removeClass('alert alert-success');
            $('.afferror').addClass('alert alert-danger');
            $.each(e.messageError, function (key, Err) {
              $('.afferror').append('<li>' + Err + '</li>');
            });
            $('input#btn').val('Enregistrer');
          } else {
            $('.afferror').html('');
            $('.afferror').removeClass('alert alert-danger');
            $('.afferror').addClass('alert alert-success');
            $('.afferror').append('<li> Mise à jour réussie </li>');
            fetchData();
            $('#formMembre')[0].reset();
            $('input#btn').val('Enregistrer');
            $("[name='idmember']").val('');
          }
        }
      });
    }
  });
});

/***/ }),

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/login.css":
/*!*********************************!*\
  !*** ./resources/css/login.css ***!
  \*********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/login": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/login","css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	__webpack_require__.O(undefined, ["css/login","css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/login","css/app"], () => (__webpack_require__("./resources/css/login.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;