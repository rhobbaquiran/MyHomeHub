<?php
require_once "controllerUserData.php";

$email = $_SESSION['email'];
if ($email == false) {
    header('Location: ../index.php');
}

$errors = array(); // Initialize the errors array

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change-password'])) {
    $password = hash('sha256', trim($_POST['password'])); // Hash the password using SHA-256
    $cpassword = hash('sha256', trim($_POST['cpassword'])); // Hash the confirm password using SHA-256

    if ($password === $cpassword) {
        $hashedPassword = hash('sha256', trim($_POST['password'])); // Hash the password using SHA-256

        // Use prepared statement to update password
        $query = "UPDATE users SET password=? WHERE email=?";
        $stmt = mysqli_prepare($mysqli, $query);
        
        // Bind parameters
        mysqli_stmt_bind_param($stmt, 'ss', $hashedPassword, $email);
        
        // Execute the statement
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $_SESSION['info'] = "Password updated successfully!";
            header('Location: success.php');
            exit(); // Stop execution after redirect
        } else {
            $errors[] = "Failed to update password. Please try again.";
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        $errors[] = "Passwords do not match.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="new-password.php" method="POST" autocomplete="off">
                    <h2 class="text-center">New Password</h2>

                    <?php
                    // Display errors first
                    if (count($errors) > 0) {
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    } elseif (isset($_SESSION['info'])) {
                        // Display success message only if no errors
                        ?>
                        <div class="alert alert-success text-center">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>

                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

