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
                $usertype = "farmer";
                break;

            // supplier registration   
            case "supplier":
                $usertype = "supplier";
                break;

        }

    }
    
?>