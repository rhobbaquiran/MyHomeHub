<?php
session_start();
include('../../includes/database.php');

if (!isset($_SESSION['username']) || empty($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: ../../index.php");
    exit();
}

// Check user role and redirect if not authorized
$allowed_roles = ['Resident'];

if (!in_array($_SESSION['role'], $allowed_roles)) {
    // User is not authorized for this dashboard
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

// Fetch data of person_of_contact
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
    $person_of_contact_username = $row['person_of_contact'];
} else {
    $_SESSION['error'] = 'No data found for the given condominium ID.';
    header("Location: community_budget.php");
    exit();
}

$errors = [];

if (isset($_POST['add_submit'])) {
    $username = $_SESSION['username'];
    $category = trim($_POST['category']);
    $amount = trim($_POST['amount']);

    // Check if a file is selected for upload
    if (!isset($_FILES['add_image']['name']) || empty($_FILES['add_image']['name'])) {
        $errors[] = "Please upload a proof of payment.";
    } else {
        $file = $_FILES['add_image'];

        // Check if the file has a valid extension
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExt, $allowedExtensions)) {
            $errors[] = "Invalid file type. Please upload a PNG, JPG, or JPEG file.";
        } else {
            // Check if the file is a valid image by verifying its content type
            $imageInfo = getimagesize($file['tmp_name']);
            if ($imageInfo === false) {
                $errors[] = "Invalid image file. Please upload a valid image.";
            }
        }
    }

    // If there are no errors, proceed with file upload and form submission
    if (empty($errors)) {
        $newFileName = $username . '_' . $category . '.' . $fileExt;
        $uploadDir = "../../uploads/payment_proof/";

        // Check if the filename already exists, and append a unique identifier if needed
        $counter = 1;
        while (file_exists($uploadDir . $newFileName)) {
            $newFileName = $username . '_' . $category . '_' . $counter . '.' . $fileExt;
            $counter++;
        }

        $uploadPath = $uploadDir . $newFileName;

        // Move the uploaded file to the desired directory
        move_uploaded_file($file['tmp_name'], $uploadPath);

        $action = $username . ' submitted a donation payment with amount: ' . $amount;

        // Check if there is already a record for this category in the budget table
        $checkQuery = "SELECT * FROM budget WHERE condominium_id = ? AND category = ?";
        $stmt = $mysqli->prepare($checkQuery);
        $stmt->bind_param("is", $_SESSION['condominium_id'], $category);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // If there is an existing record, update the amount
            $updateQuery = "UPDATE budget SET amount = amount + ? WHERE condominium_id = ? AND category = ?";
            $stmt = $mysqli->prepare($updateQuery);
            $stmt->bind_param("iis", $amount, $_SESSION['condominium_id'], $category);
            $stmt->execute();
        } else {
            // If there is no existing record, insert a new one
            $insertPaymentQuery = "INSERT INTO budget (condominium_id, category, amount) VALUES (?, ?, ?)";
            $stmt = $mysqli->prepare($insertPaymentQuery);
            $stmt->bind_param("iss", $_SESSION['condominium_id'], $category, $amount);
            $stmt->execute();
        }

        // Log the activity
        logActivity($username, $action, $_SESSION['condominium_id']);

        // Retrieve email from the users table based on the person of contact
        $email_query = "SELECT email FROM users WHERE username = ?";
        $stmt_email = $mysqli->prepare($email_query);
        $stmt_email->bind_param("s", $_SESSION['username']);
        $stmt_email->execute();
        $result_email = $stmt_email->get_result();

        // Check if the email retrieval was successful
        if ($result_email->num_rows == 1) {
            $email_row = $result_email->fetch_assoc();
            $to = $email_row['email']; // Use the retrieved email for the 'to' field
        } else {
            // Handle the case where the email couldn't be retrieved
            $_SESSION['error'] = 'Error retrieving email for person of contact: ' . $stmt_email->error;
            header("Location: donate_community_budget.php");
            exit();
        }

        $stmt_email->close();

        // Send email notification
        $subject = 'Donation Payment Notification';
        $message = "Dear Mr./Ms. $username,\n\nThank you for your contribution to our community. This is to inform you that a donation payment has been made to the community under category: $category. Amount: number_format($amount, 2) \n\n\nFrom,\n$person_of_contact_username\n Casa Bougainvilla";
        $headers = 'From: adm1nplk2022@yahoo.com';

        // Use mail() function to send the email
        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['success'] = 'Donation payment notification sent successfully.';
        } else {
            // Handle the case where the email couldn't be sent
            $_SESSION['error'] = 'Failed to send donation payment notification email.';
        }

        // Redirect back to the community_budget page
        header("Location: community_budget.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Donate to Community</title>
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
                <form method="post" enctype="multipart/form-data">
                    <h2 class="text-center">Donate to Community</h2>
                    <center><img src="../../uploads/qrcode.png" width="300" height="250"></center><br>
                    <center><img src="../../uploads/gcash.png" width="100" height="25"></center><br>

                    <div class="form-group">
                        <label for="item">Select Category:</label>
                        <select class="form-control" name="category" required>
                            <?php
                            // Query to fetch available items
                            $query = "SELECT category FROM budget WHERE condominium_id = ?";
                            $stmt = $mysqli->prepare($query);
                            $stmt->bind_param("i", $_SESSION['condominium_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Populate the dropdown with available items
                            while ($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['category'] . "'>" . $row['category'] . "</option>";
                            }
                            $stmt->close();
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Amount:</label>
                        <input type="number" class="form-control" placeholder="Enter Amount" name="amount" value="<?php echo htmlspecialchars($community_item_quantity); ?>" autocomplete="off" required>
                    </div><br>

                    <div class="form-group">
                        <label>Upload Your Proof of Payment Picture:</label>
                        <input name="add_image" type="file" accept=".jpg, .jpeg, .png" />
                    </div>

                    <?php
                    // Display error messages, if any
                    foreach ($errors as $error) {
                        echo '<div class="alert alert-danger"><center>' . $error . '</center></div>';
                    }
                    ?>

                    <div class="form-group">
                        <center><button type="submit" class="form-control button" name="add_submit">Submit</button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>