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

    $insert_query = "INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP, ?, ?, 1,$account_number)";
    $stmt = $mysqli->prepare($insert_query);
    $stmt->bind_param("ss", $user, $action);
    $stmt->execute();
    $stmt->close();
}

if (!isset($_GET['updateid']) || empty($_GET['updateid'])) {
    header("Location: resident_dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_id = $_POST['update_id'];
    $name = trim($_POST['username']);
    $email = trim($_POST['email']);
    $condominium = 'Casa Bougainvilla'; // Automatically set to 'Casa Bougainvilla'
    $role = 'Tenant';  // Set the role to 'Resident'

    // Get the condominium_id based on the selected condominium name
    $condo_query = "SELECT id FROM condominiums WHERE name = ?";
    $stmt_condo = $mysqli->prepare($condo_query);
    $stmt_condo->bind_param("s", $condominium);
    $stmt_condo->execute();
    $stmt_condo->bind_result($condo_id);
    $stmt_condo->fetch();
    $stmt_condo->close();

    // Update the resident information in the users table
    $update_query = "UPDATE users SET username=?, email=?, condominium_id=? WHERE id=?";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameters
    $stmt->bind_param("ssii", $name, $email, $condo_id, $update_id);

    // Execute the query
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Tenant updated successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Updated Tenant: $name");
    } else {
        $_SESSION['error'] = 'Error updating Tenant: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: resident_dashboard.php");
    exit();
}

$update_id = $_GET['updateid'];
$select_query = "SELECT * FROM users WHERE id = ?";
$stmt_select = $mysqli->prepare($select_query);
$stmt_select->bind_param("i", $update_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

if ($result_select->num_rows != 1) {
    header("Location: resident_dashboard.php");
    exit();
}

$row = $result_select->fetch_assoc();
$resident_name = $row['username'];
$resident_email = $row['email'];

$stmt_select->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Tenant</title>
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
                <form action="update_tenant.php?updateid=<?php echo $update_id; ?>" method="post"
                    enctype="multipart/form-data">

                    <h2 class="text-center">Update Tenant</h2><br>

                    <input type="hidden" name="update_id" value="<?php echo $update_id; ?>">

                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="username"
                            value="<?php echo htmlspecialchars($resident_name); ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email"
                            value="<?php echo htmlspecialchars($resident_email); ?>" autocomplete="off" required>
                    </div><br>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="update_submit" value="Update">
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>