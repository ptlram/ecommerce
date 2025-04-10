<?php
include "./connection.php";

$query = $conn->prepare("SELECT * FROM brand");
$query->execute();
$result = $query->fetchAll();

$count = $query->rowCount();

if ($count > 0) {
    echo json_encode($result);
} else {
    echo json_encode(array('message' => 'no record found', 'status' => false));
}
