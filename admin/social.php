<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data (with fallback if nothing sent)
$gmail    = $conn->real_escape_string($_POST['gmail'] ?? '');
$whatsapp = $conn->real_escape_string($_POST['whatsapp'] ?? '');
$github   = $conn->real_escape_string($_POST['github'] ?? '');
$telegram = $conn->real_escape_string($_POST['telegram'] ?? '');
$phone    = $conn->real_escape_string($_POST['phone'] ?? '');
$facebook = $conn->real_escape_string($_POST['facebook'] ?? '');
$linkedin = $conn->real_escape_string($_POST['linkedin'] ?? '');

// Check if any row exists
$check = $conn->query("SELECT id FROM socials LIMIT 1");

if ($check && $check->num_rows > 0) {
    // UPDATE latest row
    $sql = "
    UPDATE socials
    SET 
      gmail = '$gmail',
      whatsapp = '$whatsapp',
      github = '$github',
      telegram = '$telegram',
      phone = '$phone',
      facebook = '$facebook',
      linkedin = '$linkedin'
    WHERE id = (SELECT id FROM (SELECT id FROM socials ORDER BY id DESC LIMIT 1) AS latest)
    ";
} else {
    // INSERT new row
    $sql = "
    INSERT INTO socials (gmail, whatsapp, github, telegram, phone, facebook, linkedin)
    VALUES ('$gmail', '$whatsapp', '$github', '$telegram', '$phone', '$facebook', '$linkedin')
    ";
}

if ($conn->query($sql)) {
    header("Location: widget.php"); // or wherever you want to redirect
    exit();
} else {
    echo "Error saving social info: " . $conn->error;
}

$conn->close();
?>
