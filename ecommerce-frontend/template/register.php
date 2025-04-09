<?php
include "./connection.php"; // Ensure this file correctly initializes a PDO connection

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


include "../../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
include "../../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/SMTP.php";
include "../../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/Exception.php";


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
            echo "<script>alert('Error: Email ID already exists!'); window.location.href='./index.php';</script>";
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

        // Store in session
        $_SESSION["email_or_mobile"] = $email_or_mobile;
        $_SESSION["password"] = $password;
        $_SESSION["refferal_code"] = $refferal_code;

        // Generate OTP
        $otp = rand(100000, 999999);
        $_SESSION["otp"] = $otp;

        // Send OTP
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'ramvijaypatel96@gmail.com';
            $mail->Password   = 'odhc onch hcmt nahz'; // move to env var!
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('ramvijaypatel96@gmail.com', 'Bits infotech');
            $mail->addAddress($email_or_mobile);

            $mail->isHTML(true);
            $mail->Subject = 'Your OTP Code';
            $mail->Body    = "<h3>Your OTP is: <strong>$otp</strong></h3>";

            $mail->send();
            header("Location: registerverify.php");
            exit();
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='./index.php';</script>";
    }
}
