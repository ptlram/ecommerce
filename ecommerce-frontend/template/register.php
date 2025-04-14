<?php
session_start();
require_once './connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once '../../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require_once '../../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/SMTP.php';
require_once '../../ecommerce-backend/PHPMailer-master/PHPMailer-master/src/Exception.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

$emailOrMobile = trim($_POST['emailOrMobile'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';
$referralCode = $_POST['refferal_code'] ?? null;

if (empty($emailOrMobile) || empty($password) || empty($confirmPassword)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if ($password !== $confirmPassword) {
    echo json_encode(['success' => false, 'message' => 'Passwords do not match.']);
    exit;
}

try {
    // Check if email or mobile number already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM customers WHERE email = :email OR mobile_number = :mobile_number");
    $stmt->bindParam(':email', $emailOrMobile, PDO::PARAM_STR);
    $stmt->bindParam(':mobile_number', $emailOrMobile, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->fetchColumn() > 0) {
        echo json_encode(['success' => false, 'message' => 'Email or mobile number already exists.']);
        exit;
    }

    // Validate referral code if provided
    if (!empty($referralCode)) {
        $stmt = $conn->prepare("SELECT COUNT(*) FROM customers WHERE ReferralCode = :ReferralCode");
        $stmt->bindParam(':ReferralCode', $referralCode, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->fetchColumn() === 0) {
            echo json_encode(['success' => false, 'message' => 'Referral code does not exist.']);
            exit;
        }
    }

    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Generate a unique referral code
    function generateReferralCode($length = 10): string
    {
        return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
    }
    $newReferralCode = generateReferralCode();

    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['registration'] = [
        'email_or_mobile' => $emailOrMobile,
        'password_hash' => $passwordHash,
        'referral_code' => $referralCode,
        'generated_referral_code' => $newReferralCode,
        'otp' => $otp,
        'otp_generated_at' => time()
    ];

    // Send OTP via email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ramvijaypatel96@gmail.com';
        $mail->Password   = 'odhc onch hcmt nahz'; // Use environment variables in production
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('no-reply@example.com', 'Bits Infotech');
        $mail->addAddress($emailOrMobile);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "<h3>Your OTP is: <strong>{$otp}</strong></h3>";

        $mail->send();

        echo json_encode(['success' => true, 'otpSent' => true]);
        exit;
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
        exit;
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database Error: ' . $e->getMessage()]);
    exit;
}
