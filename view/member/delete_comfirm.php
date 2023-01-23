<?php
ob_start();
session_start();
require_once "../../connection/config.php";
include("../../check_session.php");
$id   = isset($_GET['id']) ? $_GET['id'] : 1;

echo $id;

$sql = "DELETE FROM table_member WHERE id = :id";
$delete = $obj->prepare($sql);
$delete->bindParam(":id", $id);
$result = $delete->execute();

if ($result) {
  echo "<script>alert('delete success');</script>";
  echo "<script>location.assign('../../set_session_member.php');</script>";
  header('location: ../../management_member.php');
} else {
  echo "<script>alert('delete success');</script>";
  header('location: ../../management_member.php');
}
