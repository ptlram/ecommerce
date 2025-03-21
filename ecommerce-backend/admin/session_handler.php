<?php
session_start();

// Read JSON data from the request
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data["selectedProducts"])) {
    $_SESSION["selectedProducts"] = $data["selectedProducts"];
    echo "Session updated successfully!";
} else {
    echo "No data received!";
}
