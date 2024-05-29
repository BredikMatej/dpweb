<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

require_once "connect.php";

// Directory to save uploaded images
$target_dir = "YOUR DIR";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $second_category = $_POST['second_category'];
    $price = $_POST['price'];
    $discount = $_POST['discount'];

    // Check if discount is a number between 0 and 100
    if (!is_numeric($discount) || $discount < 0 || $discount > 100) {
        echo "Discount must be a number between 0 and 100.<br>";
        exit();
    }

    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check file size (limit to 4MB)
    if ($_FILES["image"]["size"] > 4000000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowed_types)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])). " has been uploaded.<br>";

            // Save product details to database
            $image_name = basename($_FILES["image"]["name"]);
            $image_path = "products/" . $image_name;

            try {
                $query = "INSERT INTO products (name, description, category, second_category, price, image_url, discount) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$name, $description, $category, $second_category, $price, $image_path, $discount]);

                echo "Product details saved to database.<br>";
                header("Location: ../upload_product.php");
                exit();

            } catch (PDOException $e) {
                header('Location: failure_message.php');
            }
        } else {
            header('Location: failure_message.php');
        }
    }
} else {
    header("Location: product_upload_form.php");
    exit();
}
?>
