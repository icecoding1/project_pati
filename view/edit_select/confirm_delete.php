<?php
require_once "../../connection/config.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  try {
    $id = isset($_GET["id_delete"]) ? $_GET["id_delete"] : null;
    $sql = "DELETE FROM table_typefood WHERE id = :id";
    $delete = $obj->prepare($sql);
    $delete->bindParam(":id", $id);
    $result = $delete->execute();
    if ($result) {
      echo "<script>alert('ลบประเภทอาหารสำเร็จ');</script>";
      echo "<script> window.location.assign('edit_select.php');</script>";
    }
  } catch (PDOException $e) {
    $e->getMessage();
    echo "<script>alert('ลบประเภทอาหารไม่สำเร็จ');</script>";
    echo "<script> window.location.assign('edit_select.php');</script>";
  }
}
