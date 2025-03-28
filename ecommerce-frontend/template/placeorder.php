<?php
include "./connection.php";
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_name = $_POST["customer_name"];
    $customer_mobile = $_POST["customer_mobile"];
    $customer_email = $_POST["customer_email"];
    $customer_city = $_POST["customer_city"];
    $invoice_pincode = $_POST["invoice_pincode"];
    $customer_address = $_POST["customer_address"];
    $invoice_special_instruction = $_POST["invoice_special_instruction"];
    $delivery_time_slot = $_POST["delivery_time_slot"];
    $invoice_payment_mode = $_POST["invoice_payment_mode"];

    $customer_id = $_SESSION['customer_id'];

    $query = $conn->prepare("SELECT c.id, c.product_id, c.quantity, p.product_name, p.product_image, p.retailer_price ,p.mrp
                         FROM cart c 
                         JOIN products p ON c.product_id = p.id 
                         WHERE c.customer_id = ?");
    $query->execute([$customer_id]);
    $cart_items = $query->fetchAll(PDO::FETCH_ASSOC);

    $mrp_total = 0;
    $retailer_total = 0;

    foreach ($cart_items as $cart_item) {
        $mrp_total += $cart_item['mrp'] * $cart_item['quantity'];  // Sum of MRP
        $retailer_total += $cart_item['retailer_price'] * $cart_item['quantity']; // Sum of Retailer Prices
    }

    $final_price = $retailer_total; // Discounted Price
    $discount = $mrp_total - $retailer_total; // Savings Calculatio
    $delivery_charge = 50.00;  // Modify this based on your logic
    $status = "Pending";  // Initial order status

    // Insert order data    
    $query = $conn->prepare("INSERT INTO orders (customer_name, mobile, email, city, address, pincode, delivery_time, discount, delivery_charge, special_instruction, sms, final_price, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");

    $result = $query->execute([
        $customer_name,
        $customer_mobile,
        $customer_email,
        $customer_city,
        $customer_address,
        $invoice_pincode,
        $delivery_time_slot,
        $discount,
        $delivery_charge,
        $invoice_special_instruction,
        '', // `sms` field (empty for now)
        $final_price,
        $status
    ]);
    $order_id = $conn->lastInsertId();
    if ($result) {
        $insertDetails = $conn->prepare("INSERT INTO order_details ( product_name, mrp,offer_mrp, quantity,order_id) VALUES (?,?, ?, ?, ?)");
        foreach ($cart_items as $item) {
            $product_name = $item["product_name"];
            $mrp = $item["mrp"];
            $offer_mrp = $item["retailer_price"];
            $quantity = $item["quantity"];
            $insertDetails->execute([$product_name, $mrp, $offer_mrp, $quantity, $order_id]);
        }


        $delquery = $conn->prepare("DELETE FROM cart WHERE customer_id='$customer_id'");
        if ($delquery->execute()) {
            echo "<script>alert('Order placed successfully!'); window.location.href='orderlist.php';</script>";
        }
    } else {
        echo "<script>alert('Order failed. Please try again.'); window.history.back();</script>";
    }
}
