<?php
session_start();

// Handle uploaded profile picture
$profilePicturePath = '';
if (!empty($_FILES['profile_picture']['name'])) {
    $profilePic = $_FILES['profile_picture'];
    $targetDir = "uploads/";
    $profilePicturePath = $targetDir . basename($profilePic["name"]);
    move_uploaded_file($profilePic["tmp_name"], $profilePicturePath);
}

// Handle uploaded resume
$resumePath = '';
if (!empty($_FILES['resume']['name'])) {
    $resume = $_FILES['resume'];
    $targetDir = "uploads/";
    $resumePath = $targetDir . basename($resume["name"]);
    move_uploaded_file($resume["tmp_name"], $resumePath);
}

// Save all info in session
$_SESSION['profile'] = [
    'name' => $_POST['name'],
    'bio' => $_POST['bio'],
    'profile_picture' => $profilePicturePath,
    'resume' => $resumePath
];

// Redirect back to profile
header("Location: profile.php");
exit;
?>
