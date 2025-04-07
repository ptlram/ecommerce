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
<html>

<head>
    <title>Verify OTP</title>
</head>

<body>
    <h2>Enter the OTP sent to your email</h2>
    <form method="post">
        <input type="text" name="otp" required maxlength="6" pattern="\d{6}" placeholder="Enter 6-digit OTP">
        <button type="submit">Verify</button>
    </form>
    <?php if (isset($error)) echo "<p style='color:red;'>" . htmlspecialchars($error) . "</p>"; ?>
</body>

</html>