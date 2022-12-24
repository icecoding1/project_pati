<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  try {
    $id = $_POST["id"];
    array_splice($_SESSION['image_slide_food'],  $id, 1);
    echo "sucessdelelte";
    http_response_code(200);
  } catch (Exception $e) {
    http_response_code(500);
    echo "error" . $e->getMessage();
  }
}
