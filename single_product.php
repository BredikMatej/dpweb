<?php
session_start();

// Ensure the product ID is provided
if (!isset($_GET['id'])) {
    header("Location: eshop.php");
    exit();
}

$product_id = $_GET['id'];

require_once "includes/connect.php";

// Fetch the product details from the database
$query = "SELECT * FROM products WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Redirect if the product is not found
if (!$product) {
    header("Location: eshop.php");
    exit();
}

$original_price = $product['price'];
$discount = $product['discount'];
$discounted_price = $original_price * ((100 - $discount) / 100);

// Track the product view if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Fetch user's recent categories
    $userQuery = "SELECT recent_categories FROM users WHERE username = ?";
    $userStmt = $pdo->prepare($userQuery);
    $userStmt->execute([$username]);
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);

    $recentCategories = $user['recent_categories'] ? explode(',', $user['recent_categories']) : [];

    // Add the current product's category to recent categories
    if (!in_array($product['category'], $recentCategories)) {
        array_push($recentCategories, $product['category']);
    }

    // Keep only the last 5 categories
    if (count($recentCategories) > 5) {
        $recentCategories = array_slice($recentCategories, -5);
    }

    $updatedCategories = implode(',', $recentCategories);

    // Update the user's recent categories
    $updateQuery = "UPDATE users SET recent_categories = ? WHERE username = ?";
    $updateStmt = $pdo->prepare($updateQuery);
    $updateStmt->execute([$updatedCategories, $username]);
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

        gtag('event', 'view_item', {
            'items': [{
                'id': '<?php echo $product_id; ?>',
                'name': '<?php echo htmlspecialchars($product['name']); ?>',
                'category': '<?php echo htmlspecialchars($product['category']); ?>',
                'price': '<?php echo htmlspecialchars($product['price']); ?>'
            }]
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product/<?php echo htmlspecialchars($product['name']); ?></title>
    <link rel="stylesheet" type="text/css" href="themes/header_style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="themes/single_product_style.css">
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
            <a class="nav_item" href="./includes/logout.php">Logout</a>
        <?php else: ?>
            <!-- User is not logged in, show sign in and registration options -->
            <a class="nav_item" href="signin.php">Sign in</a>
            <a class="nav_item" href="register.php">Register</a>
        <?php endif; ?>
    </nav>
</header>
<div class="product-details">
    <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
    <div class="form-container">
        <a href="eshop.php" class="back-to-shop"><i class="fas fa-arrow-left"></i> Back to Shop</a>
        <h1><?php echo htmlspecialchars($product['name']); ?></h1>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <?php if ($discount > 0): ?>
            <p class="product-price"><span class="original-price">Original Price: €<?php echo number_format($original_price, 2); ?></span></p>
            <p class="product-price">Discounted Price: €<?php echo number_format($discounted_price, 2); ?></p>
        <?php else: ?>
            <p class="product-price">Price: €<?php echo number_format($original_price, 2); ?></p>
        <?php endif; ?>
        <p>Categories:</p>
        <div class="cat_container">
            <a href="eshop.php?category=<?php echo htmlspecialchars($product['category']); ?>" class="cat_link"><p><?php echo htmlspecialchars($product['category']); ?></p></a>
            <a href="eshop.php?category=<?php echo htmlspecialchars($product['second_category']); ?>" class="cat_link"><p><?php echo htmlspecialchars($product['second_category']); ?></p></a>
        </div>
        <?php if(isset($_SESSION['username'])): ?>
            <!-- Add to Cart Form -->
            <form id="cart-form" method="post" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="1" min="1">
                <label for="material">Material:</label>
                <select id="material" name="material">
                    <option value="digital">Digital</option>
                    <option value="metal">Metal</option>
                    <option value="canvas">Canvas</option>
                </select>
                <div class="button_container">
                    <button type="submit" name="add_and_continue" onclick="trackAddToCart(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', <?php echo $discounted_price; ?>)">Add and Continue Shopping</button>
                    <button type="submit" name="add_and_go" onclick="trackAddToCart(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', <?php echo $discounted_price; ?>)">Add and Go to Cart</button>
                </div>
            </form>
        <?php else: ?>
            <p>You need to <a href="signin.php">sign in</a> to add products to the cart.</p>
        <?php endif; ?>
    </div>
</div>

<script>
    function trackAddToCart(id, name, category, price) {
        gtag('event', 'add_to_cart', {
            'items': [{
                'id': id,
                'name': name,
                'category': category,
                'price': price
            }]
        });
    }
</script>
</body>
</html>
