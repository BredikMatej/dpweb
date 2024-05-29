<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['psw'];

    try {
        require_once "connect.php"; // Make sure this file has your database connection

        $query = "SELECT id, username, email, password, permission FROM users WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                // Password is correct, start the session
                $_SESSION['loggedin'] = true;
                $_SESSION['userid'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['permission'] = $user['permission'];

                // Redirect to a new page (e.g., user dashboard)
                header("Location: ../index.php");
                exit();
            } else {
                // Handle incorrect password
                echo "Incorrect username or password.";
            }
        } else {
            // Handle username not found
            echo "Incorrect username or password.";
        }

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
} else {
    // Redirect if accessed without POST request
    header("Location: ../signin.php");
    exit();
}
