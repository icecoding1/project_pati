<?php
require_once "../../connection/config.php";
$id = $_POST['id'];

$sql = "SELECT * FROM table_typefood WHERE id = $id";
$result = $obj->query($sql);
$text = "";

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
  $text .= " 
  <input type='hidden' name='id' value=" . $row['id'] . ">
  <input type='text' value=" . $row['type'] . " name='edit_type' class='form-control w-100'> 
  ";
}

echo $text;
