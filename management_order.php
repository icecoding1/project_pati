<?php $name_web = "ระบบจัดการร้านอาหาร";
ob_start();
session_start();
require_once("connection/config.php");
$page_nav = 2;

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
      <div class="content-wrapper set-content">

        <div class="content-header mx-3">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">จัดการออเดอร์</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                  <li class="breadcrumb-item active">จัดการออเดอร์</li>
                </ol>
              </div>
            </div>
          </div>
        </div>



        <section class="content p-3 ">
          <div class="container-fluid ">

            <div class="row   py-3 border-report">
              <div class="col-12 ">
                <div class="card card-primary card-tabs">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                      <li class="pt-2 px-3">
                        <h3 class="card-title">จัดการออเดอร์</h3>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-two-neworder-teb" data-toggle="pill" href="#custom-tabs-two-neworder" role="tab" aria-controls="custom-tabs-two-neworder" aria-selected="true">ออเดอร์ใหม่</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-progress-tab" data-toggle="pill" href="#custom-tabs-two-progress" role="tab" aria-controls="custom-tabs-two-progress" aria-selected="false">กำลังดำเนินการ</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-two-success-tab" data-toggle="pill" href="#custom-tabs-two-success" role="tab" aria-controls="custom-tabs-two-success" aria-selected="false">เสร็จสิ้น</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body p-2">
                    <div class="tab-content" id="custom-tabs-two-tabContent-order">
                      <div class="tab-pane  fade show active" id="custom-tabs-two-neworder" role="tabpanel" aria-labelledby="custom-tabs-two-neworder-tab">
                        <div class="row">
                          <div class="col-12">
                            <div class="card-header ">
                              <div class="w-100 d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="card-title mx-2">ออเดอร์ใหม่</h3>

                                <div class="card-tools mt-2">
                                  <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table table-head-fixed text-nowrap">
                                <thead>
                                  <tr>
                                    <th>เลขที่ออเดอร์</th>
                                    <th>วันเวลา</th>
                                    <th>โต๊ะ</th>
                                    <th>สถานะ</th>
                                    <th>รายการ</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $sql1 = "SELECT * FROM table_order WHERE status = 1";
                                  $result  = $obj->query($sql1);
                                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                    <tr>
                                      <td nowrap><?= $row['number_order'] ?></td>
                                      <td nowrap><?= $row['create_date'] ?></td>
                                      <td nowrap>โต๊ะ <?= $row['table_user'] ?></td>
                                      <td nowrap><span class="text-danger fw-semibold">รอการยืนยัน</span></td>
                                      <td nowrap> <a href="order_new.php?page=1&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">รายละเอียด </a></td>
                                    </tr>
                                  <?php  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-two-progress" role="tabpanel" aria-labelledby="custom-tabs-two-progress-tab">
                        <div class="row">
                          <div class="col-12">
                            <div class="card-header">
                              <div class="w-100 d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="card-title mx-2">ออเดอร์กำลังดำเนินการ</h3>

                                <div class="card-tools  mt-2">
                                  <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table table-head-fixed text-nowrap">
                                <thead>
                                  <tr>
                                    <th>เลขที่ออเดอร์</th>
                                    <th>วันเวลา</th>
                                    <th>โต๊ะ</th>
                                    <th>สถานะ</th>
                                    <th>รายการ</th>
                                  </tr>
                                </thead>

                                <tbody>
                                  <?php
                                  $sql2 = "SELECT * FROM table_order WHERE status = 2";
                                  $result2  = $obj->query($sql2);
                                  while ($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                    <tr>
                                      <td nowrap><?= $row['number_order'] ?></td>
                                      <td nowrap><?= $row['create_date'] ?></td>
                                      <td nowrap>โต๊ะ <?= $row['table_user'] ?></td>
                                      <td nowrap><span class="text-warning fw-semibold">ยืนยันออเดอร์เเล้ว</span></td>
                                      <td nowrap> <a href="order_new.php?page=2&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">รายละเอียด </a></td>
                                    </tr>
                                  <?php  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="custom-tabs-two-success" role="tabpanel" aria-labelledby="custom-tabs-two-success-tab">
                        <div class="row">
                          <div class="col-12">
                            <div class="card-header">
                              <div class="w-100 d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="card-title mx-2">ออเดอร์เสร็จสิ้น</h3>

                                <div class="card-tools  mt-2">
                                  <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                    <div class="input-group-append">
                                      <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="card-body table-responsive p-0" style="height: 300px;">
                              <table class="table table-head-fixed text-nowrap">
                                <thead>
                                  <tr>
                                    <th>เลขที่ออเดอร์</th>
                                    <th>วันเวลา</th>
                                    <th>โต๊ะ</th>
                                    <th>สถานะ</th>
                                    <th>รายการ</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $sql3 = "SELECT * FROM table_order WHERE status = 3";
                                  $result3  = $obj->query($sql3);
                                  while ($row = $result3->fetch(PDO::FETCH_ASSOC)) {
                                  ?>
                                    <tr>
                                      <td nowrap><?= $row['number_order'] ?></td>
                                      <td nowrap><?= $row['create_date'] ?></td>
                                      <td nowrap>โต๊ะ <?= $row['table_user'] ?></td>
                                      <td nowrap><span class="text-success fw-semibold">จ่ายเงินเรียบร้อย</span></td>
                                      <td nowrap> <a href="order_new.php?page=3&id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">รายละเอียด </a></td>
                                    </tr>
                                  <?php  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>


    </div>

    <?php include 'add_framwork/js.php' ?>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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