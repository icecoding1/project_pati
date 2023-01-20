<?php
ob_start();
session_start();
$name_web = "สั่งออเดอร์";
require_once "../../connection/config.php";
include("check_session.php");
$count_order = isset($_GET['count_order']) ? $_GET['count_order'] : 0;
$_SESSION["session_table"] = isset($_SESSION["session_table"]) ? $_SESSION["session_table"] :  "คุณไม่ได้เลือกโต๊ะ";
$_SESSION["session_table"] = isset($_POST['select_table']) ? $_POST['select_table'] :  $_SESSION["session_table"];

$select = isset($_GET['select_type']) ? $_GET['select_type'] : "";
$text_search = isset($_GET['text_search']) ? $_GET['text_search'] : "";
$_SESSION['response_select'] =  $select;
$response_select = $_SESSION['response_select'];
$_SESSION['response_text_search'] =  $text_search;
$response_text_search = $_SESSION['response_text_search'];

$count = 0;
$_SESSION["count_order"] = isset($_SESSION["count_order"]) ? $_SESSION["count_order"] : 0;

if (isset($_SESSION['data']) != "") {
  $array = $_SESSION['data'];
  $count  = count($array) > 0  ?  count($array) : 0;
  $_SESSION["count_order"] = $count;
  // echo "<pre>";
  // print_r($array);
  // echo "</pre>";g 
  // echo count($array);
}


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
$row = $result->fetchAll(PDO::FETCH_OBJ);
$count = Count($row);
// echo  $sql;
// echo $text_search;
// echo $count . "<br/>";
// echo $response_select;
// print_r($count);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $name_web;  ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="../../assets/css/management.css">
  <link rel="icon" href="../../favicon/logo_favicon.png">
  <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="body-order ">


  <header class="header-nav-order">
    <div class="d-flex align-items-center">
      <img src="../../dist/img/food_pachaew_logo.png" alt="profile" class="mx-2 header-profile-order">
      <p class="mb-0 mx-2 text-white">สั่งออเดอร์</p>
    </div>
    <div>
      <a href="../../home.php" class="btn btn-light px-4 m-2 ">กลับหน้าหลัก</a>
      <a href="index.php" class="btn btn-light px-4 m-2">กลับ</a>
    </div>
  </header>

  <div class="header-content my-3 mx-3">
    <p class="mb-0 fw-bold fs-3 ">รายการเมนู</p>


    <div class=" p-3 ">
      <form method="get" id="form_search">
        <select class="form-select m-2 select-input select_type" onChange=selectChange(this.value) name="select_type">
          <?php
          include("../../connection/config2.php");
          $table_typefood = "SELECT * FROM  table_typefood";
          $result_typefood = $obj->query($table_typefood); ?>

          <?php if ($response_select == "") {   ?>
            <option selected disabled>เลือกประเภท</option>
            <option selected>ประเภททั้งหมด</option>
            <?php while ($types = $result_typefood->fetch(PDO::FETCH_ASSOC)) { ?>
              <option value="<?= $types['type'] ?>"><?= $types['type'] ?></option>
            <?php }
          } else  if ($response_select == "ประเภททั้งหมด") {   ?>
            <option disabled>เลือกประเภท</option>
            <option selected>ประเภททั้งหมด</option>
            <?php while ($types = $result_typefood->fetch(PDO::FETCH_ASSOC)) { ?>
              <option value="<?= $types['type'] ?>"><?= $types['type'] ?></option>
            <?php }
          } else { ?>
            <option disabled>เลือกประเภท</option>
            <option>ประเภททั้งหมด</option>
            <?php while ($types = $result_typefood->fetch(PDO::FETCH_ASSOC)) { ?>

              <?php if ($response_select == $types['type']) { ?>
                <option value="<?= $types['type'] ?>" selected><?= $types['type'] ?></option>
              <?php } else { ?>
                <option value="<?= $types['type'] ?>"><?= $types['type'] ?></option>
          <?php }
            }
          }
          ?>

        </select>
        <div class="input-group  m-2 search-input">
          <?php if ($response_text_search == "") { ?>
            <input type="text" class="form-control" placeholder="ค้นหารายการ" name="text_search">
          <?php } else { ?>
            <input type="text" class="form-control" placeholder="ค้นหารายการ" name="text_search" value="<?= $response_text_search ?>">
          <?php } ?>
          <button class="btn btn-outline-secondary" type="submit" id="button-addon2"> <i class="bi bi-search"></i></button>
        </div>
      </form>
    </div>


    <p class="mb-0 fw-semibold fs-5 m-2">โต๊ะ : <?= $_SESSION["session_table"] ?></p>
  </div>



  <?php if ($count > 6) { ?>
    <div class="list-menu-order ">
      <?php foreach ($row as $row) {  ?>
        <div class="content-menu">
          <div>
            <?php if (strpos($row->image, ".")) { ?>
              <img src="../../image_myweb/img_product/<?= $row->image ?>" alt="food_lists" class="img_menu">
            <?php } else { ?>
              <img src="../../assets/img/empty_bg.jpeg" alt="food_lists" class="img_menu">
            <?php } ?>
          </div>
          <div class="content-menu-bottom">
            <div>
              <p class="mb-0"><?= $row->name ?></p>
              <p class="mb-0">ราคา : <span><?= number_format($row->price_food, 2) . "  ฿" ?></span></p>
            </div>
            <?php if ($row->status == "offline") { ?>
              <button class="btn btn-danger p-1 px-3 mt-1 " disabled>หมด</button>
            <?php } else if ($row->status == "online") { ?>
              <button class="btn btn-primary p-1 px-3 mt-1 add_order" id="<?= $row->id ?>">+ เพิ่ม</button>
            <?php  } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php } else if ($count < 6 && $count > 0) { ?>
    <div class="list-menu-order-set ">
      <?php foreach ($row as $row) {  ?>
        <div class="content-menu">
          <div>
            <?php if (strpos($row->image, ".")) { ?>
              <img src="../../image_myweb/img_product/<?= $row->image ?>" alt="food_lists" class="img_menu">
            <?php } else { ?>
              <img src="../../assets/img/empty_bg.jpeg" alt="food_lists" class="img_menu">
            <?php } ?>
          </div>
          <div class="content-menu-bottom">
            <div>
              <p class="mb-0"><?= $row->name ?></p>
              <p class="mb-0">ราคา : <span><?= number_format($row->price_food, 2) . "  ฿" ?></span></p>
            </div>
            <?php if ($row->status == "offline") { ?>
              <button class="btn btn-danger p-1 px-3 mt-1 " disabled>หมด</button>
            <?php } else if ($row->status == "online") { ?>
              <button class="btn btn-primary p-1 px-3 mt-1 add_order" id="<?= $row->id ?>">+ เพิ่ม</button>
            <?php  } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  <?php  } else if ($count == 0) { ?>
    <div class="d-flex justify-content-center align-items-center w-100  my-4 ">
      <p class="text-danger fw-bold fs-2">❗❗ ไม่พบข้อมูล</p>
    </div>
  <?php } ?>



  <!-- //ตะกร้าสินค้า -->
  <div class="brand" onclick="order_send()">
    <div>
      <p class="fw-semibold text-count " id="count_order"><?= $_SESSION["count_order"] ?></p>
      <button type="button" class="shop_order">
        <img src="../../assets/icon/brand_order.svg" alt="brand" class="icon-brand">
      </button>
    </div>
  </div>


  <script src="../../add_framwork/jquery.js"></script>
  <script>
    $(document).ready(function() {


      var count_order = $('#count_order').text();
      console.log(count_order);
      if (count_order == 0) {
        $(".brand").hide();
      } else {
        $('.brand').show(100);
      }

      $(".add_order").click(function() {
        var mid = $(this).attr("id");
        console.log(mid);
        $.ajax({
          url: "set_session_order.php",
          method: "post",
          data: {
            id: mid
          },
          success: function(response) {
            location.reload();
            console.log(response);
          }
        });
      });

    });

    function selectChange(val) {
      document.getElementById("form_search").submit();
    }

    function order_send() {
      location.assign("order_send.php");
    }
  </script>

</body>

</html>