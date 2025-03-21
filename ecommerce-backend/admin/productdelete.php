<?php
include "../connection.php"; // Include database connection
include "../session_expire.php";
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the product details
    $query = $conn->prepare("SELECT product_image, multiple_images FROM products WHERE id = :id");
    $query->execute([':id' => $product_id]);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $target_dir = "../pages/uploads/products/";

        // Delete main product image
        if (!empty($product['product_image']) && file_exists($target_dir . $product['product_image'])) {
            unlink($target_dir . $product['product_image']);
        }

        // Delete multiple images
        $multiple_images = explode(",", $product['multiple_images']);
        foreach ($multiple_images as $image) {
            if (!empty($image) && file_exists($target_dir . $image)) {
                unlink($target_dir . $image);
            }
        }

        // Delete product record from the database
        $delete_query = $conn->prepare("DELETE FROM products WHERE id = :id");
        $delete_query->execute([':id' => $product_id]);

        echo "<script>alert('Product deleted successfully!'); window.location.href='productlist.php';</script>";
    } else {
        echo "<script>alert('Product not found!'); window.location.href='productlist.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='productlist.php';</script>";
}
