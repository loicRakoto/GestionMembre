/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/loginAction.js ***!
  \*************************************/
$(document).ready(function () {
  $(document).on('click', 'span.inscr a', function () {
    //Inscription
    $(".form-inscription").css('display', 'block');
    $(".form-connection").css('display', 'none');
    $('span.inscr').css('display', 'none');
    $('span.connect').css('display', 'block');
    $('.head-formu-cnct').html("S'inscrire");
  });
  $(document).on('click', 'span.connect a', function () {
    //Connection
    $(".form-inscription").css('display', 'none');
    $(".form-connection").css('display', 'block');
    $('span.inscr').css('display', 'block');
    $('span.connect').css('display', 'none');
    $('.head-formu-cnct').html("Se connecter");
  });
  $('#formcnct').submit(function (e) {
    e.preventDefault();
    var jsondata = {
      'email': $("[name='email']").val(),
      'password': $("[name='password']").val()
    };

    // var jsondata = $('#formInscr').serializeArray();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Content-Type': 'application/json'
      }
    });
    var data = JSON.stringify(jsondata);
    console.log(data);
    $.ajax({
      type: "POST",
      url: "/authenticate",
      data: data,
      dataType: "JSON",
      success: function success(response) {
        if (response.status == 400) {
          $('.toast-body').html('');
          $('.toast-body').removeClass('alert alert-success');
          $('.toast-body').addClass('alert alert-danger');
          $.each(response.messageError, function (key, Err) {
            $('.toast-body').append('<li>' + Err + '</li>');
          });
          $('.afferror').css('display', 'block');
          $('.toast').toast('show');
        } else if (response.status == 0) {
          $('.toast-body').html('');
          $('.toast-body').removeClass('alert alert-success');
          $('.toast-body').addClass('alert alert-danger');
          $('.toast-body').append("<li> L'utilisateur ou le mots de passes ne corresponde pas </li >");
          $('.afferror').css('display', 'block');
          $('.toast').toast('show');
        } else {
          $('.toast-body').html('');
          $('.toast-body').removeClass('alert alert-danger');
          $('.toast-body').addClass('alert alert-success');
          $('.toast-body').append('<li> Connection réussie  </li>');
          $('#formInscr')[0].reset();
          $('.afferror').css('display', 'block');
          $('.toast').toast('show');
          window.location.href = "/membre";
        }
      }
    });
  });
  $('#formInscr').submit(function (e) {
    e.preventDefault();
    var jsondata = {
      'emailInscr': $("[name='emailInscr']").val(),
      'passwordInscr': $("[name='passwordInscr']").val(),
      'pseudoInscr': $("[name='pseudoInscr']").val(),
      'confirmpasswordInscr': $("[name='confirmpasswordInscr']").val()
    };

    // var jsondata = $('#formInscr').serializeArray();
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'Content-Type': 'application/json'
      }
    });
    var data = JSON.stringify(jsondata);
    console.log(data);
    $.ajax({
      type: "POST",
      url: "/addUser",
      data: data,
      dataType: "JSON",
      success: function success(response) {
        if (response.status == 400) {
          $('.toast-body').html('');
          $('.toast-body').removeClass('alert alert-success');
          $('.toast-body').addClass('alert alert-danger');
          $.each(response.messageError, function (key, Err) {
            $('.toast-body').append('<li>' + Err + '</li>');
          });
          $('.afferror').css('display', 'block');
          $('.toast').toast('show');
        } else {
          $('.toast-body').html('');
          $('.toast-body').removeClass('alert alert-danger');
          $('.toast-body').addClass('alert alert-success');
          $('.toast-body').append('<li> Ajout réussie </li>');
          $('#formInscr')[0].reset();
          $('.afferror').css('display', 'block');
          $('.toast').toast('show');
        }
      }
    });
  });
});
/******/ })()
;