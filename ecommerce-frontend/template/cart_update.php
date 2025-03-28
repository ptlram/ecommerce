<?php
session_start();
include './connection.php'; // Ensure this is the correct DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    if ($cart_id > 0 && $quantity > 0) {
        try {
            // Update cart quantity
            $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
            $stmt->execute([$quantity, $cart_id]);

            echo json_encode(["status" => "success", "message" => "Cart updated!"]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method!"]);
}
