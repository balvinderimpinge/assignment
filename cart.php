<?php
require_once 'include/classes/db.php';
require_once 'include/classes/Cart.php';
require_once 'include/classes/Product.php';
session_start();
$cart = new Cart();
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
    <title>Your Cart</title>
</head>
<body>
	 
<h1>Your Cart</h1>

<?php $cart->displayCart(); ?>
</hr>
<a href="checkout.php">Checkout and shipping</a>
</body>
</html>
