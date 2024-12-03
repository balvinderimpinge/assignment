<?php
session_start();

class Cart {
    public function addToCart($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Add product to the session cart
        if (isset($_SESSION['cart'][$product->id])) {
            $_SESSION['cart'][$product->id]['quantity']++;
        } else {
            $_SESSION['cart'][$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }
		
		
    }

    // New method to remove an item from the cart
    public function removeFromCart($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    public function displayCart() {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "Your cart is empty!";
            return;
        }

       
        echo "<ul>";
        foreach ($_SESSION['cart'] as $id => $item) {
            echo "<li>";
            echo "{$item['name']} ({$item['quantity']}) - $" . number_format($item['price'] * $item['quantity'], 2);
            // Delete button
            echo " <form method='POST' style='display:inline;'>";
            echo "<input type='hidden' name='remove_id' value='{$id}'>";
            echo "<button type='submit'>Remove</button>";
            echo "</form>";
            echo "</li>";
        }
        echo "</ul>";
    }
}
?>
