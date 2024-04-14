<?php
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
    <title>News</title>
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
<h1>News</h1>
<nav>
    <a href="index.php">Main Page</a>
    <a href="news.php">News</a>
    <a href="eshop.php">eShop</a>
    <a href="contact.html">Contact</a>
    <a href="signin.php">Sign in</a>
    <a href="register.php">Registration</a>
    <a href="./includes/logout.php">Logout</a>
</nav>

<section>
    <div>
        <form action="includes/news_handler.php" method="post">
        <div class="container">
            <h2>Add news</h2>
            <hr>

            <label for="news_title"><b>Title</b></label>
            <input type="text" placeholder="Enter Title" name="news_title" id="news_title" required>

            <label for="news_text"><b>Password</b></label>
            <textarea id="news_text" name="news_text" rows="4" cols="200" placeholder="Enter text" required></textarea>

            <button type="submit" class="news_submit_btn">Submit news</button>
        </div>

        <div class="container">
            <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        </div>
        </form>
    </div>
</section>

<section>
    <div class="news-container">
        <?php
        require_once "connect.php"; // Include your connection script

        try {
            $query = "SELECT * FROM news ORDER BY id DESC"; // Assuming you have an 'id' column
            $stmt = $pdo->query($query);

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<hr>";
                echo "<div class='news-item'>";
                echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                echo "<p>" . nl2br(htmlspecialchars($row['text'])) . "</p>";
                echo "</div>";
            }
            $pdo = null; // Close the database connection
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
    </div>
</section>

<script src="script.js"></script>
</body>
</html>
