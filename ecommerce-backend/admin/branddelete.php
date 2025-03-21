<?php
include('../connection.php'); // Include PDO database connection
include "../session_expire.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Get image filename before deleting record
        $stmt = $conn->prepare("SELECT image FROM brand WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $brand = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($brand) {
            // Delete image file from assets folder
            $image_path = "../pages/uploads/brand/" . $brand['image'];
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            // Delete record from database
            $stmt = $conn->prepare("DELETE FROM brand WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            if ($stmt->execute()) {
                echo "<script>alert('Brand deleted successfully!'); window.location.href='brandlist.php';</script>";
            } else {
                echo "<script>alert('Error deleting brand');</script>";
            }
        } else {
            echo "<script>alert('Brand not found');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Database Error: " . $e->getMessage() . "');</script>";
    }
} else {
    echo "<script>alert('Invalid request'); window.location.href='brandlist.php';</script>";
}
