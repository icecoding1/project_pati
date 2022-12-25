<?php $name_web = "ระบบจัดการร้านอาหาร";
ob_start();
session_start();
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
  $page_nav = 3;
  include "connection/config.php";
  // $sql = "SELECT * FROM  table_listfood  ";
  // $result = $obj->query($sql);

  $search =  isset($_GET['search_menu']) ? $_GET['search_menu'] : null;

  // check input list menu
  if (isset($_GET['ant'])) {
    $sql = "SELECT * FROM  table_listfood WHERE status = 'offline'";
  } else if ($search == null) {
    $sql = "SELECT * FROM  table_listfood ";
  } else {
    $sql =  "SELECT * FROM  table_listfood  WHERE name LIKE '%$search%'  OR  type_food LIKE '%$search%' OR number_menu LIKE '%$search%'";
  }

  $result = $obj->query($sql);
  $row = $result->fetchAll(PDO::FETCH_OBJ);
  $count = $result->rowCount();

  $btn_check_input = isset($_GET['ant']) || isset($_GET['search_menu']) ? '<a href="list_menu.php" class="btn btn-dark mx-2 ">รายการอาหารทั้งหมด</a>' : '<a href="list_menu.php?ant=1" class="btn btn-danger mx-2 ">รายการอาหารที่หมด</a>';

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
    <input type="hidden" id="nav_page" value="<?= $page_nav  ?>">

    <div class="wrapper">
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
                  <li class="breadcrumb-item"><a href="home.php">Home</a></li>
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
                    <div class="input-group input-group" style="max-width:450px;">
                      <input type="text" name="search_menu" class="form-control float-right" placeholder="Search" value="<?= $search ?>">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default ">
                          <i class="bi bi-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </form>

                <a href="add_detail_list_menu.php" class="btn btn-primary mx-2 ">+ เพิ่มรายการ</a>

                <!-- tag btn <a></a> -->
                <?= $btn_check_input ?>
              </div>
            </div>


            <?php if ($count > 5) { ?>
              <div class="list-menu">
                <?php
                foreach ($row as $row) { ?>
                  <div class="content-menu position-relative">
                    <div class="content-img">
                      <?php if (strpos($row->image, ".")) { ?>
                        <img src="image_myweb/img_product/<?= $row->image ?>" alt="food_lists" class="img_menu">
                      <?php } else { ?>
                        <img src="assets/img/empty_bg.jpeg" alt="food_lists" class="img_menu">
                      <?php } ?>
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
                      <?php if (strpos($row->image, ".")) { ?>
                        <img src="image_myweb/img_product/<?= $row->image ?>" alt="food_lists" class="img_menu">
                      <?php } else { ?>
                        <img src="assets/img/empty_bg.jpeg" alt="food_lists" class="img_menu">
                      <?php } ?>
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
              <center class="mt-3">
                <p class="fw-bold fs-2">ไม่มีรายการที่ต้องการ</p>
              </center>
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