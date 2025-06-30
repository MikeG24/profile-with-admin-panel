<?php
session_start();
$email = $_POST['email'];
$code = rand(100000, 999999);

// Store code in session (or use DB)
$_SESSION['reset_codes'][$email] = $code;

// Use PHPMailer to send
require '../PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';  // change if using different SMTP
$mail->SMTPAuth = true;
$mail->Username = 'yourgmail@gmail.com'; // your Gmail
$mail->Password = 'yourpassword';        // your Gmail app password
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('yourgmail@gmail.com', 'Your App');
$mail->addAddress($email);
$mail->Subject = 'Your Verification Code';
$mail->Body    = "Your verification code is: $code";

if ($mail->send()) {
  echo "success";
} else {
  echo "fail";
}
