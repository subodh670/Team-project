window.onscroll = function() {
  var scrollY = window.scrollY;
  var header = document.getElementById("header");
  header.style.transform = "translateY(" + scrollY + "px)";
};