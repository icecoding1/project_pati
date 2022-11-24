<?php
$name_web = "ระบบจัดการร้านอาหาร";
require_once("connection/config.php");

ob_start();
session_start();
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
  $is_edit = isset($_GET['is_edit']) ? $_GET['is_edit'] : false;
  $page_nav = 6;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('Asia/Bangkok');
    $date = date("dmY");
    $num_rand1 = (mt_rand());
    $num_rand2 = (mt_rand());


    $count_table = $_POST["number_table"];
    $name_shop = $_POST["change_nameshop"];
    $text_index = $_POST["change_textshow"];
    $logo_shop_old = $_POST["post_namelogo"];
    $background_old = $_POST["post_namebackground"];
    $id = $_POST["id"];


    $logo_shop = isset($_FILES["image_logo"]) ? $_FILES["image_logo"] : null;
    $background = isset($_FILES["image_bg_login"]) ? $_FILES["image_bg_login"] : null;



    if ($logo_shop != null) {
      $type_logo = strrchr($_FILES["image_logo"]["name"], ".");
      $name_logo = $date . $num_rand1 .  $type_logo;
      $path_logo = "image_myweb/img_structure_management/" . $name_logo;
      move_uploaded_file($_FILES["image_logo"]["tmp_name"], $path_logo);
      if (strpos($name_logo, ".")) {
        echo "<script>console.log('success');</script>";
      } else {
        $name_logo =  $logo_shop_old;
      }
    }

    if ($background != null) {
      $type_bg = strrchr($_FILES["image_bg_login"]["name"], ".");
      $name_bg = $date . $num_rand2 .  $type_bg;
      $path_bg = "image_myweb/img_structure_management/" . $name_bg;
      move_uploaded_file($_FILES["image_bg_login"]["tmp_name"], $path_bg);
      if (strpos($name_bg, ".")) {
        echo "<script>console.log('success');</script>";
      } else {
        $name_bg =  $background_old;
      }
    }

    $sql_insert = "UPDATE structure_management SET name_shop=:name_shop,  count_table=:count_table,  text_index=:text_index,  logo_shop=:logo_shop, background=:background WHERE id = :id";
    $insert = $obj->prepare($sql_insert);
    $insert->bindParam(":name_shop", $name_shop);
    $insert->bindParam(":count_table", $count_table);
    $insert->bindParam(":text_index", $text_index);
    $insert->bindParam(":logo_shop", $name_logo);
    $insert->bindParam(":background", $name_bg);
    $insert->bindParam(":id", $id);
    $result = $insert->execute();

    if ($result) {
      echo "<script>alert('เเก้ไขข้อมูลสำเร็จ');</script>";
      echo "<script>location.assign('set_session_structure.php?id=" . $id . "');</script>";
    } else {
      echo "<script>alert('เเก้ไขข้อมูลไม่สำเร็จ');</script>";
      echo "<script>window.location.assing('setting.php?is_edit=1');</script>";
    }
  }
