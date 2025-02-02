<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyAgro Privt Limited</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="z-50 flex p-2 border-b-2 shadow-2xl h-14 border-slate-300">
        <div class="grow">
            <a href="index.php" class="font-serif text-3xl font-bold  text-transparent bg-clip-text bg-[#73F80B]">MyAgro</a>
        </div>
        <ul class="flex justify-end gap-5 py-2 font-serif text-1xl">
            <li>
                <a href="index.php" class="">Home</a>
            </li>
            <li>
                <a href="productSell.php" class="" title="Find vegetables and fruits product here">Product</a>
            </li>
            <li>
                <a href="typeagrochemical.php" class="" title="Find agrochemicals and fertilizers product here">Agrochemicals</a>
            </li>
            <li>
                <a href="techno.php" class="" title="Find agricultural related new techniques here">New Technology</a>
            </li>
            <li>
                <a href="verities.php" class="" title="Find different varieties of vegetables and fruits here">Varieties of Product</a>
            </li>
            <li>
                <a href="nutrients.php" class="" title="Find normal nutrients of vegetables and fruits here">Nutrients of Product</a>
            </li>
            <li>
                <a href="faqs.php" class="" title="Find your common queastion answer here">FAQs</a>
            </li>
            <li>
                <a href="contactUs.php" class="" title="Find our contact details,inquiry here">Contact Us</a>
            </li>
            
            <?php

                include 'db_connect.php';

                if(isset($_SESSION['login_user'])) {
                    $username = $_SESSION['login_user'];
                    $usertype = $_SESSION['login_type'];
                    
                    ?>
                    <li>
                        <button id="menubar_btn" class="relative flex items-center justify-center rounded-full cursor-pointer bottom-2 h-fit w-fit bg-slate-200">
                            <?php
                                $sql = "SELECT images FROM $usertype WHERE username = '$username'";
                                $query_run = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($query_run);
                                $image = $row['images'];

                                if($image != NULL) {
                                    ?>
                                    <img src="images/user/<?php echo $image; ?>" class="w-10 h-10 border-2 rounded-full border-slate-300" alt="image">
                                    <?php

                                }else{
                                    ?>
                                    <h1 class=" flex justify-center items-center text-[#73F80B] text-xl font-bold w-8 h-8 text-center "><?php echo strtoupper($username[0]); ?></h1>
                                <?php
                                } 
                            ?>   
                        </button>
                    </li>
                    <?php

                }else {
                    ?>

                    <li>
                        <a href="customer.php" class="" title="You don't have an account? Register here">Register</a>
                    </li>
                    <li>
                        <a href="login.php" class="" title="Do you have an account? Login here">Login</a>
                    </li>

                    <?php
                }
            ?>       
        </ul>
    </nav>

    <!--user menu bar -->
    <div id="menubar" class="fixed inset-0 " style="display: none;"> 
        <div class="p-4 rounded-xl fixed border shadow-2xl border-slate-300 bg-[#fefefe] text-black top-11 right-3 w-[270px]">

            <!-- Modal Body -->
            <div class="flex flex-col items-center justify-center">
            <?php
                    if($image != NULL) {
                        ?>
                        <img src="images/user/<?php echo $image; ?>" alt="image" class="w-24 h-24 border-2 rounded-full border-slate-300">
                        <?php
                    }else{
                        ?>
                        <h1 class=" flex justify-center items-center font-serif bg-slate-200 text-[#73F80B] rounded-full text-5xl font-bold w-24 h-24 text-center "><?php echo strtoupper($username[0]); ?></h1>
                    <?php
                    } 
                ?>
            </div>
            <div class="flex flex-col mt-5">
                <label class="pl-2">Type : <?php echo $usertype; ?></label>
                <label class="pl-2">Username : <?php echo $username; ?></label>
            </div>

            <div class="flex flex-col mt-5 gap-0.5 border-t-2 border-slate-300">
                <?php
                    if($usertype == 'supplier') {
                        ?>
                        <a href="supplier_dashboard.php" class="pl-2 mt-1 rounded-md hover:bg-blue-300">Profile</a>
                        <?php
                    }else if($usertype == 'farmer') {
                        ?>
                        <a href="farmer_dashboard.php" class="pl-2 mt-1 rounded-md hover:bg-blue-300">Profile</a>
                        <?php
                    }else{
                        ?>
                        <a href="customer_dashboard.php" class="pl-2 mt-1 rounded-md hover:bg-blue-300">Profile</a>
                        <?php
                    }
                    ?>
                <a href="login.php" class="pl-2 rounded-md hover:bg-blue-300">Switch Account</a>   
                <a href="logout.php" class="pl-2 rounded-md hover:bg-blue-300">Log Out</a>
            </div>

        </div>
    </div>

    <!-- user menu bar popup and hide -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            <?php 
                if(isset($_SESSION['login_user'])) {
                    ?>

                    const modal = document.getElementById("menubar"); // The modal element
                    const show_btn =document.getElementById("menubar_btn");

                    show_btn.onclick = function() {
                        if(modal.style.display === "block") {
                            modal.style.display = "none";
                        }else {
                            modal.style.display = "block";
                        }
                    }

                    // When the user clicks anywhere outside of the modal, close it
                    window.onclick = function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    }
                <?php
                }
            ?>
        });
    </script>

</body>
</html>