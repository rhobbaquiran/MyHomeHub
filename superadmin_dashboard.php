<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: index.php");
    exit();
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to login page after logout
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Super Administrator'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Superadmin Dashboard</title>
</head>

<body>
    <p>SUPER ADMIN DASHBOARD</p>

    <!-- Add your dashboard content here -->

    <form method="post">
        <button type="submit" class="logout-button" name="logout">Logout</button>
    </form>
</body>

</html>