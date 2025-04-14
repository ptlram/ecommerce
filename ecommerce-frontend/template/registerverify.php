<?php
session_start();
include "./connection.php"; // Make sure this file sets up $conn (PDO)


echo "<script>console.log('Email Id already exists! ');</script>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST["otp"];

    if (isset($_SESSION["otp"]) && $enteredOtp == $_SESSION["otp"]) {
        unset($_SESSION["otp"]); // Clear OTP after use

        // Fetch required data from session
        $email_or_mobile = $_SESSION["email_or_mobile"];
        $password = $_SESSION["password"];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $rcode = isset($_SESSION["rcode"]) ? $_SESSION["rcode"] : null;
        $refferal_code = $_SESSION["refferal_code"] ?? null;

        // Insert into `login`
        $stmt = $conn->prepare("INSERT INTO login (email, password, role) VALUES (:email, :password, 'customer')");
        $stmt->bindParam(":email", $email_or_mobile, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password_hash, PDO::PARAM_STR);

        // Insert into `customers`
        if (is_numeric($email_or_mobile)) {
            $stmtt = $conn->prepare("INSERT INTO customers (mobile_number, ReferralCode, referral_by) VALUES (:value, :rcode, :refferal)");
        } else {
            $stmtt = $conn->prepare("INSERT INTO customers (email, ReferralCode, referral_by) VALUES (:value, :rcode, :refferal)");
        }
        $stmtt->bindParam(":value", $email_or_mobile, PDO::PARAM_STR);
        $stmtt->bindParam(":rcode", $rcode, PDO::PARAM_STR);
        $stmtt->bindParam(":refferal", $refferal_code, PDO::PARAM_STR);

        // Execute and check
        if ($stmt->execute() && $stmtt->execute()) {

            unset($_SESSION["email_or_mobile"]); // Clear email_or_mobile after use
            unset($_SESSION["password"]); // Clear password after use
            unset($_SESSION["refferal_code"]); // Clear refferal_code after use
            echo json_encode(["success" => true, "redirect" =>  "./index.php"]);
        } else {
            echo json_encode(["success" => false, "message" => "Error: Unable to insert data."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid OTP. Please try again."]);
    }
}
