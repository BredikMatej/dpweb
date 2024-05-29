<?php
session_start();

// Ensure the user is logged in and is admin
if (!isset($_SESSION['loggedin']) || ($_SESSION['permission'] !== 0 && $_SESSION['permission'] !== 2)) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
<h1>Upload Image</h1>
<form action="includes/upload_image.php" method="post" enctype="multipart/form-data">
    <label for="image">Choose an image:</label>
    <input type="file" name="image" id="image" required>
    <br><br>
    <input type="submit" value="Upload Image">
</form>
</body>
</html>
