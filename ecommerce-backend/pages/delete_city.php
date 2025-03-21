<?php
include 'db.php';

if (isset($_GET["id"])) {
    $city_id = $_GET["id"];

    try {
        // Delete the city from the database
        $sql = "DELETE FROM cities WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $city_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "City deleted successfully!";
            header("Location: ../admin/citylist.php");
        } else {
            echo "Failed to delete city.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
