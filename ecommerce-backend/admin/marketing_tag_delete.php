<?php
include "../connection.php"; // Database connection

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid ID.'); window.location.href = 'marketing_tag.php';</script>";
    exit();
}

$id = $_GET['id'];

// Fetch image path before deleting
$query = $conn->prepare("SELECT image FROM marketing_tag WHERE id = :id");
$query->execute([":id" => $id]);
$tag = $query->fetch(PDO::FETCH_ASSOC);

if (!$tag) {
    echo "<script>alert('Tag not found.'); window.location.href = 'marketing_tag.php';</script>";
    exit();
}

// Delete image if exists
if (!empty($tag['image'])) {
    $image_path = "../pages/uploads/marketing_tag/" . $tag['image'];
    if (file_exists($image_path)) {
        unlink($image_path);
    }
}

// Delete tag from database
$delete_query = $conn->prepare("DELETE FROM marketing_tag WHERE id = :id");
$delete_query->execute([":id" => $id]);

echo "<script>alert('Marketing tag deleted successfully!'); window.location.href = 'marketing_tag.php';</script>";
exit();
