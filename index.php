<?php
require_once 'include/classes/db.php';
require_once 'include/classes/Cart.php';
require_once 'include/classes/Product.php';
// Create a database connection
$database = new Database();
$conn = $database->connect();

// Fetch products from the database
$query = "SELECT * FROM products";
$stmt = $conn->prepare($query);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$cart = new Cart();

// Handle adding to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Fetch the selected product from the database
    $query = "SELECT * FROM products WHERE product_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $product_id);
    $stmt->execute();
    $product_data = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product_data) {
        // Create a product object and add it to the cart
        $product = new Product($product_data['product_id'], $product_data['product_name'], $product_data['price']);
        $cart->addToCart($product);
		header('Location: cart.php');
        exit(); 
    }
}

// Handle removing from cart
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove_id'])) {
    $remove_id = $_POST['remove_id'];
    $cart->removeFromCart($remove_id);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>

<h1>Products</h1>
<ul>
    <?php foreach ($products as $product): ?>
        <li>
            <?php echo htmlspecialchars($product['product_name']) . " - $" . number_format($product['price'], 2); ?>
            <form method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                <button type="submit">Add to Cart</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>



</body>
</html>
