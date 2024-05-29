<?php
session_start();

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

// Directory to scan
$directory = 'uploads/';

// Supported file types
$allowed_types = array('jpg', 'jpeg', 'png', 'gif');

// Initialize an array for images
$images = array();

// Open the directory
if ($handle = opendir($directory)) {
    // Read each file from the directory
    while (false !== ($file = readdir($handle))) {
        // Check if the file has an allowed type
        $file_extension = pathinfo($file, PATHINFO_EXTENSION);
        if (in_array($file_extension, $allowed_types)) {
            $images[] = $directory . $file;
        }
    }
    // Close the directory
    closedir($handle);
}

// Randomize the order of images
shuffle($images);
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JVQTPZWTJX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-JVQTPZWTJX');
    </script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <link rel="stylesheet" type="text/css" href="themes/header_style.css">
    <link rel="stylesheet" type="text/css" href="mason/css/default.css" />
    <link rel="stylesheet" type="text/css" href="mason/css/component.css" />
    <script src="mason/js/modernizr.custom.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
            <a class="nav_item" href="signin.php">Signin</a>
            <a class="nav_item" href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<div class="container headding">
    <h1>User creations</h1>
</div>
<div class="container">
    <div class="container">
        <ul class="grid effect-2" id="grid">
            <?php foreach ($images as $image): ?>
                <li><a href="#"><img src="<?php echo htmlspecialchars($image); ?>"></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <script src="mason/js/masonry.pkgd.min.js"></script>
    <script src="mason/js/imagesloaded.js"></script>
    <script src="mason/js/classie.js"></script>
    <script src="mason/js/AnimOnScroll.js"></script>
    <script>
        new AnimOnScroll( document.getElementById( 'grid' ), {
            minDuration : 0.4,
            maxDuration : 0.7,
            viewportFactor : 0.2
        } );
    </script>
</body>
</html>
