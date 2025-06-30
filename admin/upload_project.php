<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $conn->real_escape_string($_POST['projectTitle']);
$description = $conn->real_escape_string($_POST['projectDescription']);

$targetDir = "../views/uploads/";
$allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'zip', 'rar', 'docx', 'pptx'];
$filePaths = []; // Store uploaded file paths

if (!empty($_FILES['projectFile']['name'][0])) {
    foreach ($_FILES['projectFile']['name'] as $key => $fileName) {
        $tmpName = $_FILES['projectFile']['tmp_name'][$key];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes)) {
            $uniqueName = time() . "_" . uniqid() . "_" . basename($fileName);
            $targetFile = $targetDir . $uniqueName;

            if (move_uploaded_file($tmpName, $targetFile)) {
                $filePaths[] = $targetFile;
            } else {
                echo "❌ Failed to upload file: $fileName<br>";
            }
        } else {
            echo "⚠️ File type not allowed: $fileName<br>";
        }
    }

    if (!empty($filePaths)) {
        $filePathsStr = $conn->real_escape_string(implode(',', $filePaths));
        $sql = "INSERT INTO projects (title, description, file_path) VALUES ('$title', '$description', '$filePathsStr')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('✅ Project and files uploaded successfully!'); window.location.href='typography.php';</script>";
        } else {
            echo "❌ Error saving project to database: " . $conn->error;
        }
    } else {
        echo "⚠️ No files uploaded successfully.";
    }
} else {
    echo "⚠️ No files selected.";
}
?>
