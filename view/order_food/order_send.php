<?php
$name_web = "สั่งออเดอร์";
$count_order = isset($_GET['count_order']) ? $_GET['count_order'] : 0;
$table = $_POST['select_table'];
$food = "ขนมปัง กาเเฟ";

ob_start();
session_start();
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {
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
      <a href="../../index.php" class="btn btn-light px-4 m-2 ">กลับหน้าหลัก</a>
      <a href="order_receive.php" class="btn btn-light px-4 m-2">กลับ</a>
    </div>
  </header>

  <div class="header-content my-3 mx-3">
    <p class="mb-0 fw-bold fs-3 ">รายการที่สั่ง</p>
    <p class="mb-0 fw-semibold fs-5 m-2">โต๊ะ : <?= $table ?></p>
    <p class="mb-0 fw-semibold fs-5 m-2">ราคารวม : <?= number_format(125, 2) . " ฿"; ?></p>
  </div>

  <div class="list-menu-order mb-3">
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
          <div>
            <button class="btn btn-primary p-1 px-3 mt-1 " id="add_order">+ เพิ่ม</button>
            <button class="btn btn-danger p-1 px-3 mt-1" id="add_order">ลบ</button>
          </div>
        </div>
        <p class="count mb-0 font-five">จำนวน : <span><?= $count_order ?></span></p>
      </div>
    <?php } ?>
  </div>

  <div class="send-to-manage">
    <div class="input-group m-2 ">
      <span class="input-group-text">โน๊ต</span>
      <textarea class="form-control note" aria-label="With textarea"></textarea>
    </div>
    <button class="btn btn-primary px-4 m-2  mt-2 ">
      ยืนยันคำสั่ง
    </button>
  </div>




  <script src="../../add_framwork/jquery.js"></script>
  <?php include '../../add_framwork/js.php' ?>

</body>

</html>

<?php } else {
echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('../../login.php');
}else {
location.assign('../../login.php');
}
</script>";
} ?>