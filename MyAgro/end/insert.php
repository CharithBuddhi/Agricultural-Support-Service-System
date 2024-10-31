<!-- insert inqury data in to database -->
<?php 
session_start();
require('db_connect.php');

if(isset($_POST['contact_submit'])){

    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){
        
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        
        $sql = "INSERT INTO `inquiry`(`notify_name`, `notify_email`, `notify_subject`, `notify_msg`) VALUES ('$name','$email','$subject','$message')";
        $result = mysqli_query($conn, $sql);

        if($result){
            $_SESSION['status'] = "Inquiry has been sent successfully ";
            header("Location: contactUs.php");     
            exit(0);
        }else{
            $_SESSION['status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";  
            header("Location: contactUs.php");
            exit(0);
        }
        
    }else{
        $_SESSION['status'] = "Please fill all the fields";
        header("Location: contactUs.php");     
        exit(0);
    }
}
?>