<?php
session_start();

include('../includes/database.php');

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Super Administrator') {
    header("Location: ../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action)
{
    global $mysqli;

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $insert_query = "INSERT INTO activity_logs (timestamp, user, action) VALUES (CURRENT_TIMESTAMP, ?, ?)";
    $stmt = $mysqli->prepare($insert_query);

    if (!$stmt) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();

    if ($stmt->error) {
        die("Error executing statement: " . $stmt->error);
    }

    $stmt->close();
}

if (isset($_GET['updateid'])) {
    $update_id = $_GET['updateid'];

    $select_query = "SELECT id, timestamp, username, bill_number, screenshot, status, rejection_reason FROM payments WHERE id = ?";
    $stmt_select = $mysqli->prepare($select_query);
    $stmt_select->bind_param("i", $update_id);
    $stmt_select->execute();
    $stmt_select->bind_result($id, $timestamp, $username, $bill_number, $screenshot, $status, $rejection_reason);

    if ($stmt_select->fetch()) {
        $stmt_select->close();
    } else {
        header("Location: proof_of_payments.php");
        exit();
    }
} else {
    header("Location: proof_of_payments.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_status = ($_POST['new_status'] === 'Rejected') ? 'Rejected' : $_POST['new_status'];

    if ($new_status === 'Rejected' && empty($_POST['rejection_reason'])) {
        header("Location: update_proof_of_payments.php?updateid=$update_id&error=empty_rejection_reason");
        exit();
    }

    $rejection_reason = ($new_status === 'Rejected') ? $_POST['rejection_reason'] : NULL;

    $update_query_payments = "UPDATE payments SET status = ?, rejection_reason = ? WHERE id = ?";
    $stmt_update_payments = $mysqli->prepare($update_query_payments);
    $stmt_update_payments->bind_param("ssi", $new_status, $rejection_reason, $update_id);
    $stmt_update_payments->execute();
    $stmt_update_payments->close();

    $admin_status = ($new_status === 'Verified') ? 'Paid' : 'Pending';
    $update_query_admin = "UPDATE admin_transactions SET status = ? WHERE bill_number = ?";
    $stmt_update_admin = $mysqli->prepare($update_query_admin);
    $stmt_update_admin->bind_param("ss", $admin_status, $bill_number);
    $stmt_update_admin->execute();
    $stmt_update_admin->close();

    // Log the activity for the payment status update
    logActivity($_SESSION['username'], "Updated Payment Status: Bill Number $bill_number, New Status: $new_status");

    // Retrieve user email and username from the 'users' table
    $select_user_info_query = "SELECT email, username FROM users WHERE username = ?";
    $stmt_select_user_info = $mysqli->prepare($select_user_info_query);
    $stmt_select_user_info->bind_param("s", $username);
    $stmt_select_user_info->execute();
    $stmt_select_user_info->bind_result($user_email, $user_username);

    if ($new_status === 'Rejected' || $new_status === 'Verified')
    {
        if ($stmt_select_user_info->fetch()) 
        {
            $stmt_select_user_info->close();
            $email = $_SESSION['email'];

            // Retrieve billing information from the admin_transactions table
            $select_billing_info_query = "SELECT account_number, bill_number, billing_period_start, billing_period_end, due_date, total_amount_due FROM admin_transactions WHERE bill_number = $bill_number";
            $stmt_select_billing_info = $mysqli->prepare($select_billing_info_query);
            $stmt_select_billing_info->bind_param("ssssss", $account_number, $bill_number, $billing_period_start, $billing_period_end, $due_date, $total_amount_due);
            $stmt_select_billing_info->execute();
            $stmt_select_billing_info->bind_result($account_number, $bill_number, $billing_period_start, $billing_period_end, $due_date, $total_amount_due);

            if ($stmt_select_billing_info->fetch()) 
            {
                $stmt_select_billing_info->close();

                // Use billing information in the email message
                $billing_details = "================\n• Account Number: $account_number\n• Bill Number: $bill_number\n• Billing Period: $billing_period_start to $billing_period_end\n• Total Amount Due: ₱ $total_amount_due\n• Due Date: $due_date\n• Payment Status: $new_status\n================\n";

                // Build email message based on payment status
                $subject = "Payment $new_status for Bill $bill_number";

                if ($new_status === 'Rejected') 
                {
                    $message = "Dear Mr./Ms. $user_username,\nThe Payment for Bill $bill_number has been Rejected. The reason for rejection is $rejection_reason.\nTo avoid any service interruptions, We kindly request you to review your Bill and resubmit the Payment. Here are your Bill details:\n\n$billing_details\nIf you have any questions or concerns, please don't hesitate to reach us at:\n$email\n\nRegards, \nMyHomeHub Team";
                } 
                else if ($new_status === 'Verified') 
                {
                    $message = "Dear Mr./Ms. $user_username,\nThe Payment for Bill $bill_number has been $new_status. Here are your Bill details:\n\n$billing_details\nIf you have any questions or concerns, please don't hesitate to reach us at:\n$email\n\nRegards, \nMyHomeHub Team";
                }

                // Send email to the user
                $to = $user_email;
                //$from_email = $_SESSION['email']; // Assuming email is stored in the session
                //$headers = "From: $from_email";
                $headers = "From: adm1nplk2022@yahoo.com";

                mail($to, $subject, $message, $headers);
            }
        }
    }
    else 
    {
        // Redirect back to the proof_of_payments.php page after updating
        header("Location: proof_of_payments.php");
        exit();
    }

    // Redirect back to the proof_of_payments.php page after updating
    header("Location: proof_of_payments.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Payment Status</title>
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
                <form method="post" action="update_proof_of_payments.php?updateid=<?php echo $update_id; ?>">

                    <h2 class="text-center">Update<br>Payment Status</h2><br>

                    <input type="hidden" name="update_id" value="<?php echo $update_id; ?>">

                    <?php
                    // Display an error message if rejection reason is empty
                    if (isset($_GET['error']) && $_GET['error'] === 'empty_rejection_reason') {
                        echo '<div class="alert alert-danger">Please provide a rejection reason.</div>';
                    }
                    ?>

                    <div class="form-group">
                        <label>
                            <input type="radio" name="new_status" value="Rejected" id="rejectedRadio" <?php echo ($status === 'Rejected' || empty($status)) ? 'checked' : ''; ?>>
                            Rejected
                        </label>
                        <div id="rejectionReasonBox" style="<?php echo ($status === 'Rejected' || empty($status)) ? 'display: block;' : 'display: none;'; ?>">
                            <label for="rejectionReason">Rejection Reason:</label>
                            <textarea name="rejection_reason" id="rejectionReason" rows="4" cols="35"><?php echo $rejection_reason; ?></textarea>
                        </div><br>
                        <label>
                            <input type="radio" name="new_status" value="Unverified" <?php echo ($status === 'Unverified') ? 'checked' : ''; ?>>
                            Unverified
                        </label><br>
                        <label>
                            <input type="radio" name="new_status" value="Verified" <?php echo ($status === 'Verified') ? 'checked' : ''; ?>>
                            Verified
                        </label><br>
                    </div>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="update_submit" value="Update"></center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var rejectedRadio = document.getElementById("rejectedRadio");
            var rejectionReasonBox = document.getElementById("rejectionReasonBox");

            // Function to toggle the rejection reason box visibility
            function toggleRejectionReasonBox() {
                rejectionReasonBox.style.display = rejectedRadio.checked ? "block" : "none";
            }

            // Event listener for radio button changes
            rejectedRadio.addEventListener("change", toggleRejectionReasonBox);

            // Initial state
            toggleRejectionReasonBox();

            // Event listeners for other radio buttons
            var otherRadios = document.querySelectorAll('input[type="radio"][name="new_status"]:not(#rejectedRadio)');
            otherRadios.forEach(function(radio) {
                radio.addEventListener("change", function() {
                    rejectionReasonBox.style.display = "none";
                });
            });
        });
    </script>

</body>

</html>