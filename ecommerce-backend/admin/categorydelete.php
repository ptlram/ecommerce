<?php
include "../pages/db.php";
include "../session_expire.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch image path before deleting
    $query = $pdo->prepare("SELECT image FROM category WHERE id = ?");
    $query->execute([$id]);
    $category = $query->fetch();

    if ($category) {
        $imagePath = "../pages/uploads/category/" . $category['image'];

        // Delete image file if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete category from database
        $query = $pdo->prepare("DELETE FROM category WHERE id = ?");
        $query->execute([$id]);

        header("Location: categorylist.php");
        exit();
    }
}
