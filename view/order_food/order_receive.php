<?php
$name_web = "สั่งออเดอร์";
$count_order = isset($_GET['count_order']) ? $_GET['count_order'] : 0;
$table = $_POST['select_table'];
$food = "ขนมปัง กาเเฟ";

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $name_web;  ?></title>
  <?php include '../../add_framwork/css.php' ?>
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
      <a href="../../index1.php" class="btn btn-light px-4 m-2 ">กลับหน้าหลัก</a>
      <a href="order_food.php" class="btn btn-light px-4 m-2">กลับ</a>
    </div>
  </header>

  <div class="header-content my-3 mx-3">
    <p class="mb-0 fw-bold fs-3 ">รายการเมนู</p>

    <div class=" p-3 ">
      <select class="form-select   m-2 select-input" aria-label=".form-select example">
        <option selected disabled>เลือกประเภท</option>
        <option value="1">อาหาร</option>
        <option value="2">เครื่องดื่ม</option>
        <option value="3">เเอลกอฮอล์</option>
      </select>
      <div class="input-group  m-2 search-input">
        <input type="text" class="form-control" placeholder="ค้นหารายการ">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2"> <i class="bi bi-search"></i></button>
      </div>
    </div>

    <p class="mb-0 fw-semibold fs-5 m-2">โต๊ะ : <?= $table ?></p>
  </div>

  <div class="list-menu-order">
    <?php foreach (range(1, 10)  as $value) { ?>
      <div class="content-menu">
        <div>
          <img src="../../assets/img/coffee.jpg" alt="food_lists" class="img_menu">
        </div>
        <div class="content-menu-bottom">
          <div>
            <p class="mb-0"><?= $food ?></p>
            <p class="mb-0">ราคา : <span>75 ฿</span></p>
          </div>
          <button class="btn btn-primary p-1 px-3 mt-1 " id="add_order">+ เพิ่ม</button>
        </div>
      </div>
    <?php } ?>
  </div>

  <!-- //ตะกร้าสินค้า -->
  <div class="brand">
    <div>
      <p class="fw-semibold text-count" id="count_order"><?= $count_order  ?> </p>
      <button type="button" class="shop_order">
        <img src="../../assets/icon/brand_order.svg" alt="brand" class="icon-brand">
      </button>
    </div>
  </div>


  <script src="../../add_framwork/jquery.js"></script>
  <?php include '../../add_framwork/js.php' ?>
  <script>
    $(document).ready(function() {

      $('.brand').hide();
      var count_order = $('#count_order');
      var count = 0;

      $('#add_order').click(function() {
        $('.brand').show(100);
        count++;
        count_order.text(count);
        // if (this) {
        //   <?php $count_order =  $count_order + 1; ?>
        //   console.log(<?= $count_order ?>);
        // }
      });

    });
  </script>

</body>

</html>