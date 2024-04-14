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

<form action="/includes/handler_signin.php" method="post">
    <div class="container">
        <h1>Login</h1>

        <div class="element_div">
            <label class="element_label" for="username"><b>Username</b></label>
            <input class="element_input" type="text" placeholder="Enter Username" name="username" id="username" required>
        </div>
        <div class="element_div">
            <label  class="element_label" for="psw"><b>Password</b></label>
            <input  class="element_input" type="password" placeholder="Enter Password" name="psw" id="psw" required>
        </div>

        <button type="submit" class="loginbtn">Login</button>
    </div>

    <div class="center_text">
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</form>

</body>
</html>

