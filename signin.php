<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Sign in</title>
    <link rel="stylesheet" type="text/css" href="themes/form_style.css">

</head>
<body>

<div class="login-container">
    <img src="img/logo-transparent.png" alt="Logo" class="logo">
    <h1>Sign in</h1>
    <form action="/includes/handler_signin.php" method="post">
        <div class="form-group">
            <input type="text" placeholder="Username" name="username" id="username" required>
        </div>
        <div class="form-group">
            <input type="password" placeholder="Password" name="psw" id="psw" required>
        </div>
        <button type="submit" class="login-btn">Login</button>
    </form>
    <div class="links">
        <a href="register.php">Register</a>
        <a href="forgot_password.php">Forgot Password?</a>
    </div>
</div>

<script>
    document.querySelector('.toggle-password').addEventListener('click', function () {
        const passwordInput = document.querySelector('input[type="password"]');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.classList.remove('fa-eye');
            this.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            this.classList.remove('fa-eye-slash');
            this.classList.add('fa-eye');
        }
    });
</script>

</body>
</html>

