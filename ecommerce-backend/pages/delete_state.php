<?php
include 'db.php';

if (isset($_GET["id"])) {
    $state_id = $_GET["id"];

    try {
        // Delete the state and its corresponding cities
        $sql = "DELETE FROM states WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $state_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "State and its cities deleted successfully!";
            header("Location: ../admin/statelist.php");
        } else {
            echo "Failed to delete state.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
