<?php
$host = 'localhost';
$dbname = 'fru6323'; // Replace with your database name
$username = 'fru632'; // Replace with your username
$password = ''; // Replace with your password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>