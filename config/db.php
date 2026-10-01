<?php
// ============================================================
// database.php — Database connection
// ============================================================
// YOUR TASK: Fill in the values below to connect to your
// MySQL database. Then complete the PDO connection.
// ============================================================

$host   = 'localhost';       // Hint: usually 'localhost'
$dbname = 'fullstack_shop';       // Hint: the name you gave your database
$user   = 'root';       // Hint: your MySQL username (often 'root')
$pass   = '';       // Hint: your MySQL password (often '' locally)

// YOUR TASK: Create a PDO connection using the variables above.
// Hint: new PDO("mysql:host=...;dbname=...;charset=utf8", ...)
// Don't forget to set ERRMODE_EXCEPTION so errors are visible!
$pdo = new PDO("mysql:host=localhost;dbname=login_auth", 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// $pdo = ...
