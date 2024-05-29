<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Failure</title>
    <style>
        body {
            background-color: #2B3444;
            color: aliceblue;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .message-container {
            background-color: #597692;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .message-container h1 {
            color: #ef1442;
        }

        .message-container p {
            color: aliceblue;
        }

        .message-container a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #325169;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .message-container a:hover {
            background-color: #255E80;
    </style>
</head>
<body>
<div class="message-container">
    <h1>Failure</h1>
    <p>Something went wrong. Please try again later.</p>
    <a href="../index.php">Home</a>
</div>
</body>
</html>
