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
    <div class="content-wrapper">

      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">รายงานสรุปผล</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                <li class="breadcrumb-item active">รายงานสรุปผล </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <?php
      date_default_timezone_set('Asia/Banhkok');
      $total_income_day = 10000;
      $total_order_day = 30;

      $total_income = 30000;
      $total_order = 300;
      $date_total1 = date("d-m-Y");
      $date_total2 = date("d-m-Y");
      ?>

      <section class="content ">
        <div class="container-fluid ">
          <div class="row  bg-secondary px-4 py-3 border-report">
            <div class="col-xl-6  fw-bold"><i class="ion ion-stats-bars pr-1 "></i> ยอดขายวันนี้</div>
            <div class="col-xl-6 mb-2">วันที่ &nbsp;<?= $date_total; ?></div>
            <div class="col-xl-6 font-five">รายได้ทั้งหมด</div>
            <div class="col-xl-6 mb-2 "><?= number_format($total_income_day); ?> <span> &nbsp;&nbsp;&nbsp; บาท </span> </div>
            <div class="col-xl-6 font-five">ออเดอร์ที่สำเร็จ</div>
            <div class="col-xl-6 mb-2"><?= number_format($total_order_day); ?> <span> &nbsp;&nbsp;&nbsp;ออเดอร์ </span></div>
          </div>

          <div class="d-flex justify-content-end align-items-center mt-4 ">
            <form action="" method="get">
              <label for="datetodate">เลือกช่วงเวลา</label>
              <input type="date" name="datetodate1" id="datePicker1" class="set-input bg-light" value="">
              <label for="to"> - </label>
              <input type="date" name="datetodate2" id="datePicker2" class="set-input bg-light" value="">
              <button type="submit" name="submit_date" class="mx-1 btn btn-outline-dark">submit</button>
            </form>
          </div>

          <div class="row  bg-secondary px-4 py-3 border-report">
            <div class="col-xl-12 mb-2 fw-bold"><i class="ion ion-pie-graph pr-1 "></i> ยอดขายโดยรวม</div>
            <div class="col-xl-6 font-five">รายได้ทั้งหมด</div>
            <div class="col-xl-6 mb-2 "><?= number_format($total_income); ?> <span> &nbsp;&nbsp;&nbsp; บาท </span> </div>
            <div class="col-xl-6 font-five">ออเดอร์ที่สำเร็จ</div>
            <div class="col-xl-6 mb-2"><?= number_format($total_order); ?> <span> &nbsp;&nbsp;&nbsp;ออเดอร์ </span></div>
            <div class="col-xl-6 font-five">ช่วงเวลา</div>
            <div class="col-xl-6 mb-2"><? echo $date_total1 . " - " . $date_total2; ?></div>
          </div>


          <div class="d-flex justify-content-start align-items-center mt-4 ">
            <form action="" method="get">
              <label for="select_type">เลือกประเภท</label>
              <select name="select_type" id="select_type" class="set-input bg-light">
                <option value="alltotal">เลือกทั้งหมด</option>
                <option value="food">อาหาร</option>
                <option value="drink">เครื่องดื่ม</option>
              </select>
            </form>
          </div>

        </div>
      </section>
    </div>

    <?php include('layout/footer.php') ?>
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>

  </div>

  <script>
    var date = new Date();
    var year = date.getFullYear();
    var month = String(date.getMonth() + 1).padStart(2, '0');
    var todayDate = String(date.getDate()).padStart(2, '0');
    var datePattern = todayDate + '-' + month + '-' + year;
    document.getElementById("datePicker").value = datePattern;
    // console.log(datePattern);
  </script>

  <?php include 'add_framwork/js.php' ?>
</body>

</html>