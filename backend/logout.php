<?php
session_start();

// destroy session 
session_unset();
session_destroy();

// delete cookies 
setcookie('auth_token', '', time() - 3600, '/', '', true, true);
header("Location: ../index.php?status=unauthorized");
exit();
