<?php
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get and sanitize user input
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Validate input
if (empty($username) || empty($password)) {
    echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
    exit;
}

// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['username']; // Store username in session
        header("Location: admin/index.php"); // Redirect to dashboard
        exit;
    } else {
        echo "<script>alert('❌ Incorrect password.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('❌ Username not found.'); window.history.back();</script>";
}

// Close resources
$stmt->close();
$conn->close();
?>
