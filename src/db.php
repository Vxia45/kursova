<?php
// db.php

$host = getenv('DB_HOST') ?: "localhost"; 
$dbname = getenv('DB_NAME') ?: "kursova";
$user = getenv('DB_USER') ?: "root";
$password = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : "1234"; 

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    die("Грешка при връзка с базата данни: " . $e->getMessage());
}
?>