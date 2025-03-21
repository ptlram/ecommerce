<?php
header('Content-Type: application/json'); // Ensure JSON output
error_reporting(E_ALL); // Show all errors
ini_set('display_errors', 1); // Display errors for debugging

include '../pages/db.php'; // Include database connection

if (isset($_POST['category']) && isset($_POST['subcategory'])) {
    $categoryId = $_POST['category'];
    $subcategoryId = $_POST['subcategory'];

    try {
        $sql = "SELECT * 
                FROM products 
                WHERE category = ? AND subcategory = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$categoryId, $subcategoryId]);

        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
    } catch (Exception $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }
} else {
    echo json_encode(["error" => "Invalid request parameters."]);
}
