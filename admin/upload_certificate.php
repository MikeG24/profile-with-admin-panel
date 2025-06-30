<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $conn->real_escape_string($_POST['title']);
$description = $conn->real_escape_string($_POST['description']);

$targetDir = "uploads/";
$allowedTypes = ['jpg', 'jpeg', 'png', 'pdf'];

$errors = [];
$success = [];

foreach ($_FILES['files']['name'] as $index => $name) {
    $error = $_FILES['files']['error'][$index];
    $tmpName = $_FILES['files']['tmp_name'][$index];
    $fileName = basename($name);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if ($error === 0) {
        if (in_array($fileExt, $allowedTypes)) {
            $newFileName = time() . '_' . preg_replace('/[^A-Za-z0-9_\-\.]/', '', $fileName);
            $targetFilePath = $targetDir . $newFileName;

            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $sql = "INSERT INTO certificates (title, description, file_path)
                        VALUES ('$title', '$description', '$targetFilePath')";
                if ($conn->query($sql)) {
                    $success[] = $fileName;
                } else {
                    $errors[] = "DB error for $fileName: " . $conn->error;
                }
            } else {
                $errors[] = "Failed to move file: $fileName";
            }
        } else {
            $errors[] = "Invalid file type: $fileName";
        }
    } else {
        $errors[] = "Upload error ($error) for file: $fileName";
    }
}

$conn->close();

if (empty($errors)) {
    // ✅ If all files uploaded successfully — show success and redirect
    echo "<script>
        alert('Certificate(s) uploaded successfully!');
        window.location.href = 'button.php';
    </script>";
} else {
    // ❌ Show errors
    echo "<h3 style='color:red;'>Upload failed with the following error(s):</h3>";
    echo "<ul style='color:red;'>";
    foreach ($errors as $e) {
        echo "<li>" . htmlspecialchars($e) . "</li>";
    }
    echo "</ul>";
    echo "<br><a href='button.php'>← Back to upload</a>";
}
?>
