<?php
ob_start();
session_start();
require_once("../../connection/config.php");
date_default_timezone_set("Asia/Bangkok");
require_once("../../check_session.php");


if (isset($_SESSION['check_update']) == "") {
  echo "<script>window.history.back();</script>";
}


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
$date_report = date("Y-m-d");
$name_edit =   $_SESSION["session_name"];

$list_order =  json_encode($list);
$listAll_order =  json_encode($listAll);


// create list menu to text to notification line
$text_list = "";
$sMessage = "";
foreach ($list as $data) {
  $text_list .= $data['name'] . " จำนวน: " . $data['count'] . "\r\n";
}
$text_note = empty($note) ? "-" : $note;
// echo $text_list;


try {
  if (count($array) > 0) {
    $sql_insert = "INSERT INTO table_order(number_order, list_order, listAll_order, priceAll, count_order, table_user, note, create_date, number_sort, date_report, name_edit) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $insert = $obj->prepare($sql_insert);
    $data_execute = $insert->execute([
      $number_order,
      $list_order,
      $listAll_order,
      $priceAll,
      $count_order,
      $table,
      $text_note,
      $create_date,
      $number_sort,
      $date_report,
      $name_edit,
    ]);

    if ($data_execute) {
      $sToken = "ps5bEUJhaITa5G5jI0EfuxAbBWNovLsCzumqyB0GKsN";
      $sMessage .=  "เลขรายการ " . $number_order . "\r\n";
      $sMessage .=  "โต๊ะ " . $table . " ได้ทำการสั่งอาหาร\r\n";
      $sMessage .= "จำนวนรายทั้งสิ้น:  " . $count_order . " รายการ ดังนี้ \r\n";
      $sMessage .=  $text_list . "\r\n";
      $sMessage .= "รวมเป็นเงินทั้งสิ้น: " . $priceAll . " บาท\r\n";
      $sMessage .= "เพิ่มเติม รายละเอียดจากลูกค้า: " . $text_note . " \r\n";
      $sMessage .= "ผู้รับรายการอาหาร: " . $_SESSION["session_name"] . " \r\n";

      $chOne = curl_init();
      curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
      curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($chOne, CURLOPT_POST, 1);
      curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
      $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
      curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
      $result_notification = curl_exec($chOne);

      //Result error 
      if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
      } else {
        $result_notification = json_decode($result_notification, true);
        unset($_SESSION['send_order']);
        unset($_SESSION['data']);
        unset($_SESSION['total']);
        unset($_SESSION["count_order"]);
        echo "<script>alert('เพิ่มรายการสำเร็จ');</script>";
        echo "<script>location.assign('order_receive.php');</script>";
      }
      curl_close($chOne);
    } else {
      echo "<script>alert('เพิ่มรายการไม่สำเร็จ');</script>";
      echo "<script>location.assign('order_receive.php');</script>";
    }
  } else {
    echo "<script>alert('ไม่มีรายการต้องการ');</script>";
    echo "<script>location.assign('order_receive.php');</script>";
  }
} catch (PDOException $e) {
  echo "error" .    $e->getMessage();
}
