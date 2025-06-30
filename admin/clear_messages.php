<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete all messages
$conn->query("DELETE FROM messages");

// Optional: reset auto-increment (if you want to reset the ID counter)
$conn->query("ALTER TABLE messages AUTO_INCREMENT = 1");

// Redirect back (change to your actual admin page if needed)
header("Location: index.php"); // or index.php or dashboard.php — update as needed
exit();
?>
