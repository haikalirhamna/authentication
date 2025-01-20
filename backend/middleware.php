<?php
require 'connection.php';

function checkAuthToken()
{
  global $pdo;

  if (!isset($_COOKIE['auth_token'])) {
    header("Location: /Authentication/index.php?status=unauthorized");
    exit();
  }

  $token = $_COOKIE['auth_token'];
  $stmt = $pdo->prepare("SELECT * FROM sessions WHERE session_token = ? AND expires_at > NOW()");
  $stmt->execute([$token]);
  $session = $stmt->fetch();

  if (!$session) {
    header("Location: /Authentication/index.php?status=unauthorized");
    exit();
  }

  // Set session data
  $_SESSION['user_id'] = $session['user_id'];
}

function checkNoAuthToken()
{
  if (isset($_COOKIE['auth_token'])) {
    header("Location: /Authentication/home.php");
    exit();
  }
}

function checkSessionExpiration()
{
  global $pdo;

  if (isset($_COOKIE['auth_token'])) {
    $token = $_COOKIE['auth_token'];
    $stmt = $pdo->prepare("SELECT * FROM sessions WHERE session_token = ? AND expires_at > NOW()");
    $stmt->execute([$token]);
    $session = $stmt->fetch();

    if (!$session) {
      // Destory session and cookies
      session_destroy();
      setcookie('auth_token', '', time() - 3600, '/', '', true, true);
      header("Location: /Authentication/index.php?status=session_expired");
      exit();
    }
  }
}
