<?php
ob_start();
session_start();
require_once "../../connection/config.php";
date_default_timezone_set("Asia/bangkok");
isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"]) ? '' : header('Locatoin: ../../login.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['submit_add'])) {
    $header = $_POST['header'];
    $type = $_POST['type'];
    $detail_article = $_POST['detail_article'];
    $name_edit = $_SESSION["session_name"];
    $arr = [$header, $type, $detail_article, $name_edit];

    if (empty($detail_article)) {
      http_response_code(400);
      echo "ไม่มีข้อมูลบทความ";
    } else {
      try {
        $sql = "INSERT INTO table_article  (header, type, detail, name_edit) VALUES(?, ?, ?, ?)";
        $insert = $obj->prepare($sql);
        $result =  $insert->execute($arr);
        if ($result) {
          http_response_code(201);
          echo "success";
        } else {
          http_response_code(400);
          echo "No success";
        }
      } catch (PDOException $e) {
        echo "Error";
      }
    }
  }


  if (isset($_POST['submit_delete'])) {
    $id = $_POST['id_article'];
    try {
      $sql = "DELETE FROM table_article WHERE id = $id";
      $delete = $obj->prepare($sql);
      $result =  $delete->execute();
      if ($result) {
        http_response_code(201);
        echo "success";
      } else {
        http_response_code(400);
        echo "No success";
      }
    } catch (PDOException $e) {
      echo "Error";
    }
  }


  if (isset($_POST['submit_update'])) {
    $id = $_POST['id_article'];
    $header = $_POST['header'];
    $type = $_POST['type'];
    $detail_article = $_POST['detail_article'];
    $name_edit = $_SESSION["session_name"];
    $date = date('Y-m-d H:i:s');
    $arr = [$header, $type, $detail_article, $name_edit,  $date,  $id];

    if (empty($detail_article)) {
      http_response_code(400);
      echo "ไม่มีข้อมูลบทความ";
    } else {
      try {
        $sql = "UPDATE  table_article  SET  header = ?, type = ?, detail = ?, name_edit = ?, date_created = ? WHERE id = ?";
        $insert = $obj->prepare($sql);
        $result =  $insert->execute($arr);
        if ($result) {
          http_response_code(201);
          echo "success";
        } else {
          http_response_code(400);
          echo "No success";
        }
      } catch (PDOException $e) {
        echo "Error";
      }
    }
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (isset($_GET['fetch_delete'])) {
    $id = $_GET['fetch_delete'];
    $sql = "select * from table_article where id = $id";
    $select = $obj->prepare($sql);
    $select->execute();
    $row =  $select->fetch();
    $text = '';
    $text .= '<p>คุณต้องการลบ บทความ <span class="fw-bold">' . $row['header'] . '</span> ใช่หรือไม่</p>';
    $text .= '<input type="hidden" value="' .  $row['id'] . '" name="id_article">';
    echo $text;
  }
}
