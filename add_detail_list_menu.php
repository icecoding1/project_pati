<?php $name_web = "ระบบจัดการร้านอาหาร";
include "connection/config.php";
ob_start();
session_start();
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {


  $number_menu = (mt_rand());

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $number_menu = $_POST['number_menu'];
    $name = $_POST['name'];
    $type_food = $_POST['type_food'];
    $price_food = $_POST['price_food'];
    $detail = $_POST['detail'];
    $image_product = isset($_FILES['image_product']) ? $_FILES['image_product'] : null;

    $name_img = (mt_rand());
    date_default_timezone_set("Asia/Bangkok");
    $name_img_date = date("dmY");

    if ($image_product != null) {
      $type = strrchr($_FILES['image_product']['name'], ".");
      $name_img =    $name_img_date . $name_img . $type;
      $path_link =  "image_myweb/img_product/" . $name_img;
      move_uploaded_file($_FILES['image_product']['tmp_name'], $path_link);
    }


    $sql = "INSERT INTO table_listfood (number_menu, name, type_food,	price_food, detail, image) VALUES(:number_menu, :name, :type_food, :price_food, :detail, :image)";

    $insert = $obj->prepare($sql);
    $insert->bindParam("number_menu", $number_menu);
    $insert->bindParam("name", $name);
    $insert->bindParam("type_food", $type_food);
    $insert->bindParam("price_food", $price_food);
    $insert->bindParam("detail", $detail);
    $insert->bindParam("image", $name_img);
    $result = $insert->execute();

    if ($result) {
      // echo "<script>var form = document.getElementById('form_add');</script>";
      // echo "<script>form.reset();</script>";
      echo "<script>alert('เพิ่ม เมนูสำเร็จ🍳🍽');</script>";
      echo "<script>window.location.assign('reset_form.php')</script>";
    } else {
      echo "<script>alert('เพิ่ม ไม่เมนูสำเร็จ😀❗❗❗');</script>";
    }
  }
  $page_nav = 3;


?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $name_web;  ?></title>

    <?php include 'add_framwork/css.php' ?>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">

    <!-- page to web -->
    <input type="number" id="nav_page" value="<?= $page_nav  ?>" class="d-none">

    <div class="wrapper">
      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center bg-dark">
        <img class="animation__shake" src="dist/img/food_pachaew_logo.png" alt="AdminLTELogo" height="80" width="80">
      </div>
      <?php include('layout/header.php') ?>
      <?php include('layout/slidebar.php') ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper set-content">
        <div class="content-header mx-3">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">เพิ่มรายการ</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="list_menu.php">กลับ</a></li>
                  <li class="breadcrumb-item active">จัดการรายการเมนู</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <section class="content p-3 ">
          <div class="container-fluid ">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" id="form_add">

              <div class="content-detail-top">
                <a class="btn btn-secondary mx-2" href="list_menu.php">ยกเลิก</a>
                <button class="btn btn-primary mx-2" type="submit" id="submit_add">ยืนยัน</button>
              </div>

              <div class="content-detail-bottom ">

                <div class="d-flex justify-content-between align-items-center content-detail-inbottom-top">
                  <p class=" text-white ">หมายเลขรายการ : <?php echo $number_menu; ?></p>
                </div>

                <div class="content-detail-inbottom-bottom ">
                  <div class="row row-content-detail">
                    <div class="col-xl-3 content-row1 ">
                      <div class="content-in-row1">
                        <label>
                          เพิ่มรูปสินค้า ขนาดเเนะนำ <span class="text-danger">250px * 150px *เฉพาะ png, jpeg, jpg</span>
                        </label>
                        <input type="file" class="cursor-pointer w-100 " name="image_product" id="image_product" accept="image/png,  image/jpeg" required>
                      </div>
                    </div>
                    <div class="col-xl-9 content-row2">
                      <div class="row content-in-row2">
                        <p class="col-12 font-five mb-0">
                          หมายเลขรายการ
                        </p>
                        <p class="col-12 ">
                          <input type="number" class="form-control" id="number_menu" name="number_menu" required value="<?= $number_menu; ?>" readonly>
                        </p>
                        <p class="col-12 font-five mb-0">
                          ชื่อ
                        </p>
                        <p class="col-12 ">
                          <input type="text" class="form-control" name="name" placeholder="ชื่ออาหาร" required>
                        </p>
                        <p class="col-12 font-five mb-0">
                          ประเภท
                        </p>
                        <p class="col-12 ">
                          <select class="form-select mb-2" aria-label="Default select example" id="type_food" name="type_food" required>
                            <?php
                            // include("connection/config.php");
                            $table_typefood = "SELECT * FROM  table_typefood";
                            $result_typefood = $obj->query($table_typefood); ?>
                            <option selected disabled>ประเภททั้งหมด</option>
                            <?php while ($row = $result_typefood->fetch(PDO::FETCH_ASSOC)) { ?>
                              <option value="<?= $row['type'] ?>"><?= $row['type'] ?></option>
                            <?php } ?>
                          </select>
                        </p>
                        <p class="col-12 font-five mb-0">
                          ราคา
                        </p>
                        <p class="col-12 ">
                          <input type="number" class="form-control" name="price_food" placeholder="ราคา" required>
                        </p>
                        <p class="col-12 font-five mb-0">
                          รายละเอียด
                        </p>
                        <p class="col-12 ">
                          <textarea class="form-control" id="detail" name="detail" placeholder="รายละเอียด"></textarea>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
    <?php include 'add_framwork/js.php' ?>
  </body>

  </html>


<?php } else {
  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('login.php');
}else {
location.assign('login.php');
}
</script>";
} ?>