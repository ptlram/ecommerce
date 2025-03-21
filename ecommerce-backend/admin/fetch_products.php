<?php
include '../connection.php'; // Include database connection

if (isset($_POST["query"])) {
    $search = "%" . $_POST["query"] . "%";
    if (isset($_COOKIE["selectedProducts"])) {
        $cookieproduct = $_COOKIE["selectedProducts"];
        $cookieproduct = json_decode($_COOKIE['selectedProducts'], true);
    } else {
        $cookieproduct = [];
    }
    if (isset($_COOKIE["product_ids"])) {
        $cookieupdate = $_COOKIE["product_ids"];
        $cookieupdate = json_decode($_COOKIE['product_ids'], true);
    } else {
        $cookieupdate = [];
    }
    if (isset($_COOKIE["unchecked"])) {
        $unchecked = $_COOKIE["unchecked"];
        $unchecked = json_decode($_COOKIE['unchecked'], true);
    } else {
        $unchecked = [];
    }

    // Remove elements present in $removedata from $arrayData
    $resultArray = array_diff($cookieupdate, $unchecked);

    // Re-index the array (optional)
    $resultArray = array_values($resultArray);

    $resultArray = array_merge($resultArray, $cookieproduct);

    // Remove duplicates
    $resultArray = array_unique($resultArray);

    // Reset array indexes after removing duplicates
    $resultArray = array_values($resultArray);


    $query = $conn->prepare("SELECT id, product_name FROM products WHERE product_name LIKE :search LIMIT 10");
    $query->bindParam(":search", $search, PDO::PARAM_STR);
    $query->execute();
    $products = $query->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        echo '<table class="table table-bordered"><tr><th>Select</th><th>id</th><th>Product Name</th>
        </tr>';
        foreach ($products as $product) {
            echo '<tr><td><input type="checkbox" name="productid[]" class="product-checkbox" value="' . htmlspecialchars($product["id"]) . '"';
            if (in_array($product["id"], $resultArray)) {
                echo "checked";
            }
            echo '></td>
            <td >' . htmlspecialchars($product["id"]) . '</td>
            <td >' . htmlspecialchars($product["product_name"]) . '</td></tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No products found.</p>';
    }
}
