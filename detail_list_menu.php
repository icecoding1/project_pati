<?php $name_web = "ระบบจัดการร้านอาหาร";
ob_start();
session_start();
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {
  require_once "connection/config.php";
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $is_edit = isset($_GET['is_edit']) ? $_GET['is_edit'] : false;
  $page_nav = 3;
  $id_delete = isset($_GET['id_delete']) ? $_GET['id_delete'] : false;

  $id_On = isset($_GET['id_On']) ? $_GET['id_On'] : false;
  $id_off = isset($_GET['id_off']) ? $_GET['id_off'] : false;

  echo "<script>console.log(" . $id_On . ");</script>";

  if ($id_delete) {
    $sql = "DELETE FROM table_listfood WHERE id = $id_delete";
    $delete = $obj->query($sql);
    if ($delete) {
      echo "<script>alert('ลบ รายการสำเร็จ🍳🍝🥂');</script>";
      echo "<script>window.location.assign('list_menu.php')</script>";
    } else {
      echo "<script>alert('ลบ รายการไม่สำเร็จ❌❌');</script>";
      echo "<script>window.location.assign('detail_list_menu.php?id=" . $id_delete . "')</script>";
    }
  }

  if ($id_On) {
    $offline = "offline";
    $sql = "UPDATE  table_listfood SET status = :stutus WHERE id = $id";
    $off = $obj->prepare($sql);
    $off->bindParam(":stutus", $offline);
    // $off->bindParam(":id", $id);
    $result = $off->execute();
    if ($result) {
      echo "<script>alert('ปิดการใช้งานสำเร็จ❌❌');</script>";
      echo "<script>window.location.assign('detail_list_menu.php?id=" . $id_On . "')</script>";
    } else {
      echo "<script>alert('ปิดการใช้งานไม่สำเร็จ❌❌❌❌');</script>";
      echo "<script>window.location.assign('detail_list_menu.php?id=" . $id_On . "')</script>";
    }
  }

  if ($id_off) {
    $online = "online";
    $sql = "UPDATE  table_listfood SET status= :stutus WHERE id =  $id";
    $on = $obj->prepare($sql);
    $on->bindParam(":stutus", $online);
    $result = $on->execute();
    if ($result) {
      echo "<script>alert('เปิดการใช้งานสำเร็จ ✔✔✔');</script>";
      echo "<script>window.location.assign('detail_list_menu.php?id=" . $id_off . "')</script>";
    } else {
      echo "<script>alert('เปิดการใช้งานไม่สำเร็จ❌❌❌❌');</script>";
      echo "<script>window.location.assign('detail_list_menu.php?id=" . $id_off . "')</script>";
    }
  }

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

    <?php
    include "connection/config2.php";
    $sql = "SELECT * FROM  table_listfood WHERE id = $id";
    $result =  $obj->query($sql);
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    ?>

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
                  <h1 class="m-0">รายละเอียดรายการเมนู </h1>
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


          <section class="content p-3">
            <form action="view/list_menu/index.php" method="POST" enctype="multipart/form-data">
              <div class="container-fluid ">

                <div class="content-detail-top">
                  <?php if ($is_edit) { ?>
                    <a class="btn btn-dark  mx-2" href="detail_list_menu.php?id=<?= $id ?>">ยกเลิก</a>
                    <!-- <a href="detail_list_menu.php?id=<?= $id ?>"></a> -->
                    <button type="submit" name="submit_datail-product" class="btn btn-primary">บันทึกข้อมูล</button>
                  <?php } else { ?>
                    <a class="btn btn-outline-dark px-3" href="detail_list_menu.php?is_edit=1&id=<?= $id ?>">เเก้ไขข้อมูล</a>
                  <?php } ?>
                </div>
                <div class="content-detail-bottom ">

                  <div class="d-flex justify-content-between align-items-center content-detail-inbottom-top">
                    <p class="mb-0 text-white ">หมายเลขรายการ : <?= $row['number_menu']; ?></p>
                    <div class="dropdown setborder-dropdown ">
                      <i class="bi bi-three-dots i-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete"> <span><i class="bi bi-trash-fill text-danger"></i></span> ลบรายการนี้</a></li>
                        <li>
                          <?php if ($row['status'] == "online") { ?>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#off_on">
                              <span>
                                <i class="bi bi-toggle2-off text-danger"></i>
                              </span>
                              ปิดการใช้งาน</a>
                          <?php } else if ($row['status'] == "offline") { ?>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#off_on">
                              <span>
                                <i class="bi bi-toggle2-off text-success"></i>
                              </span>
                              เปิดการใช้งาน</a>
                          <?php } ?>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="content-detail-inbottom-bottom ">
                    <div class="row row-content-detail">

                      <div class="col-xl-3 content-row1 ">
                        <div class="content-in-row1">
                          <!-- image -->
                          <?php if ($is_edit) { ?>
                            <?php if (strpos($row['image'], ".")) { ?>
                              <img src="image_myweb/img_product/<?= $row['image'] ?>" alt="food_lists" class="image-product">
                            <?php } else { ?>
                              <img src="assets/img/empty_bg.jpeg" alt="food_lists" class="image-product">
                            <?php } ?>
                            <label>
                              เปลี่ยนรูปสินค้า<span class="text-danger"> *เฉพาะ png, jpeg, jpg</span>
                            </label>
                            <input type="file" class="cursor-pointer " name="image_product" accept="image/png,  image/jpeg">
                          <?php } else { ?>
                            <?php if (strpos($row['image'], ".")) { ?>
                              <img src="image_myweb/img_product/<?= $row['image'] ?>" alt="food_lists" class="image-product">
                            <?php } else { ?>
                              <img src="assets/img/empty_bg.jpeg" alt="food_lists" class="image-product">
                            <?php } ?>
                          <?php } ?>
                          <!-- image -->
                        </div>
                      </div>

                      <div class="col-xl-9 content-row2">
                        <div class="row content-in-row2">
                          <!-- name -->
                          <p class="col-12 font-five mb-0">
                            ชื่อ
                          </p>
                          <p class="col-12 ">
                            <?php if ($is_edit) { ?>
                              <input type="text" class="form-control" name="text_name" placeholder="ชื่ออาหาร" value="<?= $row['name'] ?>">
                            <?php } else { ?>
                              <?= $row['name'] ?>
                            <?php } ?>
                          </p>
                          <!-- name -->
                          <!-- select type -->
                          <p class="col-12 font-five mb-0">
                            ประเภท
                          </p>
                          <p class="col-12 ">
                            <?php if ($is_edit) { ?>
                              <select class="form-select" aria-label="Default select example" name="text_type">
                                <?php
                                include("connection/config2.php");
                                $table_typefood = "SELECT * FROM  table_typefood";
                                $result_typefood = $obj->query($table_typefood); ?>
                                <option selected disabled>ประเภททั้งหมด</option>
                                <?php while ($types = $result_typefood->fetch(PDO::FETCH_ASSOC)) {
                                  if ($row['type_food'] == $types['type']) {
                                ?>
                                    <option value="<?= $types['type'] ?>" selected><?= $types['type'] ?></option>
                                  <?php  } else { ?>
                                    <option value="<?= $types['type'] ?>"><?= $types['type'] ?></option>
                                <?php   }
                                } ?>
                              </select>
                            <?php } else { ?>
                              <?= $row['type_food'] ?>
                              <?php } ?>detail
                          </p>
                          <!-- select type -->
                          <!-- price food -->
                          <p class="col-12 font-five mb-0">
                            ราคา
                          </p>
                          <p class="col-12 ">
                            <?php if ($is_edit) { ?>
                              <input type="number" class="form-control" name="text_price" value="<?= number_format($row['price_food'], 2) ?>">
                            <?php } else { ?>
                              <?php
                              echo number_format($row['price_food'], 2) . " ฿";
                              ?>
                            <?php } ?>
                          </p>
                          <!-- price food -->
                          <!-- detail -->
                          <p class="col-12 font-five mb-0">
                            รายละเอียด
                          </p>
                          <p class="col-12 ">
                            <?php if ($is_edit) { ?>
                              <!-- <input type="textarea" class="form-control text-detail" id="detail" name="detail" value="<?= $detail ?>"> -->
                              <textarea class="form-control" id="detail" name="detail" rows="5"><?= $row['detail'] ?></textarea>
                            <?php } else {
                              echo $row['detail'];
                            } ?>
                          </p>
                          <!-- detail -->
                          <!-- stutus -->
                          <?php if ($is_edit == false) { ?>
                            <p class="col-12 font-five mb-0">
                              สถานนะ
                            </p>
                            <?php if ($row['status'] == "online") { ?>
                              <p class="col-12 text-success fw-bold">
                                พร้อมใช้งาน
                              </p>
                            <?php   } else if ($row['status'] == "offline") { ?>
                              <p class="col-12 text-danger fw-bold">
                                ไม่พร้อมใช้งาน
                              </p>
                            <?php  } ?>
                            <!-- stutus -->
                            <p class="col-12 font-five mb-0">
                              ยอดขายโดยรวม
                            </p>
                            <p class="col-12 text-primary">
                              <?php
                              $count_order = 10;
                              echo number_format($count_order);
                              ?>
                            </p>
                          <?php } ?>

                          <?php if ($is_edit) { ?>

                            <p class="col-12 font-five mb-0 ">
                              คุณต้องการให้เมนูนี้เป็นเมนูเเนะนำหรือไม่
                            </p>
                            <div class="col-12 ">
                              <?php if ($row['intro_check'] == "no") { ?>
                                <input type="radio" name="intro" value="no" class="mx-2" checked>ไม่
                                <input type="radio" name="intro" value="yes" class="mx-2">ใช่
                              <?php } else { ?>
                                <input type="radio" name="intro" value="no" class="mx-2">ไม่
                                <input type="radio" name="intro" value="yes" class="mx-2" checked>ใช่
                              <?php }  ?>
                            </div>

                            <?php } else {

                            if ($row['intro_check'] == "yes") { ?>
                              <p class="col-12 font-five mb-0 fw-bold">
                                รายการนี้เป็นเมนูเเนะนำ
                              </p>
                          <?php }
                          } ?>

                          <!-- send name img for set name old -->
                          <input type="hidden" name="name_img_old" value="<?= $row['image'] ?>">
                          <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        </div>
                      </div>

                    </div>
                  </div>

                </div>
              </div>
            </form>
          </section>


        </div>


      </div>


      <!-- Modal delete -->
      <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ลบรายการนี้</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                คุณต้องการลบรายการ <b><?= $row['name'] . "\r:\r" . $row['number_menu']; ?></b> หรือไม่
                <input type="hidden" name="id_delete" value="<?= $row['id'] ?>">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="submit" class="btn btn-danger">ลบรายการนี้</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- Modal off_on -->
      <div class="modal fade" id="off_on" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">เปิด/ปิดการใช้งาน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <?php if ($row['status'] == "online") { ?>
                  คุณต้องการปิดการใช้งาน <b><?= $row['name'] . "\r:\r" . $row['number_menu']; ?></b> เพื่อไม่ให้สั่งได้ใช่หรือไม่
                  <input type="hidden" name="id_On" value="<?= $row['id'] ?>">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <?php } else if ($row['status'] == "offline") { ?>
                  คุณต้องการเปิดการใช้งาน <b><?= $row['name'] . "\r:\r" . $row['number_menu']; ?></b> ใช่หรือไม่
                  <input type="hidden" name="id_off" value="<?= $row['id'] ?>">
                  <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <?php } ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <?php if ($row['status'] == "online") { ?>
                  <button type="submit" class="btn btn-danger">ปิดการใช้งาน</button>
                <?php } else if ($row['status'] == "offline") { ?>
                  <button type="submit" class="btn btn-success">เปิดการใช้งาน</button>
                <?php } ?>
              </div>
            </div>
          </form>
        </div>
      </div>
    <?php } ?>

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