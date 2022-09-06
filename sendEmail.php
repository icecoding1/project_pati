<?php

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['name']) && isset($_POST['email'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $header = $_POST['header'];
    $detail = $_POST['detail'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    // SMTP Settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "iceiiiii1998@gmail.com"; // enter your email address
    $mail->Password = "asdbnmii495"; // enter your password
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //Email Settings
    $mail->isHTML(true);
    $mail->setFrom($email);
    $mail->addAddress("patiphonwongsee01@gmail.com"); // Send to mail
    $mail->Subject = $email;
    $mail->Body = $detail;

    if ($mail->send()) {
        $status = "success";
        $response = "Email is sent";
    } else {
        $status = "failed";
        $response = "Something is wrong" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}
