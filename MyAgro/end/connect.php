<?php 
    session_start();
    require ('db_connect.php');  
    date_default_timezone_set('Asia/Colombo');
    
    // registration manage here
    if(isset($_POST['register'])){
        $usertype = $_POST['usertype'];    
        $email = $_SESSION['email'];
        $yourname = $_SESSION['yourname'];
        
        echo $usertype;
                echo $email;
                echo $yourname;
        
        // identify user type
        switch($usertype){


            // customer registration
            case "customer":  
    
                $username = $_POST['username'];
                $password = $_POST['password'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                
                if (!empty($yourname) && !empty($username) && !empty($password) && !empty($address) && !empty($email) && !empty($phone)) {
                    
                    $hash_password = password_hash($password, PASSWORD_DEFAULT);      
                    $SELECT = "SELECT username FROM customer WHERE username = ? LIMIT 1";
                    $SELECT1 = "SELECT customer_email FROM customer WHERE customer_email = ? LIMIT 1";
                    $INSERT = "INSERT INTO customer (customer_name, username, password, customer_address, customer_email, customer_telno, create_time) values(?, ?, ?, ?, ?, ?,Now())";
                    
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
                            $stmt->execute();
                            $_SESSION['reg_message'] = "Registered successfully!";
                            $stmt->bind_param("sssssi",$yourname, $username, $hash_password, $address, $email, $phone);
                            $stmt->close();
                            $conn->close();
                            header("Location: customer.php");
                            exit();
                        }else{
                            $_SESSION['reg_message'] = "Someone already register using this username";
                            header("Location: customer.php");
                            exit();
                        }
                    }else{
                        $_SESSION['reg_message'] = "Someone already register using this email";
                        header("Location: customer.php");
                        exit();
                    }
    
                }else{
                    $_SESSION['reg_message'] = "Please customer fill the all input field";
                    header("Location: customer.php");
                    exit();  
                }
                
    
            // farmer registration send as request
            case "farmer":
                
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                $nic = $_POST['nic'];
                $address = $_POST['address'];
                $phone = $_POST['phone'];
                $proof = $_FILES['image']['name'];
    
                if(!empty($yourname) || !empty($username) || !empty($password) || !empty($nic) || !empty($address) || !empty($email) || !empty($phone) || !empty($proof)){
    
                    $hash_password = password_hash($password, PASSWORD_DEFAULT);  
                    $SELECT = "SELECT username FROM farmer WHERE username = ? LIMIT 1";
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
                                            $stmt->bind_param("sssssssis", $yourname, $username, $hash_password, $usertype, $nic, $address, $email, $phone, $proof);
                                            $stmt->execute();
                                            move_uploaded_file($_FILES['image']['tmp_name'], "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\images\\reg/$proof");
                                            $_SESSION['reg_message'] = "Request sent successfully!";
                                            $stmt->close();
                                            $conn->close();
                                            header("Location: farmer.php");
                                            exit();
                                            
                                        }else{
                                            $_SESSION['reg_message'] = "Someone already register using this username";
                                            header("Location: farmer.php");
                                            exit();
                                            
                                        }
                                    }else{
                                        $_SESSION['reg_message'] = "someone already register using this email";
                                        header("Location: farmer.php");
                                        exit();
                                        
                                    }
                                }else{
                                    $_SESSION['reg_message'] = "Someone already register using this NIC";
                                    header("Location: farmer.php");
                                    exit();
                                    
                                }
                            }else{
                                $_SESSION['reg_message'] = "This NIC is already taken";
                                header("Location: farmer.php");
                                exit();
                                
                            }
                        }else{
                            $_SESSION['reg_message'] = "This email is already taken";
                            header("Location: farmer.php");
                            exit();
                            
                        }
                    }else{
                        $_SESSION['reg_message'] = "This username is already taken";
                        header("Location: farmer.php");
                        exit();  
                    }
                    
                }else{
                    $_SESSION['reg_message'] = "Please fill the all input field";
                    header("Location: farmer.php");
                    exit();  
                }
    
            // supplier registration send as request
            case "supplier":
    
                $username = $_POST['username'];
                $password = $_POST['password'];
                $nic = $_POST['nic'];
                $address = $_POST['address'];
                $shop_name = $_POST['shop_name'];
                $phone = $_POST['phone'];
                $proof = $_FILES['image']['name'];
    
                if(!empty($yourname) || !empty($username) || !empty($password) || !empty($nic) || !empty($address) || !empty($shop_name) || !empty($email) || !empty($phone) || !empty($proof)){
    
                    $hash_password = password_hash($password, PASSWORD_DEFAULT);
                    $SELECT = "SELECT username FROM supplier WHERE username = ? LIMIT 1";
                    $SELECT1 = "SELECT supplier_email FROM supplier WHERE supplier_email = ? LIMIT 1";
                    $SELECT2 = "SELECT supplier_nic FROM supplier WHERE supplier_nic = ? LIMIT 1";
                    $SELECT3 = "SELECT username FROM request WHERE username = ? LIMIT 1";
                    $SELECT4 = "SELECT user_email FROM request WHERE user_email = ? LIMIT 1";
                    $SELECT5 = "SELECT nic_number FROM request WHERE nic_number = ? LIMIT 1";
    
    
                    $INSERT = "INSERT INTO request (your_name, username, user_password, user_type, nic_number, user_address, user_email, tel_no, proof_image, shop_name) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    
                    // prepare statment
                    // verify supplier username in supplier table
                    $stmt = $conn->prepare($SELECT);
                    $stmt->bind_param("s", $username);
                    $stmt->execute();
                    $stmt->bind_result($username);
                    $stmt->store_result();
                    $rnum = $stmt->num_rows;
    
                    // verify supplier email in supplier table
                    $stmt1 = $conn->prepare($SELECT1);
                    $stmt1->bind_param("s", $email);        
                    $stmt1->execute();           
                    $stmt1->bind_result($email);         
                    $stmt1->store_result();           
                    $rnum1 = $stmt1->num_rows;
    
                    // verify supplier NIC in supplier table
                    $stmt2 = $conn->prepare($SELECT2);
                    $stmt2->bind_param("i", $nic);
                    $stmt2->execute();
                    $stmt2->bind_result($nic);
                    $stmt2->store_result();
                    $rnum2 = $stmt2->num_rows;
    
                    // verify supplier username in request table
                    $stmt3 = $conn->prepare($SELECT3);
                    $stmt3->bind_param("s", $username);        
                    $stmt3->execute();           
                    $stmt3->bind_result($username);         
                    $stmt3->store_result();           
                    $rnum3 = $stmt3->num_rows;
    
                    // verify supplier email in request table
                    $stmt4 = $conn->prepare($SELECT4);
                    $stmt4->bind_param("s", $email);
                    $stmt4->execute();
                    $stmt4->bind_result($email);
                    $stmt4->store_result();
                    $rnum4 = $stmt4->num_rows;
    
                    // verify supplier nic in request table
                    $stmt5 = $conn->prepare($SELECT5);
                    $stmt5->bind_param("i", $nic);
                    $stmt5->execute();
                    $stmt5->bind_result($nic);
                    $stmt5->store_result();
                    $rnum5 = $stmt5->num_rows;
    
                    // check user issue
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
                                            $stmt->bind_param("sssssssiss", $yourname, $username, $hash_password, $usertype, $nic, $address, $email, $phone, $proof, $shop_name);
                                            $stmt->execute();
                                            move_uploaded_file($_FILES['image']['tmp_name'], "D:\\a XAmpp projec\\htdocs\\Agricultural-Support-Service-System\\MyAgro\\admin\\images\\reg/$proof");
                                            $_SESSION['reg_message'] = "Request sent successfully!";
                                            $stmt->close();
                                            $conn->close();
                                            header("Location: supplier.php");
                                            exit();
                                            
                                        }else{
                                            $_SESSION['reg_message'] = "Someone already register using this username";
                                            header("Location: supplier.php");
                                            exit();
                                            
                                        }
                                    }else{
                                        $_SESSION['reg_message'] = "someone already register using this email";
                                        header("Location: supplier.php");
                                        exit();
                                        
                                    }
                                }else{
                                    $_SESSION['reg_message'] = "Someone already register using this NIC";
                                    header("Location: supplier.php");
                                    exit();
                                    
                                }
                            }else{
                                $_SESSION['reg_message'] = "This NIC is already taken";
                                header("Location: supplier.php");
                                exit();
                                
                            }
                        }else{
                            $_SESSION['reg_message'] = "This email is already taken";
                            header("Location: supplier.php");
                            exit();
                            
                        }
                    }else{
                        $_SESSION['reg_message'] = "This username is already taken";
                        header("Location: supplier.php");
                        exit();  
                    }
                    
                }else{
                    $_SESSION['reg_message'] = "Please fill the all input field";
                    header("Location: supplier.php");
                    exit();  
                }
    
        }
    }
    
    // user login manage here
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) && empty($password)){
            $_SESSION['login_message'] = "Please fill the all input field";
            header("Location: login.php");
            exit();

        }else if(($_POST['usertype'])=="farmer" || ($_POST['usertype'])=="supplier" || ($_POST['usertype'])=="customer"){
            
            $usertype = $_POST['usertype']; 

            // $sql = "SELECT * FROM $usertype WHERE username = '$username' AND password = '$password'";
            $sql = "SELECT * FROM $usertype WHERE username = '$username'";

            $query_run = mysqli_query($conn, $sql);

            if(mysqli_num_rows($query_run) >  0){

                $row = mysqli_fetch_assoc($query_run);

                $hash_password = $row['password'];

                if(!password_verify($password, $hash_password)){
                    $_SESSION['login_message'] = "Invalid username or password";
                    header("Location: login.php");
                    exit();
                }

                if($usertype == 'farmer'){

                    if($row['farmer_status'] == 0){

                        $_SESSION['login_id'] = $row['farmer_id'];    
                    }else{
                        $_SESSION['login_message'] = "Your account has been hold temporarily by admin, please contact us for more information";
                        header("Location: login.php");
                        exit();
                    }

                }elseif($usertype == 'supplier'){

                    if($row['supplier_status'] == 0){

                        $_SESSION['login_id'] = $row['supplier_id'];
                    }else{
                        $_SESSION['login_message'] = "Your account has been hold temporarily by admin, please contact us for more information";
                        header("Location: login.php");
                        exit();
                    }

                }elseif($usertype == 'customer'){

                    if($row['customer_status'] == 0){

                        $_SESSION['login_id'] = $row['customer_id'];
                    }else{
                        $_SESSION['login_message'] = "Your account has been hold temporarily by admin, please contact us for more information";
                        header("Location: login.php");
                        exit();
                    }

                }
                $_SESSION['login_user'] = $row['username'];
                $_SESSION['login_type'] = $usertype;
                $_SESSION['home_message'] = "Login successfull";
                
                if(isset($_SESSION['login_url'])){
                    $login_url = $_SESSION['login_url'];
                    unset($_SESSION['login_url']);
                    header("Location: $login_url");
                }else{
                    header("Location: index.php");
                }
                exit();  

            }else{
                $_SESSION['login_message'] = "Invalid username or password";
                header("Location: login.php");
                exit();
            }

        }else{
            $_SESSION['login_message'] = "Please select your user type";
            header("Location: login.php");
            exit();
        }
    }

    // CDM payment confirm
    if (isset($_POST['confirm_btn'])) {

        $ref = $_SESSION['ref'];
        $sqln = "UPDATE `transaction` SET `payment_status`='Pending' WHERE `Reference_id` = '$ref'";
        $result = mysqli_query($conn, $sqln);

        if ($result) {
            if($_SESSION['category'] == "chemical"){
                $type = $_SESSION['agro_type'];
                $_SESSION['home_message'] = "Your order placed successfull";
                header("Location: chemicalsell.php?type=$type");
                exit(0);
            }elseif($_SESSION['category'] == "fertilizer"){
                $type = $_SESSION['agro_type'];
                $_SESSION['home_message'] = "Your order placed successfull";
                header("Location: agrosell.php?type=$type");
                exit(0);    
            }else if($_SESSION['category'] == "vegetable"){
                $_SESSION['vegetable_sell'] = "Your order placed successfull";
                header("Location: productSell.php");
                exit(0);
            }
        } else {
            $_SESSION['cdm_message'] = "Your order placed failed";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    // redirect to index page
    if (
        !isset($_POST["register"]) &&
        !isset($_POST["login"]) &&
        !isset($_POST["confirm_btn"])
    ) {
        header('Location: index.php');
        exit(0);
    }
    
?>
