<?php 
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $otp = rand(100, 9999);
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    // send otp code for registration user
    if(isset($_POST['email_btn'])){

        $email = $_POST['email'];
        $yourname = $_POST['yourname'];

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
            $mail->Subject = 'Let\'s get you verified.';
            $mail->Body    = '<h1>Your OTP number is '.$otp.'</h1>
                <h3>Welcome to MyAgro'.$yourname.'!</h3>
                <h4>We are so thrilled you decided to join MyAgro!</h4>
                <h4>All you need to do now is use the verification code in the app to confirm the email.</h4>
                <p>If you did not request this code, you can safely ignore this email. Someone might have typed your email address by mistake.</p>
                <p>Thank you, MyAgro Team.</p>
            ';
    
            if($mail->send()){
                $_SESSION['email'] = $email;
                $_SESSION['otp'] = $otp;
                $_SESSION['yourname'] = $yourname;
                $_SESSION['reg_message'] = "Email has been sent successfully";
                header("Location: {$_SERVER["HTTP_REFERER"]}?email={$email}&yourname={$yourname}");
                exit();
    
            }else{
                $_SESSION['reg_message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                header("Location: {$_SERVER["HTTP_REFERER"]}");
                exit(0);
            }
                
                
        } catch (Exception $e) {
            $_SESSION['reg_message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
    }

    // send otp code for frogot password
    if(isset($_POST['froget_password_mail'])){
        
        $email = $_POST['froget_mail'];

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
            $mail->Subject = 'Let\'s get change your password.';
            $mail->Body    = '<h1>Your OTP number is '.$otp.'</h1>
                <h4>Enter this Once Time Password number in the OTP verification section and click the check button. Please remember your new password.</h4>
                <h4>If you did not request this code, you can safely ignore this email. Someone might have typed your email address by mistake.</h4>
                <p>Thank you, MyAgro Team.</p>
            ';
    
            if($mail->send()){
                $_SESSION['froget_email_send'] = $email;
                $_SESSION['froget_otp_send'] = $otp;
                $_SESSION['login_message'] = "Email has been sent successfully";
                header("Location: {$_SERVER["HTTP_REFERER"]}");
                exit();
    
            }else{
                $_SESSION['login_message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                header("Location: {$_SERVER["HTTP_REFERER"]}");
                exit(0);
            }
                
                
        } catch (Exception $e) {
            $_SESSION['login_message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            header("Location: {$_SERVER["HTTP_REFERER"]}");
            exit(0);
        }
    }


?>