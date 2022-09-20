
var nav1 = document.getElementById("nav1");
var nav2 = document.getElementById("nav2");
var nav3 = document.getElementById("nav3");
var navbtn1 = document.querySelector(".navbtn1");
var navbtn2 = document.querySelector(".navbtn2");
var navbtn3 = document.querySelector(".navbtn3");
var buttonnav2 = document.querySelector(".buttonnav2");
var buttonnav3 = document.querySelector(".buttonnav3");
var span = document.getElementById("span");

var nav_respone = document.querySelector(".nav_respone");
var toggle = document.querySelector(".toggle_nav");
var page = document.getElementById("page_output").value;

$(document).ready(function () {
  $('.nav_respone').hide();
  $(".toggle_nav").click(function () {
    $(".nav_respone").slideToggle("slow");
  });
  $("#nav_respone1").click(function () {
    $(".nav_respone").slideToggle("slow");
  });
  $("#nav_respone2").click(function () {
    $(".nav_respone").slideToggle("slow");
  });
  $("#nav_respone3").click(function () {
    $(".nav_respone").slideToggle("slow");
  });
});


function selectChange(val) {
  document.getElementById("form_search").submit();
}

$('.content-show').hide();

$("#closr_x").click(function () {
  $('.content-show').hide(300);
})

function sendEmail() {
  var name = $("#name");
  var email = $("#email");
  var header = $("#header");
  var detail = $("#detail");

  if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(header) && isNotEmpty(detail)) {
    $.ajax({
      url: 'sendEmail.php',
      method: 'POST',
      dataType: 'json',
      data: {
        name: name.val(),
        email: email.val(),
        header: header.val(),
        detail: detail.val()
      },
      success: function (response) {
        $('#myform')[0].reset();
        $('.content-show').show(100);
        $('.msg').text("✅✅ Message send successfully");
      }
    });
  }
}


function isNotEmpty(caller) {
  if (caller.val() == "") {
    caller.css('border', '1px solid red');
    return false;
  } else caller.css('border', '');

  return true;
}



if (page == 1) {
  navbtn1.style.fontSize = "130%";
  document.querySelector(".contect").style.display = "none";
  document.querySelector(".menu_list_home").style.display = "none";
} else if (page == 2) {
  document.querySelector(".index").style.display = "none";
  document.querySelector(".contect").style.display = "block";
  document.querySelector(".menu_list_home").style.display = "none";
} else if (page == 3) {
  span.style.cssText = "right: 168px; width: 101px;";
  document.querySelector(".index").style.display = "none";
  document.querySelector(".contect").style.display = "none";
  document.querySelector(".menu_list_home").style.display = "block";
  navbtn3.style.fontSize = "130%";
}





nav1.addEventListener("click", () => {
  span.style.cssText = "right: 384px; width: 78px;";
  document.querySelector(".index").style.display = "block";
  document.querySelector(".contect").style.display = "none";
  document.querySelector(".menu_list_home").style.display = "none";

});

nav2.addEventListener("click", () => {
  span.style.cssText = "right: 289px; width: 78px;";
  document.querySelector(".index").style.display = "none";
  document.querySelector(".contect").style.display = "block";
  document.querySelector(".menu_list_home").style.display = "none";

});

nav3.addEventListener("click", () => {
  span.style.cssText = "right: 168px; width: 101px;";
  document.querySelector(".index").style.display = "none";
  document.querySelector(".contect").style.display = "none";
  document.querySelector(".menu_list_home").style.display = "block";

});


navbtn1.addEventListener("click", () => {
  document.querySelector(".index").style.display = "block";
  document.querySelector(".contect").style.display = "none";
  document.querySelector(".menu_list_home").style.display = "none";
  toggle.classList.toggle("active");
  navbtn1.style.fontSize = "130%";
  navbtn2.style.fontSize = "100%";
  navbtn3.style.fontSize = "100%";
});

navbtn2.addEventListener("click", () => {
  document.querySelector(".index").style.display = "none";
  document.querySelector(".contect").style.display = "block";
  document.querySelector(".menu_list_home").style.display = "none";
  toggle.classList.toggle("active");
  navbtn1.style.fontSize = "100%";
  navbtn2.style.fontSize = "130%";
  navbtn3.style.fontSize = "100%";

});

navbtn3.addEventListener("click", () => {
  document.querySelector(".index").style.display = "none";
  document.querySelector(".contect").style.display = "none";
  document.querySelector(".menu_list_home").style.display = "block";
  toggle.classList.toggle("active");
  navbtn1.style.fontSize = "100%";
  navbtn2.style.fontSize = "100%";
  navbtn3.style.fontSize = "130%";

});





buttonnav2.addEventListener("click", () => {
  span.style.cssText = "right: 289px; width: 78px;";
  document.querySelector(".index").style.display = "none";
  document.querySelector(".contect").style.display = "block";
  document.querySelector(".menu_list_home").style.display = "none";
  page = 2;
  if (page == 2) {
    navbtn2.style.fontSize = "130%";
  }
});

buttonnav3.addEventListener("click", () => {
  span.style.cssText = "right: 168px; width: 101px;";
  document.querySelector(".index").style.display = "none";
  document.querySelector(".contect").style.display = "none";
  document.querySelector(".menu_list_home").style.display = "block";
  page = 3;
  if (page == 3) {
    navbtn3.style.fontSize = "130%";
  }
});

toggle.addEventListener("click", () => {
  toggle.classList.toggle("active");
});

// console.log(page);


