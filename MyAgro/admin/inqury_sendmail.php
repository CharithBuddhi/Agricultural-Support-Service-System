<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST["inqury_submit"])){

    $id = $_POST["id"];
    $username = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output

        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->Username   = 'cbuddhika305@gmail.com';                     //SMTP username
        $mail->Password   = 'mygmqdqkxqtplrbr';                               //SMTP password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //change encryption method TLS and port 587. ENCRYPTION_SMTPS - 465 Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('cbuddhika305@gmail.com', 'MyAgro Pvt.Ltd.');
        $mail->addAddress($email, 'MyAgro Pvt.Ltd.User');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Replay for the '.$subject.'';
        $mail->Body    = '<h4>Dear '.$username.',</h4>
            <p>We are so thrilled you contacted MyAgro!</p>
            <p>'.$message.'</p>
            <p>Thank you and good day.</p>';

        // if send successfully  mail     
        if($mail->send()){
            $_SESSION['status'] = "Email has been sent successfully ";  
            require('db_conn.php');
            $result = mysqli_query($conn,"UPDATE `inquiry` SET `inquire_status`='0' WHERE notify_id = '$id'");
            header("Location: inquiry.php");    //redirect previous web page 
            exit(0);
        }else{
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";  
            header("Location: inquiry.php");
            exit(0);
        }

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}else{
    header('Location: staff.php');
    exit(0);
}

?>