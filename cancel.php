<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Canceled</title>
</head>
<body>
<h1>Payment Canceled</h1>
<p>Your payment was canceled. Please try again.</p>
<a href="cart.php">Return to Cart</a>
</body>
</html>
