var redio1 = document.getElementById("radio1");
var redio2 = document.getElementById("radio2");
var redio3 = document.getElementById("radio2");

var counter = 1;

redio1.addEventListener("click", () => {
  counter = 1;
});

redio2.addEventListener("click", () => {
  counter = 2;
});
redio3.addEventListener("click", () => {
  counter = 3;
});


setInterval(function () {
  document.getElementById('radio' + counter).checked = true;
  counter++;
  if (counter > 3) {
    counter = 1;
  }
}, 5000);

