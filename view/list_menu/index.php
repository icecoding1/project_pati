<?php
require_once "../../connection/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = isset($_POST["id"]) ? $_POST["id"] : null;
  $name = $_POST["text_name"];
  $type_food = $_POST["text_type"];
  $price_food = $_POST["text_price"];
  $detail = $_POST["detail"];
  $image = isset($_FILES["image_product"]) ? $_FILES["image_product"] : null;
  $name_old_imd = $_POST["name_img_old"];

  date_default_timezone_set('Asia/Bangkok');
  $name_rand = (mt_rand());
  $date = date('dmY');
  $price = intval($price_food);
  // echo $type_food;

  if ($image != null) {
    $path = "../../image_myweb/img_product/";
    $type = strrchr($_FILES['image_product']['name'], ".");
    $nameimg = $date . $name_rand . $type;
    $pathlink = $path . $nameimg;
    move_uploaded_file($_FILES['image_product']['tmp_name'], $pathlink);
    if (strpos($nameimg, ".")) {
      echo "<script>console.log('success');</script>";
    } else {
      $nameimg =  $name_old_imd;
    }
  }

  try {
    $sql  = "UPDATE table_listfood SET name = :name, type_food=:type_food, price_food = :price_food, detail = :detail, image = :image   WHERE id = $id ";
    $update = $obj->prepare($sql);
    $update->bindParam(":name", $name);
    $update->bindParam(":type_food", $type_food);
    $update->bindParam(":price_food", $price);
    $update->bindParam(":detail", $detail);
    $update->bindParam(":image", $nameimg);
    // $update->bindParam(":id ", $id);
    $result = $update->execute();
    if ($result) {
      echo "<script>alert('เเก้ไขเมนูสำเร็จ🍳🍽');</script>";
      echo "<script>window.location.assign('../../detail_list_menu.php?id=" . $id . "')</script>";
    }
  } catch (PDOException $e) {
    $e->getMessage();
    echo "<script>alert('เเก้ไขเมนูไม่สำเร็จ😀❗❗❗');</script>";
    echo "<script>window.location.assign('../../detail_list_menu.php?id=" . $id . "')</script>";
  }
}
