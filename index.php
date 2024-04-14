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


<div class="main-wrapper">
    <h1 class="main-text">Welcome to PAINTBRUSH</h1>
</div>
<!--<div class="carousel">-->
<!--    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(1).jpeg" alt="Image 1">-->
<!--    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(2).jpeg" alt="Image 2">-->
<!--    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(3).jpeg" alt="Image 3">-->
<!--    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(4).jpeg" alt="Image 4">-->
<!--</div>-->
<!--<div class="carousel">-->
<!--    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(1).jpeg" alt="Image 1">-->
<!--    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(2).jpeg" alt="Image 2">-->
<!--    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(3).jpeg" alt="Image 3">-->
<!--    <img src="img/WhatsApp%20Image%202023-10-27%20at%2020.24.20%20(4).jpeg" alt="Image 4">-->
<!--</div>-->

<section>
    <div class="section1">
        <div class="sectext">
            <h2>
                Lorem
            </h2>
            <p>
                Vel turpis nunc eget lorem dolor sed viverra ipsum. Non nisi est sit amet facilisis magna etiam tempor. Integer
                quis auctor elit sed vulputate. Urna id volutpat lacus laoreet non curabitur. Ullamcorper eget nulla facilisi
                etiam dignissim diam quis enim lobortis. Habitant morbi tristique senectus et netus et malesuada fames. Est antei
                nibh mauris cursus mattis. Commodo nulla facilisi nullam vehicula ipsum a arcu cursus. Commodo nulla facilisi
                nullam vehicula ipsum a arcu. Varius sit amet mattis vulputate enim. Pretium lectus quam id leo in vitae. Nisl
                nisi scelerisque eu ultrices vitae auctor eu. Felis bibendum ut tristique et egestas quis ipsum suspendisse ultrices.
                Diam phasellus vestibulum lorem sed risus. Purus in mollis nunc sed id semper risus in. Quam nulla porttitor massa id
                neque aliquam vestibulum morbi blandit. Ipsum nunc aliquet bibendum enim facilisis gravida. Nec feugiat nisl pretium
                fusce id velit. Tellus elementum sagittis vitae et leo.
            </p>
        </div>
        <div>
            <img src="img/ideaiart.jpg" class="secpic-1" alt="pic001">
        </div>
    </div>
</section>

<section>
    <div class="wrapper">
        <div class="container">
            <input type="radio" name="slide" id="c1" checked>
            <label for="c1" class="card">
                <div class="row">
                    <div class="icon">1</div>
                    <div class="description">
                        <h4>Forest light</h4>
                        <p>Vytvorte si realisticke obrazky</p>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c2" >
            <label for="c2" class="card">
                <div class="row">
                    <div class="icon">2</div>
                    <div class="description">
                        <h4>obrazok</h4>
                        <p>Ale aj abstraktne umenie</p>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c3" >
            <label for="c3" class="card">
                <div class="row">
                    <div class="icon">3</div>
                    <div class="description">
                        <h4>halo</h4>
                        <p>bla lba</p>
                    </div>
                </div>
            </label>
            <input type="radio" name="slide" id="c4" >
            <label for="c4" class="card">
                <div class="row">
                    <div class="icon">4</div>
                    <div class="description">
                        <h4>other stuff</h4>
                        <p>znovu bla bla</p>
                    </div>
                </div>
            </label>
        </div>
    </div>
</section>

<section>
    <div class="section1">
        <div>
            <img src="img/forestlight.jpg" class="secpic-1" alt="pic002">
        </div>
        <div class="sectext">
            <h2>
                Ipsum
            </h2>
            <p>
                Vel turpis nunc eget lorem dolor sed viverra ipsum. Non nisi est sit amet facilisis magna etiam tempor. Integer
                quis auctor elit sed vulputate. Urna id volutpat lacus laoreet non curabitur. Ullamcorper eget nulla facilisi
                etiam dignissim diam quis enim lobortis. Habitant morbi tristique senectus et netus et malesuada fames. Est antei
                nibh mauris cursus mattis. Commodo nulla facilisi nullam vehicula ipsum a arcu cursus. Commodo nulla facilisi
                nullam vehicula ipsum a arcu. Varius sit amet mattis vulputate enim. Pretium lectus quam id leo in vitae. Nisl
                nisi scelerisque eu ultrices vitae auctor eu. Felis bibendum ut tristique et egestas quis ipsum suspendisse ultrices.
                Diam phasellus vestibulum lorem sed risus. Purus in mollis nunc sed id semper risus in. Quam nulla porttitor massa id
                neque aliquam vestibulum morbi blandit. Ipsum nunc aliquet bibendum enim facilisis gravida. Nec feugiat nisl pretium
                fusce id velit. Tellus elementum sagittis vitae et leo.
            </p>
        </div>
    </div>
</section>

<script src="script.js"></script>
</body>
</html>