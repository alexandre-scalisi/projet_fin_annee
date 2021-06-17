/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/form.js ***!
  \******************************/
window.app = function () {
  return {
    form: document.getElementById('form'),
    test: function test(el) {
      console.log('hello');
      form.scrollTop > 0 ? el.classList.add('opacity-100') : el.classList.remove('opacity-100');
    },
    test2: function test2(el) {
      console.log('hello');
      form.scrollTop !== form.scrollTopMax ? el.classList.add('opacity-100') : el.classList.remove('opacity-100');
    },
    scrollFunc: function scrollFunc(ev) {
      if (ev.target.scrollTop > 0) {
        document.getElementById('bg-top').classList.add('opacity-100');
      } else {
        document.getElementById('bg-top').classList.remove('opacity-100');
        console.log('test');
      }

      if (ev.target.scrollTop !== ev.target.scrollTopMax) {
        document.getElementById('bg-bottom').classList.add('opacity-100');
      } else {
        document.getElementById('bg-bottom').classList.remove('opacity-100');
      }

      var maxScroll = ev.target.scrollHeight - ev.target.clientHeight;

      if (ev.target.scrollTop >= maxScroll) {
        document.getElementById('bg-bottom').classList.remove('opacity-100');
        window.livewire.emit('load_more_comments');
      }

      ;
    }
  };
};
/******/ })()
;