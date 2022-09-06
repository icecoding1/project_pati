<?php $page = isset($_GET['page']) ? $_GET['page'] : 1; ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ร้านป้าเเจ๋ว</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/management.css">
  <link rel="stylesheet" href="assets/css/slide.css">
  <link rel="icon" href="favicon/logo_favicon.png">
  <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="bg-home">


  <div class="header_nav">
    <div class="navbar">
      <a href="home.php" class="mr-auto">
        <img src="assets/img/food_pachaew_logo.png" alt="logo">
      </a>
      <ul>
        <li>
          <p id="nav1">หน้าเเรก</p>
          <span id="span">
          </span>
        </li>
        <li>
          <p id="nav2">ติดต่อ</p>
        </li>
        <li>
          <p href="" id="nav3">รายการอาหาร</p>
        </li>
        <li>
          <a href="login.php" class="login">เข้าสู่ระบบ</a>
        </li>
      </ul>
      <div>
        <button class="toggle_nav" id="toggle_nav">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>

    <div class="nav_respone" id="nav_respone">
      <div>
        <ul>
          <li>
            <p id="nav1">หน้าเเรก</p>
          </li>
          <li>
            <p id="nav2">ติดต่อ</p>
          </li>
          <li>
            <p href="" id="nav3">รายการอาหาร</p>
          </li>
          <li>
            <a href="login.php" class="login">เข้าสู่ระบบ</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="index">
    <div class="slider">
      <div class="slides">
        <!--radio buttons start-->
        <input type="radio" name="radio-btn" id="radio1">
        <input type="radio" name="radio-btn" id="radio2">
        <input type="radio" name="radio-btn" id="radio3">

        <div class="slide first">
          <img src="assets/img/bg_restaurant.jpg" alt="">
        </div>
        <div class="slide">
          <img src="assets/img/img2.png" alt="">
        </div>
        <div class="slide">
          <img src="assets/img/imgfood1.png" alt="">
        </div>

        <div class="navigation-auto">
          <div class="auto-btn1"></div>
          <div class="auto-btn2"></div>
          <div class="auto-btn3"></div>
        </div>

        <!--automatic navigation end-->
        <div class="navigation-manual">
          <label for="radio1" class="manual-btn"></label>
          <label for="radio2" class="manual-btn"></label>
          <label for="radio3" class="manual-btn"></label>
        </div>

        <div class="d-flex justify-content-center align-items-center div_btn">
          <button class="btn btn btn-light border border-dark rounded-5 mx-2 px-2 fw-bold">ช่องทางการติดต่อ</button>
          <button class="btn btn btn-light border border-dark rounded-5 mx-2 px-3 fw-bold">รายการอาหาร</button>
        </div>

      </div>
    </div>

    <div class="py-4 my-3 set_content">
      <div class="content_index px-4">
        <?php foreach (range(1, 10) as $row) { ?>
          <div class="card mb-3 in_content_index">
            <div class="row g-0 content">
              <div class="col-md-4 image">
                <img src="assets/img/empty_bg.jpeg" class="img-fluid rounded-start" alt="img">
              </div>
              <div class="col-md-8 detail_box">
                <div class="card-body detail">
                  <h5 class="card-title titel">Card title</h5>
                  <p class="card-text text_detail">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                  <a href="">see more..</a>
                </div>
              </div>
            </div>
          </div>
        <?php  } ?>
      </div>
    </div>
  </div>

  <div class="contect ">
    <div class="py-4 my-3 ">
      <div class="row px-4 ">
        <div class="col-xl-6">
          <div class="d-flex justify-content-center align-items-center w-100">
            <p class="fw-bold font-titel ">ช่องทางการติดต่อ Social</p>
          </div>
          <div class="d-flex flex-column justify-content-center align-items-center w-100 mt-3">
            <a href="" class="fw-seibold font-detail text-decoration-none text-dark"><i class="bi bi-facebook"></i>&nbsp; &nbsp;facebook</a>
          </div>
          <div class="d-flex flex-column justify-content-center align-items-center w-100 mt-3">
            <a href="" class="fw-seibold font-detail text-decoration-none text-dark"><i class="bi bi-instagram"></i>&nbsp; &nbsp;instagram</a>
          </div>
          <div class="d-flex flex-column justify-content-center align-items-center w-100 mt-3">
            <a href="" class="fw-seibold font-detail text-decoration-none text-dark"><i class="bi bi-messenger">&nbsp; &nbsp;messenger</i></a>
          </div>
        </div>
        <div class="col-xl-6">

          <div class="d-flex justify-content-center align-items-center w-100">
            <p class="fw-bold font-titel">ช่องทางการติดต่อ Email</p>
          </div>
          <div class="d-flex justify-content-center align-items-center w-100 mt-3">
            <div class="box-email">
              <form action="" class="form_email" id="myform" method="post">
                <div class="msg"></div>
                <div class="d-flex justify-content-center align-items-center w-100">
                  <p class="fw-bold font-detail">Email : patiphonwongsee01@gmail.com</p>
                </div>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text font-detail ">หัวข้อ</span>
                  <input type="text" class="form-control" id="header" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="titel" placeholder="พิมพ์.." required>
                </div>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text font-detail" id="inputGroup-sizing-default">ชื่อ</span>
                  <input type="text" class="form-control" id="name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="name" placeholder="พิมพ์.." required>
                </div>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text font-detail" id="inputGroup-sizing-default">อีเมลผู้ส่ง</span>
                  <input type="email" class="form-control" id="email" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="email" placeholder="พิมพ์.." required>
                </div>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text font-detail">ข้อความ</span>
                  <textarea class="form-control" id="detail" aria-label="With textarea" name="message" placeholder="พิมพ์.."></textarea>
                </div>
                <button class="btn btn-dark mt-3 px-4 font-detail btn-submit" type="button" onclick="sendEmail()" value="Send an email">
                  ส่งอีเมล
                </button>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer_web">
    <p class="fw-bold mb-0 text-white ">&copy; footer restaurant & food web version 1.0.0</p>
  </div>

  <script src="add_framwork/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/slide.js"></script>
  <script src="assets/js/home.js"></script>

  <script type="text/javascript">
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
          success: function(response) {
            $('#myform')[0].reset();
            $('.msg').text("Message send successfully");
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
  </script>
</body>

</html>