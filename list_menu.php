<?php $name_web = "ระบบจัดการร้านอาหาร";
ob_start();
session_start();
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {
  $page_nav = 3;
  include "connection/config.php";
  // $sql = "SELECT * FROM  table_listfood  ";
  // $result = $obj->query($sql);

  $search =  isset($_GET['search_menu']) ? $_GET['search_menu'] : "not";
  // echo $check_search;
  $sql = $search == "not" || $search == "" ? "SELECT * FROM  table_listfood " : "SELECT * FROM  table_listfood  WHERE name LIKE '%$search%'  OR  type_food LIKE '%$search%' OR number_menu LIKE '%$search%'";
  $result = $obj->query($sql);

  $row = $result->fetchAll(PDO::FETCH_OBJ);
  $count = count($row);

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

        <section class="content p-3 mx-2">
          <div class="container-fluid ">
            <div class="content-top">
              <div class="search_listmenu ">

                <form action="<?php $_SERVER['PHP_SELF'] ?> " method="GET" class="mb-0">
                  <div class="card-tools">
                    <div class="input-group input-group" style="width: 150px;">
                      <input type="text" name="search_menu" class="form-control float-right" placeholder="Search">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default ">
                          <i class="bi bi-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </form>

                <a href="add_detail_list_menu.php" class="btn btn-primary mx-2 ">+ เพิ่มรายการ</a>
              </div>
            </div>


            <?php if ($count > 5) { ?>
              <div class="list-menu">
                <?php
                foreach ($row as $row) { ?>
                  <div class="content-menu position-relative">
                    <div class="content-img">
                      <!-- <img src="assets/img/coffee.jpg" alt="food_lists" class="img_menu"> -->
                      <img src="image_myweb/img_product/<?= $row->image ?>" alt="food_lists" class="img_menu">
                    </div>
                    <div class="content-menu-bottom">
                      <div>
                        <p class="mb-0"><?= $row->name ?></p>
                        <?php
                        $price =  $row->price_food;
                        $price_set =  number_format($price, 2);
                        ?>
                        <p class="mb-0">ราคา : <span><?= $price_set . " ฿"; ?></span></p>
                      </div>
                      <a class="btn btn-primary p-1 btn-detail" href="detail_list_menu.php?id=<?= $row->id ?>">รายละเอียด</a>
                    </div>
                    <?php if ($row->status == "offline") { ?>
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-danger text-lg">
                          ปิดการใช้งานอยู่
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>
            <?php } else if ($count < 5 && $count >  0) { ?>
              <div class="list-menu-set">
                <?php
                foreach ($row as $row) { ?>
                  <div class="content-menu position-relative">
                    <div class="content-img">
                      <!-- <img src="assets/img/coffee.jpg" alt="food_lists" class="img_menu"> -->
                      <img src="image_myweb/img_product/<?= $row->image ?>" alt="food_lists" class="img_menu">
                    </div>
                    <div class="content-menu-bottom">
                      <div>
                        <p class="mb-0"><?= $row->name ?></p>
                        <?php
                        $price =  $row->price_food;
                        $price_set =  number_format($price, 2);
                        ?>
                        <p class="mb-0">ราคา : <span><?= $price_set . " ฿"; ?></span></p>
                      </div>
                      <a class="btn btn-primary p-1 btn-detail" href="detail_list_menu.php?id=<?= $row->id ?>">รายละเอียด</a>
                    </div>
                    <?php if ($row->status == "offline") { ?>
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-danger text-lg">
                          ปิดการใช้งานอยู่
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>
            <?php } else { ?>
              <div class="list-menu-set">
                <?php
                foreach ($row as $row) { ?>
                  <div class="content-menu position-relative">
                    <div class="content-img">
                      <!-- <img src="assets/img/coffee.jpg" alt="food_lists" class="img_menu"> -->
                      <img src="image_myweb/img_product/<?= $row->image ?>" alt="food_lists" class="img_menu">
                    </div>
                    <div class="content-menu-bottom">
                      <div>
                        <p class="mb-0"><?= $row->name ?></p>
                        <?php
                        $price =  $row->price_food;
                        $price_set =  number_format($price, 2);
                        ?>
                        <p class="mb-0">ราคา : <span><?= $price_set . " ฿"; ?></span></p>
                      </div>
                      <a class="btn btn-primary p-1 btn-detail" href="detail_list_menu.php?id=<?= $row->id ?>">รายละเอียด</a>
                    </div>
                    <?php if ($row->status == "offline") { ?>
                      <div class="ribbon-wrapper ribbon-xl">
                        <div class="ribbon bg-danger text-lg">
                          ปิดการใช้งานอยู่
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

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