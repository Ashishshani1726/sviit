<?php 
include("config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$email = $_POST['email'];
$otp = $_POST['otp'];
if (empty($email) || empty($otp)) {
    $output = "<div class='alert alert-danger'>All fields are requried.</div>";
} else {

    $sql = "SELECT user_email FROM users WHERE user_email = '{$email}'";
        $result = mysqli_query($conn, $sql) or die("Query failed.");
     
        if(mysqli_num_rows($result) >0){
            
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com;';
            $mail->SMTPAuth = true;
            $mail->Username = '<email>';
            $mail->Password = '<password>';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('<email>', 'SVIIT');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'SVIIT Registration';
            $mail->Body = "<b style='color:blue;font-size: 15px;'><br />You varification code is </b><br /><b style='color:red;font-size:20px'>" . $otp . "</b>";
            $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            $output = '<div style="font-size:14px;color:red;">OTP has been sent to your email...</div>';
            } catch (Exception $e) {
                $output = '<div>Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
            
        }else{
                $output= "<div class='alert alert-danger'>Email not register..</div>";
            }
}
// $output .= $email;
echo $output;
?>
