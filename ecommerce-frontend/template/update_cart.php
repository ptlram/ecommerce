<?php
session_start();
include './connection.php'; // Change this to your DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 0;

    if ($product_id > 0 && $customer_id > 0) {
        try {
            // Check if item already exists in cart
            $stmt = $conn->prepare("SELECT * FROM cart WHERE customer_id = ? AND product_id = ?");
            $stmt->execute([$customer_id, $product_id]);
            $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingItem) {
                // Update quantity if already exists
                $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE customer_id = ? AND product_id = ?");
                $stmt->execute([$quantity, $customer_id, $product_id]);
                echo "Cart updated!";
            } else {
                // Insert new item if not exists
                $stmt = $conn->prepare("INSERT INTO cart (customer_id, product_id, quantity) VALUES (?, ?, ?)");
                $stmt->execute([$customer_id, $product_id, $quantity]);
                echo "Item added to cart!";
            }
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid request!";
    }
} else {
    echo "Invalid request method!";
}
