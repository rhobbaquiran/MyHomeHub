<?php
session_start();
include('../includes/database.php');

// Redirect if the user is not logged in or has an invalid session
if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../index.php");
    exit();
}

// Check if the updateid parameter is set
if (!isset($_GET['updateid']) || empty($_GET['updateid'])) {
    header("Location: administrators.php");
    exit();
}

// Process Form Data if Submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and remove whitespaces
    $update_id = $_POST['update_id'];
    $name = trim($_POST['admin_name']);
    $email = trim($_POST['admin_email']);
    $condominium = trim($_POST['admin_condominium']);

    // Update the record in the users table
    $update_query = "UPDATE users SET username=?, email=?, condominium_id=? WHERE id=?";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameters
    $stmt->bind_param("ssii", $name, $email, $condominium, $update_id);

    // Execute the query
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Administrator updated successfully.';
        // Log the activity
        logActivity($_SESSION['username'], "Updated Administrator: $name");
    } else {
        $_SESSION['error'] = 'Error updating Administrator: ' . $stmt->error;
    }

    $stmt->close();
    header("Location: administrators.php");
    exit();
}

// Retrieve existing Administrator information for updating
$update_id = $_GET['updateid'];
$select_query = "SELECT * FROM users WHERE id = ?";
$stmt_select = $mysqli->prepare($select_query);
$stmt_select->bind_param("i", $update_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

// Check if Administrator exists
if ($result_select->num_rows != 1) {
    header("Location: administrators.php");
    exit();
}

$row = $result_select->fetch_assoc();
$admin_name = $row['username'];
$admin_email = $row['email'];
$admin_condominium = $row['condominium_id']; // Update this line

$stmt_select->close();

// Function to log activity
function logActivity($user, $action)
{
    global $mysqli;
    $insert_query = "INSERT INTO activity_logs (timestamp, user, action) VALUES (CURRENT_TIMESTAMP, ?, ?)";
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
    <title>Update Administrator</title>
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
    <?php include "../includes/sidebars/superadmin_sidebar.php" ?>
    <!-- import prompt styles -->
    <?php include "../includes/sidebars/superadmin_sidebar_prompts.php" ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="update_administrator.php?updateid=<?php echo $update_id; ?>" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Update Administrator</h2><br>

                    <input type="hidden" name="update_id" value="<?php echo $update_id; ?>">

                    <div class="form-group">
                        <label for="admin_name">Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="admin_name" value="<?php echo htmlspecialchars($admin_name); ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="admin_email">Email:</label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="admin_email" value="<?php echo htmlspecialchars($admin_email); ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label for="admin_condominium">Select Condominium:</label>
                        <select class="form-control" name="admin_condominium" autocomplete="off" required>
                            <?php
                            // To select condo names from table condominiums
                            $condo_query = "SELECT id, name FROM condominiums"; // Update this line
                            $condo_result = $mysqli->query($condo_query);

                            while ($row = $condo_result->fetch_assoc()) {
                                $condo_id = $row['id']; // Update this line
                                $condo_name = $row['name'];
                                $selected = ($condo_id == $admin_condominium) ? 'selected' : ''; // Update this line
                                echo "<option value=\"$condo_id\" $selected>$condo_name</option>"; // Update this line
                            }
                            ?>
                        </select>
                    </div><br>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="update_submit" value="Update"></button></center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>