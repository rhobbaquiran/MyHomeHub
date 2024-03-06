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

if (!isset($_GET['resolveid']) || empty($_GET['resolveid'])) {
    header("Location: resolve_repair_request.php");
    exit();
}

// To get person of contact
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
    $condominium_id = $row['id'];
    
} else {
    $_SESSION['error'] = 'No data found for the given condominium ID';
    header("Location: repair_request.php");
    exit();
}

// Retrieve title from the database based on the resolve id
$resolve_id = $_GET['resolveid'];
$sql = "SELECT heading, service_ticket.username, service_ticket.condominium_id, users.username AS resident_username 
        FROM service_ticket 
        LEFT JOIN users ON service_ticket.username = users.username
        WHERE ticket_number = ?";
$stmt_title = $mysqli->prepare($sql);
$stmt_title->bind_param("i", $resolve_id);
$stmt_title->execute();
$stmt_title->bind_result($heading, $resident_username, $condominium_id, $resident_username);
$stmt_title->fetch();
$stmt_title->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resolve_confirmation = trim($_POST['resolve_confirmation']);

    // Get the condominium_id based on the selected condominium name
    $condo_query = "SELECT id FROM condominiums WHERE name = ?";
    $stmt_condo = $mysqli->prepare($condo_query);
    $stmt_condo->bind_param("s", $condominium);
    $stmt_condo->execute();
    $stmt_condo->bind_result($condo_id);
    $stmt_condo->fetch();
    $stmt_condo->close();

    // To get condominium name
    $query_condo_name = "SELECT name FROM condominiums WHERE id = ?";
    $stmt_condo_name = $mysqli->prepare($query_condo_name);
    $stmt_condo_name->bind_param("i", $condominium_id);
    $stmt_condo_name->execute();
    $result_condo_name = $stmt_condo_name->get_result();

    if ($result_condo_name->num_rows == 1) {
        $condo_row = $result_condo_name->fetch_assoc();
        $condominium_name = $condo_row['name'];
    } else {
        $_SESSION['error'] = 'Error retrieving condominium name.';
        // handle error as per your application logic
    }

    $stmt_condo_name->close();

    // To update the repair status
    $update_query = "UPDATE service_ticket SET status=1, date_finished=CURRENT_TIMESTAMP,  resolve_confirmation=? WHERE ticket_number=?";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameters
    $stmt->bind_param("si", $resolve_confirmation, $resolve_id);

    // Execute the query
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Request resolved successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Resolved a request: $heading");

        // Retrieve person of contact's email
        $email_query = "SELECT email FROM users WHERE username = (SELECT person_of_contact FROM condominiums WHERE id = ?)";
        $stmt_email = $mysqli->prepare($email_query);
        $stmt_email->bind_param("i", $condominium_id);
        $stmt_email->execute();
        $result_email = $stmt_email->get_result();

        if ($result_email->num_rows == 1) {
            $email_row = $result_email->fetch_assoc();
            $to = $email_row['email']; // Use the retrieved email for the 'to' field

            // Compose email notification message
            $username = $_SESSION['username'];
            $resolve_confirmation = trim($_POST['resolve_confirmation']);
            $subject = 'Repair Request Resolved Notification';
            $message = "Dear Mr./Ms. $resident_username,\n\nYour repair request titled '$heading' has been resolved with the following confirmation:\n\n$resolve_confirmation\n\n\nFrom,\n$person_of_contact_username\nAdministrator of $condominium_name";
            $headers = 'From:  adm1nplk2022@yahoo.com';

            // Send email notification
            if (mail($to, $subject, $message, $headers)) {
                $_SESSION['success'] = 'Request resolved successfully. Email notification sent.';
            } else {
                $_SESSION['error'] = 'Error sending email notification.';
            }
        } else {
            $_SESSION['error'] = 'Error retrieving email for person of contact.';
        }
    } else {
        $_SESSION['error'] = 'Error resolving a request: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: repair_request.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Resolve Request</title>
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
    <?php include "../../includes/sidebars/administrator_sidebar.php" ?>
    <!-- import prompt styles -->
    <?php include "../../includes/sidebars/administrator_sidebar_prompt.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="resolve_repair_request.php?resolveid=<?php echo $_GET['resolveid']; ?>" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Resolve Repair Request</h2><br>

                    <!-- Display the title retrieved from URL parameters -->
                    <h2 class="text-center">Title: <?php echo  $heading; ?></h2><br>

                    <div class="form-group">
                        <label for="resolve_confirmation">Resolve Confirmation:</label>
                        <textarea class="form-control" placeholder="Enter Resolve Confirmation" name="resolve_confirmation" autocomplete="off" required></textarea>
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