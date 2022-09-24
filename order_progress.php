<?php $name_web = "ระบบจัดการร้านอาหาร";
require_once "connection/config.php";
$page_nav = 2;
$id = isset($_GET['id']) ? $_GET['id'] : "";
ob_start();
session_start();
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {

  $sql = "SELECT * FROM table_order WHERE id = $id";
  $result = $obj->query($sql);
  $row = $result->fetchAll(PDO::FETCH_OBJ);
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
            <?php foreach ($row as $data) { ?>
              <div class="d-flex justify-content-end">
                <a href=""><button type="button" class="btn btn-dark m-1">ออกบิล</button></a>
                <a href="view/set_manaorder/index.php?id=<?= $id; ?>&status=<?= $data->status; ?>" class="btn btn-success m-1">เสร็จสิ้นออเดอร์</a>
                <button type="button" class="btn btn-primary m-1">เพิ่ม/เเก้ไข</button>
                <button type="button" class="btn btn-danger m-1">ลบ</button>
              </div>


              <div class="row my-3">
                <div class="col-xl-4 mb-2">
                  <div class="row fs-5">
                    <div class="col-md-5 font-five ">เลขที่ออเดอร์</div>
                    <div class="col-md-5 mb-2 "><?= $data->number_order; ?></div>
                    <div class="col-md-5 font-five">เวลา</div>
                    <div class="col-md-5  mb-2"><?= $data->create_date; ?></div>
                    <div class="col-md-5 font-five">โต๊ะ </div>
                    <div class="col-md-5 mb-2"><?= $data->table_user; ?></div>
                    <div class="col-md-5 font-five ">จำนวนรายการ</div>
                    <div class="col-md-5 mb-2"><?= $data->count_order; ?></div>
                    <div class="col-md-5 font-five ">โน๊ตจากลูกค้า</div>
                    <div class="col-md-5 mb-2">
                      <?php
                      $str = $data->note;
                      echo (empty($str)) ? "-" : $data->note;
                      ?>
                    </div>
                  </div>
                </div>

                <div class="col-xl-8 bg-order-set fs-5 bg-light">
                  <div class="content_order">
                    <div class="row ">
                      <div class="d-flex justify-content-center align-items-center mb-2 font-five">รายการ</div>
                      <div class="row mb-2">
                        <div class="col-3 font-five ">เมนู</div>
                        <div class="col-3 font-five">ประเภท</div>
                        <div class="col-3 font-five">จำนวน</div>
                        <div class="col-3 font-five">ราคา/รวม(บาท)</div>
                      </div>

                      <div class="order-menu">
                        <?php
                        $data_order = json_decode($data->list_order);
                        // echo "<pre>";
                        // print_r($data_order);
                        // echo "</pre>";
                        for ($i = 0; $i < count($data_order); $i++) {
                        ?>
                          <div class="row">
                            <div class="col-3"><?= $data_order[$i]->name; ?></div>
                            <div class="col-3"><?= $data_order[$i]->type; ?></div>
                            <div class="col-3"><?= $data_order[$i]->count; ?></div>
                            <div class="col-3"><?= $data_order[$i]->price_food . "/" . $data_order[$i]->priceAll; ?></div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                    <div class=" fixed-footer-order row p-3">
                      <div class="col-4 font-five">รวม</div>
                      <div class="col-8"><?= number_format($data->priceAll, 2) . " "; ?><span>บาท</span> </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </section>
      </div>


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