<?php
require_once "../../connection/config.php";
session_start();
date_default_timezone_set("Asia/Bangkok");
$date = date("dmy");
$numrandom = (mt_rand());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : false;
  $password_new = isset($_POST['password_new']) ? $_POST['password_new'] : false;
  $password_old = isset($_POST['password_old']) ? $_POST['password_old'] : false;
  $hash_old = md5($password_old);
  $hash_new = md5($password_new);
  try {

    $sql_select = "SELECT * FROM table_member WHERE id = :id";
    $check_pw = $obj->prepare($sql_select);
    $check_pw->execute([
      'id' =>   $id,
    ]);


    $row_member = $check_pw->fetch(PDO::FETCH_ASSOC);
    $check_update_pw = $row_member['password'] == $hash_old ? true : false;




    if ($password_new && $password_old) {
      if ($check_update_pw) {
        if ($_FILES['image_perosnal']['size'] == 0) {
          $sql = "UPDATE table_member SET name = :name, password = :password_new WHERE id = :id";
          $update = $obj->prepare($sql);
          $result = $update->execute([
            'name' =>   $fullname,
            'password_new' =>   $hash_new,
            'id' =>   $id,
          ]);
          if ($result) {
            http_response_code(201);
            echo 'อัพเดทข้อมูลเเละรหัสผ่านสำเร็จ';
          } else if ($result == false) {
            http_response_code(400);
            echo 'อัพเดทไม่ข้อมูลสำเร็จ';
          }
        } else {
          $sql_img = "SELECT * FROM table_member WHERE id = :id";
          $check_img = $obj->prepare($sql_img);
          $check_img->execute([
            'id' =>   $id,
          ]);

          $result_shop = $check_img->fetch(PDO::FETCH_ASSOC);

          if (strpos($result_shop['image'], ".")) {
            $filename = '../../image_myweb/img_member/' . $result_shop['image'];
            unlink($filename);
          }

          $path = "../../image_myweb/img_member/";
          $type =  strrchr($_FILES['image_perosnal']['name'], ".");
          $new_img =  $date . $numrandom . $type;
          $path_link = $path . $new_img;
          move_uploaded_file($_FILES['image_perosnal']['tmp_name'], $path_link);

          $sql = "UPDATE table_member SET name = :name, password = :password_new, image = :image WHERE id= :id";
          $update = $obj->prepare($sql);
          $result = $update->execute([
            'name' =>   $fullname,
            'password_new' =>   $hash_new,
            'image' =>   $new_img,
            'id' =>   $id
          ]);

          if ($result) {
            http_response_code(201);
            echo 'อัพเดทข้อมูลเเละรหัสผ่านสำเร็จ';
          } else {
            http_response_code(400);
            echo 'อัพเดทไม่ข้อมูลสำเร็จ';
          }
        }
      } else {
        http_response_code(400);
        echo 'อัพเดทข้อมูลไม่สำเร็จเนื่องจากรหัสผ่านไม่ถูกต้อง';
      }
    } else {
      if ($_FILES['image_perosnal']['size'] == 0) {
        $sql = "UPDATE table_member SET name = :name WHERE id= :id";
        $update = $obj->prepare($sql);
        $result = $update->execute([
          'name' =>   $fullname,
          'id' =>   $id
        ]);

        if ($result) {
          http_response_code(201);
          echo 'อัพเดทข้อมูลสำเร็จ';
        } else {
          http_response_code(400);
          echo 'อัพเดทไม่ข้อมูลสำเร็จ';
        }
      } else {
        $sql_img = "SELECT * FROM table_member WHERE id = :id";
        $check_img = $obj->prepare($sql_img);
        $check_img->execute([
          'id' =>   $id,
        ]);
        $result_shop = $check_img->fetch(PDO::FETCH_ASSOC);

        if (strpos($result_shop['image'], ".")) {
          $filename = '../../image_myweb/img_member/' . $result_shop['image'];
          unlink($filename);
        }

        $path = "../../image_myweb/img_member/";
        $type =  strrchr($_FILES['image_perosnal']['name'], ".");
        $new_img =  $date . $numrandom . $type;
        $path_link = $path . $new_img;
        move_uploaded_file($_FILES['image_perosnal']['tmp_name'], $path_link);

        $sql = "UPDATE table_member SET name = :name, image = :image WHERE id= :id";
        $update = $obj->prepare($sql);
        $result = $update->execute([
          'name' =>   $fullname,
          'image' =>   $new_img,
          'id' =>   $id
        ]);

        if ($result) {
          http_response_code(201);
          echo 'อัพเดทข้อมูลสำเร็จ';
        } else {
          http_response_code(400);
          echo 'อัพเดทไม่ข้อมูลสำเร็จ';
        }
      }
    }
  } catch (PDOException $e) {
    http_response_code(500);
    echo 'Server Error';
  }
}
