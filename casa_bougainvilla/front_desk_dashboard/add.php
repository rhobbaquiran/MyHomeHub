<?php
session_start();
include('../../includes/database.php');

// Redirect if the user is not logged in or has an invalid session
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Check if the condominium is disabled
$query = "SELECT disabled FROM condominiums WHERE name='Casa Bougainvilla'";
$result = $mysqli->query($query);

if ($result && $result->num_rows == 1) {
    $condominium = $result->fetch_assoc();
    $condominium_disabled = $condominium['disabled'];

    // Redirect if the condominium is disabled and the user has a restricted role
    if ($condominium_disabled == 1 && in_array($_SESSION['role'], ['Resident', 'Front Desk', 'Administrator'])) {
        header("Location: ../../index.php");
        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and trim whitespaces
    $name = trim($_POST['visitor_name']);
    $phone_number = trim($_POST['phone_number']);
    $email = trim($_POST['email']);
    $arrival_time = trim($_POST['arrival_time']);
    $departure_time = trim($_POST['departure_time']);
    $purpose = trim($_POST['purpose']);

    // Insert into visitors table
    $insert_query = "INSERT INTO visitors (name, phone_number, email, arrival_time, departure_time, purpose, condominium_id) VALUES (?, ?, ?, ?, ?, ?, 1)";
    $stmt = $mysqli->prepare($insert_query);

    // Bind parameters
    $stmt->bind_param("ssssss", $name, $phone_number, $email, $arrival_time, $departure_time, $purpose);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Visitor added successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Added visitor: $name");
    } else {
        $_SESSION['error'] = 'Error adding visitor: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: front_desk_dashboard.php");
    exit();
}

// Function to log activity
function logActivity($user, $action)
{
    global $mysqli;

    $account_number = $_SESSION['account_number'];

    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP, ?, ?, 1, $account_number)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Visitor</title>
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
    <?php include "../../includes/sidebars/front_desk_sidebar.php" ?>
    <!-- import prompt styles -->
    <?php include "../../includes/sidebars/front_desk_sidebar_prompt.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="add.php" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Add Visitor</h2>

                    <div class="form-group">
                        <label for="username">Visitor Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Visitor Name" name="visitor_name"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="number" class="form-control" placeholder="Enter Phone Number:" name="phone_number"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Email:" name="email"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Arrival Time:</label>
                        <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time"
                            required>
                    </div>

                    <!-- Add the departure-label class to the div to hide the label -->
                    <div class="form-group departure-label">
                        <label>Departure Time:</label>
                        <!-- Set a default value for departure_time or use a timestamp from the server if needed -->
                        <input type="hidden" class="form-control" id="departure_time" name="departure_time" value="" />
                    </div>

                    <div class="form-group">
                        <label>Purpose:</label>
                        <textarea id="purpose" class="form-control" name="purpose" rows="4" required></textarea>
                    </div>

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