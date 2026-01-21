<?php

$host = 'mysql_db';
$db   = 'crud';
$user = 'devuser';
$pass = 'devpass';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );

    // echo "Connected to MySQL";
} catch (PDOException $e) {
    die("DB connection failed: " . $e->getMessage());
}
