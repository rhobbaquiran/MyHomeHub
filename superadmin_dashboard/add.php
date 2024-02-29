<?php
session_start();
include('../includes/database.php');

// Redirect if the user is not logged in or has an invalid session
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

// Function to log activity
function logActivity($user, $action)
{
    global $mysqli;
    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id) VALUES (CURRENT_TIMESTAMP, ?, ?, NULL)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

// Add this code before rendering the HTML form
$admin_users_query = "SELECT username, account_number FROM users WHERE role = 'Administrator'";
$admin_users_result = $mysqli->query($admin_users_query);
$admin_users_exist = $admin_users_result->num_rows > 0;

// Check for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and remove whitespaces
    $name = trim($_POST['condominium_name']);
    $person_contact = trim($_POST['person_of_contact']);
    $condo_address = trim($_POST['address']);

    // To handle file upload
    $upload_dir = '../uploads/';
    $legal_documents_name = basename($_FILES["legal_documents"]["name"]);
    $legal_documents_path = $upload_dir . $legal_documents_name;

    // Ensure a unique file name
    $timestamp = time();
    $legal_documents_name = pathinfo($_FILES["legal_documents"]["name"], PATHINFO_FILENAME) . '_' . $timestamp . '.' . pathinfo($_FILES["legal_documents"]["name"], PATHINFO_EXTENSION);
    $legal_documents_path = $upload_dir . $legal_documents_name;

    if (move_uploaded_file($_FILES["legal_documents"]["tmp_name"], $legal_documents_path)) {
        // Insert into condominium table
        $insert_query = "INSERT INTO condominiums (name, person_of_contact, address, payment_status, condominium_status, legal_documents) VALUES (?, ?, ?, 'PENDING', 'PENDING', ?)";
        $stmt = $mysqli->prepare($insert_query);

        // Check for errors in the preparation
        if (!$stmt) {
            die("Error in prepare: " . $mysqli->error);
        }

        // Bind parameters
        $stmt->bind_param("ssss", $name, $person_contact, $condo_address, $legal_documents_name);

        // Execute the statement
        $result = $stmt->execute();

        // Check for errors in execution
        if (!$result) {
            die("Error in execute: " . $stmt->error);
        }

        // Check for success
        if ($stmt->affected_rows > 0) {
            $_SESSION['success'] = 'Condominium added successfully.';
            // Log the activity
            logActivity($_SESSION['username'], "Added Condominium: $name");
        } else {
            $_SESSION['error'] = 'Error adding Condominium: ' . $stmt->error;
        }

        // Close the statement
        $stmt->close();

        header("Location: superadmin_dashboard.php");
        exit();
    } else {
        $_SESSION['error'] = 'Error uploading file.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Condominium</title>
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
    <?php include "../includes/sidebars/superadmin_sidebar.php" ?>
    <!-- import prompt styles -->
    <?php include "../includes/sidebars/superadmin_sidebar_prompts.php" ?>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="add.php" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Add Condominium</h2><br>

                    <div class="form-group">
                        <label for="username">Condominium Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Condominium Name" name="condominium_name" autocomplete="off" required>
                    </div>

                    <div class="form-group">
    <label for="person_of_contact">Person of Contact:</label>
    <?php if ($admin_users_exist) { ?>
        <select class="form-control" name="person_of_contact" required>
            <?php
            while ($admin_user = $admin_users_result->fetch_assoc()) {
                $username = $admin_user['username'];
                $account_number = $admin_user['account_number'];
                echo "<option value=\"$username\">$username - $account_number</option>";
            }
            ?>
        </select>
    <?php } else { ?>
        <input type="text" class="form-control" value="No Person of Contact" readonly>
    <?php } ?>
</div>

                    <div class="form-group">
                        <label for="">Address:</label>
                        <input type="text" class="form-control" placeholder="Enter Address" name="address" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="legal_documents">Legal Documents:</label>
                        <input type="file" class="form-control-file" name="legal_documents" accept=".pdf, .doc, .docx" required>
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