<?php
include "./connection.php"; // Ensure this file correctly initializes a PDO connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_or_mobile = trim($_POST["emailOrMobile"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirmPassword"];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Error: Passwords do not match!'); window.location.href='register.php';</script>";
        exit;
    }

    try {
        // Check if email or phone already exists
        $stmt = $conn->prepare("SELECT COUNT(*) FROM login WHERE email = :email");
        $stmt->bindParam(":email", $email_or_mobile, PDO::PARAM_STR);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            echo "<script>alert('Error: Email or mobile number already exists!'); window.location.href='register.php';</script>";
            exit;
        }

        // Hash password for security
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user
        $stmt = $conn->prepare("INSERT INTO login (email, password, role) VALUES (:email, :password, 'customer')");
        $stmt->bindParam(":email", $email_or_mobile, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password_hash, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: Unable to insert data.'); window.location.href='register.php';</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href='register.php';</script>";
    }
}
