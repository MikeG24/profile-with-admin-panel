<?php
$conn = new mysqli("localhost", "root", "", "portfoliodb");
$email = $_POST['email'];

$stmt = $conn->prepare("SELECT security_question FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($question);

$questions = [
  'pet' => "What is the name of your first pet?",
  'school' => "What was the name of your elementary school?",
  'city' => "In what city were you born?"
];

if ($stmt->fetch()) {
  echo json_encode(['status' => 'success', 'question' => $questions[$question]]);
} else {
  echo json_encode(['status' => 'error']);
}
