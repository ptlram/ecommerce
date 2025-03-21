<?php
include "../connection.php";

// Get Blog ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Invalid Blog ID.");
}
$blog_id = $_GET['id'];

// Fetch Blog Image
$stmt = $conn->prepare("SELECT blog_image FROM blogs WHERE id = :id");
$stmt->bindParam(':id', $blog_id);
$stmt->execute();
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$blog) {
    die("Blog not found.");
}

// Delete Image File from Server
$imagePath = "../pages/uploads/blog/" . $blog['blog_image'];
if (file_exists($imagePath)) {
    unlink($imagePath); // Remove the file
}

// Delete Blog from Database
$stmt = $conn->prepare("DELETE FROM blogs WHERE id = :id");
$stmt->bindParam(':id', $blog_id);

if ($stmt->execute()) {
    echo "<script> window.location.href='blog.php';</script>";
} else {
    echo "<script>alert('Failed to delete blog');</script>";
}
