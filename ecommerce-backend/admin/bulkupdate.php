<?php
include '../connection.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_ids = $_POST['product_id'];
    $mrp_values = $_POST['mrp'];
    $retailer_prices = $_POST['retailer_price'];
    $wholesaler_prices = $_POST['wholesaler_price'];

    $updatedCount = 0;
    echo "<script>alert('No changes were made.');</script>";

    foreach ($product_ids as $index => $product_id) {
        $mrp = $mrp_values[$index];
        $retailer_price = $retailer_prices[$index];
        $wholesaler_price = $wholesaler_prices[$index];

        $sql = "UPDATE products 
                SET mrp = :mrp, retailer_price = :retailer_price, wholesaler_price = :wholesaler_price 
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':mrp' => $mrp,
            ':retailer_price' => $retailer_price,
            ':wholesaler_price' => $wholesaler_price,
            ':id' => $product_id
        ]);

        if ($stmt->rowCount() > 0) {
            $updatedCount++;
        }
    }

    if ($updatedCount > 0) {
        echo "<script>alert('Successfully updated $updatedCount products!'); window.location.href='your_page.php';</script>";
    } else {
        echo "<script>alert('No changes were made.'); window.location.href='your_page.php';</script>";
    }
}
