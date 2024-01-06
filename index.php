<?php
include('includes/database.php'); // Include database connection
session_start(); // Start or resume a session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform database query to verify user credentials
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $dashboard_url = $user['dashboard_url'];
        $user_role = $user['role'];

        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['dashboard_url'] = $dashboard_url;
        $_SESSION['role'] = $user_role;

        // Redirect to the user's dashboard URL
        header("Location: $dashboard_url");
        exit();
    } else {
        $error_message = "Invalid username or password. Make sure you are logging in with correct credentials.";
    }
}

// Logout functionality
if (isset($_GET['logout'])) {
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    header("Location: index.php"); // Redirect to login page after logout
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/style.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="index.php" method="post" enctype="multipart/form-data">

                    <center><img src="includes/logo.png" width="300" height="250"></center>

                    <h2 class="text-center">MyHomeHub</h2>

                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" placeholder="Enter Username" name="username" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Password:</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="off" required>
                    </div>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="add_submit" value="Login"></button></center>
                    </div>

                    <div class="link login-link text-center"><a href="forgot_password.php">Forgot Password?</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>