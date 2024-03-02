<?php
include('includes/database.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $mysqli->prepare("SELECT u.*, c.suspended AS condominium_suspended, c.suspension_reason AS condominium_suspension_reason FROM users u LEFT JOIN condominiums c ON u.condominium_id = c.id WHERE u.email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        if ($user['condominium_suspended'] == 1) {
            // Handle suspended condominium
            $error_message = "This condominium is suspended. Reason: " . $user['condominium_suspension_reason'] . '.';
        } elseif ($user['suspended'] == 1) {
            // Handle suspended user
            $error_message = "Your account is suspended. Reason: " . $user['suspension_reason'] . '.';
        } else {
            // Verify the password using sha256 hashing
            $hashed_password = hash("sha256", $password, false);

            if ($hashed_password === $user['password']) {
                // Password is correct
                $_SESSION['email_2fa_required'] = true; // Rename to email_2fa_required

                $dashboard_url = $user['dashboard_url'];
                $user_role = $user['role'];

                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['dashboard_url'] = $dashboard_url;
                $_SESSION['role'] = $user_role;
                $_SESSION['account_number'] = $user['account_number'];
                $_SESSION['condominium_id'] = $user['condominium_id'];

                $login_user = $user['username'];
                $login_activity = "Logged in";
                $condominium_id = $user['condominium_id'];
                $account_number = $user['account_number'];

                $stmt_insert_activity = $mysqli->prepare("INSERT INTO activity_logs (timestamp, user, action, condominium_id, account_number) VALUES (CURRENT_TIMESTAMP(), ?, ?, ?, ?)");
                $stmt_insert_activity->bind_param("ssss", $login_user, $login_activity, $condominium_id, $account_number);
                $stmt_insert_activity->execute();
                $stmt_insert_activity->close();
            } else {
                // Wrong password
                $error_message = "Wrong password. Please enter the correct password.";
            }
        }
    } else {
        // Account does not exist
        $error_message = "Account with this email does not exist. Please check your email.";
    }

    $stmt->close();
}

function generateRandomCaptcha($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $captcha = '';
    $charactersLength = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $captcha .= $characters[rand(0, $charactersLength - 1)];
    }

    return $captcha;
}

function generateCaptchaImage($captchaText) {
    $image = imagecreate(150, 50);
    $background_color = imagecolorallocate($image, 255, 255, 255);
    $text_color = imagecolorallocate($image, 0, 0, 0);

    imagestring($image, 5, 20, 15, $captchaText, $text_color);

    ob_start();
    imagepng($image);
    $image_data = ob_get_contents();
    ob_end_clean();

    imagedestroy($image);

    return $image_data;
}

// Email 2FA
if (isset($_SESSION['email_2fa_required']) && $_SESSION['email_2fa_required']) {
    $email_2fa_code = generateRandomCaptcha(6); // Use the same function for simplicity
    $_SESSION['email_2fa'] = $email_2fa_code;
    unset($_SESSION['email_2fa_required']);

    $to = $user['email'];
    $subject = 'Your Login Verification';
    $message = 'Your OTP code is: ' . $email_2fa_code;

    // Additional headers for better email deliverability
    $headers = "From: adm1nplk2022@yahoo.com\r\n";
    $headers .= "Reply-To: adm1nplk2022@yahoo.com\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Send the email
    if (mail($to, $subject, $message, $headers)) {} 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="includes/style.css">

    <style>
        #email2faModal {
            margin-top: 255px; /* Adjust this value as needed to center the modal */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="index.php" method="post" enctype="multipart/form-data">

                    <center><img src="includes/logo.png" width="300" height="250"></center>

                    <h2 class="text-center">MyHomeHub</h2>

                    <div class="form-group">
                        <label for="email"><strong>Email:</strong></label>
                        <input type="email" class="form-control" placeholder="Enter Email" name="email" autocomplete="off" required>
                    </div>

                    <div class="form-group">
                        <label><strong>Password:</strong></label>
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" autocomplete="off" required>
                    </div>

                    <?php
                        $error_color = '#ff0000'; // Default color (you can change it as needed)
                        
                        if (isset($error_message)) 
                        {
                            if (isset($user) && $user['condominium_suspended'] == 0) 
                            {
                                if ($user['role'] == "Tenant") 
                                {
                                    $error_color = '#ff0000'; // Red for Tenant if Condominium is not Suspended
                                } elseif ($user['role'] == "Resident") 
                                {
                                    $error_color = '#ff0000'; // Red for Resident if Condominium is not Suspended
                                } elseif ($user['role'] == "Front Desk") 
                                {
                                    $error_color = '#ff0000'; // Red for Front Desk if Condominium is not Suspended
                                } elseif ($user['role'] == "Administrator") 
                                {
                                    $error_color = '#ff0000'; // Red for Administrator if Condominium is not Suspended
                                }
                            } 
                            elseif (isset($user) && $user['condominium_suspended'] == 1) 
                            {
                                if ($user['role'] == "Tenant") 
                                {
                                    $error_color = '#006400'; // Green for Tenant if Condominium is Suspended
                                } elseif ($user['role'] == "Resident") 
                                {
                                    $error_color = '#006400'; // Green for Resident if Condominium is Suspended
                                } elseif ($user['role'] == "Front Desk") 
                                {
                                    $error_color = '#ff0000'; // Red for Front Desk if Condominium is Suspended
                                } elseif ($user['role'] == "Administrator") 
                                {
                                    $error_color = '#ff0000'; // Red for Administrator if Condominium is Suspended
                                }
                            } 
                            else 
                            {
                                $error_color = '#ff0000'; // Red for non-existing account
                            }

                            echo "<p class='error'><strong><center><font color='$error_color'>$error_message</font></center></strong></p>";
                        }
                    ?>

                    <div class="form-group">
                        <center><input type="submit" class="form-control button" name="add_submit" value="Login"></button></center>
                    </div>

                    <div class="link login-link text-center"><a href="forgotPassword/forgot-password.php">Forgot Password?</a></div>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['email_2fa'])) { ?>
    <div class="modal" id="email2faModal" tabindex="-1" role="dialog" aria-labelledby="email2faModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="email2faModalLabel">Email OTP Verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>The OTP code has been sent to your email address. Please enter the code below:</p>
                    <label for="email2faInput"><strong>OTP Code:</strong></label>
                    <input type="text" class="form-control" id="email2faInput" name="email2faInput" required>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn-secondary" onclick="generateNewOTP()">New OTP Code</button>-->
                    <button type="button" class="btn btn-primary" onclick="verifyEmail2FA()">Verify OTP Code</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generateNewOTP() 
        {
            location.reload();
        }
        function verifyEmail2FA() {
            var enteredCode = document.getElementById("email2faInput").value.trim();

            if (enteredCode === '') {
                alert('Please enter the OTP code sent from the email.');
            } else if (enteredCode === '<?= $_SESSION['email_2fa'] ?>') {
                window.location.href = '<?= $dashboard_url ?>';
            } else {
                alert('Wrong OTP code! Please try again.');
            }
        }

        function generateNewEmail2FACode() {
            // You can implement the logic to resend the email with a new code here
            alert('New OTP code sent to your email.');
        }

        $(document).ready(function () {
            $("#email2faModal").modal({ backdrop: 'static', keyboard: false });
        });
    </script>
<?php } ?>
</body>
</html>