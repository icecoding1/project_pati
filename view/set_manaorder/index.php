<?php
require_once "../../connection/config.php";
ob_start();
session_start();
if (isset($_SESSION["session_username"]) &&  isset($_SESSION["session_password"])) {
  $array = $_SESSION['add_count_sales'];
  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $status = isset($_GET['status']) ? $_GET['status'] : "";
  date_default_timezone_set("Asia/Bangkok");
  $update_date = date("d-m-Y  H:i:s");
  $number_sort = date("dmYHis");
  // $count_add =  count($array);

  if ($status == 1) {
    try {
      $sql = "UPDATE table_order SET status = 2, create_date = :create_date, number_sort = :number_sort   WHERE id = $id";
      $result = $obj->prepare($sql);
      $result->bindParam(':create_date', $update_date);
      $result->bindParam(':number_sort', $number_sort);
      $result->execute();
      if ($result) {
        echo "<script>location.assign('../../order_new.php?page=2&id=" . $id . "')</script>";
      }
    } catch (PDOException $e) {
      echo "error" . $e->getMessage();
    }
  } else if ($status == 2) {
    for ($i = 0; $i < count($array); $i++) {
      $id_sales = $array[$i]['id'];
      $sql_update_sales = "UPDATE table_listfood SET count_sales =  count_sales + 1 WHERE id = $id_sales";
      $result_update = $obj->prepare($sql_update_sales);
      $result_update->execute();
    }
    try {
      $sql = "UPDATE table_order SET status = 3, create_date = :create_date,  number_sort = :number_sort   WHERE id = $id";
      $result = $obj->prepare($sql);
      $result->bindParam(':create_date', $update_date);
      $result->bindParam(':number_sort', $number_sort);
      $result->execute();
      if ($result) {
        echo "<script>location.assign('../../order_new.php?page=3&id=" . $id . "')</script>";
      }
    } catch (PDOException $e) {
      echo "error" . $e->getMessage();
    }
  }
} else {

  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
  location.assign('../../login.php');
}else {
location.assign('../../login.php');
}
</script>";
}
