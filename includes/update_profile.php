<?php
session_start();
require_once "connect.php";

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../signin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_username = $_SESSION['username'];
    $new_username = $_POST['new_username'];
    $new_email = $_POST['new_email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    try {
        // Verify current password
        $query = "SELECT password FROM users WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$current_username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($current_password, $user['password'])) {
            echo "Incorrect current password.";
            exit();
        }

        // Update username and email
        $update_query = "UPDATE users SET username = ?, email = ? WHERE username = ?";
        $update_params = [$new_username, $new_email, $current_username];

        // Update password if provided
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_query = "UPDATE users SET username = ?, email = ?, password = ? WHERE username = ?";
            $update_params = [$new_username, $new_email, $hashed_password, $current_username];
        }

        $update_stmt = $pdo->prepare($update_query);
        $update_stmt->execute($update_params);

        // Update session variables
        $_SESSION['username'] = $new_username;
        $_SESSION['email'] = $new_email;

        header("Location: ../profile.php");
        exit();

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: ../profile.php");
    exit();
}
?>