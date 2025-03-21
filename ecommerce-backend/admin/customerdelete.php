<?php
include "../pages/db.php";
include "../session_expire.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete customer record
    $query = $pdo->prepare("DELETE FROM customers WHERE id = ?");
    $query->execute([$id]);

    header("Location: customerlist.php");
    exit();
}
