<?php
include 'db.php';

if (isset($_POST['state_id'])) {
    $state_id = $_POST['state_id'];

    $sql = "SELECT * FROM cities WHERE state_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$state_id]);
    $cities = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<option value="">Select City</option>';
    foreach ($cities as $city) {
        echo '<option value="' . $city['id'] . '">' . htmlspecialchars($city['city_name']) . '</option>';
    }
}
