<?php
session_start();
require_once "includes/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $consent = isset($_POST['consent']) ? true : false;

    if (!$consent) {
        echo "You must agree to the terms.";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit();
    }

    try {
        $query = "INSERT INTO newsletter_subscribers (email) VALUES (?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);

        echo "Subscription successful. Thank you!";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) { // Integrity constraint violation: 1062 Duplicate entry
            echo "You are already subscribed.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    echo "Invalid request method.";
}
?>