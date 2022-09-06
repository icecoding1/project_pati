
$(document).ready(function () {
  $('.nav_respone').hide();
  $(".toggle_nav").click(function () {
    $(".nav_respone").slideToggle("slow");
  });
});




var nav1 = document.getElementById("nav1");
var nav2 = document.getElementById("nav2");
var nav3 = document.getElementById("nav3");
var span = document.getElementById("span");

var nav_respone = document.querySelector(".nav_respone");
var toggle = document.querySelector(".toggle_nav");


// nav_respone.style.display = "none";
document.querySelector(".index").style.display = "none";
// document.querySelector(".contect").style.display = "none";
// document.getElementById("divtree").style.display = "none";

nav1.addEventListener("click", () => {
  span.style.cssText = "right: 384px; width: 78px;";

  // document.getElementById("divone").style.display = "block";
  // document.getElementById("divtwo").style.display = "none";
  // document.getElementById("divtree").style.display = "none";
});

nav2.addEventListener("click", () => {
  span.style.cssText = "right: 289px; width: 78px;";
  // document.getElementById("divtwo").style.display = "block";
  // document.getElementById("divone").style.display = "none";
  // document.getElementById("divtree").style.display = "none";
});

nav3.addEventListener("click", () => {
  span.style.cssText = "right: 168px; width: 101px;";
  // document.getElementById("divtree").style.display = "block";
  // document.getElementById("divone").style.display = "none";
  // document.getElementById("divtwo").style.display = "none";
});

toggle.addEventListener("click", () => {
  toggle.classList.toggle("active");
  //nav_respone.classList.toggle("active");
});
