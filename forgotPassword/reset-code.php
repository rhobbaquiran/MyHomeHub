<?php require_once "controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/style.css">
    <script>
        // Disable the back button to stay on the reset-code.php page
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <?php
                if (!isset($_SESSION['email'])) {
                    header('Location: reset-code.php');
                    exit();
                }
                ?>
                <form action="reset-code.php" method="POST" autocomplete="off">
                    <h2 class="text-center">Code Verification</h2>
                    <?php 
                    if(isset($_SESSION['info'])){
                        $alertClass = 'alert-success';
                        if(count($errors) > 0){
                            $alertClass = 'alert-danger';
                        }
                        ?>
                        <div class="alert <?php echo $alertClass; ?> text-center" style="padding: 0.4rem 0.4rem">
                            <?php echo $alertClass === 'alert-danger' ? implode("<br>", $errors) : $_SESSION['info']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-reset-otp" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
