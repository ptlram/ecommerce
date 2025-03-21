<?php
include "../connection.php"; // Database connection

// Check if ID is set in URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid request.'); window.location.href='delivery_time_slot.php';</script>";
    exit;
}

$id = $_GET['id'];

// Delete query
$deleteQuery = $conn->prepare("DELETE FROM time_slot WHERE id = :id");

if ($deleteQuery->execute([':id' => $id])) {
    echo "<script>alert('Time Slot deleted successfully!'); window.location.href='delivery_time_slot.php';</script>";
} else {
    echo "<script>alert('Error deleting record.');</script>";
}
