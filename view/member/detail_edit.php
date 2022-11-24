<?php
ob_start();
session_start();
if (isset($_SESSION["session_name"])  &&  isset($_SESSION["session_status"])) {
  require_once "../../connection/config.php";
  $id = $_POST['id'];
  $sql = "SELECT * FROM table_member WHERE id = $id";
  $result = $obj->query($sql);
  $text = "";
  $text_status = "";
  $text_img = "";

  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

    if (strpos($row['image'], ".")) {
      $text_img = " <img src='image_myweb/img_member/" . $row['image'] . "' class='img-circle profile_member ' alt='profile_member'>";
    } else {
      $text_img = " <img src='dist/img/avatar5.png' class='img-circle profile_member ' alt='profile_member'>";
    }

    $status = $row['status'];
    if ($status === "admin") {
      $text_status = "
    <select class='form-select mb-3' name='status'>
    <option value='admin' selected='selected'>admin</option>
    <option value='cashier' >cashier</option>
    <option value='member' >member</option>
    </select>";
    } else if ($status === "cashier") {
      $text_status = "
    <select class='form-select mb-3' name='status'>
    <option value='admin' '>admin</option>
    <option value='cashier' selected='selected'>cashier</option>
    <option value='member' >member</option>
    </select>";
    } else if ($status === "member") {
      $text_status = "
    <select class='form-select mb-3' name='status'>
    <option value='admin' '>admin</option>
    <option value='cashier' >cashier</option>
    <option value='member' selected='selected'>member</option>
    </select>";
    } else {
      $text_status = "
    <select class='form-select mb-3' name='status'>
    <option disabled selected='selected'>สถานะ</option>
    <option value='admin' '>admin</option>
    <option value='cashier' >cashier</option>
    <option value='member' >member</option>
    </select>";
    }


    $text .= "
  <div class='d-flex justify-content-center align-items-center mb-3'>
  <input type='hidden' name='id' value=" . $row['id'] . ">
  <input type='hidden' name='image' value=" . $row['image'] . ">
  " . $text_img . "
</div>
<div class='input-group mb-3 '>
  <span class='input-group-text fw-bold'>Name</span>
  <input type='text' class='form-control'  name='name' value=" . $row['name'] . ">
</div>
<div class='input-group mb-3 '>
  <span class='input-group-text fw-bold'>Username</span>
  <input type='text' class='form-control'  name='username' value=" . $row['username'] . " disabled>
</div>
<p class='fw-bold  mb-1'>เปลี่ยนรูปภาพของคุณ ขนาดที่เเนะนำ <span class='text-danger'>50px * 50px เฉพาะ png, jpg/jpeg</span></p>
<div class='input-group mb-3'>
  <input type='file' class='form-control'  alt='Image' accept='image/jpeg, image/png' name='imgEdit'>
</div>
 " . $text_status . "";
  }
  echo $text;
} else {
  echo "<script>
if(confirm('กรุณา login ก่อนเข้าสู่ระบบ')){
location.assign('login.php');
}else {
  location.assign('login.php');
}
</script>";
}
