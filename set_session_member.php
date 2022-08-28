<?php
ob_start();
session_start();
require_once "connection/config.php";
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {

  $id =  $_SESSION["id_member"];
  $sql = "SELECT * FROM table_member WHERE id = $id";
  $set_session = $obj->query($sql);

  if ($row = $set_session->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION["session_username"] = $row["username"];
    $_SESSION["session_password"] = $row["password"];
    $_SESSION["session_status"] = $row["status"];
    $_SESSION["session_image"] = $row["image"];
    $_SESSION["session_name"] = $row["name"];
    $_SESSION["id_member"] = $row["id"];
    echo "<script>window.history.back()</script>";
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
