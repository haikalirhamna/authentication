<?php

require '../vendor/autoload.php';
require 'connection.php';

use Ramsey\Uuid\Uuid;

// Generate UUID versi 4 (random)
$uuid = Uuid::uuid4();

// Check methode request 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get value form 
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm = $_POST['confirm'];

  // confirm password validation
  if ($password === $confirm) {
    // Hashing password 
    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

    try {
      // Insert Database 
      $stmt = $pdo->prepare("INSERT INTO users (uuid, username, email, password) VALUES (?, ?, ?, ?)");
      $stmt->execute([$uuid, $username, $email, $hashedPassword]);

      header("Location: ../index.php?status=success");
      exit();
    } catch (\Throwable $th) {
      header("Location: ../register.php?status=failed&error=" . urlencode($th));
      exit();
    }
  } else {
    header("Location: ../register.php?status=password_mismatch&error=" . urlencode("Password not match"));
    exit();
  }
}
