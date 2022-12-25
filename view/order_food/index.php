<?php $name_web = "สั่งออเดอร์";
require_once "../../connection/config.php";
ob_start();
session_start();
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
  $count_table =  $_SESSION["count_table"];
  $_SESSION["session_table"] = isset($_SESSION["session_table"]) ? $_SESSION["session_table"] :  "คุณไม่ได้เลือกโต๊ะ";
  // echo $count_table;
  // require_once "../../connection/config.php";

  // check session table
  if ($_SESSION["session_table"] == "คุณไม่ได้เลือกโต๊ะ") {
    $btn_txt = 'd-none';
  } else {
    $btn_txt = '';
  }
?>



  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $name_web;  ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/management.css">
    <link rel="icon" href="../../favicon/logo_favicon.png">
  </head>

  <body class="body-order">


    <header class="header-nav-order">
      <div class="d-flex align-items-center">
        <img src="../../dist/img/food_pachaew_logo.png" alt="profile" class="mx-2 header-profile-order">
        <p class="mb-0 mx-2 text-white">สั่งออเดอร์</p>
      </div>
      <div>
        <a href="order_receive.php" class="btn btn-light px-4 mx-2 my-3 <?= $btn_txt ?>">รายการอาหารของฉัน</a>
        <a href="../../home.php" class="btn btn-light px-4 mx-2 my-3">กลับ</a>
      </div>
    </header>

    <form action="order_receive.php" method="post" class="form-content">
      <div class="content-select">
        <select class="form-select form-select-lg  " aria-label=".form-select-lg example" id="select" name="select_table">
          <option selected disabled value="disabled">เลือกโต๊ะ</option>
          <?php for ($i = 1; $i <= $count_table; $i++) {  ?>
            <option value="<?= $i ?>">โต๊ะ : <?= $i; ?></option>
          <?php } ?>
        </select>
      </div>
      <button type="submit" class="button-send fw-bold" id="disabled" disabled>กรุณาเลือกโต๊ะของท่าน</button>
    </form>

    <script src="../../add_framwork/jquery.js"></script>


    <script>
      $(document).ready(function() {
        $("#select").change(function() {
          if ($(this).val() == "disabled") {
            $("#disabled").prop('disabled', true);
          } else {
            $("#disabled").prop('disabled', false);
            $("#disabled").addClass("btn-active");
            $("#disabled").text("สั่งอาหาร");
          }
        })
        $("#disabled").click(function() {
          alert("โต๊ะที่ : " + $("#select").val())

        })
      });
    </script>

  </body>

  </html>


<?php } else {
  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('../../login.php');
}else {
location.assign('../../login.php');
}
</script>";
} ?>