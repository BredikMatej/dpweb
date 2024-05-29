<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
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
    <title>Plans</title>
    <link rel="stylesheet" type="text/css" href="themes/header_style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
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
            <a class="nav_item" href="signin.php">Sign in</a>
            <a class="nav_item" href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

<div class="plans-heading">
    <h1 class="plans-heading-text">Choose Your Plan</h1>
    <h4 class="plans-heading-subtext">We offer three flexible pricing plans tailored to suit your needs.</h4>
    <h4 class="plans-heading-subtext">Select the plan that best matches your usage and start creating stunning AI-generated images today!</h4>
</div>

<section class="pricing-plans">
    <div class="pricing-card basic">
        <div class="heading">
            <h4>HOBBYIST</h4>
            <p>Ideal for artistically driven individuals who enjoy creating AI-generated images as a personal hobby.
                Get access to essential features to explore your creativity and bring your ideas to life.</p>
        </div>
        <p class="price">
            $3
            <sub>/month</sub>
        </p>
        <ul class="features">
            <li>
                <strong>Access</strong> to basic tools
            </li>
            <li>
                <strong>Monthly Generation Limit</strong> 100 images
            </li>
            <li>
                <strong>Standard Resolution </strong> for 1:1 images
            </li>
            <li>
                <strong>Community Support</strong> access
            </li>
            <li>
                <strong>Non-commercial</strong> use only
            </li>
            <li>
                <strong>3 Base</strong> generative models
            </li>
            <li>
                <strong>Basic</strong> support
            </li>
        </ul>
        <button class="cta-btn"><a href="https://buy.stripe.com/test_aEU4ilgRr8XYgF2cMM">SELECT</a></button>
    </div>
    <div class="pricing-card standard">
        <div class="heading">
            <h4>PROFESSIONAL</h4>
            <p>Perfect for professionals who require advanced tools and features for their projects. This plan offers
                enhanced capabilities and more resources to support your professional needs.</p>
        </div>
        <p class="price">
            $25
            <sub>/month</sub>
        </p>
        <ul class="features">
            <li>
                <strong>Advanced</strong> tools & features
            </li>
            <li>
                <strong>Higher Generation Limit</strong> 1,000 images
            </li>
            <li>
                <strong>High Resolution</strong> all common ratios
            </li>
            <li>
                <strong>Community Support</strong> access (enhanced)
            </li>
            <li>
                <strong>Commercial</strong> use license
            </li>
            <li>
                <strong>All Base</strong> generative models
            </li>
            <li>
                <strong>Priority</strong> customer support
            </li>
        </ul>
        <button class="cta-btn"><a href="https://buy.stripe.com/test_6oEcOReJjcaa3SgeUV">SELECT</a></button>
    </div>
    <div class="pricing-card premium">
        <div class="heading">
            <h4>ENTERPRISE</h4>
            <p>Designed for companies and organizations that need comprehensive solutions and extensive support.
                This plan provides premium features and scalable resources to meet your business requirements.</p>
        </div>
        <p class="price">
            $350
            <sub>/month</sub>
        </p>
        <ul class="features">
            <li>
                <strong>All-Inclusive</strong> tools
            </li>
            <li>
                <strong>Unlimited</strong> image generation
            </li>
            <li>
                <strong>Ultra-High Resolution</strong> custom ratios
            </li>
            <li>
                <strong>Team Collaboration</strong> multi-user access
            </li>
            <li>
                <strong>Enterprise</strong> large-scale use licence
            </li>
            <li>
                <strong>Custom</strong> generative models
            </li>
            <li>
                <strong>Dedicated</strong> 24/7 support
            </li>
        </ul>
        <button class="cta-btn"><a href="https://buy.stripe.com/test_9AQ8yB44F1vw3SgcMO">SELECT</a></button>
    </div>
</section>

<?php include "includes/footer.html" ?>
<script src="script.js"></script>
</body>
</html>
