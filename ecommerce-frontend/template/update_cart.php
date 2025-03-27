<?php
include "./connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = $_POST["cart_id"];
    $quantity = $_POST["quantity"];

    // Ensure the quantity is never below 1
    if ($quantity >= 1) {
        $query = $conn->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
        $query->execute([$quantity, $cart_id]);
        echo "Success";
    } else {
        echo "Quantity cannot be less than 1";
    }
}
