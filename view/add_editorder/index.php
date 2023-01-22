<?php
ob_start();
session_start();
$name_web = "สั่งออเดอร์";
require_once "../../connection/config.php";
include("../../check_session.php");

if (isset($_SESSION['array_order']) == "") {
  echo "<script>window.history.back();</script>";
}

$count_order = isset($_GET['count_order']) ? $_GET['count_order'] : 0;
$select = isset($_GET['select_type']) ? $_GET['select_type'] : "";
$text_search = isset($_GET['text_search']) ? $_GET['text_search'] : "";
$_SESSION['response_select'] =  $select;
$response_select = $_SESSION['response_select'];
$_SESSION['response_text_search'] =  $text_search;
$response_text_search = $_SESSION['response_text_search'];



$array = "";
$countdata = 0;
$_SESSION['id_forupdate'] = isset($_GET['id']) ? $_GET['id'] : 0;
$id_forupdate = $_SESSION['id_forupdate'];
$_SESSION['check_update'] = true;

if (isset($_SESSION['array_order'])) {
  $array_order = $_SESSION['array_order'];
  $array2 = $_SESSION['array_order'];
  usort($array_order, function ($a, $b) {
    return $a['id'] - $b['id'];
  });
  $data = array_map("unserialize", array_unique(array_map("serialize", $array_order)));
  usort($data, function ($a, $b) {
    return $a['id'] - $b['id'];
  });
  $order = 1;
  $count_delete = 0;
  $total = 0;
  $count_products  = 0;


  $_SESSION["total_order_success"] =   count($array_order) > 0  ?  count($array_order) : 0;
  $count_order = isset($_SESSION["total_order_success"]) ? $_SESSION["total_order_success"] : 0;


  if (count($array_order) > 0) {
    for ($x = 0; $x < count($array_order); $x++) {
      $total += $array_order[$x]['price_food'];
      $_SESSION['total'] = $total;
    }
  } else {
    $total  = 0;
    $_SESSION['total'] = $total;
  }
}

// echo "<pre>";
// print_r($array_order);
// echo "</pre>";



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
      <p class="mb-0 mx-2 text-white">จัดการออเดอร์</p>
    </div>
    <div>
      <a href="../../order_new.php?page=2&id=<?= $id_forupdate; ?>" class="btn btn-light px-4 m-2 ">ยกเลิก</a>
      <a href="update_order.php" class="btn btn-light px-4 m-2">บันทึกข้อมูล</a>
    </div>
  </header>

  <div class="my-3 mx-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
      <p class=" fw-bold fs-4 mb-0 " style="margin-right:10px;">รายการอาหารของฉัน</p>
      <div class="d-flex  align-items-center flex-wrap">
        <p class="mb-0 mx-1"><?= "หมายเลขออเดอร์ : " . $_SESSION['number_order']; ?></p>
        <p class="mb-0 mx-1"><?= " | จำนวนรายการ : " . $count_order; ?></p>
        <p class="mb-0 mx-1"><?= " | ราคารวม : " . $total; ?></p>
      </div>
    </div>

    <div class="card-body table-responsive p-0" style="height: 300px;">
      <table class="table table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th>ลำดับ</th>
            <th>ชื่อ</th>
            <th>ประเภท</th>
            <th>จำนวน</th>
            <th>ราคา</th>
            <th>ราคารวม</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php for ($i  = 0; $i < count($data); $i++) {
            $id_for1 = $data[$i]['id'];
            for ($k  = 0; $k < count($array2); $k++) {
              $id_for2 = $array2[$k]['id'];
              if ($id_for1 ==  $id_for2) {
                $count_products  += $array2[$k]['count'];
                $data[$i]['count'] =  $count_products;
              }
            }
            $data[$i]['priceAll'] =  $data[$i]['price_food'] * $count_products;
            $count_delete += $data[$i]['count'];
          ?>
            <tr>
              <td><?= $order++ ?></td>
              <td><?= $data[$i]['name'] ?></td>
              <td><?= $data[$i]['type'] ?></td>
              <td><?= $data[$i]['count'] ?></td>
              <td><?= $data[$i]['price_food'] ?></td>
              <td><?= $data[$i]['priceAll'] ?></td>
              <td class="d-flex- justify-content-center" align="right">
                <button class="btn btn-primary p-1 px-3 mt-1 mx-1 add_order" id="<?= $data[$i]['id'] ?>">+ เพิ่ม</button>
                <button class="btn btn-danger p-1 px-3 mt-1 mx-1 delete_order" id="<?= $count_delete - 1  ?>">ลบ</button>
              </td>
            </tr>
          <?php
            $count_products = 0;
          }
          $_SESSION['update_order'] = $data;
          $_SESSION['update_orderAll'] = $array_order;
          ?>
        </tbody>
      </table>
    </div>

  </div>


  <div class="header-content my-3 mx-3">
    <p class="mb-0 fw-bold fs-3 ">รายการเมนูที่จะเพิ่ม</p>
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

  <script src="../../add_framwork/jquery.js"></script>
  <script>
    $(document).ready(function() {
      $(".add_order").click(function() {
        var mid = $(this).attr("id");
        console.log(mid);
        $.ajax({
          url: "set_session.php",
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

      $(".delete_order").click(function(e) {
        e.preventDefault();
        var mid = $(this).attr("id");
        console.log(mid);

        $.ajax({
          url: "delete_order.php",
          method: "post",
          data: {
            id: mid
          },
          success: function(response) {
            console.log(response);
            location.reload();
          }
        });
      });

    });

    function selectChange(val) {
      document.getElementById("form_search").submit();
    }

    // function order_send() {
    //   location.assign("order_send.php");
    // }
  </script>

</body>

</html>