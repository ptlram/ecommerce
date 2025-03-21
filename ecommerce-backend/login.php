<?php
session_start(); // Start session
include "./connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myemail = trim($_POST["email"]);
    $mypassword = $_POST["password"];

    try {
        // Fetch user data for the provided email
        $query = $conn->prepare("SELECT * FROM login WHERE email = :email");
        $query->bindParam(':email', $myemail);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mypassword, $user["password"])) {
            // Store user session
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["last_activity"] = time();

            // Redirect based on role
            if ($user["role"] == "admin") {
                header("location: ./admin/dashboard.php");
            } else {
                header("location: ./user/index.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid email or password!'); window.location.href='./index.php'</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
//ends