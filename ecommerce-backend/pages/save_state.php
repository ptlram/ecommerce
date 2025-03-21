<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $state_name = $_POST["state_name"];

    if (!empty($state_name)) {
        try {
            $sql = "INSERT INTO states (state_name) VALUES (:state_name)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":state_name", $state_name);

            if ($stmt->execute()) {
                echo "State added successfully!";
                header("location: ../admin/statelist.php");
            } else {
                echo "Failed to add state.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "State name is required!";
    }
}
