<?php
session_start();
include('../includes/database.php');

// Redirect if the user is not logged in or has an invalid session
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action, $condoName = null)
{
    global $mysqli;
    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id) VALUES (CURRENT_TIMESTAMP, ?, ?, NULL)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

function generateUniqueNumber($column, $table)
{
    global $mysqli;

    $maxAttempts = 10;

    for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
        $uniqueNumber = mt_rand(1000000000, 2147483646);

        // Check if the generated number already exists
        $check_query = "SELECT COUNT(*) FROM $table WHERE $column = ?";
        $stmt_check = $mysqli->prepare($check_query);
        $stmt_check->bind_param("s", $uniqueNumber);
        $stmt_check->execute();
        $stmt_check->bind_result($count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($count == 0) {
            // The generated number is unique
            return $uniqueNumber;
        }
    }

    // If after maxAttempts we couldn't find a unique number, return null
    return null;
}

// Get the list of administrators and their associated condominiums
$adminCondoQuery = "SELECT users.account_number, users.username, users.email, condominiums.name 
                   FROM users 
                   INNER JOIN condominiums ON users.condominium_id = condominiums.id 
                   WHERE users.role = 'Administrator'";
$adminCondoResult = $mysqli->query($adminCondoQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and remove whitespaces
    $billingPeriodStart = $_POST['billing_period_start'];
    $totalAmountDue = trim($_POST['total_amount_due']);
    $status = trim($_POST['status']);
    $selectedAdmin = $_POST['selected_admin'];

    // Extract account number and condominium name from the selected administrator
    list($selectedAdminAccount, $condoName) = explode("-", $selectedAdmin);

    // Retrieve the administrator's email address
    $adminEmailQuery = "SELECT email, username FROM users WHERE account_number = ?";
    $stmtAdminEmail = $mysqli->prepare($adminEmailQuery);
    $stmtAdminEmail->bind_param("s", $selectedAdminAccount);
    $stmtAdminEmail->execute();
    $stmtAdminEmail->bind_result($adminEmail, $adminUsername);
    $stmtAdminEmail->fetch();
    $stmtAdminEmail->close();

    // Use while loop to generate 12 monthly bills
    $currentDate = new DateTime($billingPeriodStart);
    for ($i = 0; $i < 12; $i++) {
        $billingPeriodEnd = $currentDate->format('Y-m-t');
        $dueDate = date('Y-m-d', strtotime('+10 days', strtotime($billingPeriodEnd))); // Due date is set to 10 days after the end of billing period

        // Generate unique bill number
        $billNumber = generateUniqueNumber("bill_number", "admin_transactions");

        // Insert into admin_transactions table
        $insert_query = "INSERT INTO admin_transactions (bill_number, account_number, billing_period_start, billing_period_end, due_date, total_amount_due, status, is_deleted, condominium) VALUES (?, ?, ?, ?, ?, ?, ?, 0, ?)";
        $stmt = $mysqli->prepare($insert_query);

        // Bind parameters
        $stmt->bind_param("ssssssss", $billNumber, $selectedAdminAccount, $billingPeriodStart, $billingPeriodEnd, $dueDate, $totalAmountDue, $status, $condoName);

        // Execute the statement
        $stmt->execute();

        // Increment to next month
        $currentDate->modify('+1 month');
        $billingPeriodStart = $currentDate->format('Y-m-01');
    }

    // Send email to the administrator
    $to = $adminEmail;
    $emailSubject = "12 Monthly Bills Notification";
    $emailBody = "Dear Mr./Ms. $adminUsername,\n\nYou have received 12 monthly bills for the condominium $condoName.";
    $headers = "From: adm1nplk2022@yahoo.com"; // Update with your email address
    mail($adminEmail, $emailSubject, $emailBody, $headers);

    // Check for success
    $_SESSION['success'] = '12 Monthly Bills generated successfully.';
    // Log the activity
    logActivity($_SESSION['username'], "Added 12 monthly bills for $condoName", $condoName);

    $stmt->close();
    header("Location: transactions.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Bill</title>
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
    <?php include "../includes/sidebars/superadmin_sidebar.php" ?>
    <!-- import prompt styles -->
    <?php include "../includes/sidebars/superadmin_sidebar_prompts.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="add_transaction.php" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Add Bill</h2><br>

                    <div class="form-group">
                        <label for="selected_admin">Select Administrator:</label>
                        <select class="form-control" name="selected_admin" required>
                            <?php
                            // Populate dropdown list with administrators and their condominiums
                            while ($row = $adminCondoResult->fetch_assoc()) {
                                $adminAccount = $row['account_number'];
                                $adminUsername = $row['username'];
                                $condoName = $row['name'];
                                echo "<option value=\"$adminAccount-$condoName\">$adminUsername - $condoName</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="billing_period_start">Billing Period Start:</label>
                        <input type="date" class="form-control" name="billing_period_start" required>
                    </div>

                    <div class="form-group">
                        <label for="billing_period_end">Billing Period End:</label>
                        <input type="date" class="form-control" name="billing_period_end" required>
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" class="form-control" name="due_date" required>
                    </div>

                    <div class="form-group">
                        <label for="total_amount_due">Total Amount Due:</label>
                        <input type="text" class="form-control" placeholder="Enter Total Amount Due" name="total_amount_due" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                        </select>
                    </div>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="add_submit" value="Submit"></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>