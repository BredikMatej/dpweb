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
    <link rel="stylesheet" type="text/css" href="themes/header_style.css">
    <link rel="stylesheet" type="text/css" href="themes/utm_gen_style.css">
    <title>UTM Campaign Link Generator</title>
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
            <a class="nav_item" href="./includes/logout.php">Logout</a>
        <?php else: ?>
            <!-- User is not logged in, show sign in and registration options -->
            <a class="nav_item" href="signin.php">Sign in</a>
            <a class="nav_item" href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>

<h2>UTM Campaign Link Generator</h2>
<form id="utmForm">
    <div>
        <p class="element_label">Base URL: https://matejbredik.in</p>
        <input type="hidden" id="baseUrl" name="baseUrl" value="https://matejbredik.in/">
    </div>
    <div class="element_div">
        <label class="element_label" for="utmSource">UTM Source:</label>
        <select id="utmSource" name="utmSource" required>
            <option value="">--Select a Source--</option>
            <option value="facebook">Facebook</option>
            <option value="instagram">Instagram</option>
            <option value="linkedin">LinkedIn</option>
            <option value="twitter">X/Twitter</option>
            <option value="newsletter">Newsletter</option>
            <option value="google">Google</option>
            <option value="custom">Custom (please specify)</option>
        </select>
        <input class="element_input" type="text" id="customSource" name="customSource" style="display:none;" placeholder="Enter custom source" required>
    </div>
    <div class="element_div">
        <label class="element_label" for="utmMedium">UTM Medium:</label>
        <select id="utmMedium" name="utmMedium" required>
            <option value="">--Select a Medium--</option>
            <option value="email">Email</option>
            <option value="cpc">CPC</option>
            <option value="social">Social</option>
            <option value="banner">Banner</option>
            <option value="referral">Referral</option>
            <option value="custom">Custom (please specify)</option>
        </select>
        <input class="element_input" type="text" id="customMedium" name="customMedium" style="display:none;" placeholder="Enter custom medium" required>
    </div>
    <div class="element_div">
        <label class="element_label" for="utmCampaign">UTM Campaign:</label>
        <input class="element_input" type="text" id="utmCampaign" name="utmCampaign" required>
    </div>
    <div class="element_div">
        <label class="element_label" for="utmTerm">UTM Term:</label>
        <input class="element_input" type="text" id="utmTerm" name="utmTerm">
    </div>
    <div class="element_div">
        <label class="element_label" for="utmContent">UTM Content:</label>
        <input class="element_input" type="text" id="utmContent" name="utmContent">
    </div>
    <button type="button" onclick="generateLink()">Generate Link</button>
</form>
<p id="tocopy">Generated Links: </p>
<p id="generatedLink" onclick="copyContent()" ></p>
<button class="btn" onclick="copyContent()">Copy!</button>

<script src="./scripts/utm_script.js"></script>
</body>
</html>

