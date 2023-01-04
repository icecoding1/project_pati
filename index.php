<?php
require_once("connection/config.php");
ob_start();
session_start();
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$select = isset($_GET['select_type']) ? $_GET['select_type'] : "";
$text_search = isset($_GET['text_search']) ? $_GET['text_search'] : "";
$lsit_type = isset($_GET['input_list_type_article']) ? $_GET['input_list_type_article'] : "";
$_SESSION['response_select'] =  $select;
$response_select = $_SESSION['response_select'];
$_SESSION['response_text_search'] =  $text_search;
$response_text_search = $_SESSION['response_text_search'];
$sql = "";

if ($text_search == "" && $select == "") {
  $sql = "SELECT * FROM table_listfood";
} else if ($text_search == "" && $select == "ประเภททั้งหมด") {
  $sql = "SELECT * FROM table_listfood";
} else if ($text_search != "" && $select == "") {
  $sql = "SELECT * FROM table_listfood WHERE  name LIKE '%$text_search%'  OR  type_food LIKE '%$text_search%' OR number_menu LIKE '%$text_search%' ";
} else if ($select != "" && $text_search == "") {
  $sql = "SELECT * FROM table_listfood WHERE    type_food LIKE '%$select%' ";
} else if ($text_search != "" && $select != "ประเภททั้งหมด") {
  $sql = "SELECT * FROM table_listfood WHERE type_food LIKE '%$select%' AND  name LIKE '%$text_search%'  OR  type_food LIKE '%$text_search%' OR number_menu LIKE '%$text_search%'   ";
} else if ($select == "ประเภททั้งหมด" &&   $text_search != "") {
  $sql = "SELECT * FROM table_listfood WHERE  name LIKE '%$text_search%'  OR  type_food LIKE '%$text_search%' OR number_menu LIKE '%$text_search%' ";
}

$result = $obj->query($sql);
date_default_timezone_set("Asia/Bangkok");
$date = date("dmYHis");
$date = (int)$date;


$sql_select = "SELECT * FROM structure_management";
$select_str = $obj->query($sql_select);
$result_str = $select_str->fetch();
$image_decode = json_decode($result_str['slide_image']);
$image_slide_encode = json_decode(json_encode($image_decode), true);
$count_slide = count($image_slide_encode);
// print_r($image_slide_encode);


//article
if ($lsit_type) {
  $sql_article = "SELECT * FROM  table_article WHERE 	type =  '$lsit_type' LIMIT  10";
} else {
  $sql_article = "SELECT * FROM  table_article LIMIT  10";
}
$select_article =  $obj->prepare($sql_article);
$select_article->execute();
$rows = $select_article->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $result_str['name_shop'] ?></title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/management.css">
  <link rel="stylesheet" href="assets/css/slide.css">
  <link rel="icon" href="image_myweb/img_structure_management/<?= $result_str['logo_shop'] ?>">
  <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
  <?php include 'add_framwork/css.php' ?>
</head>

