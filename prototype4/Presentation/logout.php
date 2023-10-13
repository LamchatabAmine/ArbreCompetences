<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to the login page or any other page you want
header("Location: index.php"); // Replace "login.php" with your desired destination
exit;
