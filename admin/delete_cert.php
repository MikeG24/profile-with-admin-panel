<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);

// Fetch file path before deletion
$res = $conn->query("SELECT file_path FROM certificates WHERE id = $id");
if ($res && $res->num_rows > 0) {
    $row = $res->fetch_assoc();
    $file = $row['file_path'];

    if (file_exists($file)) {
        unlink($file); // Delete the file from the server
    }

    $conn->query("DELETE FROM certificates WHERE id = $id");
}

$conn->close();

header("Location: button.php");
exit;
?>
