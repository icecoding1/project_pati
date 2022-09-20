<?php
session_start();
require_once "../../connection/config.php";
$_SESSION['data'];
if ($_SESSION['data'] == null) {
  $_SESSION['data'] =  $_SESSION['data'][] = [];
} else {
  $_SESSION['data'] = $_SESSION['data'];
  $array = $_SESSION['data'];
  $count  = count($array) > 0  ?  count($array) : 0;
  $_SESSION["count_order"] = $count;
}
$mid = isset($_POST['id']) ? $_POST['id'] : 0;
try {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $object = new stdClass();
    $sql = "SELECT * FROM table_listfood WHERE id = :id";
    $stmt = $obj->prepare($sql);
    $stmt->bindParam(':id', $mid);
    if ($stmt->execute()) {
      $num = $stmt->rowCount();
      if ($num > 0) {

        $object->Result = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $items = array(
            "id" => $id,
            "name" => $name,
            "type" => $type_food,
            "count" => 1,
            "price_food" => $price_food,
            "priceAll" => $price_food * 1,
            "image" => $image,
          );
          array_push($object->Result, $row);
          // array_push($_SESSION['data'], $items);
          $_SESSION['array'] = $items;
          array_push($_SESSION['data'], $_SESSION['array']);
        }
        $object->RespCode = 200;
        $object->RespMessage = 'success';
        http_response_code(200);
      } else {
        $object->RespCode = 400;
        $object->Log = 0;
        $object->RespMessage = 'bad : Not found data';
        http_response_code(400);
      }

      echo json_encode($object);
    } else {
      $object->RespCode = 500;
      $object->Log = 1;
      $object->RespMessage = 'bad : bad sql';
      http_response_code(400);
    }
  } else {
    http_response_code(405);
  }
} catch (PEOException $e) {
  http_response_code(500);
  echo $e->getMessage();
}
