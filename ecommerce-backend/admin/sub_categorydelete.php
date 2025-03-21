<?php
include "../pages/db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch image path before deleting
    $query = $pdo->prepare("SELECT image FROM subcategory WHERE id = ?");
    $query->execute([$id]);
    $subcategory = $query->fetch();

    if ($subcategory) {
        $imagePath = "../pages/uploads/subcategory/" . $subcategory['image'];

        // Delete image file if it exists
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete subcategory from database
        $query = $pdo->prepare("DELETE FROM subcategory WHERE id = ?");
        $query->execute([$id]);

        header("Location: sub_categorylist.php");
        exit();
    }
}
