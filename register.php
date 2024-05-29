<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="themes/form_style.css">
</head>
<body>


<div class="login-container">
    <img src="img/logo-transparent.png" alt="Logo" class="logo">
    <form action="/includes/handler_reg.php" method="post">
        <div class="container">
            <h1>Register</h1>

            <div class="form-group">
                <input class="element_input" type="text" placeholder="Enter Username" name="username" id="username" required>
            </div>

            <div class="form-group">
                <input class="element_input" type="text" placeholder="Enter Email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <input class="element_input" type="password" placeholder="Enter Password" name="psw" id="psw" required>
            </div>

            <div class="form-group">
                <input class="element_input" type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
            </div>

            <button type="submit" class="login-btn">Register</button>
        </div>

        <div class="links">
            <a href="signin.php">Sign in</a>
        </div>
    </form>
</div>

<script src="script.js"></script>
</body>
</html>
