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
    // Get form data
    $name = $_POST['visitor_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $arrival_time = $_POST['arrival_time'];
    $departure_time = $_POST['departure_time'];
    $purpose = $_POST['purpose'];

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
    header("Location: ../front_desk_dashboard.php");
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Visitor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../includes/style.css">

    <style>
        /* Add this to your existing CSS or create a new style block */
        .form-group.departure-label {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="add.php" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Add Visitor</h2>

                    <div class="form-group">
                        <label for="username">Visitor Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Visitor Name" name="visitor_name" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="number" class="form-control" placeholder="Enter Phone Number:" name="phone_number" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" placeholder="Enter Email:" name="email" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Arrival Time:</label>
                        <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" required>
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
                        <center><input type="submit" class="form-control button" name="add_submit" value="Submit"></button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>