<?php $name_web = "ระบบจัดการร้านอาหาร";

$id = isset($_GET['id']) ? $_GET['id'] : 1;
$food = $id == $id ? "ขนมปัง กาเเฟ" : '';
$id_product = $id + 1;
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
          <form action="" method="post">

            <div class="content-detail-top">
              <a class="btn btn-secondary mx-2" href="list_menu.php">ยกเลิก</a>
              <button class="btn btn-primary mx-2" type="submit">ยืนยัน</button>
            </div>

            <div class="content-detail-bottom ">

              <div class="d-flex justify-content-between align-items-center content-detail-inbottom-top">
                <p class=" text-white ">หมายเลขรายการ : <?php echo $id_product; ?></p>
              </div>

              <div class="content-detail-inbottom-bottom ">
                <div class="row row-content-detail">
                  <div class="col-xl-3 content-row1 ">
                    <div class="content-in-row1">
                      <label>
                        เพิ่มรูปสินค้า<span class="text-danger"> *เฉพาะ png, jpeg, jpg</span>
                      </label>
                      <input type="file" class="cursor-pointer w-100 " name="image-product" id="image-product" accept="image/png,  image/jpeg" required>
                    </div>
                  </div>
                  <div class="col-xl-9 content-row2">
                    <div class="row content-in-row2">
                      <p class="col-12 font-five mb-0">
                        หมายเลขรายการ
                      </p>
                      <p class="col-12 ">
                        <input type="number" class="form-control" id="text_number_product" name="text_number_product" required value="<?= $id_product ?>" readonly>
                      </p>
                      <p class="col-12 font-five mb-0">
                        ชื่อ
                      </p>
                      <p class="col-12 ">
                        <input type="text" class="form-control" id="text_name" name="text_name" placeholder="ชื่ออาหาร" required>
                      </p>
                      <p class="col-12 font-five mb-0">
                        ประเภท
                      </p>
                      <p class="col-12 ">
                        <select class="form-select" aria-label="Default select example" id="text_type" name="text_type" required>
                          <option selected disabled>เลือกประเภท</option>
                          <option value="1">อาหาร</option>
                          <option value="2">เครื่องดื่ม</option>
                          <option value="3">เเอลกอฮอล์</option>
                        </select>
                      </p>
                      <p class="col-12 font-five mb-0">
                        ราคา
                      </p>
                      <p class="col-12 ">
                        <input type="number" class="form-control" id="text_price" name="text_price" placeholder="ราคา" required>
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

    <?php include('layout/footer.php') ?>
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>

  </div>
  <?php include 'add_framwork/js.php' ?>
</body>

</html>