<?php
require_once("../../connection/config.php");
ob_start();
session_start();
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {

  if (isset($_SESSION['check_update'])) {

    $list_order =   $_SESSION['update_order'];
    $listAll_order = $_SESSION['update_orderAll'];
    $priceAll = $_SESSION['total'];
    $count_order = $_SESSION['total_order_success'];
    $id = $_SESSION['id_forupdate'];

    $list_order =  json_encode($list_order);
    $listAll_order = json_encode($listAll_order);

    // echo $listAll_order;
    // echo "<hr>";
    // echo $list_order;
    try {
      $sql = "UPDATE table_order SET list_order = :list_order, listAll_order = :listAll_order, priceAll = :priceAll, count_order = :count_order WHERE id = :id";
      $update = $obj->prepare($sql);
      $update->execute([
        'list_order' => $list_order,
        'listAll_order' => $listAll_order,
        'priceAll' => $priceAll,
        'count_order' => $count_order,
        'id' => $id,
      ]);

      if ($update) {
        unset($_SESSION['update_order']);
        unset($_SESSION['update_orderAll']);
        unset($_SESSION['total']);
        unset($_SESSION['total_order_success']);
        unset($_SESSION['id_forupdate']);
        unset($_SESSION['array_order']);
        echo "<script>alert('เเก้ไขข้อมูลสำเร็จ')</script>";
        echo "<script>location.assign('../../order_new.php?page=2&id=" . $id . "')</script>";
      } else {
        echo "<script>window.history.back();</script>";
      }
    } catch (PDOException $e) {
      echo "errro" . $e->getMessage();
    }
  } else {
    echo "<script>window.history.back();</script>";
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
