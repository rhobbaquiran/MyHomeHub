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
    $person_of_contact = $row['person_of_contact'];
} else {
    $_SESSION['error'] = 'No data found for the given condominium ID.';
    header("Location: community_inventory.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and remove whitespaces
    $item_name = trim($_POST['item']);
    $quantity = trim($_POST['quantity']);

    // Retrieve email from the users table based on the item's contact person
    $person_of_contact_username = $row['person_of_contact'];
    $email_query = "SELECT email FROM users WHERE username = ?";
    $stmt_email = $mysqli->prepare($email_query);
    $stmt_email->bind_param("s", $person_of_contact_username);
    $stmt_email->execute();
    $result_email = $stmt_email->get_result();

    // Check if the email retrieval was successful
    if ($result_email->num_rows == 1) {
        $email_row = $result_email->fetch_assoc();
        $to = $email_row['email']; // Use the retrieved email for the 'to' field
    } else {
        // Handle the case where the email couldn't be retrieved
        $_SESSION['error'] = 'Error retrieving email for item contact person: ' . $stmt_email->error;
        header("Location: community_inventory.php");
        exit();
    }

    $stmt_email->close();

    // Send email notification
    $username = $_SESSION['username'];
    $subject = 'Item Request Notification';
    $message = "Dear Mr./Ms. $person_of_contact_username,\n\nYou have received a request for the item: $item_name. Quantity: $quantity\n\n\nFrom,\n$username";
    $headers = 'From: adm1nplk2022@yahoo.com';

    // Use mail() function to send the email
    if (mail($to, $subject, $message, $headers)) {
        $_SESSION['success'] = 'Item request notification sent successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Requested an Item: $item_name and Quantity: $quantity");
    } else {
        // Handle the case where the email couldn't be sent
        $_SESSION['error'] = 'Failed to send item request notification email.';
    }

    header("Location: community_inventory.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Request Item</title>
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
                <form action="request_item_inventory.php" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Request an Item</h2><br>

                    <div class="form-group">
                        <label for="item">Item:</label>
                        <select class="form-control" name="item" required>
                            <?php
                            // Query to fetch available items
                            $query = "SELECT item_name FROM inventory WHERE condominium_id = ?";
                            $stmt = $mysqli->prepare($query);
                            $stmt->bind_param("i", $_SESSION['condominium_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Populate the dropdown with available items
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['item_name'] . "'>" . $row['item_name'] . "</option>";
                            }
                            $stmt->close();
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" placeholder="Enter Quantity" name="quantity" autocomplete="off" required>
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