<?php
include("config.php");
ob_start();
session_start();
    $cpassword = strip_tags($_POST['cpassword']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags(md5($_POST['password']));
    $check_pass = strip_tags($_POST["password"]);
    $otp = strip_tags($_POST['otp']);
    $genOtp = strip_tags($_POST['genOtp']);
    $output = "";
    if (empty($cpassword) || empty($email) || empty($password) || empty($otp) || empty($genOtp)) {
    $output = "<div class='alert alert-danger'>All fields are requried.</div>";
    }else if($otp == $genOtp){
        if($cpassword == $check_pass){
            $sql = "SELECT user_id FROM users WHERE user_email = '{$email}'";
            $result = mysqli_query($conn, $sql) or die("Query failed.");
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                $sql1 = "UPDATE users SET user_password='{$password}' WHERE user_id = '{$row[0]}'";
                if (mysqli_query($conn, $sql1)) {
                    $output = "success";
                }else{ 
                    $output = "<div class='alert alert-danger'>Can't change password.</div>".$row[0];
                }
            }else{
                $output = "<div class='alert alert-danger'>Can't change password.</div>";
            }
        }else{
            $output = "<div class='alert alert-danger'>Password doesn't matched.</div>";
        
        }
    }else{
        $output = "<div class='alert alert-danger'>OTP not matched.</div>";
    }

echo $output;
?>
