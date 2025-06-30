<?php
// Connect to database
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
$name = $conn->real_escape_string($_POST['name']);
$bio = $conn->real_escape_string($_POST['bio']);

// Create uploads folder if it doesn't exist
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Handle profile picture
$image_path = '';
if (!empty($_FILES['profile_pic']['name'])) {
    $img_name = time() . "_" . basename($_FILES['profile_pic']['name']);
    $target_image = $uploadDir . $img_name;
    if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_image)) {
        $image_path = $target_image;
    }
}

// Handle resume
$resume_path = '';
if (!empty($_FILES['resume']['name'])) {
    $res_name = time() . "_" . basename($_FILES['resume']['name']);
    $target_resume = $uploadDir . $res_name;
    if (move_uploaded_file($_FILES['resume']['tmp_name'], $target_resume)) {
        $resume_path = $target_resume;
    }
}

// Delete old profile (optional if you want just one)
$conn->query("DELETE FROM profile");

// Insert into database
$sql = "INSERT INTO profile (name, bio, image_path, resume_path)
        VALUES ('$name', '$bio', '$image_path', '$resume_path')";

if ($conn->query($sql)) {
    header("Location: form.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}
?>
