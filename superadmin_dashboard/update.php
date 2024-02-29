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
    header("Location: superadmin_dashboard.php");
    exit();
}

// Define logActivity function
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

// Retrieve existing condominium information for updating
$update_id = $_GET['updateid'];
$select_query = "SELECT * FROM condominiums WHERE id = ?";
$stmt_select = $mysqli->prepare($select_query);
$stmt_select->bind_param("i", $update_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

// Check if the condominium exists
if ($result_select->num_rows != 1) {
    header("Location: superadmin_dashboard.php");
    exit();
}

$row = $result_select->fetch_assoc();
$condominium_name = $row['name'];
$condo_person_of_contact = $row['person_of_contact'];
$condominium_address = $row['address'];
$condominium_status = $row['condominium_status'];
$condominium_payment_status = $row['payment_status'];
$existing_legal_documents = $row['legal_documents']; // Add this line

$stmt_select->close();

// Process Form Data if Submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and remove whitespaces
    $update_id = $_POST['update_id'];
    $name = trim($_POST['condominium_name']);
    $person_contact = trim($_POST['person_of_contact']);
    $condo_address = trim($_POST['address']);
    $condominium_status = trim($_POST['condominium_status']);
    $payment_status = trim($_POST['condominium_payment_status']);

    $update_query = "UPDATE condominiums SET name=?, person_of_contact=?, address=?, condominium_status=?, payment_status=? WHERE id=?";
    $stmt = $mysqli->prepare($update_query);

    // Bind parameters
    $stmt->bind_param("sssssi", $name, $person_contact, $condo_address, $condominium_status, $payment_status, $update_id);
    $stmt->execute();

    // Check for success
    if ($stmt->affected_rows > 0) {
        $_SESSION['success'] = 'Condominium updated successfully.';
        // Log the activity (included directly in this file)
        logActivity($_SESSION['username'], "Updated Condominium: $name");
    } else {
        $_SESSION['error'] = 'Error updating Condominium: ' . $stmt->error;
    }

    // To handle file upload
    $upload_dir = '../uploads/';
    $existing_legal_documents = $row['legal_documents'];

    if (!empty($_FILES["legal_documents"]["name"])) {
        $legal_documents_name = basename($_FILES["legal_documents"]["name"]);
        $legal_documents_path = $upload_dir . $legal_documents_name;

        // Ensure a unique file name
        $timestamp = time();
        $legal_documents_name = pathinfo($_FILES["legal_documents"]["name"], PATHINFO_FILENAME) . '_' . $timestamp . '.' . pathinfo($_FILES["legal_documents"]["name"], PATHINFO_EXTENSION);
        $legal_documents_path = $upload_dir . $legal_documents_name;

        if (move_uploaded_file($_FILES["legal_documents"]["tmp_name"], $legal_documents_path)) {
            // Update the legal_documents field in the database
            $update_legal_documents_query = "UPDATE condominiums SET legal_documents=? WHERE id=?";
            $stmt_update_legal_documents = $mysqli->prepare($update_legal_documents_query);
            $stmt_update_legal_documents->bind_param("si", $legal_documents_name, $update_id);
            $stmt_update_legal_documents->execute();
            $stmt_update_legal_documents->close();
        } else {
            $_SESSION['error'] = 'Error uploading file.';
            // Handle the error as needed
        }
    } else {
        // No new file uploaded, use the existing file name
        $legal_documents_name = $existing_legal_documents;
    }

    $stmt->close();
    header("Location: superadmin_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Condominium</title>
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
                <form action="update.php?updateid=<?php echo $update_id; ?>" method="post" enctype="multipart/form-data">

                    <h2 class="text-center">Update Condominium</h2><br>

                    <input type="hidden" name="update_id" value="<?php echo $update_id; ?>">

                    <div class="form-group">
                        <label for="username">Condominium Name:</label>
                        <input type="text" class="form-control" placeholder="Enter Condominium Name" name="condominium_name" value="<?php echo $condominium_name; ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
    <label for="person_of_contact">Person of Contact:</label>
    <select class="form-control" name="person_of_contact" required>
        <?php
        while ($admin_user = $admin_users_result->fetch_assoc()) {
            $username = $admin_user['username'];
            $account_number = $admin_user['account_number'];
            $selected = ($username == $condo_person_of_contact) ? 'selected' : '';
            echo "<option value=\"$username\" $selected>$username - $account_number</option>";
        }
        ?>
    </select>
</div>

                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" placeholder="Enter Address" name="address" value="<?php echo $condominium_address; ?>" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label>Approval Status:</label>
                        <select id="condominium_status" name="condominium_status" class="form-control" onchange="updatePaymentStatus()">
                            <option value="PENDING" <?php echo ($condominium_status == 'PENDING') ? 'selected' : ''; ?>>Pending</option>
                            <option value="APPROVED" <?php echo ($condominium_status == 'APPROVED') ? 'selected' : ''; ?>>Approved</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Payment Status:</label>
                        <select name="condominium_payment_status" class="form-control">
                            <option value="PENDING" <?php echo ($condominium_payment_status == 'PENDING') ? 'selected' : ''; ?>>Pending</option>
                            <option value="PAID" <?php echo ($condominium_payment_status == 'PAID') ? 'selected' : ''; ?>>Paid</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="existing_legal_documents">Existing Legal Documents:</label>
                        <?php
                        // Check if a file exists
                        if (!empty($existing_legal_documents)) {
                            $file_path = '../uploads/' . $existing_legal_documents;
                        ?>
                            <p><a href="<?php echo $file_path; ?>" target="_blank"><?php echo $existing_legal_documents; ?></a></p>
                        <?php
                        } else {
                            echo "<p>No existing legal documents.</p>";
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="legal_documents">New Legal Documents (Optional):</label>
                        <input type="file" class="form-control-file" name="legal_documents" accept=".pdf, .doc, .docx">
                    </div>

                    <?php
                    if (isset($error_message)) {
                        echo "<p class='error'>$error_message</p>";
                    }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="update_submit" value="Update"></center>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updatePaymentStatus() {
            var approvalStatus = document.getElementById("condominium_status").value;
            var paymentStatusSelect = document.querySelector("[name='condominium_payment_status']");

            // Automatically set payment_status based on approval_status
            if (approvalStatus === 'PENDING') {
                paymentStatusSelect.value = 'PENDING';
            } else if (approvalStatus === 'APPROVED') {
                paymentStatusSelect.value = 'PAID';
            }
        }

        // Call the function to set the initial payment_status
        updatePaymentStatus();
    </script>

</body>

</html>