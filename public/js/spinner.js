/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/spinner.js ***!
  \*********************************/
var spinner = document.getElementById("spinner");
window.onbeforeunload = showSpinner;

window.onload = function () {
  console.log("entra");
  var links = document.getElementsByClassName("save-id"); // Cuando carga la página quitamos el spinner

  hideSpinner();

  for (var i = 0; i < links.length; i++) {
    links.item(i).addEventListener("click", showSpinner);
  }
};

function hideSpinner() {
  if (!spinner.classList.contains("hidden")) {
    spinner.classList.add("hidden");
    spinner.classList.remove("flex");
  }
}

function showSpinner() {
  if (spinner.classList.contains("hidden")) {
    spinner.classList.remove("hidden");
    spinner.classList.add("flex");
  }
}
/******/ })()
;