<?php
include("config.php");
ob_start();
session_start();


    $name = strip_tags($_POST['name']);
    $email = strip_tags($_POST['email']);
    $password = strip_tags(md5($_POST['password']));
    $otp = strip_tags($_POST['otp']);
    $genOtp = strip_tags($_POST['genOtp']);
    $output = "";
if (empty($name) || empty($email) || empty($password) || empty($otp) || empty($genOtp)) {
    $output = "<div class='alert alert-danger'>All fields are requried.</div>";
}else if($otp == $genOtp){

        $sql = "SELECT user_email FROM users WHERE user_email = '{$email}'";
        $result = mysqli_query($conn, $sql) or die("Query failed.");
     
        if(mysqli_num_rows($result) >0){
            $output= "<div class='alert alert-danger'>Email Already Exists</div>";
        } else {
            $sql1 = "INSERT INTO users (user_name,user_email,user_password)
                 VALUES ('{$name}','{$email}','{$password}')";
            if(mysqli_query($conn,$sql1)) {
                $sql2 = "SELECT user_id,user_name,user_email,role FROM users WHERE user_email = '{$email}'";
                $result1 = mysqli_query($conn, $sql2) or die("Query failed.");
                if(mysqli_num_rows($result1)>0){
                
                    while($row =mysqli_fetch_assoc($result1)){
                        $_SESSION["user_name"] = $row['user_name'];
                        $_SESSION["user_email"] = $row['user_email'];
                        $_SESSION["user_id"] = $row['user_id'];
                        $_SESSION["role"] = $row['role'];
                        $output = "success";
                    } 
                }
            }
        }
        

    }else{
        $output = "<div class='alert alert-danger'>OTP not matched.</div>";
    }
echo $output;
?>