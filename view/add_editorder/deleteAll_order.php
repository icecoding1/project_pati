<?php
ob_start();
session_start();
require_once("../../connection/config.php");
include("../../check_session.php");
if (isset($_SESSION['array_order']) == "") {
  echo "<script>window.history.back();</script>";
}
$id = isset($_GET['id']) ? $_GET['id'] : "";
try {
  $sql = "DELETE FROM table_order WHERE id = $id";
  $result = $obj->prepare($sql);
  $result->execute();
  if ($result) {
    echo "<script>alert('ลบข้อมูลสำเร็จ♻');</script>";
    echo "<script>location.assign('../../management_order.php');</script>";
  }
} catch (PDOException $e) {
  echo "error" . $e->getMessage();
  echo "<script>location.assign('../../order_new.php?page=2&id=" . $id . "');</script>";
}
