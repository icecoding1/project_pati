<?php
ob_start();
session_start();
$name_web = "เพิ่มสมาชิก";
require_once "../../connection/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = isset($_POST["id"]) ? $_POST["id"] : null;
  $check_id = isset($_POST["id"]) ? true : false;
  $password_new = isset($_POST["password_new"]) ? $_POST["password_new"] : false;
  $password_old = isset($_POST["password_old"]) ? $_POST["password_old"] : false;
  $password_admin = isset($_POST["password_admin"]) ? $_POST["password_admin"] : false;
  $name = $_POST["name"];
  $status = $_POST["status"];


  date_default_timezone_set("Asia/Bangkok");
  $date = date("dmy");
  $numrandom = (mt_rand());


  $uplode = isset($_FILES['img']) ? $_FILES['img'] : null;
  if ($uplode != null) {
    $path = "../../image_myweb/img_member/";
    $type = strrchr($_FILES['img']['name'], ".");
    $nameimg = $date . $numrandom . $type;
    $path_link =  "../../image_myweb/img_member/" . $nameimg;

    move_uploaded_file($_FILES['img']['tmp_name'], $path_link);
  } else {
    $nameimg = "NO img";
  }



  $sql = $check_id ?   "UPDATE table_member SET  name = :name, password = :password, status = :status WHERE id = :id" : "INSERT INTO table_member(image, name, username, password, status) VALUES(:image,:name,:username,:password,:status)";

  try {
    if ($check_id) {
      if ($password_new &&   $password_admin) {
        $check_pw = "SELECT password  FROM table_member WHERE id = :id";
        $fetch_check_pw = $obj->prepare($check_pw);
        $fetch_check_pw->execute(["id" =>  $_SESSION["id_member"]]);
        $result_check =   $fetch_check_pw->fetch();
        $hash_pw_admin = md5($password_admin);
        $hash_pw_new = md5($password_new);
        if ($hash_pw_admin ==   $result_check['password']) {
          $update_password = $obj->prepare($sql);
          $update_password->bindParam(":name", $name);
          $update_password->bindParam(":password", $hash_pw_new);
          $update_password->bindParam(":status", $status);
          $update_password->bindParam(":id", $id);
          $update_password->execute();
          echo "<script>alert('เเก้ไขข้อมูลเเละรหัสผ่านสำเร็จ');</script>";
          echo "<script> window.location.assign('../../management_member.php');</script>";
        } else {
          echo "<script>alert('รหัสผ่านของคุณไม่ถุกต้อง');</script>";
          echo "<script> window.location.assign('../../management_member.php');</script>";
        }
      } else {
        $insert = $obj->prepare($sql);
        $insert->bindParam(":name", $name);
        $insert->bindParam(":password", $password_old);
        $insert->bindParam(":status", $status);
        $insert->bindParam(":id", $id);
        $result = $insert->execute();
        if ($result) {
          echo "<script>alert('การเเก้ไขสมาชิกสำเร็จ');</script>";
          echo "<script> window.location.assign('../../management_member.php');</script>";
        }
      }
    } else {
      $username = $_POST["username"];
      $password = $_POST["password"];
      $hash = md5($password);

      // check username
      $sql_check_username = "SELECT COUNT(username) FROM table_member WHERE username = :username";
      $fetch_check_user = $obj->prepare($sql_check_username);
      $fetch_check_user->execute(["username" =>  $username]);
      $result_username = $fetch_check_user->fetchColumn();

      if ($result_username > 0) {
        echo "<script>alert('มีชื่อสมาชิกนี่อยู่เเล้ว กรุณาใช้ชื่อื่น');</script>";
      } else {
        $insert = $obj->prepare($sql);
        $insert->bindParam(":image", $nameimg);
        $insert->bindParam(":name", $name);
        $insert->bindParam(":username", $username);
        $insert->bindParam(":password", $hash);
        $insert->bindParam(":status", $status);
        $result = $insert->execute();
        echo "<script>alert('การเพิ่มสมาชิกสำเร็จ');</script>";
        echo "<script> window.location.assign('../../management_member.php');</script>";
      }
    }
  } catch (PDOException $e) {
    $e->getMessage();
    echo "<script>alert('การเพิ่มข้อมูลหรือเเก้ไขไม่ถูกต้อง');</script>";
    echo "<script> window.location.assign('../../management_member.php');</script>";
  }
}


if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
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

    <body class="bg-addmember">

      <div class="d-flex justify-content-center align-items-center box-add">
        <div class="box-add-member">
          <div class="d-flex justify-content-center mb-3">
            <p class="mb-0 fw-bold fs-5">เพิ่มสมาชิก</p>
          </div>

          <!-- <p class="mb-0 fw-bold">เพิ่มสมาชิก</p> -->
          <form action="<?php $_SERVER['PHP_SELF'] ?> " method="POST" enctype="multipart/form-data">
            <div class="input-group mb-3 ">
              <span class="input-group-text fw-bold">Name</span>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="input-group mb-3 ">
              <span class="input-group-text fw-bold">Username</span>
              <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="input-group mb-3 ">
              <span class="input-group-text fw-bold">Password</span>
              <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <p class="fw-bold  mb-1">รูปภาพของคุณ ขนาดที่เเนะนำ <span class="text-danger"> 50px * 50px เฉพาะ png, jpg/jpeg</span></p>
            <div class="input-group mb-3">
              <input type="file" class="form-control" id="img" name="img" alt="Image" accept="image/jpeg, image/png">
            </div>
            <select class="form-select mb-3" name="status" required>
              <option disabled selected="selected">สถานะ</option>
              <option value="admin">admin</option>
              <option value="cashier">cashier</option>
              <option value="member">member</option>
            </select>
            <div class="d-flex justify-content-between">
              <a href="../../management_member.php" class="btn btn-secondary px-4">ยกลิก</a>
              <button type="submit" class="btn btn-primary px-4">บันทึก</button>
            </div>
          </form>
        </div>
      </div>

      <?php include '../../add_framwork/js.php' ?>
    </body>

    </html>
  <?php } ?>

<?php } else {
  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('../../login.php');
}else {
location.assign('../../login.php');
}
</script>";
} ?>