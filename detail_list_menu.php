<?php $name_web = "ระบบจัดการร้านอาหาร";

$id = isset($_GET['id']) ? $_GET['id'] : '';
$food = $id == $id ? "ขนมปัง กาเเฟ" : '';
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
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center bg-dark">
      <img class="animation__shake" src="dist/img/food_pachaew_logo.png" alt="AdminLTELogo" height="80" width="80">
    </div>
    <?php include('layout/header.php') ?>
    <?php include('layout/slidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content-header">
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

      <section class="content">
        <div class="container-fluid">
          <div class="content-detail-top">
            <button class="btn btn-primary">เเก้ไข</button>
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

            <div class="content-detail-inbottom-bottom">hello word</div>
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
</body>

</html>