<?php 
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "myagro";
    
    // create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if(!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }else{

        // get user type
        $usertype = $_POST['usertype'];

        // identify user type
        switch($usertype){
            // customer registration
            case "customer":  
                $yourname = $_POST['yourname'];
                $username = $_POST['username'];
                $password = $_POST['password'];      
                $address = $_POST['address'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];

                if(!empty($yourname) || !empty($username) || !empty($password) || !empty($address) || !empty($email) || !empty($phone)){

                    $SELECT = "SELECT customer_uname FROM customer WHERE customer_uname = ? LIMIT 1";
                    $SELECT1 = "SELECT customer_email FROM customer WHERE customer_email = ? LIMIT 1";
                    $INSERT = "INSERT INTO customer (customer_name, customer_uname, customer_password, 	customer_address, customer_email, customer_telno) values(?, ?, ?, ?, ?, ?)";
                    
                    // prepare statment
                    $stmt = $conn->prepare($SELECT);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($username);
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;

                    $stmt1 = $conn->prepare($SELECT1);
                    $stmt1->bind_param("s", $email);        
                    $stmt1->execute();           
                    $stmt1->bind_result($email);         
                    $stmt1->store_result();           
                    $rnum1 = $stmt1->num_rows;
                    
                    if ($rnum1==0) {
                        if($rnum==0){
                            $stmt->close();
                            $stmt1->close();
                            $stmt = $conn->prepare($INSERT);
                            $stmt->bind_param("sssssi", $yourname, $username, $password, $address, $email, $phone);
                            $stmt->execute();
                            echo "alert('Registered successfully!')";
                        }else{
                            echo "Someone already register using this username";
                        }
                    }else{
                        echo "alert('Someone already register using this email')"; //Someone already register using this email";
                    }
                    $stmt->close();
                    $conn->close();
                }
                break;

            // farmer registration
            case "farmer":
                
                $yourname = $_POST['yourname'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $usertype = "farmer";
                $nic = $_POST['nic'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $proof = $_FILES['image']['name'];

                echo $proof;

                if(!empty($yourname) || !empty($username) || !empty($password) || !empty($nic) || !empty($address) || !empty($email) || !empty($phone) || !empty($proof)){

                    $SELECT = "SELECT farmer_username FROM farmer WHERE farmer_username = ? LIMIT 1";
                    $SELECT1 = "SELECT farmer_email FROM farmer WHERE farmer_email = ? LIMIT 1";
                    $SELECT2 = "SELECT farmer_nic FROM farmer WHERE farmer_nic = ? LIMIT 1";
                    $SELECT3 = "SELECT username FROM request WHERE username = ? LIMIT 1";
                    $SELECT4 = "SELECT user_email FROM request WHERE user_email = ? LIMIT 1";
                    $SELECT5 = "SELECT nic_number FROM request WHERE nic_number = ? LIMIT 1";
                    $INSERT = "INSERT INTO request (your_name, username, user_password, user_type, nic_number, user_address, user_email, tel_no, proof_image) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    // prepare statment
                    // verify farmer username in farmer table
                    $stmt = $conn->prepare($SELECT);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($username);
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;

                    // verify farmer email in farmer table
                    $stmt1 = $conn->prepare($SELECT1);
                    $stmt1->bind_param("s", $email);        
                    $stmt1->execute();           
                    $stmt1->bind_result($email);         
                    $stmt1->store_result();           
                    $rnum1 = $stmt1->num_rows;

                    // verify farmer NIC in farmer table
                    $stmt2 = $conn->prepare($SELECT2);
                    $stmt2->bind_param("i", $nic);
                    $stmt2->execute();
                    $stmt2->bind_result($nic);
                    $stmt2->store_result();
                    $rnum2 = $stmt2->num_rows;

                    // verify farmer username in request table
                    $stmt3 = $conn->prepare($SELECT3);
                    $stmt3->bind_param("s", $username);        
                    $stmt3->execute();           
                    $stmt3->bind_result($username);         
                    $stmt3->store_result();           
                    $rnum3 = $stmt3->num_rows;

                    // verify farmer email in request table
                    $stmt4 = $conn->prepare($SELECT4);
                    $stmt4->bind_param("s", $email);
                    $stmt4->execute();
                    $stmt4->bind_result($email);
                    $stmt4->store_result();
                    $rnum4 = $stmt4->num_rows;

                    // verify farmer nic in request table
                    $stmt5 = $conn->prepare($SELECT5);
                    $stmt5->bind_param("i", $nic);
                    $stmt5->execute();
                    $stmt5->bind_result($nic);
                    $stmt5->store_result();
                    $rnum5 = $stmt5->num_rows;


                    if($rnum3==0){
                        if($rnum4==0){
                            if($rnum5==0){
                                if($rnum2==0){
                                    if ($rnum1==0) {
                                        if($rnum==0){
                                            $stmt->close();
                                            $stmt1->close();
                                            $stmt2->close();
                                            $stmt3->close();
                                            $stmt4->close();
                                            $stmt5->close();
                                            $stmt = $conn->prepare($INSERT);
                                            $stmt->bind_param("sssssssis", $yourname, $username, $password, $usertype, $nic, $address, $email, $phone, $proof);
                                            $stmt->execute();
                                            move_uploaded_file($_FILES['image']['tmp_name'], "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\images\\reg/$proof");
                                            echo "<script>openPopup();</script>";
                                            echo "<script>alert('Registered successfully!')</script>";
                                            header('Location: farmer.php');
                                            
                                        }else{
                                            echo "<script> alert('Someone already register using this username') </script>";
                                        }
                                    }else{
                                        echo "<script> alert('someone already register using this email') </script>"; //Someone already register using this email";
                                    }
                                }else{
                                    echo "<script> alert('Someone already register using this NIC') </script>";
                                }
                            }else{
                                echo "<script>alert('This NIC is already taken')</script>";
                            }
                        }else{
                            echo "<script>alert('This email is already taken')</script>";
                        }
                    }else{
                        echo "<script>alert('This username is already taken')</script>";
                    }
                    $stmt->close();
                    $conn->close();
                }
                break;
                

            // supplier registration   
            case "supplier":
                $yourname = $_POST['yourname'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $usertype = "supplier";
                $nic = $_POST['nic'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $proof = base64_decode($_POST['proof']);

                if(!empty($yourname) || !empty($username) || !empty($password) || !empty($nic) || !empty($address) || !empty($email) || !empty($phone) || !empty($proof)){

                    $SELECT = "SELECT farmer_username FROM farmer WHERE farmer_username = ? LIMIT 1";
                    $SELECT1 = "SELECT farmer_email FROM farmer WHERE farmer_email = ? LIMIT 1";
                    $INSERT = "INSERT INTO request (your_name, username, user_password, user_type, nic_number, user_address, user_email, tel_no, proof_image) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    // prepare statment
                    $stmt = $conn->prepare($SELECT);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($username);
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;

                    $stmt1 = $conn->prepare($SELECT1);
                    $stmt1->bind_param("s", $email);        
                    $stmt1->execute();           
                    $stmt1->bind_result($email);         
                    $stmt1->store_result();           
                    $rnum1 = $stmt1->num_rows;
                    
                    if ($rnum1==0) {
                        if($rnum==0){
                            $stmt->close();
                            $stmt1->close();
                            $stmt = $conn->prepare($INSERT);
                            $stmt->bind_param("sssssssib", $yourname, $username, $password, $usertype, $nic, $address, $email, $phone, $proof);
                            $stmt->execute();
                            echo "<script>openPopup();</script>";
                            echo "<script>alert('Registered successfully!')</script>";
                            
                        }else{
                            echo "<script> alert('Someone already register using this username') </script>";
                        }
                    }else{
                        echo "<script> alert('someone already register using this email') </script>"; //Someone already register using this email";
                    }
                    $stmt->close();
                    $conn->close();
                }
                break;

        }

    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
<!-- toast massage pop -->
    <div id="popup" class="absolute top-5 h-[75px] right-5 justify-end w-[370px] hidden">
        <div class="flex border-l-8 border-green-400 rounded shadow-xl mt-5 h-[75px] items-center mr-5 w-[370px] bg-white">
            <i class="fas fa-solid fa-check ml-2 rounded-full w-[30px] h-[30px] bg-green-400 align-center items-center justify-center flex text-white"></i>
            <div class="flex flex-col ml-4">
                <label class="font-bold">Successfull</label> 
                <label class="text-sm">Your has been successfully requested</label> 
            </div>
            <div class="absolute top-6 right-2">
                <button type="button" onclick="closePopup()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-500 size-4 hover:text-gray-900">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg> 
                </button>             
            </div>
        </div>
    </div> 

    <!-- remvoe success massage after display -->   
    <script>
        let popup = document.getElementById('popup');

        function openPopup(){
            popup.classList.remove('hidden');
            
        }
        function closePopup(){
            popup.classList.add('hidden');
        }
    </script>
    
</body>
</html>
