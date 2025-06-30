<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form inputs
$title = $conn->real_escape_string($_POST['title']);
$description = $conn->real_escape_string($_POST['description']);

// Check if file was uploaded
if (!isset($_FILES["resume"]) || $_FILES["resume"]["error"] === 4) {
    echo "no_file_uploaded";
    exit;
}

// File handling
$targetDir = "../views/uploads/resume/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$fileName = basename($_FILES["resume"]["name"]);
$targetFile = $targetDir . time() . "_" . $fileName;
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Allow PDF and DOCX
$allowedTypes = ["pdf", "doc", "docx"];

if (in_array($fileType, $allowedTypes)) {
    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $targetFile)) {
        // Save to DB
        $stmt = $conn->prepare("INSERT INTO resumes (title, description, file_path) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $description, $targetFile);
        $stmt->execute();
        echo "success";
    } else {
        echo "error_uploading_file";
    }
} else {
    echo "invalid_file_type";
}
?>
