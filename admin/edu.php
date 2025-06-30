<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize inputs

$school = $conn->real_escape_string($_POST['school'] ?? '');
$course = $conn->real_escape_string($_POST['course'] ?? '');
$year_graduated = $conn->real_escape_string($_POST['year_graduated'] ?? '');
$company = $conn->real_escape_string($_POST['company'] ?? '');
$position = $conn->real_escape_string($_POST['position'] ?? '');
$duration = $conn->real_escape_string($_POST['duration'] ?? '');
$description = $conn->real_escape_string($_POST['description'] ?? '');

// Delete old (optional if you want to replace)
$conn->query("DELETE FROM user_profile");

// Insert new
$sql = "INSERT INTO user_profile 
        (school, course, year_graduated, company, position, duration, description) 
        VALUES 
        ('$school', '$course', '$year_graduated', '$company', '$position', '$duration', '$description')";

if ($conn->query($sql) === TRUE) {
    header("Location: form.php"); // Go back to profile
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
