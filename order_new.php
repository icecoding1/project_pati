<?php
ob_start();
session_start();
require_once "connection/config.php";
$name_web = "ระบบจัดการร้านอาหาร";
$page_nav = 2;
$id = isset($_GET['id']) ? $_GET['id'] : header("Location:management_order.php");
empty($id) ? header("Location:management_order.php") : '';
require_once("connection/config.php");

$sql = "SELECT * FROM table_order WHERE id = $id";
$select_order = $obj->prepare($sql);
$select_order->execute();
$data = $select_order->fetch(PDO::FETCH_OBJ);
$page = $data->status;

$decode_name_confirm = json_decode($data->name_edit);
$ende_name_confirm  = json_decode(json_encode($decode_name_confirm), true);
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
    <?php include('layout/header.php') ?>
    <?php include('layout/slidebar.php') ?>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper set-content">
      <div class="content-header mx-3">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">
                <?php if ($page == 1) {
                  echo "กรุณายืนยันออเดอร์";
                } else if ($page == 2) {
                  echo "จัดการออเดอร์เเละออกบิล";
                } else if ($page == 3) {
                  echo "ออเดอร์ที่สำเร็จ";
                } ?>
              </h1>
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
          <?php
          $number_order = $data->number_order;
          $_SESSION['number_order'] = $number_order;
          ?>
          <div class="d-flex justify-content-end">

            <?php if ($page == 1) { ?>
              <a href="view/set_manaorder/index.php?id=<?= $id; ?>&status=<?= $data->status; ?>" class="btn btn-danger mx-1">ยืนยันออเดอร์</a>
              <a href="print_all.php?id_confrim=<?= $data->id ?>" class="btn btn-dark mx-1">ออกบิล</a>
            <?php   } else if ($page == 2) { ?>
              <button type="button" class="btn btn-dark m-1" data-bs-toggle="modal" data-bs-target="#print_bill">ออกบิล</button>
              <?php if ($data->pay_from_user > 0) { ?>
                <a href="view/set_manaorder/index.php?id=<?= $id; ?>&status=<?= $data->status; ?>" class="btn btn-success m-1">เสร็จสิ้นออเดอร์</a>
              <?php  } ?>
              <a href="view/add_editorder/index.php?id=<?= $id; ?>" class="btn btn-primary m-1">เพิ่ม/เเก้ไข</a>
              <a href="view/add_editorder/deleteAll_order.php?id=<?= $id; ?>" class="btn btn-danger m-1">ลบ</a>
            <?php   } else if ($page == 3) { ?>
              <a href="print_all.php?id_confrim=<?= $data->id ?>&show_all=1" class="btn btn-dark m-1">ออกบิล</a>
            <?php    } ?>

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
                  echo (empty($str)) ?  "-" : $data->note;
                  ?>
                </div>
                <?php if ($page == 1) { ?>
                  <div class="col-md-5 font-five ">ผู้รับรายการ</div>
                  <div class="col-md-5 mb-2"><?= $data->name_edit; ?></div>
                <?php } else if (($page == 2)) { ?>
                  <div class="col-md-5 font-five ">ผู้รับรายการ</div>
                  <div class="col-md-5 mb-2"><?= $ende_name_confirm['order_send'] ?></div>
                  <div class="col-md-5 font-five ">ผู้ยืนยันรายการ</div>
                  <div class="col-md-5 mb-2"><?= $ende_name_confirm['order_confirm'] ?></div>
                <?php } else if ($page == 3) { ?>
                  <div class="col-md-5 font-five ">ผู้รับรายการ</div>
                  <div class="col-md-5 mb-2"><?= $ende_name_confirm['order_send'] ?></div>
                  <div class="col-md-5 font-five ">ผู้ยืนยันรายการ</div>
                  <div class="col-md-5 mb-2"><?= $ende_name_confirm['order_confirm'] ?></div>
                  <div class="col-md-5 font-five ">ผู้ยืนยันรายการเสร็จสิ้น</div>
                  <div class="col-md-5 mb-2"><?= $ende_name_confirm['order_success'] ?></div>
                <?php } ?>
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
                    $dataAll_order = json_decode($data->listAll_order);
                    $_SESSION["array_order"]  = json_decode(json_encode($dataAll_order), true);
                    $_SESSION['add_count_sales'] =   $_SESSION["array_order"];
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
                  <div class="col-4 font-five">จ่ายเเล้ว</div>
                  <div class="col-8"><?= number_format($data->pay_from_user, 2) . " "; ?><span>บาท</span> </div>
                  <?php if ($data->pay_from_user > 0) { ?>
                    <div class="col-4 font-five">ทอน</div>
                    <div class="col-8"><?= number_format($data->pay_from_user - $data->priceAll, 2) . " "; ?><span>บาท</span> </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- comfirm -->
  <div class="modal fade" id="print_bill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form method="POST" id="pass_order" class="modal-content" action="print_all.php">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">รับเงินจากลูกค้า</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_confrim" value="<?= $data->id ?>">
          <p class="mb-0">คุณต้องการออกบิลรายการ&nbsp;<span class="fw-bold"><?= $data->number_order ?></span>&nbsp;นี่ใช่หรือไม่</p>
          <p class="mb-0 text-danger">**กรุณากรอกเงินที่ลูกค้าจะจ่าย</p>
          <input type="number" name="pay_money" id="pay_money" placeholder="กรุณากรอกจำนวนเงินที่ลูกค้าจ่าย" required class="form-control mt-2">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-dark">ไปหน้าออกบิล</button>
        </div>
      </form>
    </div>
  </div>

  <?php include 'add_framwork/js.php' ?>
</body>

</html>