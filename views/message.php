<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$message = $conn->real_escape_string($_POST['message']);

$sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

if ($conn->query($sql)) {
    echo "
    <!DOCTYPE html>
    <html><head>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head><body>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Message Sent!',
            text: 'Thank you for reaching out.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#198754'
        }).then(() => {
            window.location.href = 'profile.php#contact';
        });
    </script>
    </body></html>
    ";
    exit;
} else {
    echo "
    <!DOCTYPE html>
    <html><head>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head><body>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Message failed to send. Please try again.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#dc3545'
        }).then(() => {
            window.location.href = 'profile.php#contact';
        });
    </script>
    </body></html>
    ";
    exit;
}
?>
