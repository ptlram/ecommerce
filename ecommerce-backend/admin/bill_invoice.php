<?php
include "../connection.php"; // Database connection

// Check if order_id is set
if (isset($_GET['orderid'])) {
    $order_id = $_GET['orderid'];

    // Fetch order details for the given order_id
    $query = $conn->prepare("SELECT product_name, mrp, offer_mrp, quantity FROM order_details WHERE order_id = :order_id ORDER BY id DESC");
    $query->execute([":order_id" => $order_id]);
    $order_details = $query->fetchAll(PDO::FETCH_ASSOC);

    // Fetch order details for the given order_id
    $query2 = $conn->prepare("SELECT * FROM orders WHERE id = :order_id ORDER BY id DESC");
    $query2->execute([":order_id" => $order_id]);
    $order_details2 = $query2->fetchAll(PDO::FETCH_ASSOC);

    if (!$order_details) {
        echo "<p style='color:red;'>Error: No orders found for Order ID: $order_id</p>";
        exit();
    }
} else {
    echo "<p style='color:red;'>Error: Order ID is missing!</p>";
    exit();
}

// Sample customer details (replace with actual customer data from DB)
$customer_name = $order_details2[0]["customer_name"];
$customer_mobile = $order_details2[0]["mobile"];
$shipping_address = $order_details2[0]["address"];
$invoice_id = "BI-" . $order_id;
$date = date("d-m-Y H:i:s");

// Initialize totals
$mrp_total = 0;
$discount_total = 0;
$net_amount = 0;
$delivery_charge = 0;

// Generate order items dynamically
$items = [];
foreach ($order_details as $order) {
    $mrp = $order['mrp'];
    $offer_mrp = $order['offer_mrp'];
    $quantity = $order['quantity'];
    $net_amt = $offer_mrp * $quantity;
    $cgst = ($net_amt * 9) / 100;
    $sgst = ($net_amt * 9) / 100;

    // Add to items array
    $items[] = [
        "name" => $order['product_name'],
        "qty" => $quantity,
        "mrp" => $mrp,
        "cgst" => number_format($cgst, 2),
        "sgst" => number_format($sgst, 2),
        "net_amt" => number_format($net_amt, 2)
    ];

    // Update totals
    $mrp_total += ($mrp * $quantity);
    $discount_total += (($mrp - $offer_mrp) * $quantity);
    $net_amount += $net_amt;
}

// Grand total
$grand_total = $net_amount + $delivery_charge;
?>

<!DOCTYPE html>
<html>

<head>
    <title>Invoice <?php echo $invoice_id; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-box {
            width: 80%;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .total {
            font-weight: bold;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            display: block;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <h2 style="text-align:center;">Bits Infotech</h2>
        <p><strong>GSTIN:</strong> 012345 | <strong>Phone:</strong> +91 0000 0000 0 | <strong>Email:</strong> sales@bitsinfotech.in</p>
        <hr>
        <p><strong>Name:</strong> <?php echo $customer_name; ?> <br>
            <strong>Mobile:</strong> <?php echo $customer_mobile; ?><br>
            <strong>Shipping Address:</strong> <?php echo $shipping_address; ?>
        </p>
        <p><strong>Invoice:</strong> <?php echo $invoice_id; ?> | <strong>Time:</strong> <?php echo $date; ?> | <strong>Payment Mode:</strong> COD</p>
        <hr>

        <table>
            <tr>
                <th>#</th>
                <th>ITEM DESC</th>
                <th>QTY</th>
                <th>MRP</th>
                <th>CGST</th>
                <th>SGST</th>
                <th>NET AMT</th>
            </tr>
            <?php foreach ($items as $index => $item): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['qty']; ?></td>
                    <td>Rs <?php echo $item['mrp']; ?></td>
                    <td>Rs <?php echo $item['cgst']; ?></td>
                    <td>Rs <?php echo $item['sgst']; ?></td>
                    <td>Rs <?php echo $item['net_amt']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <hr>
        <div style="text-align: right; width: 100%; float: right;">
            <p class="total">MRP Total: Rs <?php echo number_format($mrp_total, 2); ?></p>
            <p class="total">Discount: Rs -<?php echo number_format($discount_total, 2); ?></p>
            <p class="total">Net Amount: Rs <?php echo number_format($net_amount, 2); ?></p>
            <p class="total">Delivery Charge: Rs <?php echo number_format($delivery_charge, 2); ?></p>
            <p class="total"><strong>Grand Total: Rs <?php echo number_format($grand_total, 2); ?></strong></p>
        </div>


        <p><strong>You have saved Rs <?php echo number_format($discount_total, 2); ?> on this order.</strong></p>
        <p>Total Number of Items: <?php echo count($items); ?></p>

        <p style="text-align:center;"><strong>THANK YOU!</strong></p>

        <!-- Print Button -->
        <button onclick="window.print();">Print Invoice</button>
    </div>
</body>

</html>