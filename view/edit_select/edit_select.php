<?php $name_web = "เเก้ไขประเภท";

$types_food = ["อาหาร", "เครื่องดื่ม", "เเอลกอฮอล์"];
$id   = isset($_GET['id']) ? $_GET['id'] : 0;

// $id_type = $_POST['id_type'];
?>

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
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_select">
      + เพิ่มประเภท
    </button>
  </div>

  <div class="table-responsive m-4 p-4 border border-3 rounded-4">
    <table class="table table-hover table-head-fixed text-nowrap">
      <thead>
        <tr>
          <th class="w-50">ปรเภท</th>
          <th class="w-50" align="right">
          </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($types_food as  $data) {
        ?>
          <tr>
            <td nowrap><?= $data ?></td>
            <td nowrap align="right">
              <button class=" mx-2 btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#edit_select" id="<?= $id; ?>"><i class="bi bi-pen px-1"></i>เเก้ไข</button>
              <button class=" mx-2 btn btn-danger" type="submit" data-bs-toggle="modal" data-bs-target="#delete_select" id="<?= $id; ?>"><i class="bi bi-trash3-fill px-1"></i>ลบ</button>
            </td>
          </tr>
        <?php
        } ?>
      </tbody>
    </table>
  </div>

  <!-- delete select -->
  <div class="modal fade" id="delete_select" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ลบประเภท</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          คุณต้องการประเภท <b> <?= $types_food[0]; ?> </b> ออกใช่หรือไม่
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-danger" id="emp_id">ลบ</button>
        </div>
      </div>
    </div>
  </div>



  <!-- edit select -->
  <div class="modal fade" id="edit_select" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เเก้ไขประเภท</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" value="<?= $types_food[0]; ?>" class="form-control w-100">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
          <button type="submit" class="btn btn-warning" id="emp_id">เเก้ไข</button>
        </div>
      </div>
    </div>
  </div>

  <!-- add -->
  <div class="modal fade" id="add_select" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
          <button type="submit" class="btn btn-primary" id="emp_id">บันทึกข้อมูล</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../../add_framwork/jquery.js"></script>
  <?php include '../../add_framwork/js.php' ?>
</body>

</html>