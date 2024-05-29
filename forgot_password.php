<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" type="text/css" href="themes/form_style.css">
</head>
<body>
<div class="login-container">
    <img src="img/logo-transparent.png" alt="Logo" class="logo">
    <h1>Forgot Password</h1>
    <form action="includes/send_new_password.php" method="post">
        <div class="form-group">
            <input type="email" name="email" placeholder="Email Address" required>
        </div>
        <button type="submit" class="login-btn">Send New Password</button>
    </form>
    <div class="links">
        <a href="signin.php">Back to sign in</a>
        <a href="register.php">Register</a>
    </div>
</div>
</body>
</html>
