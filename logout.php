<?php
session_start();

// Include the database connection file
include('includes/database.php');

if (isset($_SESSION['username'])) {
    // Get condominium_id and account_number based on the account
    $username = $_SESSION['username'];
    $stmt_get_user_info = $mysqli->prepare("SELECT condominium_id, account_number FROM users WHERE username = ?");
    $stmt_get_user_info->bind_param("s", $username);
    $stmt_get_user_info->execute();
    $stmt_get_user_info->bind_result($condominium_id, $account_number);
    $stmt_get_user_info->fetch();
    $stmt_get_user_info->close();

    // Record logout activity in activity_logs table
    $logout_user = $_SESSION['username'];
    $logout_activity = "Logged out";

    $stmt_insert_activity = $mysqli->prepare("INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP(), ?, ?, ?, ?)");
    $stmt_insert_activity->bind_param("ssss", $logout_user, $logout_activity, $condominium_id, $account_number);
    $stmt_insert_activity->execute();
    $stmt_insert_activity->close();
}

// Unset all session variables and destroy the session
session_unset();
session_destroy();

// Redirect to login page after logout
header("Location: index.php");
exit();
?>