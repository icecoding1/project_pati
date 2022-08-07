<?php $name_web = "สั่งออเดอร์";

$page = isset($_GET['ppage']) ? $_GET['ppage'] : 1;

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
      <p class="mb-0 mx-2 text-white">สั่งออเดอร์</p>
    </div>
    <div>
      <a href="../../index1.php" class="btn btn-light px-4 mx-2">กลับ</a>
    </div>
  </header>

  <form action="" method="post">
    <div class="content-select">
      <select class="form-select form-select-lg mb-3 " aria-label=".form-select-lg example" id="select">
        <option selected disabled value="disabled">เลือกโต๊ะ</option>
        <option value="1">โต๊ะ1</option>
        <option value="2">โต๊ะ2</option>
        <option value="3">โต๊ะ3</option>
      </select>
    </div>
    <button type="submit" class="button-send fw-bold" id="disabled" disabled>สั่งอาหาร</button>
  </form>

  <script src="../../add_framwork/jquery.js"></script>
  <?php include '../../add_framwork/js.php' ?>

  <script>
    $(document).ready(function() {
      $("#select").change(function() {
        if ($(this).val() == "disabled") {
          $("#disabled").prop('disabled', true);
        } else {
          $("#disabled").prop('disabled', false);
          $("#disabled").addClass("btn-active");
        }
      })
      $("#disabled").click(function() {
        alert("โต๊ะที่ : " + $("#select").val())
      })
    });
  </script>

</body>

</html>