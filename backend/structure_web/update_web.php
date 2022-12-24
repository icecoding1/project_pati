<?php
session_start();
require_once("../../connection/config.php");
date_default_timezone_set("Asia/bangkok");
$date = date("dmy");
$id = $_POST['id'];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_FILES['slide_image'])) {
    $imge_slide = $_FILES['slide_image'];
    $count_array_img = 1;

    foreach ($imge_slide['name'] as $image1) {
      if (!strlen($image1)) {
        unset($imge_slide['name']);
        $count_array_img = 0;
      }
    }


    if ($count_array_img == 0) {
      $count = count($_SESSION['image_slide_food']);
      if ($count < 1) {
        http_response_code(400);
        echo "รูปภาพน้อยกว่ากำหนด ต้องมากกว่า 1";
      } else {
        $all_image_encode = json_encode($_SESSION['image_slide_food']);
        $sql_update = "UPDATE structure_management SET 	slide_image = :slide_image WHERE id = :id";
        $update = $obj->prepare($sql_update);
        $update->bindParam(":slide_image", $all_image_encode);
        $update->bindParam(":id", $id);
        $result = $update->execute();
        if ($result) {
          http_response_code(200);
          unset($_SESSION['image_pd']);
          echo "เเก้ไขข้อมูลสำเร็จ";
        } else {
          http_response_code(400);
          echo "เเก้ไขข้อมูลไม่สำเร็จ";
        }
      }
    } else  if ($count_array_img == 1) {
      $num_of_imgs = count($imge_slide['name']);
      $count =  count($imge_slide['name']);
      if ($count > 3) {
        http_response_code(400);
        echo "รูปภาพเกินกว่ากำหนด";
      } else {
        for ($i = 0; $i < $num_of_imgs; $i++) {
          $numrandom = (mt_rand());
          $path = "../../image_myweb/img_structure_management/";
          $type =  strrchr($_FILES['slide_image']['name'][$i], ".");
          $name_img =  $date . $numrandom . $type;
          $path_link = $path . $name_img;
          move_uploaded_file($_FILES['slide_image']['tmp_name'][$i], $path_link);
          $items = array(
            "name" => $name_img,
          );
          array_push($_SESSION['image_slide_food'], $items);
        }
      }

      $all_image_encode = json_encode($_SESSION['image_slide_food']);
      $sql_update = "UPDATE structure_management SET 	slide_image = :slide_image WHERE id = :id";
      $update = $obj->prepare($sql_update);
      $update->bindParam(":slide_image", $all_image_encode);
      $update->bindParam(":id", $id);
      $result = $update->execute();
      if ($result) {
        http_response_code(200);
        unset($_SESSION['image_pd']);
        echo "เเก้ไขข้อมูลสำเร็จ";
      } else {
        http_response_code(400);
        echo "เเก้ไขข้อมูลไม่สำเร็จ";
      }
    }
  }
}
