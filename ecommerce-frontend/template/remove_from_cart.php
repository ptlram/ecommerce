<?php
session_start();
include './connection.php'; // Ensure this file correctly connects to your DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $customer_id = isset($_POST['customer_id']) ? intval($_POST['customer_id']) : 0;

    if ($product_id > 0 && $customer_id > 0) {
        try {
            $stmt = $conn->prepare("DELETE FROM cart WHERE customer_id = ? AND product_id = ?");
            $stmt->execute([$customer_id, $product_id]);

            echo "Item removed!";
        } catch (PDOException $e) {
            echo "Database Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid request!";
    }
} else {
    echo "Invalid request method!";
}
