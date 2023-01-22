<?php
ob_start();
session_start();
$name_web = "ระบบจัดการร้านอาหาร";
require_once("connection/config.php");
include("check_session.php");

$page_nav = 6;
$id = isset($_GET["id"]) ? $_GET["id"] : header('location:article.php');
empty($id) ? header("Location:article.php") : '';

$sql = "SELECT * FROM table_article WHERE id = '$id'";
$select = $obj->prepare($sql);
$select->execute();
$rows = $select->fetch();up
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
    <?php include('layout/header.php') ?>
    <?php include('layout/slidebar.php') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper set-content">

      <div class="content-header mx-3">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0"> <i class="bi bi-pen-fill"></i> เเก้ไขบทความ</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="article.php">กลับ</a></li>
                <li class="breadcrumb-item active">จัดการบทความ </li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content p-2">
        <div class="container-fluid ">

          <div class="card ">
            <div class="card-header">
              <h3 class="card-title">เเก้ไขบทความ</h3>
            </div>
            <div class="card-body  p-4 ">
              <form class="row" method="POST" enctype="multipart/form-data" id="form_update_article">
                <input type="hidden" value="<?= $rows['id'] ?>" name="id_article">
                <p class="col-12 mb-0 fw-bold">หัวข้อ</p>
                <div class="col-12 mb-3">
                  <input type="text" name="header" class="form-control" required value="<?= $rows['header'] ?>">
                </div>
                <p class="col-12 mb-0 fw-bold">ประเภทบทความ</p>
                <div class="col-12 mb-3">
                  <input type="text" name="type" class="form-control" required value="<?= $rows['type'] ?>">
                </div>
                <p class="col-12 mb-0 fw-bold">เนื้อหา</p>
                <div class="col-12 mb-3">
                  <textarea id="editor" type="text" name="detail_article"><?= $rows['detail'] ?></textarea>
                </div>
                <div class="col-12 mt-3">
                  <input type="submit" value="บันทึก" class="btn btn-primary" name="submit_add_btn">
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>

        </div>
      </section>

    </div>
  </div>

  <?php include 'add_framwork/js.php' ?>
  <script src="ckeditor5/ckeditor.js"></script>
  <script>
    ClassicEditor
      .create(document.querySelector('#editor'))
      .catch(error => {
        console.error(error);
      });

    var form_update_article = document.getElementById('form_update_article');

    form_update_article.addEventListener("submit", async (e) => {
      e.preventDefault();
      const formData = new FormData(form_update_article);
      formData.append("submit_update", 1);

      if (form_update_article.checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
        return false;
      } else {
        const data = await fetch("view/article/add_article.php", {
          method: "POST",
          body: formData
        })
        const response = await data.text();
        // console.log(response);
        if (response == "success") {
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'เเก้ไขบทความสำเร็จ',
            showConfirmButton: false,
          })
          setTimeout(() => {
            location.reload();
          }, 1500);
        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: response,
            showConfirmButton: false,
          })
        }
      }
    })
  </script>

</body>

</html>