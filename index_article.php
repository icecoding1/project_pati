<?php
require_once("connection/config.php");
ob_start();
session_start();
$id = isset($_GET['id']) ? $_GET['id'] : header('location:index.php');
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$sql = "SELECT * FROM  table_article WHERE id = '$id'";
$select =  $obj->prepare($sql);
$select->execute();
$rows = $select->fetch();


$sql_select = "SELECT * FROM structure_management";
$select_str = $obj->query($sql_select);
$result_str = $select_str->fetch();
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


  <div class="header_nav">
    <div class="navbar">
      <a href="index.php" class="mr-auto">
        <img src="image_myweb/img_structure_management/<?= $result_str['logo_shop'] ?>" alt="logo">
      </a>
      <ul>
        <li>
          <a href="index.php?page=1" id="nav1">หน้าเเรก</a>
          <span id="span">
          </span>
        </li>
        <li>
          <a href="index.php?page=2" id="nav2">ติดต่อ</a>
        </li>
        <li>
          <a href="index.php?page=3" id=" nav3">รายการอาหาร</a>
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
            <a href="index.php?page=1" id="nav_respone1" class="navbtn1">หน้าเเรก</a>
          </li>
          <li>
            <a href="index.php?page=2" id="nav_respone2" class="navbtn2">ติดต่อ</a>
          </li>
          <li>
            <a href="index.php?page=3" id="nav_respone3" class="navbtn3">รายการอาหาร</a>
          </li>
          <li>
            <a href="home.php" class="login">เข้าสู่ระบบ</a>
          </li>
        </ul>
      </div>
    </div>
  </div>


  <div class="p-4">
    <div class="container-fluid ">
      <a href="index.php" class="text-end text-decoration-underline text-black fs-5 mb-3">กลับ</a>
      <div class="card ">
        <div class="card-header">
          <h3 class="card-title">บทความ</h3>
        </div>
        <div class="card-body  p-4 ">
          <form class="row" method="POST" enctype="multipart/form-data" id="form_update_article">
            <p class="col-12 mb-0 fw-bold">เรื่อง</p>
            <p class="col-12 mb-4 "><?= $rows['header'] ?></p>
            <p class="col-12 mb-0 fw-bold">ประเภทบทความ</p>
            <p class="col-12 mb-4 "><?= $rows['type'] ?></p>
            <p class=" col-12 mb-0 fw-bold">เนื้อหา</p>
            <div class="col-12 p-2 mb-4">
              <?= $rows['detail'] ?>
            </div>
            <div class="col-12 text-end">
              <small class="text-muted">Last updated <?= date("d-m-Y H:i:s", strtotime($rows['date_created'])) ?> ago.</small>
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>

    </div>
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