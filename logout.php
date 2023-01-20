<?php
ob_start();
session_start();
// session_destroy();
unset($_SESSION['id_member']);
unset($_SESSION['session_status']);
unset($_SESSION['session_image']);
unset($_SESSION['session_name']);
header("location: login.php");
