<?php
session_start();
$x = isset($_POST['id']) ? $_POST['id'] : "";

if (isset($_SESSION['array_order'])) {
  usort($_SESSION['array_order'], function ($a, $b) {
    return $a['id'] - $b['id'];
  });
  array_splice($_SESSION['array_order'], $x, 1);
  $array = $_SESSION['array_order'];
  $count  = count($array) > 0  ?  count($array) : 0;
  $_SESSION["total_order_success"] = $count;
}

echo "success";
