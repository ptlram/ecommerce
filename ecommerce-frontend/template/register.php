<?php
include "./connection.php"; // Ensure this file correctly initializes a PDO connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_mobile = trim($_POST["emailOrMobile"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmPassword"];

    $refferal_code = $_POST["refferal_code"] || null;


    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Error: Passwords do not match!'); window.location.href='./index.php';</script>";
        exit;
    }

    try {
        // Check if email or phone already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM customers WHERE email = :email OR mobile_number = :mobile_number");
        $stmt->bindParam(":email", $email_or_mobile, PDO::PARAM_STR);
        $stmt->bindParam(":mobile_number", $email_or_mobile, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo "<script>alert('Error: Email or mobile number already exists!'); window.location.href='./index.php';</script>";
            exit;
        }

        if (!empty($_POST["refferal_code"])) {
            // Check if email or phone already exists
            $refferal_code = $_POST["refferal_code"];
            $stmt = $conn->prepare("SELECT COUNT(*) FROM customers WHERE ReferralCode = :ReferralCode");
            $stmt->bindParam(":ReferralCode", $refferal_code, PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetchColumn();

            if ($count <= 0) {
                echo "<script>alert('Error: refferal code not exists!'); window.location.href='./index.php';</script>";
                exit;
            }
        }

        // Hash password for security
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        function generateAlphanumericCode($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $code = '';
            $maxIndex = strlen($characters) - 1;

            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, $maxIndex)];
            }

            return $code;
        }

        // Generate a unique referral code
        $rcode = generateAlphanumericCode();

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO login (email, password, role) VALUES (:email, :password, 'customer')");
        $stmt->bindParam(":email", $email_or_mobile, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password_hash, PDO::PARAM_STR);
        if (is_numeric($email_or_mobile)) {
            $stmtt = $conn->prepare("INSERT INTO customers (mobile_number,ReferralCode,referral_by) VALUES ('$email_or_mobile','$rcode','$refferal_code')");
        } else {
            $stmtt = $conn->prepare("INSERT INTO customers (email,ReferralCode,referral_by) VALUES ('$email_or_mobile','$rcode','$refferal_code')");
        }



        if ($stmt->execute() && $stmtt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='./index.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to insert data.'); window.location.href='./index.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='./index.php';</script>";
    }
}
