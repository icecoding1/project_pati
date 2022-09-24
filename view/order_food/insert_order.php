<?php
require_once "../../connection/config.php";
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");
$date = date("His");
// $numrandom = (mt_rand());
$numrandom = (rand(100, 1000));
$array = $_SESSION['data'];


$count  = count($array) > 0  ?  count($array) : 0;
$_SESSION["count_order"] = $count;

$number_order = $date . $numrandom;
$list = isset($_SESSION['send_order']) ? $_SESSION['send_order'] : false;
$priceAll = $_SESSION['total'];
$count_order = isset($_SESSION["count_order"]) ? $_SESSION["count_order"] : 0;
$table =   $_SESSION["session_table"] = isset($_SESSION["session_table"]) ? $_SESSION["session_table"] :  "";
$note = isset($_POST['note']) ? $_POST['note'] : "";
$list_order =  json_encode($list);
// echo $list_order;
// echo "<hr>";
// $list_decode =  json_decode($list_order);
// echo "<pre>";
// print_r($list_decode);
// echo "</pre>";




if (count($array) > 0) {
  try {
    $sql = "INSERT INTO table_order(number_order, list_order, priceAll, count_order, table_user, note) VALUES(:number_order, :list_order, :priceAll, :count_order, :table_user, :note)";
    $result = $obj->prepare($sql);
    $result->execute([
      'number_order' => $number_order,
      'list_order' => $list_order,
      'priceAll' => $priceAll,
      'count_order' => $count_order,
      'table_user' => $table,
      'note' => $note,
    ]);

    if ($result) {
      unset($_SESSION['send_order']);
      unset($_SESSION['data']);
      unset($_SESSION['total']);
      unset($_SESSION["count_order"]);
      echo "<script>alert('เพิ่มรายการสำเร็จ');</script>";
      echo "<script>location.assign('order_receive.php');</script>";
    }
  } catch (PDOException $e) {
    echo "error" .    $e->getMessage();
  }
} else {
  echo "<script>alert('เพิ่มรายการไม่สำเร็จ');</script>";
  echo "<script>location.assign('order_receive.php');</script>";
}
