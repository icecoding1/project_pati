<?php

ob_start();
session_start();
require_once "connection/config.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = htmlentities($_POST['txt_username'], ENT_QUOTES);
  $password = htmlentities($_POST['txt_password'], ENT_QUOTES);

  $sql = "SELECT * FROM table_member WHERE username = '$username' AND password = '$password'";
  $result =  $obj->query($sql);


  if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION["id_member"] = $row["id"];
    $_SESSION["session_username"] = $row["username"];
    $_SESSION["session_password"] = $row["password"];
    $_SESSION["session_status"] = $row["status"];
    $_SESSION["session_image"] = $row["image"];
    $_SESSION["session_name"] = $row["name"];
    header("location: set_session_structure.php");
  } else {
    echo "<script>
    if(confirm(' password หรือ username ของคุณไม่ถูกต้อง')){
      location.assign('login.php');
    }
    </script>";
  }
}

$sql_structure = "SELECT * FROM structure_management";
$select_bg = $obj->query($sql_structure);
$datafetch = $select_bg->fetch(PDO::FETCH_ASSOC);
// $img = $datafetch['background'];
// echo  $data;

?>



<!DOCTYPE html>
<html lang="en" class="html">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <?php include 'add_framwork/css.php' ?>
</head>

<body>


  <div class="bg-login d-flex justify-content-center align-items-center" style="background-image: url('image_myweb/img_structure_management/<?= $datafetch['background'] ?>');">

    <div class=" login-box">

      <div class="login-logo">
        <a href="index.php" class="d-flex justify-content-center align-items-center flex-wrap">
          <?php if (strpos($datafetch['logo_shop'], ".")) { ?>
            <img src="image_myweb/img_structure_management/<?= $datafetch['logo_shop']  ?>" alt="logo" class="logo-login" loading="lazy">
          <?php } else { ?>
            <img src="assets/img/logo_empty.jpg" alt="logo" class="logo-login" loading="lazy">
          <?php } ?>
          <b class="text-white px-1 text-pachaew"><?= $datafetch['name_shop'] ?></b>
        </a>
      </div>

      <div class="card padding-card-login ">
        <div class="card-body   ">
          <p class="login-box-msg">Sign in to management</p>


          <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form">
            <div class="input-group mb-3">
              <input type="username" class="form-control" placeholder="Username" name="txt_username" require>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="bi bi-person-circle"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" placeholder="Password" name="txt_password" require>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember">
                  <label for="remember">
                    จดจำ
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <button type="submit" class="btn btn-primary btn-block">เข้าสู่ระบบ</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>
    <?php include 'add_framwork/js.php' ?>


</body>

</html>