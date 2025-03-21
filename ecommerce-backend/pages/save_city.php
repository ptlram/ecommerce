<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $city_name = $_POST["city_name"];
    $state_id = $_POST["state_id"];

    if (!empty($city_name) && !empty($state_id)) {
        try {
            $sql = "INSERT INTO cities (city_name, state_id) VALUES (:city_name, :state_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":city_name", $city_name);
            $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo "City added successfully!";
                header("location: ../admin/citylist.php");
            } else {
                echo "Failed to add city.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "City name and state selection are required!";
    }
}
