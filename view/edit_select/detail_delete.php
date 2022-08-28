<?php
require_once "../../connection/config.php";
$id = $_POST['id'];

$sql = "SELECT * FROM table_typefood WHERE id = $id";
$result = $obj->query($sql);
$text = "";

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $text .= " 
  <input type='hidden' name='id_delete' value=" . $row['id'] . ">
   <p>คุณต้องการลบ ประเภท  <b>" . $row['type'] . "</b>  ใช่หรือไม่</p>
  ";
}

echo $text;
