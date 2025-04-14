<?php
session_start();

if (isset($_POST['month'])) {
    if ($_POST['month'] == $_SESSION['selected_month']) {
        unset($_SESSION['selected_month']);
    } else {
        $_SESSION['selected_month'] = $_POST['month'];
    }
    echo "Session updated successfully.";
} else {
    echo "Month not provided.";
}
