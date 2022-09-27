<?php
require_once("connection/config.php");
$name_web = "ระบบจัดการร้านอาหาร";
$page_nav = 1;

ob_start();
session_start();
if (isset($_SESSION["session_username"]) &&  isset($_SESSION["session_password"])) {

  date_default_timezone_set("Asia/Bangkok");
  $date_now = date("Y-m-d");
  $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : false;
  $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : false;



?>
  <?php if ($_SESSION["session_status"] == "admin" || $_SESSION["session_status"] == "cashier") { ?>
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
        <!-- <div class="preloader flex-column justify-content-center align-items-center bg-dark">
          <img class="animation__shake" src="dist/img/food_pachaew_logo.png" alt="AdminLTELogo" height="80" width="80">
        </div> -->
        <?php include('layout/header.php') ?>
        <?php include('layout/slidebar.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper set-content">


          <div class="content-header mx-3">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0">รายงานสรุปผล</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active">รายงานสรุปผล </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <section class="content p-3">
            <div class="container-fluid ">
              <?php
              $date_oneday = date("Y-m-d");
              $total_income = 0;
              $count_orderday = 0;
              $sql_onedaty = "SELECT * FROM table_order WHERE date_report LIKE '%$date_oneday%' AND status = 3 ";
              $result_search_ondeday =  $obj->query($sql_onedaty);

              while ($row = $result_search_ondeday->fetch(PDO::FETCH_ASSOC)) {
                $count_orderday = $result_search_ondeday->rowCount();
                $total_income += $row['priceAll'];
              }
              ?>

              <div class="row  bg-secondary px-4 py-3 border-report">
                <div class="col-xl-6  fw-bold"><i class="ion ion-stats-bars pr-1 "></i> ยอดขายวันนี้</div>
                <div class="col-xl-6 mb-2">วันที่ &nbsp;<?= date("d-m-Y"); ?></div>
                <div class="col-xl-6 font-five">รายได้ทั้งหมด</div>
                <div class="col-xl-6 mb-2 "><?= number_format($total_income, 2); ?> <span> &nbsp;&nbsp;&nbsp; บาท </span> </div>
                <div class="col-xl-6 font-five">ออเดอร์ที่สำเร็จ</div>
                <div class="col-xl-6 mb-2"><?= number_format($count_orderday); ?> <span> &nbsp;&nbsp;&nbsp;ออเดอร์ </span></div>
              </div>

              <div class="d-flex justify-content-between align-items-center flex-wrap  mb-3">
                <button type="button" class="btn btn-dark  px-2 mt-4 mx-2" onclick="showAll_order()">เเสดงทั้งหมด</button>
                <form action="" method="get" class="d-flex flex-wrap align-items-center mb-0 mt-4">
                  <div class="mx-2"> <label for="datetodate" class="mb-0">เลือกช่วงเวลา</label></div>
                  <div class="mx-2 ">
                    <input type="date" name="from_date" id="from_date" class="set-input bg-light my-1" value="<?= $from_date ?>">
                    <label for="to" class="to-date "> - </label>
                    <input type="date" name="to_date" id="to_date" class="set-input bg-light my-1" value="<?= $to_date ?>">
                  </div>
                  <button type="submit" class="mx-2 btn btn-outline-dark">submit</button>
                </form>
              </div>

              <?php
              $totalAll_income = 0;
              $count_orderAll = 0;
              $sql = $from_date && $to_date ? "SELECT * FROM table_order WHERE status = 3 AND date_report BETWEEN '$from_date' AND '$to_date'" : "SELECT * FROM table_order WHERE status = 3 ";
              $result_all_success =  $obj->query($sql);

              while ($row = $result_all_success->fetch(PDO::FETCH_ASSOC)) {
                $count_orderAll = $result_all_success->rowCount();
                $totalAll_income += $row['priceAll'];
              }

              ?>

              <div class="row  bg-secondary px-4 py-3 border-report">
                <div class="col-xl-12 mb-2 fw-bold"><i class="ion ion-pie-graph pr-1 "></i> ยอดขายโดยรวม</div>
                <div class="col-xl-6 font-five">รายได้ทั้งหมด</div>
                <div class="col-xl-6 mb-2 "><?= number_format($totalAll_income, 2); ?> <span> &nbsp;&nbsp;&nbsp; บาท </span> </div>
                <div class="col-xl-6 font-five">ออเดอร์ที่สำเร็จ</div>
                <div class="col-xl-6 mb-2"><?= number_format($count_orderAll); ?> <span> &nbsp;&nbsp;&nbsp;ออเดอร์ </span></div>
                <div class="col-xl-6 font-five">ช่วงเวลา</div>
                <div class="col-xl-6 mb-2"><?= $from_date && $to_date ?   date("d-m-Y", strtotime($from_date)) . " - " . date("d-m-Y", strtotime($to_date)) : "ทั้งหมด"; ?></div>
              </div>


              <div class="d-flex justify-content-start align-items-center mt-4 ">
                <form action="" method="get">
                  <label for="select_type">เลือกประเภท</label>
                  <select name="select_type" id="select_type" class="set-input bg-light">
                    <option value="alltotal" disabled>เลือก</option>
                    <option value="food">อาหาร</option>
                    <option value="drink">เครื่องดื่ม</option>
                  </select>
                </form>
              </div>

              <div class="card card-secondary">
                <div class="card-header">
                  <h3 class="card-title">กราฟเเสดงข้อมูลเมนูขายดี</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="barChart" class="barChart" style="width:100%; max-height:500px; min-height:280px; ">
                    </canvas>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>

            </div>
          </section>
        </div>


      </div>


      <?php include 'add_framwork/js.php' ?>

      <script>
        // var date = new Date();
        // var year = date.getFullYear();
        // var month = String(date.getMonth() + 1).padStart(2, '0');
        // var todayDate = String(date.getDate()).padStart(2, '0');
        // var datePattern = year + '-' + month + '-' + todayDate;
        // document.getElementById("datePicker2").value = datePattern;
        // document.getElementById("datePicker1").value = datePattern;
        // console.log(datePattern);
        // var bg_chart = {
        //   background: "#3E88FB"
        // };

        const showAll_order = () => {
          // document.getElementById("from_date").value = "";
          // document.getElementById("to_date").value = "";
          location.assign("report.php");
        }


        const data = {
          labels: ['ผัดกระเพราหมู', 'ผัดกระเพราหมูกรอบ', 'ข้าวผัดกุ้ง', 'ผัดคะน้า', 'เเกงส้ม', 'เเกงปลา'],
          datasets: [{
            barPercentage: 100,
            barThickness: 60,
            maxBarThickness: 80,
            minBarLength: 25,
            label: 'อาหาร : ยอดออเดอร์ ',
            data: [19, 19, 7, 5, 2, 1],
            backgroundColor: '#426fbd',
            borderColor: '#707070',
            borderWidth: 1
          }]
        }

        const config = {
          type: 'horizontalBar',
          data,
          options: {
            title: {
              position: 'bottom',
              display: true,
              text: 'กราฟเเสดงข้อมูลออเดอร์ขายดี'
            },
          }
        };

        const myChart = new Chart(
          document.getElementById('barChart'),
          config
        );
      </script>

    </body>

    </html>
  <?php } ?>
<?php } else {

  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('login.php');
}else {
location.assign('login.php');
}
</script>";
} ?>