?>

  <?php if ($_SESSION["session_status"] == "admin") { ?>
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
        <?php include('layout/preloader.php') ?>
        <?php include('layout/header.php') ?>
        <?php include('layout/slidebar.php') ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper set-content">

          <div class="content-header mx-3">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class="m-0"> <i class="bi bi-gear-wide nav-icon"></i> ตั้งค่า</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active">ตั้งค่า </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <section class="content p-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
              <div class="container-fluid ">
                <div class="content-detail-top">
                  <?php if ($is_edit) { ?>
                    <a class="btn btn-dark  mx-2" href="setting.php">ยกเลิก</a>
                    <button type="submit" name="submit_datail-product" class="btn btn-primary">บันทึกข้อมูล</button>
                  <?php } else { ?>
                    <a class="btn btn-outline-dark px-3" href="setting.php?is_edit=1">เเก้ไขข้อมูล</a>
                  <?php } ?>
                </div>

                <div class="content-detail-bottom ">
                  <div class="d-flex justify-content-between align-items-center content-detail-inbottom-top">
                    <p class=" text-white ">ตั้งค่ารูปเเบบเว็บไซต์</p>
                  </div>

                  <div class="content-detail-inbottom-bottom ">
                    <div class="row row-content-detail">

                      <?php $sql_select = "SELECT * FROM structure_management";
                      $select = $obj->query($sql_select);
                      $row = $select->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <div class="col-xl-3 content-row1 ">
                        <div class="content-in-row1">
                          <div class="row">
                            <div class="col-md-12">
                              <p class="mb-0 fw-semibold">
                                จำนวนโต๊ะ
                              </p>
                            </div>
                            <div class="col-md-12 mb-2">

                              <?php if ($is_edit) { ?>
                                <input type="number" class="form-control" id="number_table" name="number_table" required placeholder="พิมพ์จำนวนโต๊ะ.." value="<?= $row['count_table'] ?>">
                              <?php } else {
                                echo $row['count_table'];
                              } ?>

                            </div>
                            <div class="col-md-12">
                              <p class="mb-0 fw-semibold">
                                ประเภทรายการอาหาร
                              </p>
                            </div>
                            <div class="col-md-12 mb-2">
                              <select class="form-select" aria-label="Default select example" name="text_type">
                                <?php
                                // include("connection/config2.php");
                                $table_typefood = "SELECT * FROM  table_typefood";
                                $result_typefood = $obj->query($table_typefood); ?>
                                <option selected disabled>ประเภททั้งหมด</option>
                                <?php while ($types = $result_typefood->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                  <option value="<?= $types['type'] ?>"><?= $types['type'] ?></option>
                                <?php
                                } ?>
                              </select>
                              <?php if ($is_edit) { ?>
                                <a href="view/edit_select/edit_select.php" class="btn btn-secondary px-3 my-2">เเก้ไข</a>
                              <?php } ?>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-9 content-row2">
                        <div class="row content-in-row2">
                          <div class="col-xl-6 mb-2">
                            <p class="mb-0 fw-bold">ชื่อร้าน</p>
                          </div>
                          <div class="col-xl-6 mb-3">

                            <?php if ($is_edit) { ?>
                              <input type="text" class="form-control w-100" placeholder="ชื่อร้าน" value="<?= $row['name_shop'] ?>" name="change_nameshop" required>
                            <?php } else {
                              echo $row['name_shop'];
                            } ?>

                          </div>
                          <div class="col-xl-6 mb-2">
                            <p class="mb-0 fw-bold">ข้อความเเสดงหน้าเเรก</p>
                          </div>
                          <div class="col-xl-6 mb-3">

                            <?php if ($is_edit) { ?>
                              <input type="text" class="form-control w-100" placeholder="ข้อความเเสดงหน้าเเรก" value="<?= $row['text_index'] ?>" name="change_textshow" required>
                            <?php } else {
                              echo $row['text_index'];
                            } ?>

                          </div>
                          <div class="col-xl-6 mb-2">

                            <?php if ($is_edit) { ?>
                              <label>
                                เปลี่ยนรูปหน้าปก login<span class="text-danger"> *เฉพาะ png, jpeg, jpg</span>
                              </label>
                              <input type="file" class="cursor-pointer w-100" name="image_bg_login" accept="image/png,  image/jpeg">
                            <?php } else { ?>
                              <p class="mb-0 fw-bold">หน้าปกหน้า login</p>
                            <?php  } ?>

                          </div>
                          <div class="col-xl-6 mb-4">
                            <?php if (strpos($row['background'], ".")) { ?>
                              <img src="image_myweb/img_structure_management/<?= $row['background']  ?>" alt="change_bg" class="change_bg" loading="lazy">
                            <?php } else { ?>
                              <img src="assets/img/empty_bg.jpeg" alt="change_bg" class="change_bg" loading="lazy">
                            <?php } ?>
                          </div>
                          <div class="col-xl-6 mb-2">

                            <?php if ($is_edit) { ?>
                              <label>
                                เปลี่ยนรูป Logo<span class="text-danger"> *เฉพาะ png, jpeg, jpg</span>
                              </label>
                              <input type="file" class="cursor-pointer w-100" name="image_logo" accept="image/png,  image/jpeg">
                            <?php } else { ?>
                              <p class="mb-0 fw-bold">Logo ร้าน</p>
                            <?php  } ?>

                          </div>
                          <div class="col-xl-6 mb-3 ">

                            <?php if (strpos($row['background'], ".")) { ?>
                              <img src="image_myweb/img_structure_management/<?= $row['logo_shop'] ?>" alt="change_logo" class="change_logo " loading="lazy">
                            <?php } else { ?>
                              <img src="assets/img/logo_empty.jpg" alt="change_logo" class="change_logo " loading="lazy">
                            <?php } ?>
                          </div>
                        </div>

                        <input type="hidden" value="<?= $row['logo_shop'] ?>" name="post_namelogo">
                        <input type="hidden" value="<?= $row['background'] ?>" name="post_namebackground">
                        <input type="hidden" value="<?= $row['id'] ?>" name="id">
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </form>
          </section>

        </div>
      </div>

      <?php include 'add_framwork/js.php' ?>
    </body>

    </html>
  <?php } ?>

<?php } else {
  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('login.php');
}else {
location.assign('login.php');
}
</script>";
} ?>