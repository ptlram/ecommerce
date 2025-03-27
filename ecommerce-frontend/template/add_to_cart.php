<?php
session_start();
include "./connection.php";  // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $product_id = $_POST["product_id"];
    $quantity = $_POST["quantity"];

    if (!$customer_id || !$product_id || !$quantity) {
        echo "Invalid data!";
        exit;
    }

    // Check if the product is already in the cart
    $check_cart = $conn->prepare("SELECT * FROM cart WHERE customer_id = ? AND product_id = ?");
    $check_cart->execute([$customer_id, $product_id]);
    $cart_item = $check_cart->fetch();

    if ($cart_item) {
        // If product exists, update the quantity
        $new_quantity = $cart_item["quantity"] + $quantity;
        $update_cart = $conn->prepare("UPDATE cart SET quantity = ? WHERE customer_id = ? AND product_id = ?");
        $update_cart->execute([$new_quantity, $customer_id, $product_id]);
        echo "Cart updated!";
    } else {
        // Insert new item into the cart
        $insert_cart = $conn->prepare("INSERT INTO cart (customer_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert_cart->execute([$customer_id, $product_id, $quantity]);
        echo "Product added to cart!";
    }
}
