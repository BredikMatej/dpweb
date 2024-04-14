<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    // Now you can echo the username wherever needed
} else {
    $username = 'Consider signing in';
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
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
    <title>MainPage</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '7686297748052801');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=7686297748052801&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->
</head>
<body>
<header>
    <a href="#" class="nav-logo"><img src="img/logo-transparent.png" class="logo-header" alt="website logo"> </a>
    <nav>
        <a class="nav_item" href="index.php">Main Page</a>
        <a class="nav_item" href="news.php">News</a>
        <a class="nav_item" href="eshop.php">eShop</a>
        <a class="nav_item" href="contact.html">Contact</a>
        <?php if(isset($_SESSION['user_name'])): ?>
            <!-- User is logged in, show user name and logout option -->
            <a class="nav_item" href="#"><?= htmlspecialchars($_SESSION['user_name']); ?></a>
            <a class="nav_item" href="./includes/logout.php">Logout</a>
        <?php else: ?>
            <!-- User is not logged in, show sign in and registration options -->
            <a class="nav_item" href="signin.php">Sign in</a>
            <a class="nav_item" href="register.php">Registration</a>
        <?php endif; ?>
    </nav>
</header>


<div class="gallery">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(1).jpeg" alt="Image 1" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(1).jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(2).jpeg" alt="Image 2" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(2).jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(3).jpeg" alt="Image 3" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(3).jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(4).jpeg" alt="Image 4" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(4).jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20.jpeg" alt="Image 5" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20.jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.21.jpeg" alt="Image 6" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.21.jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(1).jpeg" alt="Image 1" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(1).jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(2).jpeg" alt="Image 2" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(2).jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(3).jpeg" alt="Image 3" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(3).jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(4).jpeg" alt="Image 4" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(4).jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20.jpeg" alt="Image 5" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.20.jpeg')">
    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.21.jpeg" alt="Image 6" onclick="openModal('img/WhatsApp%20Image%202023-10-27%20at%2020.24.21.jpeg')">
</div>

<!-- Modal -->
<div id="myModal" class="modal" onclick="closeModal()">
    <span class="close">&times;</span>
    <div class="modal-content">
        <img id="modalImage" src="" alt="Modal Image">
    </div>
</div>

<script src="script.js"></script>
</body>
</html>