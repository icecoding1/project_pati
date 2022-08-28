<?php $name_web = "ระบบจัดการร้านอาหาร";

$id   = isset($_GET['id']) ? $_GET['id'] : '';
$page_nav = 2;

ob_start();
session_start();
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $name_web;  ?></title>

    <?php include 'add_framwork/css.php' ?>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <!-- page to web -->
    <input type="number" id="nav_page" value="<?= $page_nav  ?>" class="d-none">


    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center bg-dark">
        <img class="animation__shake" src="dist/img/food_pachaew_logo.png" alt="AdminLTELogo" height="80" width="80">
      </div>
      <?php include('layout/header.php') ?>
      <?php include('layout/slidebar.php') ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper ">
        <div class="content-header mx-3">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">จัดการออเดอร์เเละออกบิล</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="management_order.php">กลับ</a></li>
                  <li class="breadcrumb-item active">จัดการออเดอร์</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <section class="content p-3">
          <div class="container-fluid ">

            <div class="d-flex justify-content-end flex-wrap">
              <a href=""><button type="button" class="btn btn-dark m-1">ออกบิล</button></a>
              <a href="order_success.php?&id=<?= $id; ?>"><button type="button" class="btn btn-success m-1">เสร็จสิ้นออเดอร์</button></a>
              <button type="button" class="btn btn-primary m-1">เพิ่ม/เเก้ไข</button>
              <button type="button" class="btn btn-danger m-1">ลบ</button>
            </div>

            <div class="row my-3">
              <div class="col-md-4 mb-2">
                <div class="row fs-5">
                  <div class="col-md-5 font-five">เลขที่ออเดอร์</div>
                  <div class="col-md-5 mb-2">0000001</div>
                  <div class="col-md-5 font-five">เวลา</div>
                  <div class="col-md-5  mb-2">11-7-2014 | 12:00</div>
                  <div class="col-md-5 font-five">โต๊ะ </div>
                  <div class="col-md-5 mb-2">1</div>
                  <div class="col-md-5 font-five ">โน๊ตจากลูกค้า</div>
                  <div class="col-md-5">เอาไข่ดาวสุกๆ</div>
                </div>
              </div>

              <div class="col-md-8 bg-order-set fs-5 bg-light">

                <div class="row ">
                  <div class="d-flex justify-content-center align-items-center mb-2">รายการ</div>
                  <div class="row mb-2">
                    <div class="col-4">เมนู</div>
                    <div class="col-4">ประเภท</div>
                    <div class="col-4">ราคา(บาท)</div>
                  </div>

                  <div class="order-menu">
                    <div class="row">
                      <div class="col-4">ข้าวผัด</div>
                      <div class="col-4">อาหาร/ผัด</div>
                      <div class="col-4">40</div>
                    </div>
                    <div class="row">
                      <div class="col-4">ไข่ดาว</div>
                      <div class="col-4">อาหาร/ทอด</div>
                      <div class="col-4">5</div>
                    </div>
                  </div>


                  <div class="row fixed-footer-order p-3 ">
                    <div class="col-4">รวม</div>
                    <div class="col-8">45 <span>บาท</span> </div>
                  </div>


                </div>

              </div>
            </div>
          </div>
        </section>
      </div>

      <?php include('layout/footer.php') ?>
    </div>

    <?php include 'add_framwork/js.php' ?>
  </body>

  </html>

  <?php } else {

echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('login.php');
}else {
location.assign('login.php');
}
</script>";
} ?>