<?php
session_start();
// Ensure the user is logged in
if (!isset($_SESSION['loggedin'])) {
    header("Location: ../signin.php");
    exit();
}

require_once "includes/connect.php";

// Initialize the cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to add product to the cart
function addToCart($product_id, $quantity = 1, $material = 'digital') {
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id && $item['material'] == $material) {
            $item['quantity'] += $quantity;
            return;
        }
    }
    $_SESSION['cart'][] = ['id' => $product_id, 'quantity' => $quantity, 'material' => $material];
}

// Function to update product quantity in the cart
function updateCart($product_id, $quantity, $material) {
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['id'] == $product_id && $item['material'] == $material) {
            $item['quantity'] = $quantity;
            return;
        }
    }
}

// Function to remove product from the cart
function removeFromCart($product_id, $material) {
    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id'] == $product_id && $item['material'] == $material) {
            unset($_SESSION['cart'][$key]);
            return;
        }
    }
}

// Function to clear the cart
function clearCart() {
    $_SESSION['cart'] = [];
}

// Function to get all items in the cart
function getCartItems() {
    return $_SESSION['cart'];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add_and_continue'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $material = $_POST['material'];
        addToCart($product_id, $quantity, $material);
        header('Location: eshop.php');
        exit();
    } elseif (isset($_POST['add_and_go'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $material = $_POST['material'];
        addToCart($product_id, $quantity, $material);
        header('Location: cart.php');
        exit();
    } elseif (isset($_POST['update_cart'])) {
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $material = $_POST['material'];
        updateCart($product_id, $quantity, $material);
    } elseif (isset($_POST['remove_from_cart'])) {
        $product_id = $_POST['product_id'];
        $material = $_POST['material'];
        removeFromCart($product_id, $material);
    } elseif (isset($_POST['clear_cart'])) {
        clearCart();
    }
    header('Location: cart.php');
    exit();
}

// Fetch product details from the database
function getProductDetails($product_id) {
    global $pdo;
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Display cart items
$cart_items = getCartItems();
$products_in_cart = [];
foreach ($cart_items as $item) {
    $product_details = getProductDetails($item['id']);
    $product_details['quantity'] = $item['quantity'];
    $product_details['material'] = $item['material'];
    $products_in_cart[] = $product_details;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-image: url("../img/profilebc.png");
            object-position: center;
            object-fit: cover;
            background-color: #2B3444;
            color: aliceblue;
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .cart-container {
            background-color: #325169;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            width: 90%;
            max-width: 800px;
        }
        .cart-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: aliceblue;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #eee;
            color: aliceblue;
        }
        .cart-item img {
            width: 75px;
            height: 75px;
            border-radius: 5px;
        }
        .cart-item .item-details {
            flex: 1;
            margin-left: 10px;
        }
        .cart-item .item-details h2 {
            margin: 0;
            font-size: 16px;
            color: aliceblue;
        }
        .cart-item .item-details p {
            margin: 5px 0;
            font-size: 14px;
            color: aliceblue;
        }
        .button {
            background-color: aliceblue;
            color: #325169;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        .button:hover {
            background-color: #aabfec;
        }
        .button i {
            margin-right: 5px;
        }
        form {
            display: inline-block;
        }
        input[type="number"] {
            width: 50px;
            padding: 5px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .checkout-button {
            background-color: aliceblue;
            color: #325169;
        }
        .checkout-button:hover {
            background-color: #aabfec;
        }
        .toleft{
            max-width: fit-content;
            margin-left: auto;
        }
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JVQTPZWTJX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-JVQTPZWTJX');

        // Track view_cart event
        gtag('event', 'view_cart', {
            'items': <?php echo json_encode(array_map(function($product) {
                return [
                    'id' => $product['id'],
                    'name' => htmlspecialchars($product['name']),
                    'category' => htmlspecialchars($product['category']),
                    'price' => htmlspecialchars($product['price']),
                    'quantity' => $product['quantity'],
                    'material' => htmlspecialchars($product['material'])
                ];
            }, $products_in_cart)); ?>
        });

        // Function to track remove_from_cart event
        function trackRemoveFromCart(id, name, category, price, quantity, material) {
            gtag('event', 'remove_from_cart', {
                'items': [{
                    'id': id,
                    'name': name,
                    'category': category,
                    'price': price,
                    'quantity': quantity,
                    'material': material
                }]
            });
        }

        // Function to track update_cart event
        function trackUpdateCart(id, name, category, price, quantity, material) {
            gtag('event', 'update_cart', {
                'items': [{
                    'id': id,
                    'name': name,
                    'category': category,
                    'price': price,
                    'quantity': quantity,
                    'material': material
                }]
            });
        }
    </script>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
<div class="cart-container">
    <h1>Shopping Cart</h1>
    <?php if (empty($products_in_cart)): ?>
        <p>Your cart is empty.</p>
        <a href="eshop.php" class="button"><i class="fas fa-shopping-bag"></i> Continue Shopping</a>
    <?php else: ?>
        <div class="toleft">
            <form action="cart.php" method="post">
                <button type="submit" name="clear_cart" class="button"><i class="fas fa-trash-alt"></i> Clear Cart</button>
            </form>
        </div>
        <?php foreach ($products_in_cart as $product): ?>
            <div class="cart-item">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="item-details">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p><?php echo htmlspecialchars($product['price']); ?>€</p>
                    <p>Material: <?php echo htmlspecialchars($product['material']); ?></p>
                    <form action="cart.php" method="post" onsubmit="trackUpdateCart(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', <?php echo htmlspecialchars($product['price']); ?>, this.quantity.value, '<?php echo htmlspecialchars($product['material']); ?>')">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="material" value="<?php echo $product['material']; ?>">
                        <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" min="1">
                        <button type="submit" name="update_cart" class="button"><i class="fas fa-sync"></i> Update</button>
                    </form>
                    <form action="cart.php" method="post" onsubmit="trackRemoveFromCart(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', <?php echo htmlspecialchars($product['price']); ?>, <?php echo $product['quantity']; ?>, '<?php echo htmlspecialchars($product['material']); ?>')">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <input type="hidden" name="material" value="<?php echo $product['material']; ?>">
                        <button type="submit" name="remove_from_cart" class="button"><i class="fas fa-trash"></i> Remove</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <br>
        <a href="eshop.php" class="button"><i class="fas fa-shopping-bag"></i> Continue Shopping</a>
        <a href="tmp_checkout.php" class="button checkout-button" onclick="gtag('event', 'begin_checkout', {
                'items': <?php echo json_encode(array_map(function($product) {
            return [
                'id' => $product['id'],
                'name' => htmlspecialchars($product['name']),
                'category' => htmlspecialchars($product['category']),
                'price' => htmlspecialchars($product['price']),
                'quantity' => $product['quantity'],
                'material' => htmlspecialchars($product['material'])
            ];
        }, $products_in_cart)); ?>
                });">Checkout</a>
    <?php endif; ?>

</div>
</body>
</html>

