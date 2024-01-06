<?php
session_start();

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

// Check if the condominium is disabled
include('../includes/database.php'); // Assuming the path is correct
$query = "SELECT disabled FROM condominiums WHERE name='Casa Bougainvilla'";
$result = $mysqli->query($query);

if ($result && $result->num_rows == 1) {
    $condominium = $result->fetch_assoc();
    $condominium_disabled = $condominium['disabled'];

    if ($condominium_disabled == 1 && in_array($_SESSION['role'], ['Resident', 'Front Desk', 'Administrator'])) {
        // The condominium is disabled, and the user has a locked role
        header("Location: ../index.php");
        exit();
    }
}

// Logout functionality
if (isset($_POST['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: ../index.php"); // Redirect to login page after logout
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Resident'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Resident Dashboard</title>
</head>

<body>
    <p>RESIDENT DASHBOARD</p>

    <!-- Add your dashboard content here -->

    <form method="post">
        <button type="submit" class="logout-button" name="logout">Logout</button>
    </form>
</body>

</html>