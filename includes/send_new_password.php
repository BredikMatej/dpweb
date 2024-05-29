<?php
require 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists
    $query = "SELECT id FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Generate a new temporary password
        $temp_password = bin2hex(random_bytes(4)); // Generates an 8-character temporary password
        $hashed_password = password_hash($temp_password, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $query = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$hashed_password, $email]);

        // Send the new password to the user's email
        $subject = "Your New Temporary Password";
        $message = "Your new temporary password is: $temp_password\nPlease change your password after logging in. You can do this in profile section.";
        $headers = "From: no-reply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "A new password has been sent to your email address.";
        } else {
            echo "Failed to send the new password. Please try again.";
        }
    } else {
        echo "No account found with that email address.";
    }
}
?>
