<?php 
session_start();

include('../includes/database.php');

$email = "";
$name = "";
$errors = array();

    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($mysqli, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE otp_code = $otp_code";
        $code_res = mysqli_query($mysqli, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['otp_code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'otp_verified';
            $update_otp = "UPDATE users SET otp_code = $code, otp_verified = '$status' WHERE otp_code = $fetch_code";
            $update_res = mysqli_query($mysqli, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: ../index.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($mysqli, $_POST['email']);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $run_sql = mysqli_query($mysqli, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE users SET otp_code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($mysqli, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: adm1nplk2022@yahoo.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "Please wait for 2 minutes to receive the OTP code sent at $email.";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    mail($email, $subject, $message, $sender);
                    //$errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($mysqli, $_POST['otp']);
        $check_code = "SELECT * FROM users WHERE otp_code = $otp_code";
        $code_res = mysqli_query($mysqli, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($mysqli, $_POST['password']);
        $cpassword = mysqli_real_escape_string($mysqli, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $update_pass = "UPDATE users SET otp_code = $code, password = '$password' WHERE email = '$email'";
            $run_query = mysqli_query($mysqli, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }
    
   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: ../index.php');
    }
?>