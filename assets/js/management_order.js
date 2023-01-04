var content_order1 = document.getElementById("conntent_taborder1");
var content_order2 = document.getElementById("conntent_taborder2");
var content_order3 = document.getElementById("conntent_taborder3");
var active1 = document.getElementById("btn_conntent_taborder1");
var active2 = document.getElementById("btn_conntent_taborder2");
var active3 = document.getElementById("btn_conntent_taborder3");

var table_ordernew1 = document.getElementById("table_ordernew1");
var table_ordernew2 = document.getElementById("table_ordernew2");
var table_ordernew3 = document.getElementById("table_ordernew3");

var form_search = document.getElementById("form_search");

// modal show reload
var show_dom = new bootstrap.Modal(document.getElementById("show_dom"));
var close_modal = document.getElementById("close_modal");
var refresh = document.getElementById("refresh").value;

var tbody = document.querySelector("tbody");

content_order2.style.display = "none";
content_order3.style.display = "none";
active1.style.cssText = "color:#000; background: #fff;";

active1.addEventListener("click", () => {
  active1.style.cssText = "color:#000; background: #fff;";
  active2.style.cssText = "color:#fff; background: rgb(255 255 255 / 0%);";
  active3.style.cssText = "color:#fff; background: rgb(255 255 255 / 0%);";
  content_order1.style.display = "block";
  content_order2.style.display = "none";
  content_order3.style.display = "none";
})

active2.addEventListener("click", () => {
  active2.style.cssText = "color:#000; background: #fff;";
  active1.style.cssText = "color:#fff; background: rgb(255 255 255 / 0%);";
  active3.style.cssText = "color:#fff; background: rgb(255 255 255 / 0%);";
  content_order2.style.display = "block";
  content_order1.style.display = "none";
  content_order3.style.display = "none";
})

active3.addEventListener("click", () => {
  active3.style.cssText = "color:#000; background: #fff;";
  active2.style.cssText = "color:#fff; background: rgb(255 255 255 / 0%);";
  active1.style.cssText = "color:#fff; background: rgb(255 255 255 / 0%);";
  content_order3.style.display = "block";
  content_order2.style.display = "none";
  content_order1.style.display = "none";
})


window.onload = function () {
  if (refresh == 1) {
    show_dom.show();
  }
};




close_modal.addEventListener("click", () => {
  show_dom.hide();
})

// confirm_order
tbody.addEventListener("click", (e) => {
  if (e.target.matches("button.confirm_order1")) {
    e.preventDefault();
    let id = e.target.getAttribute("data-id");
    confirm_order1(id);
  }
})


const confirm_order1 = async (id) => {

  const data = await fetch(`fetch_count_order.php?confirm_order1=${id}`, {
    method: "GET"
  })
  const res = await data.text();
  if (res == "success") {
    location.assign("management_order.php?refresh=2");
  }
  console.log(res);
}


// fetch data
setInterval(fetchdata_ordernew1 = async () => {
  const data = await fetch("fetch_count_order.php?get_ordernew1=1", {
    method: "GET"
  })
  const res = await data.json();
  table_ordernew1.innerHTML = res.text;
  var notification_sound_check = res.notification_sound_check;
  notification_sound_check = parseInt(notification_sound_check);
  if (notification_sound_check > 0) {
    output_sound(notification_sound_check);
  }
},
  1000);


// // open sound notification

// // open sound notification
const output_sound = async (sum_counter) => {
  sum_counter = sum_counter * 12;
  const audio = document.getElementById("notification");
  while (sum_counter >= 0) {
    if (sum_counter > 0) {
      audio.volume = 0.5;  // Set the volume to 50%
      audio.loop = false;  // Play the audio only once
      audio.controls = true;
      audio.play();
      // console.log(sum_counter);
    } else {
      const data = await fetch("fetch_count_order.php?update_sound=1", {
        method: "GET"
      })
      const res = await data.text();
      // console.log(res);
    }
    sum_counter--;
  }
}



setInterval(fetchdata_ordernew2 = async () => {
  const data = await fetch("fetch_count_order.php?get_ordernew2=1", {
    method: "GET"
  })
  const res = await data.text();
  table_ordernew2.innerHTML = res;
},
  1000);


const fetchdata_ordernew3 = async () => {
  const data = await fetch("fetch_count_order.php?get_ordernew3=1", {
    method: "GET"
  })
  const res = await data.text();
  table_ordernew3.innerHTML = res;
}

fetchdata_ordernew3();


form_search.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(form_search);
  formData.append("search", 1);

  if (form_search.checkValidity() === false) {
    e.preventDefault();
    e.stopPropagation();
    return false;
  } else {
    const data = await fetch("fetch_count_order.php", {
      method: "POST",
      body: formData
    })
    const response = await data.text();
    table_ordernew3.innerHTML = response;
  }
})

form_search.addEventListener("keypress", async (e) => {
  if (e.key === "Enter") {
    e.preventDefault();
    const formData = new FormData(form_search);
    formData.append("search", 1);

    if (form_search.checkValidity() === false) {
      e.preventDefault();
      e.stopPropagation();
      return false;
    } else {
      const data = await fetch("fetch_count_order.php", {
        method: "POST",
        body: formData
      })
      const response = await data.text();
      table_ordernew3.innerHTML = response;
    }
  }
})


const showAll_order = () => {
  fetchdata_ordernew3();
  document.getElementById("text_search_order").value = "";
}
