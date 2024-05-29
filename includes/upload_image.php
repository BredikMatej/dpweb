<?php
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

// Get user ID and username from session
$user_id = $_SESSION['userid'];
$username = $_SESSION['username'];

// Directory to save uploaded images
$target_dir = "YOUR DIR";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
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
            // Save image path to database
            $image_name = basename($_FILES["image"]["name"]);
            $image_path = "uploads/" . $image_name;

            try {
                require_once "connect.php";

                $query = "INSERT INTO user_images (user_id, username, image_name, image_path) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$user_id, $username, $image_name, $image_path]);

                header("Location: ../profile.php");
                exit();

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage() . "<br>";
                header('Location: failure_message.php');
            }
        } else {
            header('Location: failure_message.php');
        }
    }
} else {
    header("Location: ../upload.php");
    exit();
}
?>