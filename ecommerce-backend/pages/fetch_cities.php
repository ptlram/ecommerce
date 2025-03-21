<?php
include 'db.php';

if (isset($_POST["state_id"])) {
    $state_id = $_POST["state_id"];

    $sql = "SELECT * FROM cities WHERE state_id = :state_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":state_id", $state_id, PDO::PARAM_INT);
    $stmt->execute();
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($cities);
}
