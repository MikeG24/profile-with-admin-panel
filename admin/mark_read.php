<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $conn = new mysqli("localhost", "root", "", "portfoliodb");
    if ($conn->connect_error) {
        die("Connection failed");
    }

    $id = intval($_POST['id']);
    $stmt = $conn->prepare("UPDATE messages SET status = 'Read' WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
}
?>
