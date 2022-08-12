<?php $name_web = "ระบบจัดการร้านอาหาร";
$food = "ขนมปัง กาเเฟ";
$id = 1;
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
              <h1 class="m-0">จัดการรายการเมนู</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                <li class="breadcrumb-item active">จัดการรายการเมนู</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content p-3">
        <div class="container-fluid ">
          <div class="content-top">
            <div class="search_listmenu ">
              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default ">
                      <i class="bi bi-search"></i>
                    </button>
                  </div>
                </div>
              </div>
              <a href="add_detail_list_menu.php" class="btn btn-primary mx-2 ">+ เพิ่มรายการ</a>
            </div>
          </div>



          <div class="list-menu">
            <?php foreach (range(1, 20) as $value) { ?>
              <div class="content-menu">
                <div>
                  <img src="assets/img/coffee.jpg" alt="food_lists" class="img_menu">
                </div>

                <div class="content-menu-bottom">
                  <div>
                    <p class="mb-0"><?= $food ?></p>
                    <p class="mb-0">ราคา : <span>75 ฿</span></p>
                  </div>
                  <a class="btn btn-primary p-1 btn-detail" href="detail_list_menu.php?id=<?= $id; ?>">รายละเอียด</a>
                </div>
              </div>
            <?php } ?>
          </div>

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