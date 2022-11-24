<?php
ob_start();
session_start();
require_once "connection/config.php";
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {

  $id =  $_SESSION["id_member"];
  $sql = "SELECT * FROM table_member WHERE id = $id";
  $set_session = $obj->query($sql);

  if ($row = $set_session->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION["session_status"] = $row["status"];
    $_SESSION["session_image"] = $row["image"];
    $_SESSION["session_name"] = $row["name"];
    $_SESSION["id_member"] = $row["id"];
    header("Location: personal_data.php");
  }
} else {

  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('login.php');
}else {
location.assign('login.php');
}
</script>";
}
