<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Password Change Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/style.css">

    <!-- Custom style for the button -->
    <style>
    .button {
        background: #084cb4 !important;
        color: white !important;
    }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <div class="alert alert-success text-center">
                    <?php
                    // Display success message
                    session_start(); // Start the session
                    if (isset($_SESSION['info'])) {
                        echo $_SESSION['info'];
                        unset($_SESSION['info']); // Remove the session variable to prevent showing the message again
                    } else {
                        // If somehow the session info is not set, display a generic success message
                        echo "You've successfully changed your Password!";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <center><button class="form-control button" onclick="redirectToLogin()">Back to Login</button></center>
                </div>
            </div>
        </div>
    </div>

    <script>
        function redirectToLogin() {
            // Use window.location.replace() to replace the current page in the browser history
            window.location.replace('../index.php');
        }
    </script>
</body>
</html>