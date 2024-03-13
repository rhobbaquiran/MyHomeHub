<?php
session_start();
// Include the database connection file
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

// Fetch pending bills based on the current user's account number
$account_number = $_SESSION['account_number'];

// Define variables to store error messages
$errors = [];

if (isset($_POST['add_submit'])) // add_submit is the name of the button
{
    $username = $_SESSION['username'];
    $condominium_id = 1;
    $bill_number = $_POST['bill_number'];

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
        $newFileName = $username . '_' . $bill_number . '.' . $fileExt;
        $uploadDir = "../../uploads/payment_proof/";

        // Check if the filename already exists, and append a unique identifier if needed
        $counter = 1;
        while (file_exists($uploadDir . $newFileName)) {
            $newFileName = $username . '_' . $bill_number . '_' . $counter . '.' . $fileExt;
            $counter++;
        }

        $uploadPath = $uploadDir . $newFileName;

        // Move the uploaded file to the desired directory
        move_uploaded_file($file['tmp_name'], $uploadPath);

        $action = $username . ' submitted payment with Bill Number: ' . $bill_number;

        // Insert payment information into the 'payments' table
        $insertPaymentQuery = "INSERT INTO payments (username, condominium_id, bill_number, timestamp, screenshot) 
                              VALUES ('$username', '$condominium_id', '$bill_number', NOW(), '$uploadPath')";

        $insertPaymentResult = mysqli_query($mysqli, $insertPaymentQuery);

        // Check if the payment information was successfully inserted
        if ($insertPaymentResult) {
            // Insert activity log for Administrator Dashboard
            $insertActivityQuery = "INSERT INTO activity_logs (user, timestamp, action, condominium_id,account_number) 
                                    VALUES ('$username', NOW(), '$action', '$condominium_id','$account_number')";

            $insertActivityResult = mysqli_query($mysqli, $insertActivityQuery);

            // Insert activity log for Super Administrator Dashboard
            $insertActivityQuery2 = "INSERT INTO activity_logs (user, timestamp, action, condominium_id) 
            VALUES ('$username', NOW(), '$action', 1)";

            $insertActivityResult2 = mysqli_query($mysqli, $insertActivityQuery2);

            if (!$insertActivityResult) {
                die("Error inserting activity log: " . mysqli_error($mysqli));
            }
        } else {
            die("Error inserting payment information: " . mysqli_error($mysqli));
        }

        // Redirect back to the account_payment_history page
        header("Location: account_payment_history.php");
    }
}

$sql = "SELECT bill_number, billing_period_start, billing_period_end, total_amount_due FROM resident_transactions WHERE account_number = '$account_number' AND status = 'Pending' AND is_deleted = 0";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Bill Payment</title>
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
                <form method="post" enctype="multipart/form-data">
                    <h2 class="text-center">Bill Payment</h2>
                    <center><img src="../../uploads/qrcode.png" width="300" height="250"></center><br>
                    <center><img src="../../uploads/gcash.png" width="100" height="25"></center><br>

                    <div class="form-group">
                        <label>Select Your Pending Bill:</label><br>
                        <select class="form-control" name="bill_number" style="height:40px;" required>
                            <?php
                            // Check if there are pending bills
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $bill_number = $row['bill_number'];
                                    $billing_period_start = $row['billing_period_start'];
                                    $billing_period_end = $row['billing_period_end'];
                                    $total_amount_due = $row['total_amount_due'];

                                    echo "<option value='$bill_number'>$bill_number | $billing_period_start | $billing_period_end | $total_amount_due</option>";
                                }
                            } else {
                                echo "<option value='' disabled selected>No Pending Bills</option>";
                            }
                            ?>
                        </select>
                    </div>

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