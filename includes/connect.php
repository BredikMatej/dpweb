<?php

$dsn = "mysql:host=localhost;dbname=id21458670_matejbredikdp";
$dbusername = "id21458670_admin";
$dbpassword = "96!(4(Y4fh";

try {
    $pdo = new PDO($dsn,$dbusername,$dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}