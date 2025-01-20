<?php
session_start();

require '../vendor/autoload.php';
require 'connection.php';

use Ramsey\Uuid\Uuid;

// Generate UUID versi 4 (random)
$uuid = Uuid::uuid4();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $password = $_POST['password'];
  $remember = isset($_POST['remember_me']);

  // Fetch user
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  // Auth Validation 
  if ($user && password_verify($password, $user['password'])) {

    // Generate secure token
    $token = bin2hex(random_bytes(32));
    $expiry = time() + (3600 * 24); // Token valid for 24 hours (Unix timestamp)

    // Save token and expiry to database
    $stmt = $pdo->prepare("INSERT INTO sessions (uuid, user_id, session_token, expires_at) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE session_token = VALUES(session_token), expires_at = VALUES(expires_at)");
    $stmt->execute([$uuid, $user['uuid'], $token, date('Y-m-d H:i:s', $expiry)]);

    // Set session and cookies
    $_SESSION['user_id'] = $user['uuid'];
    $_SESSION['last_activity'] = time();

    // Set secure HttpOnly cookie
    setcookie('auth_token', $token, $expiry, '/', '', true, true);

    header("Location: ../home.php?status=success");
    exit();
  } else {
    header("Location: ../index.php?status=unauthorized");
    exit();
  }
}
