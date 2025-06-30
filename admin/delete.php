<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
$id = $_GET['id'];
$conn->query("DELETE FROM users WHERE id=$id");
header("Location: table.php");
?>
