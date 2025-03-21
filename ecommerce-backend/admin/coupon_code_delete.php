<?php
include "../connection.php"; // Include database connection
include "../session_expire.php";
if (isset($_GET['id'])) {
    $coupon_id = $_GET['id'];

    // Delete coupon record
    $query = $conn->prepare("DELETE FROM coupons WHERE id = :id");
    $query->execute([':id' => $coupon_id]);

    echo "<script>alert('Coupon deleted successfully!'); window.location.href='coupon_codelist.php';</script>";
} else {
    echo "<script>alert('Invalid request!'); window.location.href='coupon_codelist.php';</script>";
}
