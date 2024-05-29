<?php

$dsn = "mysql:host=localhost;dbname=YOUR DATABASE NAME";
$dbusername = "YOUR DB USERNAME";
$dbpassword = "YOUR DB PASS";

try {
    $pdo = new PDO($dsn,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}