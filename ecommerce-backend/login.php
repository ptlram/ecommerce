<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
include "../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/SMTP.php";
include "../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/Exception.php";
include "./connection.php";
session_start();

// Check if this is an AJAX request (for modal login)
$isAjax = isset($_POST['ajax']) && $_POST['ajax'] == '1';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myemail = trim($_POST["email"]);
    $mypassword = $_POST["password"];

    try {
        // Fetch user info
        $query = $conn->prepare("SELECT * FROM login WHERE email = :email");
        $query->bindParam(':email', $myemail);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        // Fetch customer info (optional if needed)
        $querys = $conn->prepare("SELECT * FROM customers WHERE email = :email OR mobile_number = :mobile_number");
        $querys->bindParam(':email', $myemail);
        $querys->bindParam(':mobile_number', $myemail);
        $querys->execute();
        $customer = $querys->fetch(PDO::FETCH_ASSOC);

        // Validate password
        if ($user && password_verify($mypassword, $user["password"])) {
            // Save session info
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["customer_id"] = $customer["id"] ?? null;
            $_SESSION["last_activity"] = time();

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
                $mail->Password   = 'odhc onch hcmt nahz'; // Move to environment variable in production!
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;

                $mail->setFrom('ramvijaypatel96@gmail.com', 'Your Site');
                $mail->addAddress($myemail);

                $mail->isHTML(true);
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = "<h3>Your OTP is: <strong>$otp</strong></h3>";

                $mail->send();

                // ✅ AJAX response
                if ($isAjax) {
                    echo json_encode(["otpSent" => true, "message" => "OTP sent to your email."]);
                    exit();
                } else {
                    header("Location: verify-otp.php");
                    exit();
                }
            } catch (Exception $e) {
                $error = "Mailer Error: " . $mail->ErrorInfo;
                if ($isAjax) {
                    echo json_encode(["otpSent" => false, "message" => $error]);
                    exit();
                } else {
                    echo $error;
                }
            }
        } else {
            $errorMsg = "Invalid email or password!";
            if ($isAjax) {
                echo json_encode(["otpSent" => false, "message" => $errorMsg]);
                exit();
            } else {
                echo "<script>alert('$errorMsg'); window.location.href='../ecommerce-frontend/template/index.php'</script>";
            }
        }
    } catch (PDOException $e) {
        $errorMsg = "Database error: " . $e->getMessage();
        if ($isAjax) {
            echo json_encode(["otpSent" => false, "message" => $errorMsg]);
            exit();
        } else {
            echo $errorMsg;
        }
    }
}
