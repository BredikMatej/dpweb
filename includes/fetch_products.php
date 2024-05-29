<?php
require_once "connect.php";

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

header('Content-Type: application/json');

// Get filter parameters
$category = $_GET['category'] ?? '*';
$price_min = $_GET['price_min'] ?? 0;
$price_max = $_GET['price_max'] ?? 1000000;
$discounted = isset($_GET['discounted']) && $_GET['discounted'] === 'true';
$for_you = isset($_GET['for_you']) && $_GET['for_you'] === 'true';

$user_categories = [];

if ($for_you && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $userQuery = "SELECT recent_categories FROM users WHERE username = ?";
    $userStmt = $pdo->prepare($userQuery);
    $userStmt->execute([$username]);
    $user = $userStmt->fetch(PDO::FETCH_ASSOC);
    $user_categories = $user['recent_categories'] ? explode(',', $user['recent_categories']) : [];
}

try {
    // Build the query with discounted price calculation
    $query = "SELECT *, 
                 price * (1 - discount / 100) AS discounted_price 
          FROM products 
          WHERE (price * (1 - discount / 100)) BETWEEN ? AND ?";
    $params = [$price_min, $price_max];

    if ($category !== '*' && !$for_you) {
        $query .= " AND (category = ? OR second_category = ?)";
        $params[] = $category;
        $params[] = $category;
    } elseif ($for_you && !empty($user_categories)) {
        $placeholders = implode(',', array_fill(0, count($user_categories), '?'));
        $query .= " AND (category IN ($placeholders) OR second_category IN ($placeholders))";
        $params = array_merge($params, $user_categories, $user_categories);
    }

    if ($discounted) {
        $query .= " AND discount > 0";
    }

    $stmt = $pdo->prepare($query);

    // Debugging: Log the query and parameters
    file_put_contents('debug.log', print_r([
        'query' => $query,
        'params' => $params
    ], true));

    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return the products as JSON
    echo json_encode($products);

} catch (Exception $e) {
    // Return the error message as JSON
    echo json_encode(['error' => $e->getMessage()]);
}
?>