<?php

require_once("connection/config.php");
// header("Content-Type: application/json; charset=UTF-8");

try {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $object = new stdClass();
    $type_order = isset($_POST['select_type']) ? $_POST['select_type'] : "";

    if ($type_order == "" ||   $type_order == "ทั้งหมด") {
      $sql = "SELECT * FROM table_listfood  ORDER BY count_sales DESC LIMIT 10";
      $stmt = $obj->prepare($sql);
    } else {
      $sql =  "SELECT * FROM table_listfood WHERE type_food = :type_food ORDER BY count_sales DESC LIMIT 10";
      $stmt = $obj->prepare($sql);
      $stmt->bindParam(":type_food", $type_order);
    }

    if ($stmt->execute()) {
      $num = $stmt->rowCount();
      if ($num > 0) {

        $object->name = array();
        $object->countSales = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          $data = array(
            $name => $name,
            $count_sales => $count_sales,
          );
          array_push($object->name, $data[$name]);
          array_push($object->countSales, $data[$count_sales]);
        }
        $object->RespCode = 200;
        $object->RespMessage = 'success';
        $object->type = $type_order;
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
