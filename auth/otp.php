<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

$name = $_POST['name'];
$email = $_POST['email'];
$otp = $_POST['otp'];
if (empty($name) || empty($email) || empty($otp)) {
    $output = "<div class='alert alert-danger'>All fields are requried.</div>";
} else {

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com;';
        $mail->SMTPAuth = true;
        $mail->Username = 'kishan2764@gmail.com';
        $mail->Password = 'hfjetwquqxtyawuv';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('kishan2764@gmail.com', 'SVIIT');
        $mail->addAddress($email, $name);
        // $mail->addAddress('receiver2@gfg.com', 'Name');

        $mail->isHTML(true);
        $mail->Subject = 'SVIIT Registration';
        $mail->Body = "<b style='color:black;font-size: 15px;'>Hi, " . ucwords($name) . "</b><b style='color:blue;font-size: 15px;'><br />You varification code is </b><br /><b style='color:red;font-size:20px'>" . $otp . "</b>";
        $mail->AltBody = 'Body in plain text for non-HTML mail clients';
        $mail->send();
        $output = '<div style="font-size:14px;color:red;">OTP has been sent to your email...</div>';
    } catch (Exception $e) {
        $output = '<div>Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
// $output .= $email;
echo $output;
?>