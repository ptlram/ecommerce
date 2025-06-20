<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST["otp"];

    if (isset($_SESSION["otp"]) && $enteredOtp == $_SESSION["otp"]) {
        unset($_SESSION["otp"]);
        $redirectUrl = ($_SESSION["role"] == "admin") ? "../../ecommerce-backend/admin/dashboard.php" : "./index.php";
        echo json_encode(["success" => true, "redirect" => $redirectUrl]);
    } else {
        echo json_encode(["success" => false, "message" => "Invalid OTP. Please try again."]);
    }
}
