<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
$email = $_POST['email'];
$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
$stmt->bind_param("ss", $new_password, $email);

if ($stmt->execute()) {
  echo "Password reset successful!";
} else {
  echo "Failed to reset password.";
}
