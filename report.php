<?php
require_once("connection/config.php");
$name_web = "ระบบจัดการร้านอาหาร";
$page_nav = 1;

ob_start();
session_start();
if (isset($_SESSION["session_username"]) &&  isset($_SESSION["session_password"])) {
  date_default_timezone_set("Asia/bangkok");
  $date_now = date("Y-m-d");
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

              <div class="row  bg-secondary px-4 py-3 border-report" id="report_oneday">
              </div>

              <div class="d-flex justify-content-between align-items-center flex-wrap  mb-3">
                <button type="button" class="btn btn-dark  px-2 mt-4 mx-2" onclick="showAll_order()">เเสดงทั้งหมด | ใหม่</button>
                <form id="fetchdata_fromdate" class="d-flex flex-wrap align-items-center mb-0 mt-4">
                  <div class="mx-2"> <label for="datetodate" class="mb-0">เลือกช่วงเวลา</label></div>
                  <div class="mx-2 ">
                    <input type="date" name="from_date" id="from_date" class="set-input bg-light my-1">
                    <label for="to" class="to-date "> - </label>
                    <input type="date" name="to_date" id="to_date" class="set-input bg-light my-1" value="<?= $date_now ?>">
                  </div>
                  <button type="submit" class="mx-2 btn btn-outline-dark">submit</button>
                </form>
              </div>

              <div class="row  bg-secondary px-4 py-3 border-report" id="report_All">
              </div>


              <div class="d-flex justify-content-start align-items-center mt-4 ">
                <form>
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



        setInterval(async () => {
          const data = await fetch("fetch_count_order.php?read_detail_one=1", {
            method: "GET"
          })
          const res = await data.text();
          document.getElementById("report_oneday").innerHTML = res;
        }, 100);



        var form_date = document.getElementById("fetchdata_fromdate");


        form_date.addEventListener("submit", async (e) => {
          e.preventDefault();
          const formData = new FormData(form_date);
          formData.append("read_detail_all", 1);

          if (form_date.checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
            return false;
          } else {
            const data = await fetch("fetch_count_order.php", {
              method: "POST",
              body: formData
            })
            const response = await data.text();
            document.getElementById("report_All").innerHTML = response;
          }
        })



        form_date.addEventListener("keypress", async (e) => {
          if (e.key === "Enter") {
            e.preventDefault();
            const formData = new FormData(form_date);
            formData.append("read_detail_all", 1);

            if (form_date.checkValidity() === false) {
              e.preventDefault();
              e.stopPropagation();
              return false;
            } else {
              const data = await fetch("fetch_count_order.php", {
                method: "POST",
                body: formData
              })
              const response = await data.text();
              document.getElementById("report_All").innerHTML = response;
            }
          }
        })

        const fetdetail_all = async () => {
          const data = await fetch("fetch_count_order.php?read_detail_All=1", {
            method: "GET"
          })
          const res = await data.text();
          document.getElementById("report_All").innerHTML = res;
        }

        fetdetail_all();






        const showAll_order = () => {
          document.getElementById("from_date").value = "";
          document.getElementById("to_date").value = "<?= $date_now ?>";
          fetdetail_all();
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