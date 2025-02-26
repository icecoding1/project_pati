<?php
session_start();
ob_start();
require_once("connection/config.php");
$name_web = "ระบบจัดการร้านอาหาร";
$page_nav = 1;
include("check_session.php");
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

      <?php include('layout/preloader.php') ?>
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

            <div class="row border-report" id="report_oneday">
            </div>

            <div class="d-flex justify-content-between align-items-center flex-wrap  mb-3">
              <button type="button" class="btn btn-dark  px-2 mt-3 mx-2" onclick="showAll_order()">เเสดงทั้งหมด | ใหม่</button>
              <form id="fetchdata_fromdate" class="d-flex flex-wrap align-items-center mb-0 mt-3">
                <div class="mx-2"> <label for="datetodate" class="mb-0">เลือกช่วงเวลา</label></div>
                <div class="mx-2 ">
                  <input type="date" name="from_date" id="from_date" class="set-input bg-light my-1">
                  <label for="to" class="to-date "> - </label>
                  <input type="date" name="to_date" id="to_date" class="set-input bg-light my-1" value="<?= $date_now  ?>">
                </div>
                <button type="submit" class="mx-2 btn btn-outline-dark">submit</button>
              </form>
            </div>

            <div class="row border-report" id="report_All">
            </div>


            <div class="d-flex justify-content-start align-items-center mt-4 mb-2">
              <form id="select_sales" class="mt-4">
                <label for="">เลือกประเภท</label>
                <select id="select_type" class="set-input bg-light" name="select_type">
                  <?php $sql_select = "SELECT * FROM table_typefood";
                  $select = $obj->query($sql_select); ?>
                  <option value="alltotal" disabled>เลือก</option>
                  <option value="ทั้งหมด" selected>ทั้งหมด</option>
                  <?php while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                  ?>
                    <option value="<?= $type ?>"><?= $type ?></option>
                  <?php } ?>
                </select>
              </form>
            </div>

            <div class="card ">
              <div class="card-header card-dashboard">
                <h3 class=" card-title text-white">กราฟเเสดงข้อมูลเมนูขายดี</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus text-white"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times text-white"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart" id="body_chart">
                  <canvas id="barChart" class="barChart" style="width:100%; max-height:auto; min-height:300px; ">
                    <!-- dashboard -->
                  </canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
        </section>
      </div>


    </div>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <?php include 'add_framwork/js.php' ?>


    <script>
      var select_sales = document.getElementById("select_sales");
      var form_date = document.getElementById("fetchdata_fromdate");
      var select_form = document.getElementById("select_sales");


      setInterval(async () => {
        const data = await fetch("fetch_count_order.php?read_detail_one=1", {
          method: "GET"
        })
        const res = await data.text();
        document.getElementById("report_oneday").innerHTML = res;
      }, 1000);

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



      document.getElementById("select_type").addEventListener("change", () => {
        show_report();
      })

      const show_report = async (e) => {

        const formData = new FormData(select_form);

        const datafetch = await fetch("api_datasales.php", {
          method: "POST",
          body: formData,
        })
        const res = await datafetch.json();
        // console.log(res.type);

        const data = {
          labels: res.name,
          datasets: [{
            barPercentage: 1.0,
            barThickness: 60,
            maxBarThickness: 200,
            minBarLength: 100,
            label: `${res.type} : ยอดออเดอร์`,
            data: res.countSales,
            backgroundColor: '#007bff',
            borderColor: '#707070',
            borderWidth: 1.5
          }]
        }

        const config = {
          type: 'horizontalBar',
          data,
          options: {
            legend: {
              display: true,
              labels: {
                fontSize: 20
              }
            },
            title: {
              position: 'bottom',
              display: true,
              text: 'กราฟเเสดงข้อมูลออเดอร์ขายดี',
              fontSize: 20
            },
          }
        };

        const myChart = new Chart(
          document.getElementById('barChart'),
          config
        );
      }

      show_report();
    </script>

  </body>

  </html>
<?php } ?>