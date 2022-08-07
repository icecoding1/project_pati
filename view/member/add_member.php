<?php $name_web = "เพิ่มสมาชิก"; ?>

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

<body class="bg-addmember">

  <div class="d-flex justify-content-center align-items-center box-add">
    <div class="box-add-member">
      <div class="d-flex justify-content-center mb-3">
        <p class="mb-0 fw-bold fs-5">เพิ่มสมาชิก</p>
      </div>

      <!-- <p class="mb-0 fw-bold">เพิ่มสมาชิก</p> -->
      <form action="" method="post">
        <div class="input-group mb-3 ">
          <span class="input-group-text fw-bold">Name</span>
          <input type="text" class="form-control" id="" name="" required>
        </div>
        <div class="input-group mb-3 ">
          <span class="input-group-text fw-bold">Username</span>
          <input type="text" class="form-control" id="" name="" required>
        </div>
        <div class="input-group mb-3 ">
          <span class="input-group-text fw-bold">Password</span>
          <input type="text" class="form-control" id="" name="" required>
        </div>
        <p class="fw-bold  mb-1">รูปภาพของคุณ <span class="text-danger">เฉพาะ png, jpg/jpeg</span></p>
        <div class="input-group mb-3">
          <input type="file" class="form-control" id="inputGroupFile01" alt="Image" accept="image/jpeg, image/png">
        </div>
        <select class="form-select mb-3">
          <option disabled selected="selected">สถานะ</option>
          <option value="1">admin</option>
          <option value="2">cashier</option>
          <option value="3">member</option>
        </select>
        <div class="d-flex justify-content-between">
          <a href="../../management_member.php" class="btn btn-secondary px-4">ยกลิก</a>
          <button type="subbmit" class="btn btn-primary px-4">บันทึก</button>
        </div>
      </form>
    </div>
  </div>

  <?php include '../../add_framwork/js.php' ?>
</body>

</html>