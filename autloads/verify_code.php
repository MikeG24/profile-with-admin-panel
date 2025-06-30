<?php
session_start();
$email = $_POST['email'];
$code = $_POST['code'];

if (isset($_SESSION['reset_codes'][$email]) && $_SESSION['reset_codes'][$email] == $code) {
  echo "verified";
} else {
  echo "invalid";
}
