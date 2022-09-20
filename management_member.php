<?php
$name_web = "ระบบจัดการร้านอาหาร";
$id_member = 1;
$page_nav = 4;

ob_start();
session_start();
if ($_SESSION["session_username"] &&  $_SESSION["session_password"]) {
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
                  <h1 class="m-0">จัดการสมาชิก</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item active">จัดการสมาชิก</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>

          <section class="content p-3">
            <div class="container-fluid ">

              <div class="d-flex justify-content-end my-3">
                <a href="view/member/update_member.php" class="btn btn-primary mx-1 ">+ เพิ่มสมาชิก</a>
              </div>

              <div class="card ">
                <div class="card-header">
                  <h3 class="card-title">ตารางสมาชิก</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body table-responsive p-0 ">
                  <table class="table table-striped projects table table-hover table-head-fixed text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      include("connection/config.php");
                      $sql = "SELECT * FROM  table_member";
                      $result = $obj->query($sql);
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                        <tr>
                          <td>
                            <?= $id_member++ ?>
                          </td>
                          <td>
                            <?php
                            if (strpos($row['image'], ".")) {
                            ?>
                              <img src="image_myweb/img_member/<?= $row['image'] ?>" class="img-circle profile_member " alt="profile_member">
                            <?php } else { ?>
                              <img src="dist/img/avatar5.png" class="img-circle profile_member " alt="profile_member">
                            <?php } ?>
                          </td>
                          <td>
                            <?= $row['name']; ?>
                          </td>
                          <td>
                            <?= $row['username']; ?>
                          </td>
                          <td>
                            <?= $row['password']; ?>
                          </td>
                          <td>
                            <span class="badge badge-success"><?= $row['status']; ?></span>
                          </td>
                          <td class="project-actions text-right">
                            <!-- <a class="btn btn-primary btn-sm mx-1" href="#">
                          <i class="fas fa-folder">
                          </i>
                          View
                        </a> -->
                            <button class="btn btn-info btn-sm mx-1 editbtn_member" type="button" id="<?= $row['id'] ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                            </button>
                            <button class="btn btn-danger btn-sm mx-1 deletebtn_member" type="button" id="<?= $row['id'] ?>">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                            </button>
                          </td>

                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>

            </div>
          </section>



        </div>

      </div>



      <?php include "view/member/modal_edit.php"; ?>
      <?php include "view/member/madal_delete.php"; ?>

      <?php include 'add_framwork/js.php' ?>
      <script>
        $(document).ready(function() {
          $('.editbtn_member').click(function() {
            var uid = $(this).attr("id");

            $.ajax({
              url: "view/member/detail_edit.php",
              method: "post",
              data: {
                id: uid
              },
              success: function(data) {
                $('#detail_edit').html(data);
                $('#editModal').modal('show');
              }
            });
          });

          $('.deletebtn_member').click(function() {
            var uid = $(this).attr("id");

            $.ajax({
              url: "view/member/detail_delete.php",
              method: "post",
              data: {
                id: uid
              },
              success: function(data) {
                $('#detailDelete').html(data);
                $('#deleteModal').modal('show');
              }
            });
          });

          // // test การใช้ งาน ส่ งค่ า id จาก button มา ที่ model
          // $('#delete_member').on('show.bs.modal', function(event) {
          //   var button = $(event.relatedTarget);
          //   var id = button.data('id');
          //   var modal = $(this);
          //   modal.find('#emp_id').val(id);
          // });
          // // event.relatedtarget คือ event ค่าที่ใช้สำหรับรับส่งข้อมูล ที่มีความสัมพันธ์กัน
        });
      </script>

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