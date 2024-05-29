<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../signin.php");
    exit();
}

require_once "includes/connect.php";

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $email = $_SESSION['email'];
    $firstCharacter = $username[0];
}

// Fetch user images
$user_id = $_SESSION['userid'];
$query = "SELECT image_name, image_path FROM user_images WHERE user_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$user_id]);
$user_images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JVQTPZWTJX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-JVQTPZWTJX');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="themes/header_style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="themes/profile_style.css">
</head>
<body>

<header>
    <div class="group-logo">
        <a href="index.php" class="nav-logo"> <img src="img/logo-transparent.png" class="logo-header" alt="website logo"> </a>
        <h2><a href="index.php">SPECKBRUSH</a></h2>
    </div>
    <nav>
        <a class="nav_item" href="index.php">Home</a>
        <a class="nav_item" href="plans.php">Plans</a>
        <a class="nav_item" href="eshop.php">Shop</a>
        <a class="nav_item" href="explore.php">Explore</a>
        <?php if(isset($_SESSION['username'])): ?>
            <!-- User is logged in, show user name and logout option -->
            <a class="nav_item" href="profile.php"><?= htmlspecialchars($_SESSION['username']); ?></a>
            <a class="nav_item" href="cart.php"><i class="fas fa-cart-plus"></i></a>
            <a class="nav_item" href="./includes/logout.php">Logout</a>
        <?php else: ?>
            <!-- User is not logged in, show sign in and registration options -->
            <a class="nav_item" href="signin.php">Sign in</a>
            <a class="nav_item" href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<div class="to-center">
    <div class="profile-container">
        <div class="profile-avatar">
            <p><?php echo htmlspecialchars($firstCharacter); ?></p>
        </div>
        <div class="profile-info">
            <h1><?php echo htmlspecialchars($username); ?></h1>
        </div>
        <div class="profile-info">
            <p><label>Email:</label> <?php echo htmlspecialchars($email); ?></p>
        </div>
        <div class="profile-actions">
            <a href="#" id="editProfileBtn">Edit Profile</a>
            <a href="purchases.php" >My orders</a>
        </div>
    </div>
    <?php if($_SESSION['permission'] === 2 || $_SESSION['permission'] === 0): ?>
        <div class="gallery-section profile-container">
            <h2>Upload Image</h2>
            <form action="includes/upload_image.php" method="post" enctype="multipart/form-data">

                <label for="image">Choose an image:</label>
                <input type="file" name="image" id="image" required>
                <br><br>
                <input type="submit" value="Upload Image">
            </form>
            <h2>Your Uploaded Images</h2>
            <div class="gallery-container">
                <?php if (empty($user_images)): ?>
                    <p>No images uploaded yet.</p>
                <?php else: ?>
                    <?php foreach ($user_images as $image): ?>
                        <img src="<?php echo htmlspecialchars($image['image_path']); ?>" alt="<?php echo htmlspecialchars($image['image_name']); ?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="gallery-section profile-container">
            <h2>If you subscribe to the SPECKBRUSH you will be able to post your creations here!</h2>
        </div>
    <?php endif; ?>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Profile</h2>
        <form id="editProfileForm" method="post" action="includes/update_profile.php">
            <label for="username">New Username:</label>
            <input type="text" name="new_username" id="username" value="<?php echo htmlspecialchars($username); ?>" required>
            <br><br>
            <label for="email">New Email:</label>
            <input type="email" name="new_email" id="email" value="<?php echo htmlspecialchars($email); ?>" required>
            <br><br>
            <label for="password">Current Password:</label>
            <input type="password" name="current_password" id="password" required>
            <br><br>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password">
            <br><br>
            <input type="submit" value="Update Profile">
        </form>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("editProfileModal");

    // Get the button that opens the modal
    var btn = document.getElementById("editProfileBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>