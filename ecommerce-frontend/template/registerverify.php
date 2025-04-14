<?php
session_start();
include "./connection.php"; // Make sure this file sets up $conn (PDO)
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST["otp"];

    if (isset($_SESSION['registration']['otp']) && $enteredOtp == $_SESSION['registration']['otp']) {
        unset($_SESSION['registration']["otp"]); // Clear OTP after use

        // Fetch required data from session
        $email_or_mobile = $_SESSION['registration']["email_or_mobile"];
        $password_hash =  $_SESSION['registration']["password_hash"];
        $rcode = isset($_SESSION['registration']["rcode"]) ? $_SESSION['registration']["rcode"] : null;
        $refferal_code = $_SESSION['registration']["generated_referral_code"] ?? null;

        // Insert into `login`
        $stmt = $conn->prepare("INSERT INTO login (email, password, role) VALUES (:email, :password, 'customer')");
        $stmt->bindParam(":email", $email_or_mobile, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password_hash, PDO::PARAM_STR);

        // Insert into `customers`
        if (is_numeric($email_or_mobile)) {
            $stmtt = $conn->prepare("INSERT INTO customers (mobile_number, ReferralCode, referral_by) VALUES (:value, :refferal, :rcode)");
        } else {
            $stmtt = $conn->prepare("INSERT INTO customers (email, ReferralCode, referral_by) VALUES (:value, :refferal, :rcode)");
        }
        $stmtt->bindParam(":value", $email_or_mobile, PDO::PARAM_STR);

        $stmtt->bindParam(":refferal", $refferal_code, PDO::PARAM_STR);
        $stmtt->bindParam(":rcode", $rcode, PDO::PARAM_STR);

        // Execute and check
        if ($stmt->execute() && $stmtt->execute()) {

            unset($_SESSION['registration']["email_or_mobile"]); // Clear email_or_mobile after use
            unset($_SESSION['registration']["password"]); // Clear password after use
            unset($_SESSION['registration']["rcode"]); // Clear refferal_code after use
            echo json_encode(["success" => true, "redirect" =>  "./index.php"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: Unable to insert data."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid OTP. Please try again."]);
    }
}
