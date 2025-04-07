<?php
include "./connection.php";
include "../razorpay-php-master/razorpay-php-master/Razorpay.php";
session_start();

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$keyId = "rzp_test_fhtEq2pTItvqVr";
$keySecret = "bRUW8RNgcr6XWR5e8Q1OT9We";

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


try {
    $api = new Api($keyId, $keySecret);
    $orderData = [
        'receipt'         => 'receipt' . time() . rand(1, 10000),
        'amount'          => $final_price * 100, // amount in paise (500.00 INR)
        'currency'        => 'INR',
        'payment_capture' => 1 // auto-capture
    ];

    $razorpayOrder = $api->order->create($orderData);
} catch (Exception $e) {
    die("error" . $e->getMessage());
}
$orderId = $razorpayOrder['id'];
$amount = $razorpayOrder['amount'];
header("Location: cart.php?order_id=$orderId&amount=$amount");
exit;
