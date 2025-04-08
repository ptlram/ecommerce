<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enteredOtp = $_POST["otp"];

    if (isset($_SESSION["otp"]) && $enteredOtp == $_SESSION["otp"]) {
        unset($_SESSION["otp"]); // Clear OTP after use

        if (isset($_SESSION["role"]) && $_SESSION["role"] == "admin") {
            header("Location: ./admin/dashboard.php");
        } else {
            header("Location: ../ecommerce-frontend/template/index.php");
        }
        exit();
    } else {
        $error = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f4f4f4, #e0e0e0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .otp-box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .otp-box h2 {
            margin-bottom: 15px;
            font-weight: 600;
            color: #333;
        }

        .otp-box p {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }

        .otp-box input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            text-align: center;
            transition: 0.3s;
        }

        .otp-box input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
        }

        .otp-box button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .otp-box button:hover {
            background-color: #0056b3;
        }

        .otp-box .icon {
            font-size: 40px;
            color: #007bff;
            margin-bottom: 10px;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        @media (max-width: 480px) {
            .otp-box {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="otp-box">
        <div class="icon"><i class="fas fa-shield-alt"></i></div>
        <h2>Verify OTP</h2>
        <p>Enter the 6-digit OTP sent to your registered email</p>
        <form method="post">
            <input type="text" name="otp" required maxlength="6" pattern="\d{6}" placeholder="Enter 6-digit OTP">
            <button type="submit"><i class="fas fa-check-circle"></i> Verify</button>
        </form>
        <?php if (isset($error)) echo "<div class='error'>" . htmlspecialchars($error) . "</div>"; ?>
    </div>
</body>

</html>