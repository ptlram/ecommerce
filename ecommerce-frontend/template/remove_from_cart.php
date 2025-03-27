<?php
include "./connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = $_POST["cart_id"];

    $query = $conn->prepare("DELETE FROM cart WHERE id = ?");
    $query->execute([$cart_id]);

    echo "Item removed";
}
