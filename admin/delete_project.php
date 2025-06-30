<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Get file paths before deleting
    $result = $conn->query("SELECT file_path FROM projects WHERE id = $id");
    if ($result && $row = $result->fetch_assoc()) {
        $filePaths = explode(',', $row['file_path']);
        foreach ($filePaths as $file) {
            if (file_exists($file)) {
                unlink($file); // Delete the file from the server
            }
        }
    }

    // Delete the project record
    $delete = $conn->query("DELETE FROM projects WHERE id = $id");

    echo $delete ? "success" : "error";
}
?>
