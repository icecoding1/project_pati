<?php
session_start();
ob_start();
require_once "connection/config.php";
isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"]) ?  '' : header("location: login.php");
$id = isset($_GET['id']) ? $_GET['id'] : 1;
$check_id = isset($_GET['id']) ? $_GET['id'] : "";

$sql = "SELECT * FROM structure_management WHERE id = $id";
$set_session_structure = $obj->query($sql);

if ($row = $set_session_structure->fetch(PDO::FETCH_ASSOC)) {
  $_SESSION["count_table"] = $row["count_table"];
  $_SESSION["name_shop"] = $row["name_shop"];
  $_SESSION["text_show"] = $row["text_index"];
  $_SESSION["logo_shop"] = $row["logo_shop"];

  if ($check_id == 1) {
    echo "<script> window.location.assign('setting.php');</script>";
    header("Location:setting.php");
  } else {
    header("Location:home.php");
  }
}
