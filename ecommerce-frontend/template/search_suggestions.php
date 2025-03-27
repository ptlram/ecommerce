<?php
include "./connection.php";

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $category = $_POST['category'] !== "Your Category" ? $_POST['category'] : '';

    if ($category) {
        $stmt = $conn->prepare("SELECT product_name FROM products WHERE product_name LIKE ? AND category = ? LIMIT 10");
        $stmt->execute(["%$query%", $category]);
    } else {
        $stmt = $conn->prepare("SELECT product_name FROM products WHERE product_name LIKE ? LIMIT 10");
        $stmt->execute(["%$query%"]);
    }

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        foreach ($results as $row) {
            echo '<div class="suggestion-item" style="padding: 8px; cursor: pointer; border-bottom: 1px solid #ddd;">' . htmlspecialchars($row["product_name"]) . '</div>';
        }
    } else {
        echo '<div class="suggestion-item" style="padding: 8px; color: #999;">No results found</div>';
    }
}
