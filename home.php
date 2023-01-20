<?php
session_start();
ob_start();
require_once("connection/config.php");
$name_web = "ระบบจัดการร้านอาหาร";

include("check_session.php");
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
  <div class="wrapper">
    <?php include('layout/preloader.php') ?>
    <?php include('layout/header.php') ?>
    <?php include('layout/slidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper set-content">
      <section class="content">
        <div class="container-fluid ">
          <div class="d-flex justify-content-center align-items-center">
            <p class="fs-1 fw-bold p-3">
              <?= $_SESSION["text_show"] ?>
            </p>
          </div>
        </div>
      </section>

      <?php include('layout/footer.php') ?>
    </div>



  </div>

  <?php include 'add_framwork/js.php' ?>
</body>

</html>