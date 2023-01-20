<?php
ob_start();
session_start();
require_once "connection/config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = htmlentities($_POST['txt_username'], ENT_QUOTES);
  $password = htmlentities($_POST['txt_password'], ENT_QUOTES);

  $hash = md5($password);

  $sql = "SELECT * FROM table_member WHERE username = '$username' AND password = '$hash'";
  $result =  $obj->query($sql);

  $num = $result->rowCount();
  if ($num == 0) {
    echo "<script>
    if(confirm('รหัสผ่านเเละข้อมูลผู้ใช้ไม่ถูกต้อง')){
    location.assign('login.php');
  }
    </script>";
  }

  if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION["id_member"] = $row["id"];
    $_SESSION["session_status"] = $row["status"];
    $_SESSION["session_image"] = $row["image"];
    $_SESSION["session_name"] = $row["name"];
    header("location: set_session_structure.php");
  }
}
