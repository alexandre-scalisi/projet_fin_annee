/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/form.js ***!
  \******************************/
window.app = function () {
  return {
    form: document.getElementById('form'),
    test: function test(el) {
      form.scrollTop > 0 ? el.classList.remove('hidden') : el.classList.add('hidden');
    },
    test2: function test2(el) {
      form.scrollTop !== form.scrollTopMax ? el.classList.remove('hidden') : el.classList.add('hidden');
    },
    scrollFunc: function scrollFunc(ev) {
      if (ev.target.scrollTop > 0) {
        document.getElementById('bg-top').classList.remove('hidden');
      } else {
        document.getElementById('bg-top').classList.add('hidden');
        console.log('test');
      }

      if (ev.target.scrollTop !== ev.target.scrollTopMax) {
        document.getElementById('bg-bottom').classList.remove('hidden');
      } else {
        document.getElementById('bg-bottom').classList.add('hidden');
      }

      var maxScroll = ev.target.scrollHeight - ev.target.clientHeight;

      if (ev.target.scrollTop >= maxScroll) {
        document.getElementById('bg-bottom').classList.add('hidden');
        window.livewire.emit('load_more_comments');
      }

      ;
    }
  };
};
/******/ })()
;