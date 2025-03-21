<?php
include '../connection.php';
include "../session_expire.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch banner details
    $stmt = $conn->prepare("SELECT app_banner, web_banner FROM banners WHERE id = ?");
    $stmt->execute([$id]);
    $banner = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$banner) {
        echo "<script>alert('Banner not found!'); window.location.href = 'offers_banner_list.php';</script>";
        exit;
    }

    // Delete the banner from the database
    $deleteStmt = $conn->prepare("DELETE FROM banners WHERE id = ?");
    if ($deleteStmt->execute([$id])) {
        // Delete associated images if they exist
        if (!empty($banner['app_banner']) && file_exists("../uploads/" . $banner['app_banner'])) {
            unlink("../uploads/" . $banner['app_banner']);
        }
        if (!empty($banner['web_banner']) && file_exists("../uploads/" . $banner['web_banner'])) {
            unlink("../uploads/" . $banner['web_banner']);
        }

        echo "<script>alert('Banner deleted successfully!'); window.location.href = 'offers_banner_list.php';</script>";
    } else {
        echo "<script>alert('Error deleting banner!'); window.location.href = 'offers_banner_list.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href = 'offers_banner_list.php';</script>";
}
