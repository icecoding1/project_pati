<?php
ob_start();
session_start();
require_once "../../connection/config.php";
include("../../check_session.php");
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
  <input type='hidden' name='password_old' value=" . $row['password'] . ">
  " . $text_img . "
</div>
<div class='input-group mb-3 '>
  <span class='input-group-text fw-bold'>Name</span>
  <input type='text' class='form-control'  name='name' id='test_id' value=" . $row['name'] . " required>
</div>
<div class='input-group mb-3 '>
  <span class='input-group-text fw-bold'>Username</span>
  <input type='text' class='form-control'  name='username' value=" . $row['username'] . " disabled>
</div>
 " . $text_status . "";
  $text .= "<p class='fw-bold mt-4 mb-2 '>ต้องการเปลี่ยนรหัสผ่านใหม่สมาชิก</p>";
  $text .= "<div class='input-group mb-3 '>
    <span class='input-group-text fw-bold'>Password new</span>
 <input type='password' class='form-control'  name='password_new' value='' placeholder='กรุณากรอกรหัสผ่านสมาชิกใหม่'>
</div>";
  $text .= "<div class='input-group mb-3 '>
<span class='input-group-text fw-bold'>Password confirm </span>
<input type='password' class='form-control'  name='password_admin' value='' placeholder='กรุณากรอกรหัสผ่านผู้เเก้ไข รหัสผ่านสมาชิก'>
</div>";
}
echo $text;
