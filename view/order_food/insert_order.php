<?php
require_once "../../connection/config.php";
ob_start();
session_start();

if (isset($_SESSION["session_username"]) &&  isset($_SESSION["session_password"])) {

  if (isset($_SESSION['check_update']) == "") {
    echo "<script>window.history.back();</script>";
  }


  date_default_timezone_set("Asia/Bangkok");
  $date = date("His");
  $numrandom = (rand(100, 1000));
  $number_sort = date("dmYHis");
  $array = $_SESSION['data'];


  $count  = count($array) > 0  ?  count($array) : 0;
  $_SESSION["count_order"] = $count;
  usort($_SESSION['data'], function ($a, $b) {
    return $a['id'] - $b['id'];
  });

  $number_order = $date . $numrandom;
  $list = isset($_SESSION['send_order']) ? $_SESSION['send_order'] : false;
  $listAll = isset($_SESSION['data']) ? $_SESSION['data'] : false;
  $priceAll = $_SESSION['total'];
  $count_order = isset($_SESSION["count_order"]) ? $_SESSION["count_order"] : 0;
  $table =   $_SESSION["session_table"] = isset($_SESSION["session_table"]) ? $_SESSION["session_table"] :  "";
  $note = isset($_POST['note']) ? $_POST['note'] : "";
  $create_date = date("d-m-Y  H:i:s");

  $list_order =  json_encode($list);
  $listAll_order =  json_encode($listAll);

  // echo $list_order;
  // echo "<hr>";
  // $list_decode =  json_decode($list_order);
  // echo "<pre>";
  // print_r($list_decode);
  // echo "</pre>";




  if (count($array) > 0) {
    try {
      $sql = "INSERT INTO table_order(number_order, list_order, listAll_order, priceAll, count_order, table_user, note, create_date, number_sort) VALUES(:number_order, :list_order, :listAll_order, :priceAll, :count_order, :table_user, :note, :create_date, :number_sort)";
      $result = $obj->prepare($sql);
      $result->execute([
        'number_order' => $number_order,
        'list_order' => $list_order,
        'listAll_order' => $listAll_order,
        'priceAll' => $priceAll,
        'count_order' => $count_order,
        'table_user' => $table,
        'note' => $note,
        'create_date' => $create_date,
        'number_sort' => $number_sort,
      ]);

      if ($result) {
        unset($_SESSION['send_order']);
        unset($_SESSION['data']);
        unset($_SESSION['total']);
        unset($_SESSION["count_order"]);
        echo "<script>alert('เพิ่มรายการสำเร็จ " . gettype($number_sort) . "');</script>";
        echo "<script>location.assign('order_receive.php');</script>";
      }
    } catch (PDOException $e) {
      echo "error" .    $e->getMessage();
    }
  } else {
    echo "<script>alert('เพิ่มรายการไม่สำเร็จ');</script>";
    echo "<script>location.assign('order_receive.php');</script>";
  }
} else {
  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('../../login.php');
} else {
location.assign('../../login.php');
}
</script>";
}
