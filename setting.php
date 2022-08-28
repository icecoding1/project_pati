<?php $name_web = "ระบบจัดการร้านอาหาร";

$is_edit = isset($_GET['is_edit']) ? $_GET['is_edit'] : false;

$page_nav = 6;
ob_start();
session_start();
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {
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
      <div class="content-wrapper">

        <div class="content-header mx-3">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0"> <i class="bi bi-gear-wide nav-icon"></i> ตั้งค่า</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                  <li class="breadcrumb-item active">ตั้งค่า </li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <section class="content p-2">
          <div class="container-fluid ">


            <div class="content-detail-top">
              <?php if ($is_edit) { ?>
                <a class="btn btn-dark  mx-2" href="setting.php">ยกเลิก</a>
                <a href="setting.php"><button type="submit" name="submit_datail-product" class="btn btn-primary">บันทึกข้อมูล</button></a>
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
                            <input type="number" class="form-control" id="number_table" name="number_table" required value="6" placeholder="พิมพ์จำนวนโต๊ะ..">
                          <?php } else {
                            echo "6";
                          } ?>

                        </div>
                        <div class="col-md-12">
                          <p class="mb-0 fw-semibold">
                            ประเภทรายการอาหาร
                          </p>
                        </div>
                        <div class="col-md-12 mb-2">
                          <select class="form-select mb-2" aria-label="Default select example" id="text_type" name="text_type" required>
                            <?php
                            include("connection/config.php");
                            $sql = "SELECT * FROM  table_typefood";
                            $result = $obj->query($sql); ?>
                            <option selected disabled>ประเภททั้งหมด</option>
                            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                              <option value="<?= $row['type'] ?>"><?= $row['type'] ?></option>
                            <?php } ?>
                          </select>

                          <?php if ($is_edit) { ?>
                            <a href="view/edit_select/edit_select.php" class="btn btn-secondary px-3">เเก้ไข</a>
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
                          <input type="text" class="form-control w-100" placeholder="ชื่อร้าน" value="ร้านป้าเเจ๋ว" name="change_nameshop">
                        <?php } else {
                          echo "ร้านป้าเเจ๋ว";
                        } ?>

                      </div>
                      <div class="col-xl-6 mb-2">
                        <p class="mb-0 fw-bold">ข้อความเเสดงหน้าเเรก</p>
                      </div>
                      <div class="col-xl-6 mb-3">

                        <?php if ($is_edit) { ?>
                          <input type="text" class="form-control w-100" placeholder="ข้อความเเสดงหน้าเเรก" value="ขอให้พนักงานทุกท่านดูเเล เเละบริการลูกค้าเป็นอย่างดี😀🥰" name="change_textshow">
                        <?php } else {
                          echo "ขอให้พนักงานทุกท่านดูเเล เเละบริการลูกค้าเป็นอย่างดี😀🥰";
                        } ?>

                      </div>
                      <div class="col-xl-6 mb-2">

                        <?php if ($is_edit) { ?>
                          <label>
                            เปลี่ยนรูปหน้าปก login<span class="text-danger"> *เฉพาะ png, jpeg, jpg</span>
                          </label>
                          <input type="file" class="cursor-pointer w-100" name="image-bg-login" id="image-bg-login" accept="image/png,  image/jpeg">
                        <?php } else { ?>
                          <p class="mb-0 fw-bold">หน้าปกหน้า login</p>
                        <?php  } ?>

                      </div>
                      <div class="col-xl-6 mb-4">
                        <img src="assets/img/bg_restaurant.jpg" alt="change_bg" class="change_bg">
                      </div>
                      <div class="col-xl-6 mb-2">

                        <?php if ($is_edit) { ?>
                          <label>
                            เปลี่ยนรูป Logo<span class="text-danger"> *เฉพาะ png, jpeg, jpg</span>
                          </label>
                          <input type="file" class="cursor-pointer w-100" name="image-bg-login" id="image-bg-login" accept="image/png,  image/jpeg">
                        <?php } else { ?>
                          <p class="mb-0 fw-bold">Logo ร้าน</p>
                        <?php  } ?>

                      </div>
                      <div class="col-xl-6 mb-3 ">
                        <img src="dist/img/food_pachaew_logo.png" alt="change_logo" class="change_logo ">
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <?php include('layout/footer.php') ?>
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