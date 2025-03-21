<?php
include "../connection.php"; // Ensure this file has a valid PDO `$conn` object

if (isset($_POST["year"])) {
    $year = $_POST["year"];

    try {
        $stmt = $conn->prepare("
            SELECT MONTH(updated_at) AS month, SUM(final_price) AS total_amount 
            FROM orders 
            WHERE status = 'Delivered' 
            AND YEAR(updated_at) = :year
            GROUP BY month
            ORDER BY month
        ");

        $stmt->execute(["year" => $year]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["months" => $result]);
    } catch (PDOException $e) {
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
    }
    exit;
} else {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}
