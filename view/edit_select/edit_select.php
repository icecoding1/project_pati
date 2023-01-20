<?php

ob_start();
session_start();
require_once "../../connection/config.php";
$name_web = "เเก้ไขประเภท";
include("check_session.php");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $type = isset($_POST["add_type"]) ? $_POST["add_type"] : null;
  $edit_type = isset($_POST["edit_type"]) ? $_POST["edit_type"] : null;
  $id = isset($_POST["id"]) ? $_POST["id"] : null;
  $check_id = isset($_POST["id"]) ? true : false;


  $sql =  $check_id ? "UPDATE table_typefood SET type = :type  WHERE id = :id" : "INSERT INTO table_typefood (type) values(:type)";
  try {
    if ($check_id) {
      $update = $obj->prepare($sql);
      $update->bindParam(":type", $edit_type);
      $update->bindParam(":id", $id);
      $result = $update->execute();
      if ($result) {
        echo "<script>alert('เเก้ไขสมาชิกสำเร็จ');</script>";
        echo "<script> window.location.assign('edit_select.php');</script>";
      }
    } else {
      $insert = $obj->prepare($sql);
      $insert->bindParam(":type", $type);
      $result = $insert->execute();
      if ($result) {
        echo "<script>alert('เพิ่มสมาชิกสำเร็จ');</script>";
        echo "<script> window.location.assign('edit_select.php');</script>";
      }
    }
  } catch (PDOException $e) {
    $e->getMessage();
    echo "<script>alert('การเพิ่มเเละเเก้ไขสมาชิกไม่สำเร็จ');</script>";
    echo "<script> window.location.assign('edit_select.php');</script>";
  }
}


?>
<?php if ($_SESSION["session_status"] == "admin") { ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name_web;  ?></title>
    <?php include '../../add_framwork/css.php' ?>
    <link rel="stylesheet" href="../../assets/css/management.css">
    <link rel="icon" href="../../favicon/logo_favicon.png">
  </head>

  <body class="body-order ">


    <header class="header-nav-order">
      <div class="d-flex align-items-center">
        <img src="../../dist/img/food_pachaew_logo.png" alt="profile" class="mx-2 header-profile-order">
        <p class="mb-0 mx-2 text-white">จัดการประเภทอาหาร</p>
      </div>
      <div>
        <a href="../../setting.php" class="btn btn-light px-4 mx-2 my-3">กลับ</a>
      </div>
    </header>

    <div class="w-100 d-flex justify-content-center my-4">
      <button class="btn btn-primary insertModal">
        + เพิ่มประเภท
      </button>
    </div>

    <div class="table-responsive m-4 p-4 border border-3 rounded-4">
      <table class="table table-hover table-head-fixed text-nowrap">
        <thead>
          <tr>
            <th class="w-50">ประเภท</th>
            <th class="w-50" align="right">
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result = $obj->prepare("SELECT * FROM table_typefood");
          $result->execute();

          if ($result->rowCount() >= 1) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
              <tr>
                <td nowrap><?= $row['type'] ?></td>
                <td nowrap align="right">
                  <button class=" mx-2 btn btn-warning editBtn" type="button" id="<?= $row['id'] ?>"><i class="bi bi-pen px-1"></i>เเก้ไข</button>
                  <button class=" mx-2 btn btn-danger deleteBtn" type="button" id="<?= $row['id'] ?>"><i class="bi bi-trash3-fill px-1"></i>ลบ</button>
                </td>
              </tr>
            <?php }
          } else { ?>
            <tr>
              <td nowrap>no data</td>
              <td nowrap align="right">
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>

    <!-- delete select -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
      <div class="modal-dialog">
        <form action="confirm_delete.php" method="GET">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">ลบประเภท</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailDelete">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
              <button type="submit" class="btn btn-danger" id="emp_id">ลบ</button>
            </div>
          </div>
        </form>
      </div>
    </div>



    <!-- edit select -->
    <div class="modal fade" id="editModal" tabindex="-1">
      <div class="modal-dialog">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">เเก้ไขประเภท</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailEdit">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
              <button type="submit" class="btn btn-warning">เเก้ไข</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- add -->
    <div class="modal fade" id="insertModal" tabindex="-1">
      <div class="modal-dialog">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">เพิ่มประเภท</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="text" value="" class="form-control w-100" name="add_type" placeholder="พิมพ์ประเภทที่คุณต้องการ">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
              <button type="submit" class="btn btn-primary" ">บันทึกข้อมูล</button>
          </div>
        </div>
        </form>
      </div>
    </div>

    <script src=" ../../add_framwork/jquery.js"></script>
                <?php include '../../add_framwork/js.php' ?>


                <script>
                  $(document).ready(function() {
                    $('.insertModal').click(function() {
                      $('#insertModal').modal('show');
                    });

                    $('.editBtn').click(function() {
                      var uid = $(this).attr('id');
                      $.ajax({
                        url: "detail_edit.php",
                        method: "post",
                        data: {
                          id: uid
                        },
                        success: function(data) {
                          $('#detailEdit').html(data);
                          $('#editModal').modal('show');
                        }
                      });
                    });

                    $('.deleteBtn').click(function() {
                      var uid = $(this).attr('id');
                      $.ajax({
                        url: "detail_delete.php",
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

                  });
                </script>
  </body>

  </html>
<?php }  ?>