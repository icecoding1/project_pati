<?php
require_once "../../connection/config.php";
ob_start();
session_start();
if (isset($_SESSION["session_username"]) &&  isset($_SESSION["session_password"])) {
  $id = isset($_GET['id']) ? $_GET['id'] : "";
  $status = isset($_GET['status']) ? $_GET['status'] : "";

  if ($status == 1) {
    try {
      $sql = "UPDATE table_order SET status = 2 WHERE id = $id";
      $result = $obj->prepare($sql);
      $result->execute();
      if ($result) {
        echo "<script>location.assign('../../order_progress.php?&id=" . $id . "')</script>";
      }
    } catch (PDOException $e) {
      echo "error" . $e->getMessage();
    }
  } else if ($status == 2) {
    try {
      $sql = "UPDATE table_order SET status = 3 WHERE id = $id";
      $result = $obj->prepare($sql);
      $result->execute();
      if ($result) {
        echo "<script>location.assign('../../order_success.php?&id=" . $id . "')</script>";
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
