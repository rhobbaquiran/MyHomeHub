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

    $account_number = $_SESSION['account_number'];

    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP, ?, ?, 1, $account_number)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

// Check if the updateid parameter is set in the URL
if (!isset($_GET['updateid']) || empty($_GET['updateid'])) {
    header("Location: units.php");
    exit();
}

$update_id = $_GET['updateid'];

// Fetch the existing details of the unit
$select_query = "SELECT unit_number, unit_status, tenant_id FROM units WHERE id = ?";
$stmt_select = $mysqli->prepare($select_query);
$stmt_select->bind_param("i", $update_id);
$stmt_select->execute();
$stmt_select->bind_result($unit_number, $unit_status, $resident_id);
$stmt_select->fetch();
$stmt_select->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get updated form data and remove whitespaces
    $newUnitNumber = trim($_POST['unit_number']);
    $newStatus = trim($_POST['status']);
    $newResidentUsername = trim($_POST['tenant']);

    // Validate tenant selection if the status is "Occupied"
    if ($newStatus == 'Occupied' && empty($newResidentUsername)) {
        $_SESSION['error'] = 'Please choose a tenant for an "Occupied" Unit.';
        header("Location: update_unit.php?updateid=$update_id");
        exit();
    }

    // Validate that the status is not "Available" if a tenant is chosen
    if ($newStatus == 'Available' && !empty($newResidentUsername)) {
        $_SESSION['error'] = 'Cannot choose a tenant for an "Available" Unit.';
        header("Location: update_unit.php?updateid=$update_id");
        exit();
    }

    // Update the unit details in the database
    $update_query = "UPDATE units SET unit_status = ?, tenant_id = ? WHERE id = ?";
    $stmt_update = $mysqli->prepare($update_query);
    $stmt_update->bind_param("ssi", $newStatus, $newResidentUsername, $update_id);
    $stmt_update->execute();

    // Check for success
    if ($stmt_update->errno === 0) {
        $_SESSION['success'] = 'Unit updated successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Updated Unit: $newUnitNumber");
    } else {
        $_SESSION['error'] = 'Error updating Unit: ' . $stmt_update->error;
    }

    $stmt_update->close();
    header("Location: units.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Unit</title>
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
    <?php include "../../includes/sidebars/resident_sidebar.php" ?>
    <!-- import prompt styles -->
    <?php include "../../includes/sidebars/resident_sidebar_prompt.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="update_unit.php?updateid=<?php echo $update_id; ?>" method="post"
                    enctype="multipart/form-data">

                    <h2 class="text-center">Update Unit</h2>

                    <div class="form-group" hidden>
                        <label for="unit_number" hidden>Unit Number:</label>
                        <input type="number" class="form-control" value="<?php echo $unit_number; ?>" name="unit_number"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Unit Status:</label>
                        <select class="form-control" name="status" required>
                            <option value="Available" <?php echo ($unit_status == 'Available') ? 'selected' : ''; ?>>
                                Available</option>
                            <option value="Occupied" <?php echo ($unit_status == 'Occupied') ? 'selected' : ''; ?>>
                                Occupied</option>
                            <option value="Renovating" <?php echo ($unit_status == 'Renovating') ? 'selected' : ''; ?>>
                                Renovating</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tenant">Current Tenant:</label>
                        <select class="form-control" name="tenant">
                            <option value="">None</option>
                            <?php
                            $condominium_id = 1; // Set the condominium_id
                            $query = "SELECT username FROM users WHERE role = 'Tenant' AND condominium_id = $condominium_id";
                            $result = $mysqli->query($query);

                            while ($row = $result->fetch_assoc()) {
                                $username = $row["username"];
                                $selected = ($username == $resident_id) ? 'selected' : '';
                                echo "<option value='" . $username . "' $selected>" . $username . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group" hidden>
                        <label for="resident">Current Resident (Owner):</label>
                        <select class="form-control" name="resident">
                            <option value="">None</option>
                            <?php
                            $condominium_id = 1; // Set the condominium_id
                            $query = "SELECT username FROM users WHERE role = 'Resident' AND condominium_id = $condominium_id";
                            $result = $mysqli->query($query);

                            while ($row = $result->fetch_assoc()) {
                                $username = $row["username"];
                                $selected = ($username == $resident_id) ? 'selected' : '';
                                echo "<option value='" . $username . "' $selected>" . $username . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <?php
                    if (isset($_SESSION['error'])) {
                        echo "<p class='error' style='color: red;'><strong>" . $_SESSION['error'] . "</strong></p>";
                        unset($_SESSION['error']); // Clear the error message
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