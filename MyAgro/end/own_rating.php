<?php session_start();
if(!isset($_SESSION['login_id']) && !isset($_SESSION['login_user']) && !isset($_SESSION['login_type'])){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>User Rating</title>
</head>
<body>
    <?php require('user_header.php'); ?>
    
    <div class="w-screen h-screen">

        <h1 class="h-8 ml-8 font-serif text-3xl font-bold mt-7 w-fi">Rating Details</h1>
        <div class="flex flex-col items-center h-full mt-4">

            <?php 
                require('db_connect.php');

                $provider = $_GET['id'];
                $provider_type = $_GET['type'];

                if($provider_type == "supplier"){

                    $query = "SELECT username,images FROM $provider_type WHERE supplier_id = $provider ";

                }else if($provider_type == "farmer"){

                    $query = "SELECT username,images FROM $provider_type WHERE farmer_id = $provider ";
                    
                }
                $result = mysqli_query($conn, $query);
                
                if($result){
                    
                    $row = mysqli_fetch_assoc($result);

                    $username = $row['username'];
                    $images = $row['images'];
                    if($images == ""){
                        ?>
                            <div >
                                <h1 class="text-6xl font-bold text-center bg-slate-200 w-[150px] h-[150px] flex items-center justify-center rounded-full">
                                    <?php 
                                        $letter = str_split($username); 
                                        echo ucfirst($letter[0]);
                                    ?>
                                </h1> 
                            </div>
                        <?php
                    }else{
                        ?>
                        <img src="images/user/<?php echo $images; ?>" alt="user_image" class="w-[150px] h-[150px] rounded-full">
                    <?php
                    }
                ?>
                    <p class="mt-2">Your Name: 
                       <label class="text-lg font-bold"><?php echo ucfirst($username); ?></label>
                    </p>
                    
                <?php
                }
            ?>
            
            <h1 class="h-6 mt-4 mb-3 ml-8 text-2xl font-bold w-fi">Customer Rating</h1>
            <div class="flex justify-center w-full">

                <div class="flex flex-wrap justify-center w-full gap-8 mt-5 pl-14 pr-14">

                    <?php 
                        
                        $query = "SELECT * FROM rating_provider WHERE provider = '$provider' AND provider_type = '$provider_type' ";
                        $result = mysqli_query($conn, $query);
                        if($result){
                            while($row = mysqli_fetch_assoc($result)){
                                $rate_value = $row['rate_value'];
                                $customer_name = ucfirst($row['customer_name']);
                                $description = $row['description'];
                            ?>
                                <div class="flex flex-col flex-wrap w-[400px] border-2 border-slate-300 rounded-lg p-2">
                                    <!-- Rating star colors here -->
                                    <div class="flex gap-1">
                                        <?php
                                            for($i = 1; $i <= $rate_value; $i++){
                                        ?>
                                            <span id="rate_<?php echo $i; ?>" class="text-4xl text-yellow-400 cursor-pointer">&#9733;</span>
                                        <?php
                                        } 
                                            for($i = $rate_value + 1; $i <= 5; $i++){
                                        ?>  
                                            <span id="rate_<?php echo $i; ?>" class="text-4xl text-gray-400 cursor-pointer">&#9733;</span>
                                        <?php
                                        }
                                        ?>
                                    </div>

                                    <p class="pl-1 font-bold"><?php echo $customer_name; ?></p>
                                    
                                    <label class="pl-1"><?php echo $description; ?></label>

                                </div>

                            <?php
                            }
                        }else{
                            ?>
                                <h1 class="w-full mt-2 text-4xl font-semibold text-center text-black">This user has no rating</h1>
                            <?php
                        }
                    ?>

                </div>

            </div>

        </div>

    </div>

</body>
</html>