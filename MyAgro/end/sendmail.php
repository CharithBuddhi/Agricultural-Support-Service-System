<?php 
session_start();

//registration.js file sending object catching 
if(isset($_POST)){

    $data = file_get_contents("php://input");
    $user = json_decode($data,true);
    $usname = $user["username"];
    $email = $user["email"];
    $otp = $user["otp"];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through                                  
    $mail->Username   = 'cbuddhika305@gmail.com';                     //SMTP username (Gmail app username)
    $mail->Password   = 'mygmqdqkxqtplrbr';                               //SMTP password (Gmail app password)
        
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //ENCRYPTION_SMTPS 465 -  Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('cbuddhika305@gmail.com', 'MyAgro Pvt.Ltd.');
    $mail->addAddress($email, 'MyAgro Pvt.Ltd.User');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'OTP verification number of MyAgro';
    $mail->Body    = '<h2>Your OTP number is '.$otp.'</h2>
        <h3>Welcome to MyAgro</h3>
        <h4>We are so thrilled you decided to join MyAgro!</h4>
        <h4>All you have to do now is use the confirmation code in the app to complete the request.</h4>
        <p>Then enter your phone number and business registration certificate and make the request.
        If you did not request this code, you can safely ignore this email. Someone might have typed your email address by mistake.</p>
        <pre>Thank you,
    MyAgro Team.</pre>
    ';

    if($mail->send()){
        $_SESSION['status'] = "Email has been sent successfully";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }else{
        $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        header("Location: {$_SERVER["HTTP_REFERER"]}");
        exit(0);
    }
        
        
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>