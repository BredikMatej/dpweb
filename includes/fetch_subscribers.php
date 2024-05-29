<?php
require_once "connect.php";

function fetchSubscribers() {
    global $pdo;
    $query = "SELECT email FROM newsletter_subscribers";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
?>
