<?php
session_start();
require_once "includes/connect.php";

// Initialize the cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to fetch product details from the database
function getProductDetails($product_id) {
    global $pdo;
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get cart items
$cart_items = $_SESSION['cart'];
$products_in_cart = [];
$total_price = 0.0;

// Calculate total price
foreach ($cart_items as $item) {
    $product_details = getProductDetails($item['id']);
    $product_details['quantity'] = $item['quantity'];
    $product_details['material'] = $item['material'];

    // Calculate price based on material
    $product_price = $product_details['price'];
    if ($item['material'] === 'metal') {
        $product_price += 15;
    } elseif ($item['material'] === 'canvas') {
        $product_price += 8;
    }

    // Calculate total for this item
    $total_price += $product_price * $item['quantity'];

    $products_in_cart[] = $product_details;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Begin transaction
        $pdo->beginTransaction();

        // Insert into purchases table
        $query = "INSERT INTO purchases (user_id, username, email, total_price) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_SESSION['userid'], $_SESSION['username'], $_SESSION['email'], $total_price]);
        $purchase_id = $pdo->lastInsertId();

        // Insert into purchase_items table
        foreach ($products_in_cart as $product) {
            $product_price = $product['price'];
            if ($product['material'] === 'metal') {
                $product_price += 15;
            } elseif ($product['material'] === 'canvas') {
                $product_price += 8;
            }
            $query = "INSERT INTO purchase_items (purchase_id, product_id, product_name, category, material, quantity, price, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([
                $purchase_id,
                $product['id'],
                $product['name'],
                $product['category'],
                $product['material'],
                $product['quantity'],
                $product_price,
                $product['image_url']
            ]);
        }


        // Commit transaction
        $pdo->commit();

        // Clear the cart
        $_SESSION['cart'] = [];

        // Redirect to success page
        header("Location: success.php");
        exit();

    } catch (Exception $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        echo "Failed to complete purchase: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
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
        .checkout-container {
            background-color: #325169;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            width: 90%;
            max-width: 800px;
        }
        .checkout-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: aliceblue;
        }
        .product-summary {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .product-summary img {
            width: 50px;
            height: 50px;
            border-radius: 5px;
        }
        .product-summary .summary-details {
            flex: 1;
            margin-left: 10px;
        }
        .product-summary .summary-details h2 {
            margin: 0;
            font-size: 16px;
            color: aliceblue;
        }
        .product-summary .summary-details p {
            margin: 5px 0;
            font-size: 14px;
            color: aliceblue;
        }
        .total-price {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            color: aliceblue;
            margin-top: 20px;
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
            display: inline-block;
        }
        .button:hover {
            background-color: #aabfec;
        }
        .button i {
            margin-right: 5px;
        }
        .checkout-button {
            background-color: aliceblue;
            margin-top: 20px;
        }
        .checkout-button:hover {
            background-color: #aabfec;
        }
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-JVQTPZWTJX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-JVQTPZWTJX');

        // Function to track purchase event
        function trackPurchaseEvent() {
            gtag('event', 'purchase', {
                'transaction_id': '<?php echo uniqid(); ?>', // Generate a unique transaction ID
                'affiliation': 'Online Store',
                'value': <?php echo $total_price; ?>,
                'currency': 'EUR',
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
        }
    </script>
</head>
<body>
<div class="checkout-container">
    <h1>Checkout</h1>
    <?php if (empty($products_in_cart)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <?php foreach ($products_in_cart as $product): ?>
            <div class="product-summary">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="summary-details">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p>Material: <?php echo htmlspecialchars($product['material']); ?></p>
                    <p>Quantity: <?php echo htmlspecialchars($product['quantity']); ?></p>
                    <p>Price per unit: <?php echo htmlspecialchars($product['price']); ?>€</p>
                    <p>
                        Total for this item: <?php
                        $product_price = $product['price'];
                        if ($product['material'] === 'metal') {
                            $product_price += 15;
                        } elseif ($product['material'] === 'canvas') {
                            $product_price += 8;
                        }
                        echo $product_price * $product['quantity'];
                        ?>€
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
        <hr>
        <div class="total-price">Total Price: <?php echo $total_price; ?>€</div>
        <form id="payment-form" action="tmp_checkout.php" method="post">
            <button type="submit" class="button checkout-button" onclick="trackPurchaseEvent()">Proceed to Payment</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
