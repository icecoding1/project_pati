<?php
ob_start();
session_start();
$name_web = "ระบบจัดการร้านอาหาร";
require_once("connection/config.php");
$page_nav = 2;
include("check_session.php");
$refresh = isset($_GET['refresh']) ? $_GET['refresh'] : 1;
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
  <input type="number" id="refresh" class="d-none" value="<?= $refresh ?>">

  <div class="wrapper">
    <?php include('layout/preloader.php') ?>
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
                      <a class="nav-link active1 " id="btn_conntent_taborder1" href="#">ออเดอร์ใหม่</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active2" id="btn_conntent_taborder2" href="#">กำลังดำเนินการ</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active3" id="btn_conntent_taborder3" href="#">เสร็จสิ้น</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body p-2">
                  <div class="tab-content">
                    <div class="" id="conntent_taborder1">
                      <div class="row">
                        <div class="col-12">
                          <div class="card-header ">
                            <div class="w-100 d-flex justify-content-between align-items-center flex-wrap py-2">
                              <h3 class="card-title mx-2">ออเดอร์ใหม่</h3>
                            </div>
                          </div>
                          <div class="card-body table-responsive p-0" style="height: 400px;">
                            <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th>เลขที่ออเดอร์</th>
                                  <th>วันเวลา</th>
                                  <th>โต๊ะ</th>
                                  <th>ผู้รับรายการ</th>
                                  <th>สถานะ</th>
                                  <th>รายการ</th>
                                </tr>
                              </thead>
                              <tbody id="table_ordernew1">

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="" id="conntent_taborder2">
                      <div class="row">
                        <div class="col-12">
                          <div class="card-header">
                            <div class="w-100 d-flex justify-content-between align-items-center flex-wrap py-2">
                              <h3 class="card-title mx-2">ออเดอร์กำลังดำเนินการ</h3>
                            </div>
                          </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height: 400px;">
                          <table class="table table-head-fixed text-nowrap">
                            <thead>
                              <tr>
                                <th>เลขที่ออเดอร์</th>
                                <th>วันเวลา</th>
                                <th>โต๊ะ</th>
                                <th>ผู้ยืนยันรายการ</th>
                                <th>สถานะ</th>
                                <th>รายการ</th>
                              </tr>
                            </thead>

                            <tbody id="table_ordernew2">

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="" id="conntent_taborder3">
                      <div class="row">
                        <div class="col-12">
                          <div class="card-header">
                            <div class="w-100 d-flex justify-content-between align-items-center flex-wrap">
                              <h3 class="card-title mx-2">ออเดอร์เสร็จสิ้น</h3>

                              <form class="card-tools  mt-2 d-flex justify-content-center align-items-center flex-wrap" id="form_search">
                                <button typr="button" class="btn btn-dark px-3 py-1 mx-3" onclick="showAll_order()">รายการทั้งหมด</button>
                                <div class="input-group input-group-sm" style="width:250px;">
                                  <input type="text" name="text_search_order" id="text_search_order" class="form-control float-right" placeholder="Search">
                                  <div class="input-group-append">
                                    <button type="submit" class="btn btn-default" id="btn_search_order">
                                      <i class="fas fa-search"></i>
                                    </button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <div class="card-body table-responsive p-0" style="height: 400px;">
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
                          </div>
                          <tbody id="table_ordernew3">

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
      </section>
    </div>
  </div>


  <div class="modal fade" id="show_dom" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">โปรดอ่านก่อน!!</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close_modal"></button>
        </div>
        <div class="modal-body">
          ทุกครั้งที่เข้ามาในหน้าจัดการออเดอร์ ให้ตอบต่อกับ หน้า web browser ทุกครั้งเพื่อเป็นเปิดเสียงการเเจ้งเตือน ที่ รายการสั่งเข้ามา
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>


  <!-- notification -->
  <audio controls id="notification" style="display:none;">
    <source src="assets/audio/notification.mp3" type="audio/mp3">
  </audio>


  <?php include 'add_framwork/js.php' ?>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/management_order.js"></script>
</body>

</html>