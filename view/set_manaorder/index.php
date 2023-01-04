<?php
require_once "../../connection/config.php";
ob_start();
session_start();
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
  $array = $_SESSION['add_count_sales'];
  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $status = isset($_GET['status']) ? $_GET['status'] : "";
  date_default_timezone_set("Asia/Bangkok");
  $update_date = date("d-m-Y  H:i:s");
  $number_sort = date("dmYHis");
  // $count_add =  count($array);

  if ($status == 1) {
    try {
      $sql_select = "SELECT * FROM table_order WHERE id = $id";
      $result_select  = $obj->query($sql_select);
      $row = $result_select->fetch();
      $item = ["order_send" => $row["name_edit"], "order_confirm" => $_SESSION["session_name"]];
      $list_name_confirm = json_encode($item);


      $sql = "UPDATE table_order SET status = 2, create_date = :create_date, number_sort = :number_sort, name_edit = :name_edit   WHERE id = $id";
      $result = $obj->prepare($sql);
      $result->bindParam(':create_date', $update_date);
      $result->bindParam(':number_sort', $number_sort);
      $result->bindParam(':name_edit', $list_name_confirm);
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
      $sql_select = "SELECT * FROM table_order WHERE id = $id";
      $result_select  = $obj->query($sql_select);
      $row = $result_select->fetch();
      $decode_name_confirm = json_decode($row['name_edit']);
      $ende_name_confirm  = json_decode(json_encode($decode_name_confirm), true);
      $item = ["order_send" => $ende_name_confirm['order_send'], "order_confirm" => $ende_name_confirm['order_confirm'], "order_success" => $_SESSION["session_name"]];
      $list_name_confirm = json_encode($item);


      $sql = "UPDATE table_order SET status = 3, create_date = :create_date,  number_sort = :number_sort, name_edit = :name_edit  WHERE id = $id";
      $result = $obj->prepare($sql);
      $result->bindParam(':create_date', $update_date);
      $result->bindParam(':number_sort', $number_sort);
      $result->bindParam(':name_edit', $list_name_confirm);
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
