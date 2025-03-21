<?php
include '../connection.php'; // Include database connection

if (isset($_COOKIE["selectedProducts"])) {
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

    echo '<table class="table table-bordered">';
    echo "<thead>";
    echo "<th>ID</th>";
    echo "<th>Product Name</th>";
    echo "</thead>";
    foreach ($resultArray as $cpdid) {
        $query = $conn->prepare("SELECT * FROM products WHERE id=$cpdid");
        $query->execute();
        $products = $query->fetchAll();
        foreach ($products as $pd) {
            echo "<tr>";
            echo '<td>' . $pd["id"] . '</td>';
            echo '<td>' . $pd["product_name"] . '</td>';
            echo "<tr>";
        }
    }
    echo "</table>";
}
