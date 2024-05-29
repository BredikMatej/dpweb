<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $username = $_POST['username']; // Assuming this is different from email
    $password = $_POST['psw'];
    $repeatPassword = $_POST['psw-repeat'];

    // Validate data (e.g., check if passwords match, validate email format)
    if ($password !== $repeatPassword) {
        // Handle error: passwords do not match
        exit('Passwords do not match.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle error: invalid email
        exit('Invalid email format.');
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        require_once "./connect.php";

        $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $email, $hashed_password]);

        $pdo = null;
        $stmt = null;

        header("Location: ../signin.php");
        exit();
    } catch (PDOException $e) {
        // Handle the exception properly
        header('Location: failure_message.php');
    }
} else {
    header('Location: failure_message.php');
    exit();
}