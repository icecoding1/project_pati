<?php
session_start();
require_once "connection/config.php";
isset($_SESSION['session_name']) && isset($_SESSION['session_status']) ? '' : header("Location: login.php");
$is_edit = isset($_GET['is_edit']) ? $_GET['is_edit'] : false;
$sql = "SELECT * FROM  table_member WHERE id = " . $_SESSION["id_member"];
$select =  $obj->prepare($sql);
$select->execute();
$result = $select->fetch(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ระบบจัดการนักเรียนเเละค่าใช้จ่าย</title>
  <?php include 'add_framwork/css.php' ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <div class="wrapper">


    <?php include('layout/preloader.php') ?>
    <?php include("layout/header.php"); ?>
    <?php include("layout/slidebar.php"); ?>





    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 fw-bold">ข้อมูลส่วนตัว</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="home.php">หน้าหลัก</a></li>
                <li class="breadcrumb-item active">ข้อมูลส่วนตัว</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <form id="form_personal" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?= $result['id'] ?>" name="id">
            <div class="d-flex justify-content-end align-items-center">
              <?php if ($is_edit) { ?>
                <a class="btn btn-secondary  mx-2" href="personal_data.php?id=1">ยกเลิก</a>
                <button type="submit" name="submit_datail-product" class="btn btn-primary">บันทึก</button>
              <?php } else { ?>
                <a class="btn btn-secondary px-3" href="personal_data.php?is_edit=1&id=1">เเก้ไขข้อมูล</a>
              <?php } ?>
            </div>
            <div class="box_add_edit_form">
              <div class="header">
                <p class="mb-0">จัดการข้อมูลส่วนตัว</p>
              </div>
              <div class="content row">

                <div class="col-xl-12 text-center mb-4">
                  <?php if ($is_edit) { ?>
                    <?php if (strpos($result['image'], ".")) { ?>
                      <img class="mb-3 " src="image_myweb/img_member/<?= $result['image'] ?>" style="max-width:752px; max-height:230px;border-radius:10px">
                    <?php } else { ?>
                      <img src="dist/img/avatar5.png" class="img-circle mb-3 border" alt="profile_member">
                    <?php } ?>
                    <input type="file" class="form-control" name="image_perosnal" accept="image/png,  image/jpeg">
                    <?php } else {
                    if (strpos($result['image'], ".")) { ?>
                      <img class="mb-22 " src="image_myweb/img_member/<?= $result['image'] ?>" style="max-width:752px; max-height:230px;border-radius:10px">
                    <?php } else { ?>
                      <img src="dist/img/avatar5.png" class="img-circle mb-3 border" alt="profile_member">
                      <p class="fw-semibold">ยังไม่มีรูปภาพ</p>
                  <?php }
                  } ?>
                </div>

                <p class="mb-2 fw-bold col-xl-1">ชื่อ</p>
                <div class="col-xl-5 mb-3 ">
                  <?php if ($is_edit == false) { ?>
                    <?= $result['name']; ?>
                  <?php } else { ?>
                    <input type="text" class="form-control" name="fullname" required value="<?= $result['name'] ?>">
                  <?php } ?>
                </div>



                <p class="mb-2 fw-bold col-xl-1">ชื่อผู้ใช้</p>
                <div class="col-xl-5 mb-3 ">
                  <?= $result['username']; ?>
                </div>


                <p class="mb-2 fw-bold col-xl-1">รหัสผ่านของคุณ</p>
                <div class="col-xl-5 mb-3 ">
                  <?php if ($is_edit == false) { ?>
                    <?= "******"; ?>
                  <?php } else { ?>
                    <input type="password" class="form-control" name="password_old" id="password_old" placeholder="โปรดกรอกรหัสเก่าของคุณหากต้องการเปลี่ยน">
                  <?php } ?>
                </div>

                <?php if ($is_edit) { ?>
                  <p class="mb-2 fw-bold col-xl-1">รหัสผ่านใหม่</p>
                  <div class="col-xl-5 mb-3 ">
                    <input type="password" class="form-control" name="password_new" id="password_new" placeholder="โปรดกรอกรหัสใหม่">
                  </div>
                  <div class="col-xl-12 mb-3 ">
                    <input type="checkbox" name="show_password" id="show_password">
                    <labal class="mb-2 fw-bold col-xl-1" for="show_password">เเสดงรหัสผ่าน</labal>
                  </div>
                <?php } ?>
              </div>
            </div>
          </form>
        </div>

      </section>
      <!-- /.content -->
    </div>

  </div>
  <!-- ./wrapper -->

  <?php include 'add_framwork/js.php' ?>
  <script>
    var show_password = document.getElementById("show_password");
    var password_new = document.getElementById("password_new");
    var form_personal = document.getElementById("form_personal");

    show_password.addEventListener("click", () => {
      if (show_password.checked == true) {
        password_new.type = 'text';
      } else if ((show_password.checked == false)) {
        password_new.type = 'password';
      }
    })

    form_personal.addEventListener("submit", async (e) => {
      e.preventDefault();

      const formdata = new FormData(form_personal);

      const data = await fetch("view/member/update_personal.php", {
        method: "POST",
        body: formdata
      })

      const res = await data.text();
      if (res == "อัพเดทข้อมูลเเละรหัสผ่านสำเร็จ" || res == "อัพเดทข้อมูลสำเร็จ") {
        Swal.fire({
          icon: 'success',
          title: res
        })
        if (res == "อัพเดทข้อมูลเเละรหัสผ่านสำเร็จ") {
          setInterval(() => {
            location.assign("logout.php");
          }, 2000)
        } else if (res == "อัพเดทข้อมูลสำเร็จ") {
          setInterval(() => {
            location.assign("set_session_member.php");
          }, 2000)
        }
      } else {
        Swal.fire({
          icon: 'error',
          title: res
        })
      }
    })
  </script>

</body>

</html>