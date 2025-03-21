<?php
include '../connection.php'; // Database connection

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $stmt = $conn->prepare("DELETE FROM expense WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<script>alert('Expense deleted successfully!'); window.location.href='expense.php';</script>";
    } else {
        echo "Error deleting expense.";
    }
} else {
    echo "Invalid request!";
}
