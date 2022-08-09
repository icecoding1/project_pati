<?php $name_web = "ระบบจัดการร้านอาหาร"; ?>

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
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center bg-dark">
      <img class="animation__shake" src="dist/img/food_pachaew_logo.png" alt="AdminLTELogo" height="80" width="80">
    </div>
    <?php include('layout/header.php') ?>
    <?php include('layout/slidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper ">
      <section class="content">
        <div class="container-fluid ">
          <div class="d-flex justify-content-center align-items-center">
            <p class="fs-1 fw-bold p-3">
              ขอให้พนักงานทุกท่านดูเเล เเละบริการลูกค้าเป็นอย่างดี😀🥰
            </p>
          </div>
        </div>
      </section>
    </div>



  </div>

  <?php include 'add_framwork/js.php' ?>
</body>

</html>