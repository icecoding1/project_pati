<?php $name_web = "ระบบจัดการร้านอาหาร";
// $id   = isset($_GET['id']) ? $_GET['id'] : 1;

$page_nav = 2;
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
    <div class="content-wrapper ">

      <div class="content-header mx-3">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">จัดการออเดอร์</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                <li class="breadcrumb-item active">จัดการออเดอร์</li>
              </ol>
            </div>
          </div>
        </div>
      </div>



      <section class="content p-3 ">
        <div class="container-fluid ">

          <div class="row   py-3 border-report">
            <div class="col-12 ">
              <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                  <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                    <li class="pt-2 px-3">
                      <h3 class="card-title">จัดการออเดอร์</h3>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-two-neworder-teb" data-toggle="pill" href="#custom-tabs-two-neworder" role="tab" aria-controls="custom-tabs-two-neworder" aria-selected="true">ออเดอร์ใหม่</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-progress-tab" data-toggle="pill" href="#custom-tabs-two-progress" role="tab" aria-controls="custom-tabs-two-progress" aria-selected="false">กำลังดำเนินการ</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-two-success-tab" data-toggle="pill" href="#custom-tabs-two-success" role="tab" aria-controls="custom-tabs-two-success" aria-selected="false">เสร็จสิ้น</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body p-2">
                  <div class="tab-content" id="custom-tabs-two-tabContent-order">
                    <div class="tab-pane  fade show active" id="custom-tabs-two-neworder" role="tabpanel" aria-labelledby="custom-tabs-two-neworder-tab">
                      <div class="row">
                        <div class="col-12">
                          <div class="card-header   ">
                            <h3 class="card-title">ออเดอร์ใหม่</h3>

                            <div class="card-tools mt-2">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th>เลขที่ออเดอร์</th>
                                  <th>วันเวลา</th>
                                  <th>โต๊ะ</th>
                                  <th>สถานะ</th>
                                  <th>รายการ</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach (range(1, 4) as $key => $value) { ?>

                                  <tr>
                                    <td nowrap>000000001</td>
                                    <td nowrap>11-7-2014 | 12:00</td>
                                    <td nowrap>โต๊ะ 1</td>
                                    <td nowrap><span class="text-danger fw-semibold">รอการยืนยัน</span></td>
                                    <td nowrap> <a href="order_new.php?c=<?= $_GET['c'] ?>&id=<?= $id; ?>"> <button type="button" class="btn btn-primary btn-sm">รายละเอียด</button> </a> </td>

                                  </tr>
                                <?php  } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-progress" role="tabpanel" aria-labelledby="custom-tabs-two-progress-tab">
                      <div class="row">
                        <div class="col-12">
                          <div class="card-header">
                            <h3 class="card-title">ออเดอร์กำลังดำเนินการ</h3>

                            <div class="card-tools  mt-2">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th>เลขที่ออเดอร์</th>
                                  <th>วันเวลา</th>
                                  <th>โต๊ะ</th>
                                  <th>สถานะ</th>
                                  <th>รายการ</th>
                                </tr>
                              </thead>

                              <tbody>
                                <?php foreach (range(1, 4) as $key => $value) { ?>

                                  <tr>
                                    <td nowrap>000000001</td>
                                    <td nowrap>11-7-2014 | 12:00</td>
                                    <td nowrap>โต๊ะ 1</td>
                                    <td nowrap><span class="text-warning fw-semibold">ยืนยันออเดอร์เเล้ว</span></td>
                                    <td nowrap> <a href="order_progress.php?c=<?= $_GET['c'] ?>&id=<?= $id; ?>"> <button type="button" class="btn btn-primary btn-sm">รายละเอียด</button> </a> </td>

                                  </tr>
                                <?php  } ?>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-two-success" role="tabpanel" aria-labelledby="custom-tabs-two-success-tab">
                      <div class="row">
                        <div class="col-12">
                          <div class="card-header">
                            <h3 class="card-title">ออเดอร์เสร็จสิ้น</h3>

                            <div class="card-tools  mt-2">
                              <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                  <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap">
                              <thead>
                                <tr>
                                  <th>เลขที่ออเดอร์</th>
                                  <th>วันเวลา</th>
                                  <th>โต๊ะ</th>
                                  <th>สถานะ</th>
                                  <th>รายการ</th>
                                </tr>
                              </thead>
                              <!-- <tbody>
                                <tr>
                                  <td nowrap>000000001</td>
                                  <td nowrap>11-7-2014 | 12:00</td>
                                  <td nowrap>โต๊ะ 1</td>
                                  <td nowrap><span class="text-danger fw-semibold">รอการยืนยัน</span></td>
                                  <td nowrap> <a href=""> <button type="button" class="btn btn-primary btn-sm">รายละเอียด</button> </a> </td>
                                </tr>
                                <tr>
                                  <td nowrap>000000002</td>
                                  <td nowrap>11-7-2014 | 12:00</td>
                                  <td nowrap>โต๊ะ 3</td>
                                  <td nowrap><span class="text-danger fw-semibold">รอการยืนยัน</span></td>
                                  <td nowrap> <a href=""> <button type="button" class="btn btn-primary btn-sm">รายละเอียด</button> </a> </td>
                                </tr>
                              </tbody> -->
                              <tbody>
                                <?php foreach (range(1, 4) as $key => $value) { ?>

                                  <tr>
                                    <td nowrap>000000001</td>
                                    <td nowrap>11-7-2014 | 12:00</td>
                                    <td nowrap>โต๊ะ 1</td>
                                    <td nowrap><span class="text-success fw-semibold">จ่ายเงินเรียนร้อย</span></td>
                                    <td nowrap> <a href="order_success.php?c=<?= $_GET['c'] ?>&id=<?= $id; ?>"> <button type="button" class="btn btn-primary btn-sm">รายละเอียด</button> </a> </td>

                                  </tr>
                                <?php  } ?>
                            </table>
                          </div>
                        </div>
                      </div>
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
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>