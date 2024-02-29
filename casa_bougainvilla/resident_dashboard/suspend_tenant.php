<?php
session_start();
include('../../includes/database.php');

// Redirect if the user is not logged in or has an invalid session
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Check if the suspendid is set
if (!isset($_GET['suspendid']) || empty($_GET['suspendid'])) {
    header("Location: resident_dashboard.php");
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

//Retrieve existing user information for updating
$suspend_id = $_GET['suspendid'];
$select_query = "SELECT * FROM users WHERE id = ?";
$stmt_select = $mysqli->prepare($select_query);
$stmt_select->bind_param("i", $suspend_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

// Check if the administrator exists
if ($result_select->num_rows != 1) {
    header("Location: resident_dashboard.php");
    exit();
}

$row = $result_select->fetch_assoc();
$name = $row['username'];
$suspend_reason = $row['suspension_reason'];

$stmt_select->close();

// Process form data if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and remove whitespaces
    $suspend_id = $_POST['suspend_id'];

    // Check if 'suspend_reason' key is set in the $_POST array
    $reason_suspend = isset($_POST['suspend_reason']) ? $_POST['suspend_reason'] : '';
    $reason_other = trim($_POST['other_reason']);

    // To determine suspension reason based on user's choice
    if ($reason_suspend == "Non-Payment of Fees" && isset($_POST['month'])) {
        $selected_month = $_POST['month'];
        $chosen_reason = "Non-Payment of Fees for the Month of $selected_month";
    } else {
        $chosen_reason = ($reason_suspend == "Others") ? $reason_other : $reason_suspend;
    }

    // Check if a radio button is selected
    if (empty($reason_suspend) || ($reason_suspend == "Non-Payment of Fees" && empty($selected_month)) || ($reason_suspend == "Others" && empty($reason_other))) {
        $error_message = "Please select a suspension reason.";
    } else {
        // Update condominium record
        $update_query = "UPDATE users SET suspended = 1, suspension_reason = ?, suspend_timestamp = CURRENT_TIMESTAMP WHERE id = ?";
        $stmt_update = $mysqli->prepare($update_query);
        $stmt_update->bind_param("si", $chosen_reason, $suspend_id);
        $stmt_update->execute();

        // Check for success
        if ($stmt_update->affected_rows > 0) {
            $_SESSION['success'] = 'Tenant suspended successfully.';
            // Log the activity
            logActivity($_SESSION['username'], "Suspended Tenant: $name. Reason: $chosen_reason", $suspend_id);

            // Send suspension notice via email
            $email = $_SESSION['email'];
            $username = $_SESSION['username'];
            $role = $_SESSION['role'];
            $to = $row['email']; 
            $subject = 'Account Suspension Notice';
            $message = "Dear Mr./Ms. $name,\n\nYour account has been suspended due to $chosen_reason.\n\nIf you have any questions or concerns, please don't hesitate to reach us at:\n$email\n\nRegards, \n$username\n$role of Casa Bougainvilla";
            $headers = 'From: adm1nplk2022@yahoo.com'; 
                                    
            // Use mail() function to send the email
            mail($to, $subject, $message, $headers);
        } else {
            $_SESSION['error'] = 'Error Suspending Tenant: ' . $stmt_update->error;
        }

        $stmt_update->close();

        // Redirect back to the administrator_dashboard page
        header("Location: resident_dashboard.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Suspend Tenant</title>
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

        .form-group input[type="radio"] {
            margin-bottom: 10px;
        }

        .form-group textarea {
            margin-top: 10px;
            width: 100%;
            box-sizing: border-box;
            display: none;
            /* Initially hide the textarea */
        }

        /* New styles for the administrator form */
        .month-select {
            display: inline-block;
            margin-left: 10px;
        }

        .radio-group label {
            margin-right: 10px;
        }

        /* Adjusted styles for consistency */
        .form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
        }

        .form-group input[type="radio"],
        .form-group textarea,
        .form-group select {
            margin-top: 5px;
        }

        .error {
            color: #ff0000;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        .button {
            width: 150px;
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
            <div class="col-md-6 offset-md-3 form">
                <form action="suspend_tenant.php?suspendid=<?php echo $suspend_id; ?>" method="post"
                    enctype="multipart/form-data">

                    <h2 class="text-center">Suspend Tenant</h2><br>

                    <input type="hidden" name="suspend_id" value="<?php echo $suspend_id; ?>">

                    <div class="form-group">
                        <label>Select Suspension Reason:</label>
                        <input type="radio" name="suspend_reason" value="Breach of Contract"> Breach of Contract<br>
                        <input type="radio" name="suspend_reason" value="Termination of Contract"> Termination of
                        Contract<br>
                        <input type="radio" name="suspend_reason" value="Expired Contract"> Expired Contract<br>

                        <input type="radio" name="suspend_reason" value="Non-Payment of Fees"> Non-Payment of Fees for
                        the Month of:


                        <select name="month">
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>


                        <br><input type="radio" name="suspend_reason" value="Others"> Others
                        <textarea name="other_reason" rows="4" cols="50"></textarea><br>
                    </div>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'><font color='#ff0000'>$error_message</font></p>";
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var radioButtons = document.querySelectorAll('input[name="suspend_reason"]');
            var othersTextarea = document.querySelector('textarea[name="other_reason"]');

            function updateTextareaVisibility() {
                othersTextarea.style.display = (radioButtons[4].checked) ? 'block' : 'none';
            }

            radioButtons.forEach(function (radioButton) {
                radioButton.addEventListener('change', updateTextareaVisibility);
            });

            updateTextareaVisibility();
        });
    </script>
</body>

</html>