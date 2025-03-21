<?php
include "../connection.php";

if (isset($_POST["category_id"])) {
    $category_id = $_POST["category_id"];

    // Use a prepared statement to prevent SQL injection
    $query = $conn->prepare("SELECT id, name FROM subcategory WHERE category_id = :category_id");
    $query->bindParam(":category_id", $category_id, PDO::PARAM_INT);
    $query->execute();

    // Fetch results
    $subcategories = $query->fetchAll(PDO::FETCH_ASSOC);

    // Ensure correct response format
    header("Content-Type: text/html");

    if ($subcategories) {
        echo '<option value="">Select Sub Category</option>';
        foreach ($subcategories as $subcategory) {
            echo '<option value="' . htmlspecialchars($subcategory["id"]) . '">' . htmlspecialchars($subcategory["name"]) . '</option>';
        }
    } else {
        echo '<option value="">No subcategories found</option>';
    }
}
