<?php
session_start();

// Ensure the user is logged in and is admin
if (!isset($_SESSION['loggedin']) || $_SESSION['permission'] !== 0) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Product</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Upload Product</h1>
<form action="includes/product_upload.php" method="post" enctype="multipart/form-data">
    <label for="name">Product Name:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br><br>

    <label for="category">Category:</label>
    <input type="text" id="category" name="category" required><br><br>

    <label for="second_category">Second Category:</label>
    <input type="text" id="second_category" name="second_category" required><br><br>

    <label for="price">Price (€):</label>
    <input type="number" id="price" name="price" step="0.01" required><br><br>

    <label for="discount">Discount (%):</label>
    <input type="number" id="discount" name="discount" min="0" max="100" required><br>

    <label for="image">Product Image:</label>
    <input type="file" id="image" name="image" required><br><br>

    <button type="submit">Upload Product</button>
</form>
</body>
</html>
