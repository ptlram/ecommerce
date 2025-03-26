<?php
session_start();

$timeout_duration =  60; //  86400 seconds

// Check if session is set and expired
if (isset($_SESSION["last_activity"])) {
    $elapsed_time = time() - $_SESSION["last_activity"];

    if ($elapsed_time > $timeout_duration) {
        session_unset();
        session_destroy();
        echo "<script>
            alert('Your session has expired. Login again!');
            window.location.href='../../ecommerce-frontend/template/index.php?message=SessionExpired';
        </script>";
        exit();
    }
}

// ✅ Update last activity time whenever the user visits any page
$_SESSION["last_activity"] = time();
