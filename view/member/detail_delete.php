<?php
ob_start();
session_start();
require_once "../../connection/config.php";
include("../../check_session.php");
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