<body class="bg-home">

  <input type="hidden" name="page_output" id="page_output" value="<?= $page ?>">
  <input type="hidden" name="count_slide" id="count_slide" value="<?= $count_slide ?>">

  <div class="header_nav">
    <div class="navbar">
      <a href="index.php" class="mr-auto">
        <img src="image_myweb/img_structure_management/<?= $result_str['logo_shop'] ?>" alt="logo">
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
          <a href="home.php" class="login">เข้าสู่ระบบ</a>
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
            <p id="nav_respone1" class="navbtn1">หน้าเเรก</p>
          </li>
          <li>
            <p id="nav_respone2" class="navbtn2">ติดต่อ</p>
          </li>
          <li>
            <p href="" id="nav_respone3" class="navbtn3">รายการอาหาร</p>
          </li>
          <li>
            <a href="home.php" class="login">เข้าสู่ระบบ</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="index">
    <div class="slider">
      <div class="slides">

        <!--radio buttons start-->
        <?php for ($i = 0; $i < $count_slide; $i++) {
          $ii = $i; ?>
          <input type="radio" name="radio-btn" id="radio<?= $ii + 1 ?>">
        <?php } ?>

        <!-- image -->
        <?php for ($i = 0; $i < $count_slide; $i++) { ?>
          <?php if ($i == 0) { ?>
            <div class="slide first">
              <img src="image_myweb/img_structure_management/<?= $image_slide_encode[$i]['name'] ?>">
            </div>
          <?php } else { ?>
            <div class="slide">
              <img src="image_myweb/img_structure_management/<?= $image_slide_encode[$i]['name'] ?>">
            </div>
        <?php }
        } ?>

        <!-- moc btn -->
        <div class="navigation-auto">
          <?php for ($i = 0; $i < $count_slide; $i++) {
            $ii = $i; ?>
            <div class="auto-btn<?= $ii + 1 ?>"></div>
          <?php } ?>
        </div>

        <!--automatic navigation end-->
        <div class="navigation-manual">
          <?php for ($i = 0; $i < $count_slide; $i++) {
            $ii = $i; ?>
            <label for="radio<?= $ii + 1 ?>" class="manual-btn"></label>
          <?php } ?>
        </div>

        <div class="d-flex justify-content-center align-items-center div_btn">
          <button class="btn btn btn-light border border-dark rounded-5 mx-2 px-2 fw-bold  buttonnav2">ช่องทางการติดต่อ</button>
          <button class="btn btn btn-light border border-dark rounded-5 mx-2 px-3 fw-bold buttonnav3">รายการอาหาร</button>
        </div>

      </div>
    </div>

    <div class="py-4 my-3 set_content">
      <div class="d-flex justify-content-between">
        <p class="mb-0 mt-3 fw-bold fs-3 mx-4">บทความ</p>
        <form method="GET" class="mb-0 mt-3 fw-bold fs-3 mx-4">
          <!-- <input list="list_type_article" id="input_list_type_article" name="input_list_type_article"> -->
          <div class="input-group mb-3">
            <input type="hidden" name="page" value="1">
            <input type="text" class="form-control" list="list_type_article" id="input_list_type_article" name="input_list_type_article" value="<?= $lsit_type ?>">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"> <i class="bi bi-search"></i></button>
          </div>
          <datalist id="list_type_article">\
            <?php foreach ($rows  as $row) { ?>
              <option value="<?= $row['type'] ?>">
              <?php } ?>
          </datalist>
        </form>
      </div>

      <div class="content_index ">
        <?php if (empty($rows)) { ?>
          <p class="text-center fs-5">ยังไม่มีบทความ!!</p>
        <?php } else { ?>
          <?php foreach ($rows  as $row) {
            $txt = substr($row['detail'], 0, 250);
          ?>
            <div class="card mb-3 in_content_index">
              <div class="row g-0 content">
                <div class="col-md-12 detail_box">
                  <div class="card-body detail">
                    <h5 class="card-title titel"><?= $row['header'] ?></h5>
                    <p class="card-text text_detail"><?= $txt  ?> <a href="index_article.php?id=<?= $row['id'] ?>" class="fw-bold fs-5">see more....</a></p>
                    <p class="card-text"><small class="text-muted">Last updated <?= date("d-m-Y H:i:s", strtotime($row['date_created'])) ?> ago.</small></p>
                  </div>
                </div>
              </div>
            </div>
        <?php  }
        } ?>
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
          <div class="d-flex flex-column justify-content-center align-items-center w-100 mt-3 mb-3">
            <a href="" class="fw-seibold font-detail text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i>&nbsp; &nbsp;061-xxx-xxxx</i></a>
          </div>
        </div>
        <div class="col-xl-6">

          <div class="d-flex justify-content-center align-items-center w-100 mt-3">
            <p class="fw-bold font-titel">ช่องทางการติดต่อ Email</p>
          </div>
          <div class="d-flex justify-content-center align-items-center w-100 mt-3">
            <div class="box-email">
              <form action="" class="form_email" id="myform" method="post">
                <div class="content-show">
                  <p class="msg text-detail fw-bold">edbedgnh</p>
                  <i class="bi bi-x-lg" id="closr_x"></i>
                </div>
                <div class="d-flex justify-content-center align-items-center w-100">
                  <p class="fw-bold font-detail">Email : patiphonwongsee01@gmail.com</p>
                </div>
                <div class="input-group input-group-lg mb-3">
                  <span class="input-group-text font-detail ">หัวข้อ</span>
                  <input type="text" class="form-control" id="header" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="titel" readonly value="contect restaurant">
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

  <div class="menu_list_home">

    <div class="d-flex align-items-center flex-column mt-2">
      <p class="font-titel fw-bold">รายการอาหาร</p>
      <form method="get" id="form_search">
        <input type="hidden" name="page" value="3">
        <div class="form-search">
          <select class="form-select m-2 select-input select_type" onChange=selectChange(this.value) name="select_type">
            <?php
            $table_typefood = "SELECT * FROM  table_typefood";
            $result_typefood = $obj->query($table_typefood); ?>

            <?php if ($response_select == "" || $response_select == "ประเภททั้งหมด") {   ?>
              <option disabled>เลือกประเภท</option>
              <option selected>ประเภททั้งหมด</option>
              <?php while ($types = $result_typefood->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $types['type'] ?>"><?= $types['type'] ?></option>
              <?php }
            } else { ?>
              <option disabled>เลือกประเภท</option>
              <option>ประเภททั้งหมด</option>
              <?php while ($types = $result_typefood->fetch(PDO::FETCH_ASSOC)) { ?>
                <option value="<?= $types['type'] ?>" <?= $response_select == $types['type'] ? 'selected' : '' ?>><?= $types['type'] ?></option>
            <?php  }
            }
            ?>
          </select>
          <div class="d-flex gap-2">
            <div class="input-group  inputform-search">
              <span class="input-group-text" id="inputGroup-sizing-default">ค้นหารายการ</span>
              <?php if ($response_text_search == "") { ?>
                <input type="text" class="form-control" name="text_search">
              <?php } else { ?>
                <input type="text" class="form-control" name="text_search" value="<?= $response_text_search ?>">
              <?php } ?>
              <button class="btn btn-secondary" type="submit"><i class="bi bi-search"></i></button>
            </div>
            <a href="index.php?page=4" class="btn btn-dark <?= $page == 3 ? '' : 'd-none' ?>">รายการทั้งหมด</a>
          </div>
        </div>
      </form>
    </div>

    <div class="menu_introduce">
      <p class="font-titel mx-3 px-3 mb-1 fw-bold ">เมนูเเนะนำ</p>
      <div class="content_menu_list_home ">
        <div class="menu_intro">

          <?php

          $sql_check_intro = "SELECT * FROM table_listfood WHERE intro_check = 'yes'";
          $response_check_intro = $obj->query($sql_check_intro);
          $row_check_intro = $response_check_intro->fetchAll(PDO::FETCH_OBJ);


          foreach ($row_check_intro as $row_check_intro) { ?>
            <div class="content_menu position-relative">
              <?php if (strpos($row_check_intro->image, ".")) { ?>
                <img src="image_myweb/img_product/<?= $row_check_intro->image; ?>" alt="img" class="img_menu">
              <?php } else { ?>
                <img src="assets/img/empty_bg.jpeg" alt="img" class="img_menu">
              <?php } ?>
              <div class="detail_bottom">
                <p class="font_detail">ชื่อ : <?= $row_check_intro->name; ?></p>
                <p class="font_detail">ราคา : <?= $row_check_intro->price_food . " ฿"; ?></p>
              </div>
              <div class="ribbon-wrapper">
                <div class="ribbon bg-primary fw-bold">
                  เเนะนำ
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>

    <div class="menu_new">
      <p class="font-titel mx-3 px-3 mb-1 fw-bold ">เมนูใหม่</p>
      <div class="content_menu_list_home ">
        <div class="menu_intro">

          <?php

          $sql_menu_new = "SELECT * FROM table_listfood";
          $response_menu_new = $obj->query($sql_menu_new);
          $row_menu_new = $response_menu_new->fetchAll(PDO::FETCH_OBJ);

          foreach ($row_menu_new as  $row_menu_new) {
            $check_date_menu_new = (int)$row_menu_new->new_menu;
            $result_check_date = $date - $check_date_menu_new;
            $value_dateCount = 5000000000000;

            if ($result_check_date < $value_dateCount) { ?>
              <div class="content_menu position-relative">
                <?php if (strpos($row_menu_new->image, ".")) { ?>
                  <img src="image_myweb/img_product/<?= $row_menu_new->image; ?>" alt="img" class="img_menu">
                <?php } else { ?>
                  <img src="assets/img/empty_bg.jpeg" alt="img" class="img_menu">
                <?php } ?>
                <div class="detail_bottom">
                  <p class="font_detail">ชื่อ : <?= $row_menu_new->name; ?></p>
                  <p class="font_detail">ราคา : <?= $row_menu_new->price_food . " ฿"; ?></p>
                </div>
                <div class="ribbon-wrapper">
                  <div class="ribbon bg-success fw-bold">
                    ใหม่
                  </div>
                </div>
              </div>
          <?php }
          } ?>
        </div>
      </div>
    </div>

    <p class="font-titel mx-3 px-3 mb-1 mt-2 fw-bold">เมนูทั้งหมด</p>
    <?php
    $row = $result->fetchAll(PDO::FETCH_OBJ);
    $count = Count($row);
    if ($count > 6) { ?>
      <div class="all_menu_home">
        <?php foreach ($row as $row) { ?>
          <div class="content_menu position-relative">
            <?php if (strpos($row->image, ".")) { ?>
              <img src="image_myweb/img_product/<?= $row->image; ?>" alt="img" class="img_menu">
            <?php } else { ?>
              <img src="assets/img/empty_bg.jpeg" alt="img" class="img_menu">
            <?php } ?>
            <div class="detail_bottom">
              <p class="font_detail">ชื่อ : <?= $row->name; ?></p>
              <p class="font_detail">ราคา : <?= $row->price_food . " ฿"; ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php  } else if ($count < 6 && $count > 0) { ?>
      <div class="all_menu_home_set">
        <?php foreach ($row as $row) {  ?>
          <div class="content_menu position-relative">
            <?php if (strpos($row->image, ".")) { ?>
              <img src="image_myweb/img_product/<?= $row->image; ?>" alt="img" class="img_menu">
            <?php } else { ?>
              <img src="assets/img/empty_bg.jpeg" alt="img" class="img_menu">
            <?php } ?>
            <div class="detail_bottom">
              <p class="font_detail">ชื่อ : <?= $row->name ?></p>
              <p class="font_detail">ราคา : <?= $row->price_food . " ฿"; ?></p>
            </div>
          </div>
        <?php } ?>
      </div>
    <?php  } else if ($count == 0) { ?>
      <div class="d-flex justify-content-center align-items-center w-100  my-4 ">
        <p class="text-danger fw-bold fs-2">❗❗ ไม่พบข้อมูล</p>
      </div>
    <?php } ?>

  </div>

  <div class="footer_web">
    <p class="fw-bold mb-0 text-white ">&copy; footer restaurant & food web version 1.0.0</p>
  </div>


  <script src="add_framwork/jquery.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/slide.js"></script>
  <script src="assets/js/home.js" type="text/javascript"></script>
</body>

</html>