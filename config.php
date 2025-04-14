<?php
$host = 'localhost';
$dbname = 'fitquest2';
$username = 'root';
$password = 'root';

try {
    $pdo = new PDO("mysql:host=$host;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE `$dbname`");
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>