<?php
session_start();

// Check if the user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $firstCharacter = $username[0];
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MainPage</title>
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

<?php if (isset($_SESSION['loggedin']) && $_SESSION['permission'] === 0): ?>
    <div class="admin-center">
        <div class="admin-header">
            <a href="utm_gen.php" class="admin-link">UTM Builder</a>
            <a href="upload_product.php" class="admin-link">Upload Product</a>
        </div>
    </div>
<?php endif; ?>


<div class="scroller" data-speed="slow">
    <div class="scroller__inner">
        <img src="img/forestlight.jpg" alt="scroler image">
        <img src="img/city4.jpg" alt="scroler image">
        <img src="img/animals1.jpg" alt="scroler image">
        <img src="img/abstract4.png" alt="scroler image">
        <img src="img/nature3.jpg" alt="scroler image">
        <img src="img/modern1.jpeg" alt="scroler image">
    </div>
</div>
<div class="main-wrapper">
    <h1 class="main-text">Welcome to SPECKBRUSH</h1>
</div>
<div class="scroller" data-direction="right" data-speed="slow">
    <div class="scroller__inner">
        <img src="img/animals6.jpg" alt="scroler image">
        <img src="img/people6.jpg" alt="scroler image">
        <img src="img/abstract2.jpeg" alt="scroler image">
        <img src="img/vehicle1.jpeg" alt="scroler image">
        <img src="img/abstract8.jpg" alt="scroler image">
        <img src="img/modern2.jpg" alt="scroler image">
    </div>
</div>

<div class="sectionbc">
    <section>
        <div class="section1bc">
            <div class="section1">
                <div class="sectext">
                    <h2>
                        Revolutionize Your Creativity with AI
                    </h2>
                    <p>
                        Discover how our cutting-edge AI image generation tool can transform your ideas into stunning visuals in seconds. Whether you're a designer, marketer, or content creator, unleash your imagination with ease and efficiency.
                    </p>
                </div>
                <div>
                    <img src="img/subsciptionbanner.jpg" class="secpic-1" alt="pic001">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="section1bc">
            <div class="section1">
                <div>
                    <img src="img/ideaiart.jpg" class="secpic-1" alt="pic001">
                </div>
                <div class="sectext">
                    <h2>
                        Work With Our Intuitive Interface
                    </h2>
                    <p>
                        Our user-friendly interface makes it easy for anyone to generate high-quality images without any technical expertise. Fast, efficient and personalizable interface for everyone!
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="section1bc">
            <div class="section1">
                <div class="sectext">
                    <h2>
                        Access an Extensive Library of AI Models
                    </h2>
                    <p>
                        Discover the power of variety with our vast collection of AI models. From artistic styles to realistic renderings, our tool offers a model for every creative need. Enhance your projects with unique images generated by state-of-the-art AI technology.
                    </p>
                </div>
                <div>
                    <img src="img/nature3.jpg" class="secpic-1" alt="pic001">
                </div>
            </div>
        </div>
    </section>
</div>


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
    <div class="banner">
        <div class="fromfarleft">
            <h4>Brand new art</h4>
        </div>
        <div class="fromfarright">
            <h2>Up to <span id="brightblue">40% off</span> - All new art</h2>
        </div>
        <button class="button" onclick="trackPromotion()"><a href="eshop.php?discounted=true" class="cta-button">Click here!</a></button>
    </div>
</section>

<section>
    <div class="rating-flex">
        <div>
            <h2>Hear from Our Satisfied Users</h2>
        </div>
        <div class="rating-container">
            <div class="rating-slider">
                <div class="rating-cards">
                    <div class="rating-card">
                        <img src="img/commenter1.jpg" alt="rating-image">
                        <div class="rating-text">
                            <div class="rating-title">Amazing!</div>
                            <div class="rating-comment">"This AI art generator is simply incredible! It brings my imagination to life with vivid and unique designs."</div>
                        </div>
                    </div>
                    <div class="rating-card">
                        <img src="img/commenter2.jpg" alt="rating-image">
                        <div class="rating-text">
                            <div class="rating-title">The right tool!</div>
                            <div class="rating-comment">"I love how intuitive and easy it is to use. My creative projects have never looked better!"</div>
                        </div>
                    </div>
                    <div class="rating-card">
                        <img src="img/commenter3.jpg" alt="rating-image">
                        <div class="rating-text">
                            <div class="rating-title">Easy to learn.</div>
                            <div class="rating-comment">"Fast, user-friendly, and full of features! My social media feed looks fantastic with the generated images."</div>
                        </div>
                    </div>
                    <div class="rating-card">
                        <img src="img/commenter4.jpg" alt="rating-image">
                        <div class="rating-text">
                            <div class="rating-title">Great for artists!</div>
                            <div class="rating-comment">"The AI art tool exceeded my expectations, providing a stunning variety of styles that match my creative vision."</div>
                        </div>
                    </div>
                    <div class="rating-card">
                        <img src="img/commenter5.jpg" alt="rating-image">
                        <div class="rating-text">
                            <div class="rating-title">Daily use!</div>
                            <div class="rating-comment">"It’s a game-changer for artists and non-artists alike—every image feels like a masterpiece!"</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="section1bc">
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
    </div>
</section>

<section>
    <div class="subscribe">
        <h2 class="subscribe__title">Let's keep in touch</h2>
        <p class="subscribe__copy">Subscribe to keep up with fresh news and exciting updates. We promise not to spam you!</p>
        <form id="subscription-form" action="newsletter_subscribe.php" method="POST">
            <div class="form">
                <input type="email" name="email" class="form__email" placeholder="Enter your email address" required />
                <button type="submit" class="form__button">Send</button>
            </div>
            <div class="notice">
                <input type="checkbox" name="consent" required>
                <span class="notice__copy">I agree to my email address being stored and used to receive the monthly newsletter.</span>
            </div>
        </form>
        <div id="message"></div>
    </div>
</section>


<?php include "includes/footer.html" ?>

<script>
    function trackPromotion() {
        gtag('event', 'select_promotion', {
            'promotions': [{
                'id': 'promo_12345', // Change to your actual promotion ID
                'name': 'Brand New Art Discount',
                'creative_name': 'Up to 40% off - All new art',
                'creative_slot': 'banner1', // Change to the actual creative slot if available
                'location_id': 'banner_section' // Change to the actual location ID if available
            }]
        });
    }

    document.getElementById('subscription-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        var form = event.target;
        var formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                document.getElementById('message').innerText = data;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('message').innerText = 'There was an error processing your request.';
            });
    });
</script>

<script src="script.js"></script>
</body>
</html>