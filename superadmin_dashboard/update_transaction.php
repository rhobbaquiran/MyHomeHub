<?php
session_start();
include('../includes/database.php');

// Function to log activity
function logActivity($user, $action, $condoName = null, $billNumber = null)
{
    global $mysqli;

    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id) VALUES (CURRENT_TIMESTAMP, ?, ?, NULL)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

// Check if the updateid parameter is set
if (!isset($_GET['updateid']) || empty($_GET['updateid'])) {
    header("Location: transactions.php");
    exit();
}

// Process Form Data if Submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and remove whitespaces
    $updateId = $_POST['update_id'];
    $billingPeriodStart = trim($_POST['billing_period_start']);
    $billingPeriodEnd = trim($_POST['billing_period_end']);
    $dueDate = trim($_POST['due_date']);
    $totalAmountDue = trim($_POST['total_amount_due']);
    $status = trim($_POST['status']);
    $selectedAdmin = trim($_POST['selected_admin']);
    $billNumber = trim($_POST['bill_number']);

    // Extract account number and condominium name from the selected administrator
    list($selectedAdminAccount, $condoName) = explode("-", $selectedAdmin);

    // Update the admin_transactions table
    $update_query = "UPDATE admin_transactions SET billing_period_start=?, billing_period_end=?, due_date=?, total_amount_due=?, status=?, account_number=?, condominium=?, bill_number=? WHERE id=?";
    $stmt = $mysqli->prepare($update_query);

    // Check if the prepare statement succeeded
    if ($stmt === false) {
        die('Error preparing update statement: ' . $mysqli->error);
    }

    // Bind parameters
    $stmt->bind_param("ssssssssi", $billingPeriodStart, $billingPeriodEnd, $dueDate, $totalAmountDue, $status, $selectedAdminAccount, $condoName, $billNumber, $updateId);

    // Check if the bind_param succeeded
    if ($stmt === false) {
        die('Error binding parameters for update statement: ' . $stmt->error);
    }

    // Execute the query
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) 
    {
        // Log the activity
        logActivity($_SESSION['username'], "Updated transaction of $condoName with Bill Number: $billNumber", $condoName, $billNumber);

        // Update status in payments based on conditions
        $paymentStatus = ($status == 'Pending') ? 'Unverified' : 'Verified';
        $update_query_payments = "UPDATE payments SET status = ? WHERE bill_number = ?";
        $stmt_update_payments = $mysqli->prepare($update_query_payments);
        $stmt_update_payments->bind_param("ss", $paymentStatus, $billNumber);
        $stmt_update_payments->execute();
        $stmt_update_payments->close();

        if ($paymentStatus == 'Verified')
        {
            // Send payment confirmation email
            $email_query = "SELECT users.email FROM users 
            INNER JOIN payments ON users.username = payments.username 
            WHERE payments.bill_number = ?";
        
            $stmt_email = $mysqli->prepare($email_query);
            $stmt_email->bind_param("s", $billNumber);
            $stmt_email->execute();
            $stmt_email_result = $stmt_email->get_result();

            if ($stmt_email_result->num_rows > 0) 
            {
                $email_row = $stmt_email_result->fetch_assoc();
                $userEmail = $email_row['email'];
                $email = $_SESSION['email'];

                $billing_details = "================\n• Account Number: $selectedAdminAccount\n• Bill Number: $billNumber\n• Billing Period: $billingPeriodStart to $billingPeriodEnd\n• Total Amount Due: ₱ $totalAmountDue\n• Due Date: $dueDate\n• Payment Status: $paymentStatus\n================\n";
                $to = $userEmail;
                $subject = "Payment $paymentStatus for Bill $billNumber";
                $message = "Dear $condoName,\n\nYour payment for Bill Number: $billNumber has been $paymentStatus.\n\nThank you.\n\nRegards, \nMyHomeHub Team";
                $message = "Dear $condoName,\nThe Payment for Bill $billNumber has been $paymentStatus. Here are your Bill details:\n\n$billing_details\nIf you have any questions or concerns, please don't hesitate to reach us at:\n$email\n\nRegards, \nMyHomeHub Team";
                $headers = "From: adm1nplk2022@yahoo.com";

                // Use the mail() function to send the email
                mail($to, $subject, $message, $headers);
            }

            $stmt_email->close();
        }
    } 
    else 
    {
        $_SESSION['error'] = 'Error updating transaction: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: transactions.php");
    exit();
}

// Retrieve existing transaction information for updating
$updateId = $_GET['updateid'];
$select_query = "SELECT * FROM admin_transactions WHERE id = ?";
$stmt_select = $mysqli->prepare($select_query);
$stmt_select->bind_param("i", $updateId);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

// Check if transaction exists
if ($result_select->num_rows != 1) {
    header("Location: transactions.php");
    exit();
}

$row = $result_select->fetch_assoc();
$billingPeriodStart = $row['billing_period_start'];
$billingPeriodEnd = $row['billing_period_end'];
$dueDate = $row['due_date'];
$totalAmountDue = $row['total_amount_due'];
$status = $row['status'];
$selectedAdminAccount = $row['account_number'];
$condoName = $row['condominium'];
$billNumber = $row['bill_number'];

$stmt_select->close();

// Get the list of administrators and their associated condominiums
$adminCondoQuery = "SELECT users.account_number, users.username, condominiums.name 
                   FROM users 
                   INNER JOIN condominiums ON users.condominium_id = condominiums.id 
                   WHERE users.role = 'Administrator'";
$adminCondoResult = $mysqli->query($adminCondoQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Bill</title>
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
                <form action="update_transaction.php?updateid=<?php echo $updateId; ?>" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Update Bill</h2><br>

                    <input type="hidden" name="update_id" value="<?php echo $updateId; ?>">
                    <input type="hidden" name="bill_number" value="<?php echo $billNumber; ?>"> <!-- Add this line to include the bill number in the form -->

                    <div class="form-group">
                        <label for="selected_admin">Select Administrator:</label>
                        <select class="form-control" name="selected_admin" required>
                            <?php
                            // Populate dropdown list with administrators and their condominiums
                            while ($row = $adminCondoResult->fetch_assoc()) {
                                $adminAccount = $row['account_number'];
                                $adminUsername = $row['username'];
                                $condoNameOption = $row['name'];
                                $selected = ($adminAccount == $selectedAdminAccount && $condoNameOption == $condoName) ? 'selected' : '';
                                echo "<option value=\"$adminAccount-$condoNameOption\" $selected>$adminUsername - $condoNameOption</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="billing_period_start">Billing Period Start:</label>
                        <input type="date" class="form-control" name="billing_period_start" value="<?php echo $billingPeriodStart; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="billing_period_end">Billing Period End:</label>
                        <input type="date" class="form-control" name="billing_period_end" value="<?php echo $billingPeriodEnd; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="due_date">Due Date:</label>
                        <input type="date" class="form-control" name="due_date" value="<?php echo $dueDate; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="total_amount_due">Total Amount Due:</label>
                        <input type="text" class="form-control" placeholder="Enter Total Amount Due" name="total_amount_due" value="<?php echo $totalAmountDue; ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" required>
                            <option value="Pending" <?php echo ($status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Paid" <?php echo ($status == 'Paid') ? 'selected' : ''; ?>>Paid</option>
                        </select>
                    </div><br>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="update_submit" value="Update"></button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>