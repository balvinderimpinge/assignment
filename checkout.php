<?php
session_start();

require_once 'include/classes/Cart.php';

// Initialize the cart class
$cart = new Cart();

// If the cart is empty, redirect to the products page
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit();
}

// Define a fixed shipping price (for simplicity)


// Calculate the total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}

if($total_price < 50 ){
	
	$shipping_price = 4.95; 
	
}else if($total_price > 50 && $total_price < 90 ){
	
	$shipping_price = 2.95; 
}else{
	$shipping_price = 0;
}
	// Flat shipping fee

// Total price including shipping
$final_total = $total_price + $shipping_price;

// Handle the form submission (order submission)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    // In a real application, you'd save the order to the database here.
    // For now, let's just display a success message.
    echo "<h2>Thank you for your order!</h2>";
    echo "<p>Your total is $" . number_format($final_total, 2) . "</p>";

    // Clear the cart after the order is submitted
    unset($_SESSION['cart']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>

<h1>Checkout</h1>

<!-- Cart items -->
<h2>Your Cart</h2>
<ul>
    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
        <li>
            <?php echo htmlspecialchars($item['name']) . " - " . $item['quantity'] . " x $" . number_format($item['price'], 2); ?>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Shipping Price -->
<p>Shipping Price: <?php if($shipping_price > 0 ){ echo '$'.number_format($shipping_price, 2);} else { echo 'Free shipping ';} ?></p>

<!-- Total Price -->
<p>Total Price (including shipping): $<?php echo number_format($final_total, 2); ?></p>



</body>
</html>
