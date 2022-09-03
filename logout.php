<?php
ob_start();
session_start();
session_destroy();
// unset($_SESSION["session_username"]);
// unset($_SESSION["session_password"]);
// session_unset($_SESSION["session_status"]);
// session_unset($_SESSION["session_image"]);
// session_unset($_SESSION["session_name"]);
// session_unset($_SESSION["id_member"]);
// session_unset();
header("location: login.php");
