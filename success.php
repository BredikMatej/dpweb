<?php
session_start();
$_SESSION['cart'] = []; // Clear the cart on successful payment
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-image: url("../img/profilebc.png");
            object-position: center;
            object-fit: cover;
            background-color: #2B3444;
            color: aliceblue;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .success-container {
            background-color: #325169;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .success-container h1 {
            color: aliceblue;
            margin-bottom: 20px;
        }
        .success-container p {
            color: aliceblue;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .success-container .button {
            background-color: aliceblue;
            color: #325169;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
        }
        .success-container .button:hover {
            background-color: #aabfec;
        }
        .success-container .button i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<div class="success-container">
    <h1><i class="fas fa-check-circle"></i> Thank you for your purchase!</h1>
    <p>Your payment was successful. You will receive a confirmation email shortly.</p>
    <a href="eshop.php" class="button"><i class="fas fa-shopping-bag"></i> Continue Shopping</a>
    <br>
    <a href="index.php" class="button"><i class="fas fa-home"></i> Home</a>
</div>
</body>
</html>