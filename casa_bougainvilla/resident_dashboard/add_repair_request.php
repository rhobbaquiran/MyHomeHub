<?php
session_start();
include('../../includes/database.php');

// Redirect if the user is not logged in or has an invalid session
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action)
{
    global $mysqli;
    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id) VALUES (CURRENT_TIMESTAMP, ?, ?, 1)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

// Fetch data
$query = "SELECT condominiums.id, condominiums.person_of_contact FROM condominiums
            LEFT JOIN users
            ON condominiums.person_of_contact = users.username
            WHERE condominiums.id = ?";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $_SESSION['condominium_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $person_of_contact_username = $row['person_of_contact'];
} else {
    $_SESSION['error'] = 'No data found for the given condominium ID';
    header("Location: repair_request.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $heading = trim($_POST['heading']);
    $description = trim($_POST['description']);

    // To get the condominium_id based on the selected condominium name
    $condo_query = "SELECT id FROM condominiums WHERE name = ?";
    $stmt_condo = $mysqli->prepare($condo_query);
    $stmt_condo->bind_param("s", $condominium);
    $stmt_condo->execute();
    $stmt_condo->bind_result($condo_id);
    $stmt_condo->fetch();
    $stmt_condo->close();

    // To fetch unit_number based on username
    $unit_query = "SELECT unit_number FROM units WHERE resident_id = ?";
    $stmt_unit = $mysqli->prepare($unit_query);
    $stmt_unit->bind_param("s", $_SESSION['username']);
    $stmt_unit->execute();
    $stmt_unit->bind_result($target_unit);
    $stmt_unit->fetch();
    $stmt_unit->close();

    // Insert into service_ticket table
    $insert_query = "INSERT INTO service_ticket (condominium_id, target_unit, username, date_issued, heading, description, status)
    VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?, ?, 0)";
    $stmt = $mysqli->prepare($insert_query);

    // To bind parameters
    $stmt->bind_param("iisss", $_SESSION['condominium_id'], $target_unit, $_SESSION['username'], $heading, $description);
    $stmt->execute();

    // Check for success
    if ($stmt->errno === 0) {
        $_SESSION['success'] = 'Request submitted successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Submitted a repair request: $heading");

        // To retrieve email of person of contact
        $email_query = "SELECT email FROM users WHERE username = ?";
        $stmt_email = $mysqli->prepare($email_query);
        $stmt_email->bind_param("s", $person_of_contact_username);
        $stmt_email->execute();
        $result_email = $stmt_email->get_result();


        if ($result_email->num_rows == 1) {
            $email_row = $result_email->fetch_assoc();
            $to = $email_row['email']; // Use the retrieved email for the 'to' field
            $username = $_SESSION['username'];
            $subject = 'Repair Request Notification';
            $message = "Dear Mr./Ms. $person_of_contact_username,\n\nYou have received a repair request with the following details:\n\nTitle: $heading\n\nDescription:\n$description\n\n\nFrom,\n$username\nResident of Casa Bougainvilla";
            $headers = 'From: adm1nplk2022@yahoo.com'; // Change this to your email address or the email address you want to send from

            // Use mail() function to send the email
            if (mail($to, $subject, $message, $headers)) {
                $_SESSION['success'] .= ' Email notification sent successfully.';
            } else {
                $_SESSION['error'] = 'Failed to send repair request notification email.';
            }
        } else {
            // Handle the case where the email couldn't be retrieved
            $_SESSION['error'] = 'Error retrieving email for person of contact: ' . $stmt_email->error;
        }
    } else {
        $_SESSION['error'] = 'Error submitting a request: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: repair_request.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Request</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

        html,
        body {
            font-family: 'Poppins', sans-serif;
        }

        ::selection {
            color: #fff;
            background: #084cb4;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .container .form {
            background: #fff;
            padding: 30px 35px;
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .container .form form .form-control {
            height: 40px;
            font-size: 15px;
        }

        .container .form form .forget-pass {
            margin: -15px 0 15px 0;
        }

        .container .form form .forget-pass a {
            font-size: 15px;
        }

        .container .form form .button {
            background: #084cb4;
            color: #fff;
            font-size: 17px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .container .form form .button:hover {
            background: #084cb4;
        }

        .container .form form .link {
            padding: 5px 0;
        }

        .container .form form .link a {
            color: #084cb4;
        }

        .container .login-form form p {
            font-size: 14px;
        }

        .container .row .alert {
            font-size: 14px;
        }

        /* Add this to your existing CSS or create a new style block */
        .form-group.departure-label {
            display: none;
        }

        .container .form form .form-group textarea {
            width: 100%;
            height: 150px;
            font-size: 15px;
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
                <form action="add_repair_request.php" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Add Request</h2><br>

                    <div class="form-group">
                        <label for="heading">Title:</label>
                        <input type="text" class="form-control" placeholder="Enter Title" name="heading" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea class="form-control" placeholder="Enter Description" name="description" autocomplete="off" required></textarea>
                    </div><br>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="add_submit" value="Submit"></button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>