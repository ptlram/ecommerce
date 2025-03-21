<?php
include "../connection.php"; // Ensure this file has a valid PDO `$conn` object

if (isset($_POST["year"])) {
    $year = $_POST["year"];

    try {
        $stmt = $conn->prepare("
           SELECT MONTH(date) AS month, (SUM(credit) - SUM(debit)) AS balance 
            FROM transaction 
            WHERE YEAR(date) = :year 
            GROUP BY MONTH(date) 
            ORDER BY MONTH(date);
        ");
        $stmt->execute(["year" => $year]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Debugging: Log output
        error_log(json_encode(["months" => $result])); // Logs to PHP error log

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode(["months" => $result]);
        exit;
    } catch (PDOException $e) {
        echo json_encode(["error" => "Database error: " . $e->getMessage()]);
        exit;
    }
} else {
    echo json_encode(["error" => "Invalid request"]);
    exit;
}
