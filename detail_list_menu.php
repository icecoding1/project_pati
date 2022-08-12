<?php $name_web = "ระบบจัดการร้านอาหาร";

$id = isset($_GET['id']) ? $_GET['id'] : '';
$food = $id == $id ? "ขนมปัง กาเเฟ" : '';
$is_edit = isset($_GET['is_edit']) ? $_GET['is_edit'] : false;
$detail = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo culpa consequuntur molestiae ea ipsam nostrum eaque nam quibusdam dicta, quas quod praesentium dolorem at unde laborum laudantium alias odit magni.";
$price = 75;

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
    <div class="content-wrapper">
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
        <div class="container-fluid ">

          <div class="content-detail-top">
            <?php if ($is_edit) { ?>
              <a class="btn btn-dark  mx-2" href="detail_list_menu.php?id=<?= $id ?>">ยกเลิก</a>
              <a href="detail_list_menu.php?id=<?= $id ?>"><button type="submit" name="submit_datail-product" class="btn btn-primary">บันทึกข้อมูล</button></a>
            <?php } else { ?>
              <a class="btn btn-outline-dark px-3" href="detail_list_menu.php?id=<?= $id ?>&is_edit=1">เเก้ไขข้อมูล</a>
            <?php } ?>
          </div>

          <div class="content-detail-bottom ">

            <div class="d-flex justify-content-between align-items-center content-detail-inbottom-top">
              <p class="mb-0 text-white ">หมายเลขหลายการ : <?php echo $id; ?></p>
              <div class="dropdown setborder-dropdown ">
                <i class="bi bi-three-dots i-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete"> <span><i class="bi bi-trash-fill text-danger"></i></span> ลบรายการนี้</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#off_on"> <span><i class="bi bi-toggle2-off text-danger"></i></span> ปิดการใช้งาน</a></li>
                </ul>
              </div>
            </div>

            <div class="content-detail-inbottom-bottom ">
              <div class="row row-content-detail">

                <div class="col-xl-3 content-row1 ">
                  <div class="content-in-row1">
                    <?php if ($is_edit) { ?>
                      <input type="image" src="assets/img/coffee.jpg" name="" id="" alt="image" class="image-product">
                      <label>
                        เปลี่ยนรูปสินค้า<span class="text-danger"> *เฉพาะ png, jpeg, jpg</span>
                      </label>
                      <input type="file" class="cursor-pointer " name="myImage-product" accept="image/png,  image/jpeg">
                    <?php } else { ?>
                      <input type="image" src="assets/img/coffee.jpg" name="" id="" alt="image" class="image-product">
                    <?php } ?>
                  </div>
                </div>

                <div class="col-xl-9 content-row2">
                  <div class="row content-in-row2">
                    <p class="col-12 font-five mb-0">
                      ชื่อ
                    </p>
                    <p class="col-12 ">
                      <?php if ($is_edit) { ?>
                        <input type="text" class="form-control" id="text_name" name="text_name" placeholder="ชื่ออาหาร" value="<?= $food  ?>">
                      <?php } else { ?>
                        <?= $food ?>
                      <?php } ?>
                    </p>
                    <p class="col-12 font-five mb-0">
                      ประเภท
                    </p>
                    <p class="col-12 ">
                      <?php if ($is_edit) { ?>
                        <select class="form-select" aria-label="Default select example" id="text_type" name="text_type">
                          <option disabled>เลือกประเภท</option>
                          <option value="1" selected>อาหาร</option>
                          <option value="2">เครื่องดื่ม</option>
                          <option value="3">เเอลกอฮอล์</option>
                          <!-- ตรงนี้เราจะเขียน php ด้วย ใช้ if ในการกำหนดค่าเพื่อเป็น default -->
                        </select>
                      <?php } else { ?>
                        <?= "อาหาร"; ?>
                      <?php } ?>

                    </p>
                    <p class="col-12 font-five mb-0">
                      ราคา
                    </p>
                    <p class="col-12 ">
                      <?php if ($is_edit) { ?>
                        <input type="number" class="form-control" id="text_price" name="text_price" value="<?= number_format($price, 2) ?>">
                      <?php } else { ?>
                        <?php
                        echo number_format($price, 2) . " ฿";
                        ?>
                      <?php } ?>
                    </p>
                    <p class="col-12 font-five mb-0">
                      รายละเอียด
                    </p>
                    <p class="col-12 ">
                      <?php if ($is_edit) { ?>
                        <!-- <input type="textarea" class="form-control text-detail" id="detail" name="detail" value="<?= $detail ?>"> -->
                        <textarea class="form-control" id="detail" name="detail" rows="5"><?= $detail ?></textarea>
                      <?php } else {
                        echo $detail;
                      } ?>
                    </p>
                    <?php if ($is_edit == false) { ?>
                      <p class="col-12 font-five mb-0">
                        สถานนะ
                      </p>
                      <p class="col-12 text-success">
                        <?= "พร้อมใช้งาน" ?>
                      </p>
                      <p class="col-12 font-five mb-0">
                        ยอดขายด้วยรวม
                      </p>
                      <p class="col-12 text-primary">
                        <?php
                        $count_order = 10;
                        echo number_format($count_order);
                        ?>
                      </p>
                    <?php } ?>
                  </div>
                </div>

              </div>
            </div>

          </div>

        </div>
      </section>
    </div>

    <?php include('layout/footer.php') ?>
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>

  </div>


  <!-- Modal delete -->
  <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ลบรายการนี้</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          คุณต้องการลบรายการ <b><?= $food . "\r:\r" . $id; ?></b> หรือไม่
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          <button type="button" class="btn btn-danger">ลบรายการนี้</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal off_on -->
  <div class="modal fade" id="off_on" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ปิดการใช้งาน</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          คุณต้องการปิดการใช้งาน <b><?= $food . "\r:\r" . $id; ?></b> เพื่อไม่ให้สั่งได้ใช่หรือไม่
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          <button type="button" class="btn btn-danger">ปิดการใช้งาน</button>
        </div>
      </div>
    </div>
  </div>

  <?php include 'add_framwork/js.php' ?>
  <script>
    console.log(<?php echo $is_edit; ?>);
  </script>
</body>

</html>