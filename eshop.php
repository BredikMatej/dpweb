<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

require_once "includes/connect.php";

$categoryQuery = "SELECT DISTINCT category FROM products UNION SELECT DISTINCT second_category AS category FROM products";
$categoryStmt = $pdo->prepare($categoryQuery);
$categoryStmt->execute();
$categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM products";
$stmt = $pdo->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>E-shop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" type="text/css" href="themes/header_style.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="themes/product_style.css">
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

<div class="s-container">
    <div class="s-container-wrapper">
        <div class="slider">
            <input type="radio" name="slider" id="s1" checked>
            <input type="radio" name="slider" id="s2">
            <input type="radio" name="slider" id="s3">
            <input type="radio" name="slider" id="s4">
            <input type="radio" name="slider" id="s5">

            <div class="s-cards">
                <label for="s1" id="slide1">
                    <div class="s-card">
                        <img src="img/darkandgloomy.png" alt="slide1">
                    </div>
                </label>
                <label for="s2" id="slide2">
                    <div class="s-card">
                        <img src="img/city1.jpg" alt="slide2">
                    </div>
                </label>
                <label for="s3" id="slide3">
                    <div class="s-card">
                        <img src="img/forestlight.jpg" alt="slide3">
                    </div>
                </label>
                <label for="s4" id="slide4">
                    <div class="s-card">
                        <img src="img/nature5.jpg" alt="slide4">
                    </div>
                </label>
                <label for="s5" id="slide5">
                    <div class="s-card">
                        <img src="img/people2.jpg" alt="slide5">
                    </div>
                </label>
            </div>
            <div class="dots">
                <label for="s1" class="active"></label>
                <label for="s2"></label>
                <label for="s3"></label>
                <label for="s4"></label>
                <label for="s5"></label>
            </div>
            <div class="slider-arrow-prev"></div>
            <div class="slider-arrow-next"></div>
        </div>
    </div>
</div>

<div id="products-container">
    <div id="filter-form">
        <label for="category">Category:</label>
        <select id="category">
            <option value="*">all</option>
            <option value="for_you">For You</option>
            <?php foreach ($categories as $category): ?>
                <option value="<?php echo htmlspecialchars($category['category']); ?>"><?php echo htmlspecialchars($category['category']); ?></option>
            <?php endforeach; ?>
        </select>

        <label for="price_min">Min Price:</label>
        <input type="number" id="price_min" value="0">

        <label for="price_max">Max Price:</label>
        <input type="number" id="price_max" value="1000000">

        <label for="discounted">Discounted Only:</label>
        <input type="checkbox" id="discounted">

        <button onclick="filterProducts()">Filter</button>
    </div>

    <div id="products">
        <?php foreach ($products as $product): ?>
            <?php
            $original_price = $product['price'];
            $discount = $product['discount'];
            $discounted_price = $original_price * ((100 - $discount) / 100);
            ?>
            <div class='product'>
                <main>
                    <div class="product-card">
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <div class="card-content">
                            <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                            <?php if ($discount > 0): ?>
                                <p class="product-price discounted-price">
                                    <?php echo number_format($discounted_price, 2); ?>€
                                </p>
                            <?php else: ?>
                                <p class="product-price"><?php echo number_format($original_price, 2); ?>€</p>
                            <?php endif; ?>
                            <button type="button" class="cart-button open-modal" data-id="<?php echo $product['id']; ?>">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                            <a href="single_product.php?id=<?php echo $product['id']; ?>" class="button" onclick="trackProductClick(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', <?php echo number_format($original_price, 2); ?>)">
                                Find out more
                                <span class="material-symbols-outlined">arrow_right_alt</span>
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Select Options</h2>
        <?php if(isset($_SESSION['username'])): ?>
        <form id="cart-form" method="post" action="cart.php">
            <input type="hidden" name="product_id" id="product_id">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="1" min="1"><br><br>
            <label for="material">Material:</label>
            <select id="material" name="material">
                <option value="digital">Digital</option>
                <option value="metal">Metal</option>
                <option value="canvas">Canvas</option>
            </select><br><br>
            <button type="submit" name="add_and_continue" class="button" onclick="trackAddToCart(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', <?php echo number_format($original_price, 2); ?>)">Add and Continue Shopping</button>
            <button type="submit" name="add_and_go" class="button" onclick="trackAddToCart(<?php echo $product['id']; ?>, '<?php echo htmlspecialchars($product['name']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', <?php echo number_format($original_price, 2); ?>)">Add and Go to Cart</button>
            <?php else: ?>
                <p>You need to <a href="signin.php">sign in</a> to add products to the cart.</p>
            <?php endif; ?>
        </form>
    </div>
