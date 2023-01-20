<?php
$name_web = "ระบบจัดการร้านอาหาร";
require_once("connection/config.php");

ob_start();
session_start();
include("check_session.php");

$page_nav = 8;
?>

<?php if ($_SESSION["session_status"] == "admin") { ?>
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
      <?php include('layout/header.php') ?>
      <?php include('layout/slidebar.php') ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper set-content">

        <div class="content-header mx-3">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"> <i class="bi bi-sliders"></i> คู่มือการใช้งาน</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                  <li class="breadcrumb-item active">คู่มือการใช้งาน </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <section class="content p-2">
          <div class="container-fluid ">

            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">คู่มือการใช้งาน</h3>
              </div>
              <div class="card-body  p-4 ">
                <div class="w-100">
                  <iframe width="100%" height="500" src="https://www.youtube.com/embed/-YDSN1VP0wk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
                <div class="my-3">
                  <p class="fw-bold">
                    คู่มือการใช้งาน เว็บไซต์จัดการร้านอาหารเเละบริการคำสั่งซื้อในเบื้องต้น
                  </p>
                  <li> 00:00 | เเนะนำการใช้งานสำหรับหน้า users</li>
                  <li>04:05 | การ login เข้าสู่ระบบ</li>
                  <li>04:34 | เเนะนำการใช้งานภาพรวมสำหรับจัดการร้านอาหาร</li>
                  <li> 05:40 | การจัดการรายการเมนู</li>
                  <li> 08:27 | การจัดการออเดอร์เเละการสั่ง</li>
                  <li> 13:03 | การใช้งานเเละดูข้อมูลหน้ารายงาน</li>
                  <li> 14:41 | การจัดการสมาชิกเเละข้อมูลส่วนตัว</li>
                  <li> 16:25 | การจัดการบทความ</li>
                  <li> 17:50 | การใช้งานหน้าตั่งค่า</li>
                  <li> 18:45 | outtrol</li>
                  </ul>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
        </section>

      </div>
    </div>

    <?php include 'add_framwork/js.php' ?>

  </body>

  </html>
<?php } ?>