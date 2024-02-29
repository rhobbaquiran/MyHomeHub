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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $condominium = 'Casa Bougainvilla'; // Automatically set to 'Casa Bougainvilla'
    // Get form data and remove whitespaces
    $unitNumber = trim($_POST['unit_number']);
    $status = trim($_POST['status']);
    $residentUsername = trim($_POST['resident']);

    // Validate resident selection if the status is "Occupied"
    if ($status == 'Occupied' && empty($residentUsername)) {
        $_SESSION['error'] = 'Please choose a resident for an "Occupied" Unit.';
        header("Location: add_unit.php");
        exit();
    }

    // Validate that the status is not "Available" if a resident is chosen
    if ($status == 'Available' && !empty($residentUsername)) {
        $_SESSION['error'] = 'Cannot choose a resident for a "Available" Unit.';
        header("Location: add_unit.php");
        exit();
    }

    // Get the condominium_id based on the selected condominium name
    $condo_query = "SELECT id FROM condominiums WHERE name = ?";
    $stmt_condo = $mysqli->prepare($condo_query);
    $stmt_condo->bind_param("s", $condominium);
    $stmt_condo->execute();
    $stmt_condo->bind_result($condo_id);
    $stmt_condo->fetch();
    $stmt_condo->close();

    // Insert into units table
    $insert_query = "INSERT INTO units (condominium_id, unit_number, unit_status, resident_id)
    VALUES (?,?,?,?)";

    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("iiss", $condo_id, $unitNumber, $status, $residentUsername);
    $stmt->execute();

    // Check for success
    if ($stmt->errno === 0) {
        $_SESSION['success'] = 'Unit added successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Added Unit: $unitNumber");
    } else {
        $_SESSION['error'] = 'Error adding Unit: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: units.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Unit</title>
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
    <?php include "../../includes/sidebars/administrator_sidebar.php" ?>
    <!-- import prompt styles -->
    <?php include "../../includes/sidebars/administrator_sidebar_prompt.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="add_unit.php" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Add Unit</h2><br>

                    <div class="form-group">
                        <label for="unit_number">Unit Number:</label>
                        <input type="number" class="form-control" placeholder="Enter Unit Number" name="unit_number"
                            autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="status">Unit Status:</label>
                        <select class="form-control" name="status" required>
                            <option value="Available">Available</option>
                            <option value="Occupied">Occupied</option>
                            <option value="Renovating">Renovating</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="resident">Current Resident (Owner):</label>
                        <select class="form-control" name="resident">
                            <option value="">None</option>
                            <?php
                            $condominium_id = 1;  // Set the condominium_id
                            $query = "SELECT username FROM users WHERE role = 'Resident' AND condominium_id = $condominium_id";
                            $result = $mysqli->query($query);

                            while ($row = $result->fetch_assoc()) {
                                $username = $row["username"];
                                echo "<option value='" . $username . "'>" . $username . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!--<div class="form-group">
                        <label for="owner">Owner:</label>
                        <select class="form-control" name="owner">
                            <option value="">None</option>
                            <? php/*
                   $condominium_id = 1;
                   $query = "SELECT username FROM users WHERE role = 'Administrator' AND condominium_id = $condominium_id";
                   $result = $mysqli->query($query);
                   
                   while($row = $result->fetch_assoc()){
                       $username = $row["username"];
                       echo "<option value='" . $username . "'>" . $username . "</option>";
                   }*/
                                ?>
                        </select>
                    </div>-->

                    <?php
                    if (isset($_SESSION['error'])) {
                        echo "<p class='error' style='color: red;'><strong>" . $_SESSION['error'] . "</strong></p>";
                        unset($_SESSION['error']); // Clear the error message
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="add_submit"
                                value="Submit"></button></center>
                    </div>

                    <script>
                        document.addEventListener("DOMContentLoaded", function () {
                            var statusSelect = document.querySelector("select[name='status']");
                            var residentSelect = document.querySelector("select[name='resident']");

                            statusSelect.addEventListener("change", function () {
                                if (statusSelect.value === 'Available') {
                                    residentSelect.value = ''; // Set to blank if status is 'Available'
                                }
                                else if (residentSelect.value === '') {
                                    statusSelect.value === 'Available';
                                }
                                else {
                                    // If status is not 'Available', set to the selected status
                                    // Note: Assuming the status options are 'Occupied' and 'Renovating'
                                    statusSelect.value = (residentSelect.value !== '') ? statusSelect.value : 'Occupied';
                                }
                            });

                            // Trigger the change event initially to handle the default selection
                            statusSelect.dispatchEvent(new Event('change'));
                        });
                    </script>
                </form>
            </div>
        </div>
    </div>
</body>

</html>