<?php
include('includes/database.php'); // Include database connection
session_start(); // Start or resume a session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']); // Trim whitespaces
    $password = trim($_POST['password']); // Trim whitespaces

    // Use prepared statement to prevent SQL injection
    $stmt = $mysqli->prepare("SELECT u.*, c.suspended AS condominium_suspended, c.suspension_reason AS condominium_suspension_reason FROM users u LEFT JOIN condominiums c ON u.condominium_id = c.id WHERE u.email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($user['condominium_suspended'] == 1) {
            // Condominium is suspended
            if ($user['role'] == "Administrator" || $user['role'] == "Front Desk") {
                // Only show suspension reason to Administrators and Front Desk users
                $error_message = "This condominium is suspended. Reason: " . $user['condominium_suspension_reason'] . '.';
            } elseif ($user['role'] == "Resident" || $user['role'] == "Tenant") {
                // Residents will see a different message
                $error_message = "The website is currently under maintenance. Please check again later.";
            } else {
                // Handle other roles if needed
                $error_message = "Access denied. You do not have the necessary role to view this information.";
            }
        } elseif ($user['suspended'] == 1) {
            // User is suspended
            $error_message = "Your account is suspended. Reason: " . $user['suspension_reason'] . '.';
        } else {
            // Verify the password using sha256 hashing
            $hashed_password = hash("sha256", $password, false);
            if ($hashed_password === $user['password']) {
                // Password is correct

                $dashboard_url = $user['dashboard_url'];
                $user_role = $user['role'];

                // Set session variables
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['dashboard_url'] = $dashboard_url;
                $_SESSION['role'] = $user_role;
                $_SESSION['account_number'] = $user['account_number'];

                // Record login activity in activity_logs table
                $login_user = $user['username'];
                $login_activity = "Logged in";
                $condominium_id = $user['condominium_id']; // Assuming user has a condominium_id
                $account_number = $user['account_number'];

                $stmt_insert_activity = $mysqli->prepare("INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP(), ?, ?, ?, ?)");
                $stmt_insert_activity->bind_param("ssss", $login_user, $login_activity, $condominium_id, $account_number);
                $stmt_insert_activity->execute();
                $stmt_insert_activity->close();

                // Redirect to the user's dashboard URL
                header("Location: $dashboard_url");
                exit();
            } else {
                // Wrong password
                $error_message = "Wrong password. Please enter the correct password.";
            }
        }
    } else {
        // Account does not exist
        $error_message = "Account with this email does not exist. Please check your email.";
    }

    $stmt->close();
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
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label><strong>Password:</strong></label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="off" required>
                    </div>

                    <?php
                        $error_color = '#ff0000'; // Default color (you can change it as needed)
                        
                        if (isset($error_message)) 
                        {
                            if (isset($user) && $user['condominium_suspended'] == 0) 
                            {
                                if ($user['role'] == "Tenant") 
                                {
                                    $error_color = '#ff0000'; // Red for Tenant if Condominium is not Suspended
                                } elseif ($user['role'] == "Resident") 
                                {
                                    $error_color = '#ff0000'; // Red for Resident if Condominium is not Suspended
                                } elseif ($user['role'] == "Front Desk") 
                                {
                                    $error_color = '#ff0000'; // Red for Front Desk if Condominium is not Suspended
                                } elseif ($user['role'] == "Administrator") 
                                {
                                    $error_color = '#ff0000'; // Red for Administrator if Condominium is not Suspended
                                }
                            } 
                            elseif (isset($user) && $user['condominium_suspended'] == 1) 
                            {
                                if ($user['role'] == "Tenant") 
                                {
                                    $error_color = '#006400'; // Green for Tenant if Condominium is Suspended
                                } elseif ($user['role'] == "Resident") 
                                {
                                    $error_color = '#006400'; // Green for Resident if Condominium is Suspended
                                } elseif ($user['role'] == "Front Desk") 
                                {
                                    $error_color = '#ff0000'; // Red for Front Desk if Condominium is Suspended
                                } elseif ($user['role'] == "Administrator") 
                                {
                                    $error_color = '#ff0000'; // Red for Administrator if Condominium is Suspended
                                }
                            } 
                            else 
                            {
                                $error_color = '#ff0000'; // Red for non-existing account
                            }

                            echo "<p class='error'><strong><center><font color='$error_color'>$error_message</font></center></strong></p>";
                        }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="add_submit" value="Login"></button></center>
                    </div>

                    <div class="link login-link text-center"><a href="forgotPassword/forgot-password.php">Forgot Password?</a></div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>