</div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btns = document.getElementsByClassName("open-modal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Function to open the modal and set product ID
    function openModal() {
        modal.style.display = "block";
        document.getElementById("product_id").value = this.getAttribute("data-id");
    }

    // Function to close the modal
    function closeModal() {
        modal.style.display = "none";
    }

    // Attach event listeners to modal open buttons
    function attachEventListeners() {
        for (var i = 0; i < btns.length; i++) {
            btns[i].onclick = openModal;
        }
    }

    // Attach event listener to close button
    span.onclick = closeModal;

    // Close the modal if the user clicks outside of it
    window.onclick = function(event) {
        if (event.target == modal) {
            closeModal();
        }
    }

    // Attach event listeners initially
    attachEventListeners();

    // Get URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    const discountedParam = urlParams.get('discounted');

    // Set filter form values based on URL parameters
    if (categoryParam) {
        document.getElementById('category').value = categoryParam;
    }
    if (discountedParam === 'true') {
        document.getElementById('discounted').checked = true;
    }

    // Apply filters on page load if URL parameters are present
    if (categoryParam || discountedParam === 'true') {
        filterProducts();
    }

    async function filterProducts() {
        const category = document.getElementById('category').value;
        const priceMin = document.getElementById('price_min').value;
        const priceMax = document.getElementById('price_max').value;
        const discounted = document.getElementById('discounted').checked ? 'true' : 'false';
        const forYou = category === 'for_you';

        const params = new URLSearchParams({ category, price_min: priceMin, price_max: priceMax, discounted, for_you: forYou });

        try {
            const response = await fetch(`includes/fetch_products.php?${params}`);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            const result = await response.json();
            if (result.error) {
                throw new Error(result.error);
            }
            renderProducts(result);
        } catch (error) {
            console.error('Error fetching products:', error);
            alert('Error fetching products. Check console for details.');
        }
    }

    function renderProducts(products) {
        const container = document.getElementById('products');
        container.innerHTML = '';
        products.forEach(product => {
            const original_price = Number(product.price);
            const discount = Number(product.discount);
            const discounted_price = original_price * ((100 - discount) / 100);

            const productElement = document.createElement('div');
            productElement.className = 'product';
            productElement.innerHTML = `<main>
                <div class="product-card">
                    <img src="${product.image_url}" alt="${product.name}">
                    <div class="card-content">
                        <h2>${product.name}</h2>
                        <p>${product.description}</p>
                        ${discount > 0 ?
                `<p class="product-price discounted-price">
                                ${discounted_price.toFixed(2)}€
                            </p>` :
                `<p class="product-price">${original_price.toFixed(2)}€</p>`
            }
                        <button type="button" class="cart-button open-modal" data-id="${product.id}">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                        <a href="single_product.php?id=${product.id}" class="button" onclick="trackProductClick(${product.id}, '${product.name}', '${product.category}', ${original_price.toFixed(2)})">
                            Find out more
                            <span class="material-symbols-outlined">arrow_right_alt</span>
                        </a>
                    </div>
                </div>
            </main>`;
            container.appendChild(productElement);
        });
        // Re-attach event listeners to the new buttons
        attachEventListeners();
    }


    function trackProductClick(id, name, category, price) {
        gtag('event', 'select_item', {
            'items': [{
                'id': id,
                'name': name,
                'category': category,
                'price': price
            }]
        });
    }

    // Function to track the Add to Cart event with actual values
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
<script src="script.js"></script>
</body>
</html>
