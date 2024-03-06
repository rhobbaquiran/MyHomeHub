<?php
session_start();
include('../../includes/database.php');

// Redirect if the user is not logged in or has an invalid session
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action, $condoName = 1)
{
    global $mysqli;

    $account_number = $_SESSION['account_number'];

    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP, ?, ?, 1,$account_number)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

function generateAccountNumber()
{
    global $mysqli;

    $maxAttempts = 10;

    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
        $accountNumber = mt_rand(1000000000, 2147483646); // Adjusted range to avoid 2147483647

        // Check if the generated account number already exists
        $check_query = "SELECT COUNT(*) FROM users WHERE account_number = ?";
        $stmt_check = $mysqli->prepare($check_query);
        $stmt_check->bind_param("i", $accountNumber);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count == 0) {
            // The generated account number is unique
            return $accountNumber;
        }
    }

    // If after maxAttempts we couldn't find a unique number, return null
    return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and remove whitespaces
    $name = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = hash('sha256', trim($_POST['password']));
    $confirm_password = hash('sha256', trim($_POST['confirm_password']));
    $condominium = 'Casa Bougainvilla'; // Automatically set to 'Casa Bougainvilla'
    $role = 'Tenant';  // Set the role to 'Resident'

    // Generate 10 digits account ID
    $accountNumber = generateAccountNumber();

    // To check if password and re-entered password match
    if ($password !== $confirm_password) {
        echo "<script>";
        echo "let text = 'Error: Passwords do not match.';";
        echo "if (confirm(text)) {";
        echo "  window.location = 'add_tenant.php';";
        echo "}";
        echo "</script>";
        exit();
    }

    // Get the condominium_id based on the selected condominium name
    $condo_query = "SELECT id FROM condominiums WHERE name = ?";
    $stmt_condo = $mysqli->prepare($condo_query);
    $stmt_condo->bind_param("s", $condominium);
    $stmt_condo->execute();
    $stmt_condo->bind_result($condo_id);
    $stmt_condo->fetch();
    $stmt_condo->close();

    // Insert into users table
    $insert_query = "INSERT INTO users (account_number, username, email, password, condominium_id, suspended, role, dashboard_url) VALUES (?, ?, ?, ?, ?, 0, ?, ?)";
    $stmt = $mysqli->prepare($insert_query);

    // Generate dashboard_url based on the role
    $dashboard_url = ($role === 'Tenant') ? 'casa_bougainvilla/tenant_dashboard/tenant_dashboard.php' : '';

    // Bind parameters
    $stmt->bind_param("ssssiss", $accountNumber, $name, $email, $password, $condo_id, $role, $dashboard_url);
    $stmt->execute();

    // Check for success
    if ($stmt->errno === 0) {
        $_SESSION['success'] = 'Tenant added successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Added Tenant: $name");

        // Send suspension notice via email
        $roleSession = $_SESSION['role'];
        $emailSession = $_SESSION['email'];
        $temporaryPassword = $_POST['password'];
        $username = $_SESSION['username'];
        $to = $email; 
        $subject = "Your Account has been Activated for $condominium";
        $account_details = "================\n• Account Number: $accountNumber\n• Username: $name\n• Email: $email\n• Password: $temporaryPassword\n• Role: $role\n================\n";
        $message = "Dear Mr./Ms. $name,\n\nYour account has been activated for $condominium condominium.  Here are the following details: \n\n$account_details\nFor the security of your account, we recommend changing your password immediately by clicking the 'Forgot Password?' link at the Login Page.\n\nIf you have any questions or concerns, please don't hesitate to reach us at:\n$emailSession\n\nRegards, \n$username\n$roleSession of Casa Bougainvilla";
        $headers = 'From: adm1nplk2022@yahoo.com'; 
                
        // Send suspension notice via email
        $emailSent = mail($to, $subject, $message, $headers);
                
        if ($emailSent) {
            // Email sent successfully
            $_SESSION['success'] .= ' Email sent successfully.';
        } else {
            // Email not sent
            $_SESSION['error'] = 'Error sending email.';
        }
    } else {
        $_SESSION['error'] = 'Error adding Tenant: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: resident_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Tenant</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
        
        html,body{
            font-family: 'Poppins', sans-serif;
        }
        ::selection{
            color: #fff;
            background: #084cb4;
        }
        .container{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .container .form{
            background: #fff;
            padding: 30px 35px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        .container .form form .form-control{
            height: 40px;
            font-size: 15px;
        }
        .container .form form .forget-pass{
            margin: -15px 0 15px 0;
        }
        .container .form form .forget-pass a{
        font-size: 15px;
        }
        .container .form form .button{
            background: #084cb4;
            color: #fff;
            font-size: 17px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .container .form form .button:hover{
            background: #084cb4;
        }
        .container .form form .link{
            padding: 5px 0;
        }
        .container .form form .link a{
            color: #084cb4;
        }
        .container .login-form form p{
            font-size: 14px;
        }
        .container .row .alert{
            font-size: 14px;
        }
        /* Add this to your existing CSS or create a new style block */
        .form-group.departure-label {
            display: none;
        }
    </style>
</head>

<body>
    <!-- Sidebar Import -->
    <?php include "../../includes/sidebars/resident_sidebar.php" ?>
    <!-- import prompt styles -->
    <?php include "../../includes/sidebars/resident_sidebar_prompt.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="add_tenant.php" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Add Tenant</h2><br>

                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="username"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Re-enter Password:</label>
                        <input type="password" class="form-control" placeholder="Re-enter Password"
                            name="confirm_password" autocomplete="off" required>
                    </div><br>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="add_submit"
                                value="Submit"></button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>