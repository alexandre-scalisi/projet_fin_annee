/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/form-livewire.js ***!
  \***************************************/
Livewire.on('scrollToComment', function (id) {
  setTimeout(function () {
    var el = document.getElementById(id).getElementsByClassName('comment')[document.getElementById(id).getElementsByClassName('comment').length - 1];
    form.scrollTo({
      top: el.offsetTop - 400,
      behavior: 'smooth'
    });
  }, 50);
});
Livewire.on('scrollTop', function () {
  form.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});
/******/ })()
;