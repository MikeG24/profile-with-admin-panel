<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
$email = $_POST['email'];
$answer = strtolower(trim($_POST['answer']));

$stmt = $conn->prepare("SELECT security_answer FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($realAnswer);
$stmt->fetch();

if ($realAnswer && strtolower($realAnswer) === $answer) {
  echo json_encode(['status' => 'success']);
} else {
  echo json_encode(['status' => 'error']);
}
