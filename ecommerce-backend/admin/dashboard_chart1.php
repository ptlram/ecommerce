<?php
// Include database connection
include "../connection.php"; // Ensure this file has a valid PDO `$conn` object

if (isset($_POST["month"]) && isset($_POST["year"])) {
    $month = $_POST["month"];
    $year = $_POST["year"];

    try {
        // Fetch orders count per day
        $stmt = $conn->prepare("
            SELECT DAY(updated_at) AS day, COUNT(*) AS total_orders 
            FROM orders 
            WHERE status = 'Delivered' 
            AND DATE_FORMAT(updated_at, '%Y-%m') = :year_month
            GROUP BY DAY(updated_at)
            ORDER BY DAY(updated_at)
        ");

        $stmt->execute(["year_month" => "$year-$month"]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["orders" => $result]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
    exit;
} else {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}
