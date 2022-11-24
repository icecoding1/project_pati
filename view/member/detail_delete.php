<?php
ob_start();
session_start();
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
  require_once "../../connection/config.php";
  $id = $_POST['id'];
  $text = "";
  $sql = "SELECT * FROM table_member WHERE id = $id";
  $result = $obj->query($sql);

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $text .= " คุณต้องการลบสมาชิก <b> " . $row['name'] . " : " . $row['id'] . "</b> ออกใช่หรือไม่
  <input type='hidden' value=" . $row['id'] . " name='id'>
  ";
  }

  echo $text;
} else {
  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('login.php');
}else {
  location.assign('login.php');
}
</script>";
}
