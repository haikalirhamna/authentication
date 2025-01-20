<?php
// database config
$host = 'localhost'; // Host database
$dbname = 'simple-authentication'; // Nama database
$username = 'root'; // Username database
$password = ''; // Password database

try {
  // create connection 
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

  // Set pengaturan PDO untuk menangani error dengan exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  die("Koneksi gagal: " . $e->getMessage());
}
