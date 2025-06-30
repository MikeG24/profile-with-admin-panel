<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize input
$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$question = trim($_POST['security_question']);
$answer = trim(strtolower($_POST['security_answer'])); // Convert to lowercase for consistency

// Password match check
if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
    exit;
}

// Check for existing username or email
$check = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
$check->bind_param("ss", $username, $email);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    echo "<script>alert('Username or Email already exists.'); window.history.back();</script>";
    $check->close();
    $conn->close();
    exit;
}
$check->close();

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the user
$stmt = $conn->prepare("INSERT INTO users (username, email, password, security_question, security_answer) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $username, $email, $hashed_password, $question, $answer);

if ($stmt->execute()) {
    echo "<script>alert('User added successfully.'); window.location.href='table.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
