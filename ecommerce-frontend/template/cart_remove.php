<?php
session_start();
include './connection.php'; // Ensure this is the correct DB connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = isset($_POST['cart_id']) ? intval($_POST['cart_id']) : 0;

    if ($cart_id > 0) {
        try {
            // Delete item from cart
            $stmt = $conn->prepare("DELETE FROM cart WHERE id = ?");
            $stmt->execute([$cart_id]);

            echo json_encode(["status" => "success", "message" => "Item removed from cart!"]);
        } catch (PDOException $e) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid request!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method!"]);
}
