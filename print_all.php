<?php
ob_start();
session_start();
require_once "connection/config.php";
include("check_session.php");
$name_web = "ออกบิลรายการร้านอาหาร";
$page_nav = 2;
$pay_money = false;
$status3 = false;
$balance = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = isset($_POST['id_confrim']) ? $_POST['id_confrim'] : header("Location: management_order.php");
  $pay_money = isset($_POST['pay_money']) ? $_POST['pay_money'] : false;
  $status3 = true;
} else if (isset($_GET['show_all'])) {
  $id = isset($_GET['id_confrim']) ? $_GET['id_confrim'] : header("Location: management_order.php");
  $status3 = true;
} else {
  $id = isset($_GET['id_confrim']) ? $_GET['id_confrim'] : header("Location: management_order.php");
}


//fetch data form order
$sql = "SELECT * FROM table_order WHERE id = $id";
$result = $obj->query($sql);
$data = $result->fetch(PDO::FETCH_ASSOC);
$data_order = json_decode($data['list_order']);
$order_all  = json_decode(json_encode($data_order), true);
$balance_show3 = $data['pay_from_user'] - $data['priceAll'];

//fetch data form shop
$shop = "SELECT * FROM structure_management";
$result_shop = $obj->query($shop);
$row_shop = $result_shop->fetch(PDO::FETCH_ASSOC);



if ($pay_money) {
  if ($pay_money >= $data['priceAll']) {
    $balance = $pay_money - $data['priceAll'];
    $sql_update = "UPDATE table_order SET pay_from_user = :pay_from_user WHERE id = $id";
    $update = $obj->prepare($sql_update);
    $update->execute(["pay_from_user" => $pay_money]);
    $sql = "SELECT * FROM table_order WHERE id = $id";
    $result = $obj->query($sql);
    $data = $result->fetch(PDO::FETCH_ASSOC);
    $data_order = json_decode($data['list_order']);
    $order_all  = json_decode(json_encode($data_order), true);
  } else {
    echo "<script>
  if(confirm('ยอดจ่ายมีน้อยกว่ายอดรายการ กรุณาทำรายการให้ถูกต้อง')){
    location.assign('order_new.php?id=" . $id . "');
  }else {location.assign('order_new.php?id=" . $id . "');
  }
  </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $name_web ?></title>
  <?php include 'add_framwork/css.php' ?>
  <link rel="stylesheet" href="assets/css/print.css" media="print">
</head>

<body>

  <div class="text-center btn_print p-4">
    <button type="button" class=" btn btn-primary " onclick="window.print()">ออกบิล</button>
    <button type="button" class=" btn btn-dark " onclick="history.back()">กลับ</a>
  </div>

  <div class="box-allprint">
    <div class="box-print">
      <div class="text-center">
        <p class="fw-bold fs-4"><?= $row_shop['name_shop'] ?></p>
        <p class="mt-3"><?= $pay_money || $status3 ? "ใบเสร็จรับเงินอย่างย่อ" : "รายการอาหารทั้งหมด" ?></p>
        <p class="mt-3">number code #<?= $data['number_order'] ?></p>
        <p class="mt-3">เวลาที่สั่ง <?= date("d-m-Y  H:i:s", strtotime($data['create_date'])) ?></p>
        <p class="mt-3">โต๊ะ : <?= $data['table_user'] ?></p>
      </div>
      <div class="row mb-2 border-bottom">
        <p class="fw-bold col-8">รายการ</p>
        <p class="fw-bold col-2">จำนวน</p>
        <p class="fw-bold col-2">ราคาสุทธิ</p>
        <?php foreach ($order_all as $order) { ?>
          <p class=" col-8"><?= $order['name'] ?></p>
          <p class=" col-2"><?= $order['count'] ?></p>
          <p class=" col-2"><?= number_format($order['priceAll'], 2) . " ฿" ?></p>
        <?php } ?>
      </div>
      <div class="row mt-2">
        <div class="col-6">ยอดสุทธิ : &nbsp;&nbsp;&nbsp; <?= $data['count_order'] . " รายการ" ?></div>
        <div class="col-6">ราคาทั้งหมด : &nbsp;&nbsp;&nbsp; <?= number_format($data['priceAll'], 2) . " ฿"  ?></div>
        <?php if ($pay_money) { ?>
          <div class="col-6">ยอดจ่าย : &nbsp;&nbsp;&nbsp; <?= number_format($data['pay_from_user'], 2) . " ฿" ?></div>
          <div class="col-6">เงินทอน : &nbsp;&nbsp;&nbsp; <?= number_format($balance, 2) . " ฿"  ?></div>
        <?php } else if ($status3) { ?>
          <div class="col-6">ยอดจ่าย : &nbsp;&nbsp;&nbsp; <?= number_format($data['pay_from_user'], 2) . " ฿" ?></div>
          <div class="col-6">เงินทอน : &nbsp;&nbsp;&nbsp; <?= number_format($balance_show3, 2) . " ฿"  ?></div>
        <?php } ?>
      </div>
    </div>
  </div>









  <?php include 'add_framwork/js.php' ?>
</body>

</html>