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

// Check if the updateid parameter is set
if (!isset($_GET['updateid']) || empty($_GET['updateid'])) {
    header("Location: front_desk_dashboard.php");
    exit();
}

// Process Form Data if Submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and trim whitespaces
    $update_id = $_POST['update_id'];
    $name = trim($_POST['visitor_name']);
    $phone_number = trim($_POST['phone_number']);
    $email = trim($_POST['email']);
    $arrival_time = trim($_POST['arrival_time']);
    $departure_time = trim($_POST['departure_time']);
    $purpose = trim($_POST['purpose']);

    // Update the record in the visitors table
    $update_query = "UPDATE visitors SET name=?, phone_number=?, email=?, arrival_time=?, departure_time=?, purpose=? WHERE id=? AND condominium_id=1";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameters
    $stmt->bind_param("ssssssi", $name, $phone_number, $email, $arrival_time, $departure_time, $purpose, $update_id);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Visitor updated successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Updated visitor: $name");
    } else {
        $_SESSION['error'] = 'Error updating visitor: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: front_desk_dashboard.php");
    exit();
}

// Retrieve existing visitor information for updating
$update_id = $_GET['updateid'];
$select_query = "SELECT * FROM visitors WHERE id = ? AND condominium_id=1";
$stmt_select = $mysqli->prepare($select_query);
$stmt_select->bind_param("i", $update_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

// Check if the visitor exists
if ($result_select->num_rows != 1) {
    header("Location: front_desk_dashboard.php");
    exit();
}

$row = $result_select->fetch_assoc();
$visitor_name = $row['name'];
$phone_number = $row['phone_number'];
$email = $row['email'];
$arrival_time = $row['arrival_time'];
$departure_time = $row['departure_time'];
$purpose = $row['purpose'];

$stmt_select->close();

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
    <title>Update Visitor</title>
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
                <form action="update.php?updateid=<?php echo $update_id; ?>" method="post"
                    enctype="multipart/form-data">

                    <h2 class="text-center">Update Visitor</h2>

                    <input type="hidden" name="update_id" value="<?php echo $update_id; ?>">

                    <div class="form-group">
                        <label for="username">Visitor Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Visitor Name" name="visitor_name"
                            value="<?php echo $visitor_name; ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="number" class="form-control" placeholder="Enter Phone Number:" name="phone_number"
                            value="<?php echo $phone_number; ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Email:" name="email"
                            value="<?php echo $email; ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Arrival Time:</label>
                        <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time"
                            value="<?php echo date('Y-m-d\TH:i', strtotime($arrival_time)); ?>" required>
                    </div>

                    <!-- Add the departure-label class to the div to hide the label -->
                    <div class="form-group">
                        <label>Departure Time:</label>
                        <input type="datetime-local" class="form-control" id="departure_time" name="departure_time"
                            value="<?php echo ($departure_time) ? date('Y-m-d\TH:i', strtotime($departure_time)) : ''; ?>" />
                    </div>

                    <div class="form-group">
                        <label>Purpose:</label>
                        <textarea id="purpose" class="form-control" name="purpose" rows="4"
                            required><?php echo $purpose; ?></textarea>
                    </div>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="update_submit"
                                value="Update"></button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>