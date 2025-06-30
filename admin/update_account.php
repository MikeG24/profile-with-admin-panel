<?php
session_start();
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// OPTIONAL: Use session if logged in user
// $user_id = $_SESSION['user_id'];

// OR use hidden input in form
$user_id = $_POST['user_id'];  // Make sure your form includes this as a hidden field

$email = $conn->real_escape_string($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$security_question = $conn->real_escape_string($_POST['security_question']);
$security_answer = $conn->real_escape_string($_POST['security_answer']);

// Check passwords match
if ($password !== $confirm_password) {
    die("Passwords do not match.");
}

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Update query
$sql = "UPDATE users SET 
            email = '$email',
            password = '$hashed_password',
            security_question = '$security_question',
            security_answer = '$security_answer'
        WHERE id = $user_id";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Account updated successfully!'); window.location.href='table.php';</script>";
} else {
    echo "Error updating account: " . $conn->error;
}

$conn->close();
?>
