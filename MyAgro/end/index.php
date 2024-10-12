<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyAgro Privt Limited</title>
    <link rel="stylesheet" href="style.css"> 
     
</head>
<body>
    <!-- navigation bar -->
    <?php 
    include('db_connect.php');

    require('header.php');
    
    ?>
    
    <!-- first section in home page -->
    <div class="h-[70vh] p-6 bg-no-repeat bg-cover">
        <img id="dynamicImage" src="images/home9.jpg" alt="" class="w-[100%] h-[100%] object-cover">
        <h2 class="absolute top-[120px] text-5xl text-[#73F80B] font-serif px-2 font-semibold animate-pulse">The only place to sell <br> your products at <br> reasonable prices.</h2>
    </div>
    <div class=" shadow-xl h-[100px] rounded-3xl border-b-2 border-slate-300 relative bottom-[70px] bg-slate-100 w-[50%] ml-[25%]">
        <marquee  behavior="scroll" direction="left" height="120px" width="100%" scrolldelay="1" class="font-serif p-3 text-7xl font-bold text-[#6fff00] ">Welcome to MyAgro</marquee>
    </div>

    <!-- Mostly soled Products section in home page -->
    <div class="flex flex-col ">
        <h1 class="flex justify-center font-serif text-3xl italic font-bold mb-8 ">Mostly soled Product</h1>
        <div class="flex justify-evenly">
            <div  class="font-semibold">
                <img class="w-[280px] h-[250px] border-[3px] shadow-2xl shadow-neutral-600 border-[#BFDC0C] rounded-3xl" src="images/carrot.jpg" alt="carrot">
                <br>
                <div class="flex justify-center mt-3">
                    <label id="productName">Carrot</label>
                </div>
                <div class="flex flex-col gap-4 mt-2">
                    <div>
                        <label>Price :</label>
                        <label>Rs.<label id="productPrice">1500.00</label></label> 
                    </div>
                    <div>
                        <label >Quantity :</label>
                        <label id="productQuantity">25 <label>Kg</label></label>
                    </div>
                    <div>
                        <label >Location :</label>
                        <label id="productLocation">Dehiowita</label>
                    </div>
                </div>
                
            </div>
            <div class="font-semibold">
                <img class="w-[280px] h-[250px] border-[3px] shadow-2xl shadow-neutral-600 border-[#BFDC0C] rounded-3xl" src="images/pineapple.jpg" alt="pineapple">
                <br>
                <div class="flex justify-center mt-3">
                    <label id="productName">Pineapple</label>
                </div>
                <div class="flex flex-col gap-4 mt-2">
                    <div>
                        <label >Price :</label>
                        <label>Rs.<label id="productPrice">1800.00</label></label> 
                    </div>
                    <div>
                        <label >Quantity :</label>
                        <label id="productQuantity">25 <label>Kg</label></label>
                    </div>
                    <div>
                        <label >Location :</label>
                        <label id="productLocation">Dehiowita</label>
                    </div>
                </div>
            </div>
            <div class="font-semibold">
                <img class="w-[280px] h-[250px] border-[3px] shadow-2xl shadow-neutral-600 border-[#BFDC0C] rounded-3xl" src="images/watermelon.jpg" alt="watermelon">
                <br>
                <div class="flex justify-center mt-3">
                    <label id="productName">Watermelon</label>
                </div>
                <div class="flex flex-col gap-4 mt-2">
                    <div>
                        <label >Price :</label>
                        <label>Rs.<label id="productPrice">800.00</label></label> 
                    </div>
                    <div>
                        <label >Quantity :</label>
                        <label id="productQuantity">25 <label>Kg</label></label>
                    </div>
                    <div>
                        <label >Location :</label>
                        <label id="productLocation">Dehiowita</label>
                    </div>
                </div>
            </div>
        </div> 
        <br><br> 
        <a href="productSell.php" class="flex justify-center cursor-pointer w-[200px] self-center text-black font-bold border-[3px] bg-[#ddf2a1] border-[#BFDC0C] rounded-3xl px-4 py-1 mt-2 ">Know more</a>
    </div>

    <!-- Most Demand Agrochemicals section in home page -->
    <div class="flex flex-col">
        <h1 class="flex justify-center mt-16 font-serif text-3xl italic font-bold mb-14">Most Demand Agrochemicals</h1>
        <div class="flex justify-evenly">
            <div  class="flex flex-col items-center font-semibold w-[300px] h-[380px] border-[3px] border-[#BFDC0C] rounded-3xl shadow-2xl shadow-neutral-600">
                <div class="">
                    <img class="w-[250px] h-[210px] py-1 " src="images/fer1.png" alt="fertilizer">
                </div>
                <div class="mt-3 ">
                    <label id="productName">Carrot</label>
                </div>
                <div class="flex flex-col gap-4 px-3 mt-2 place-self-start">
                    <div>
                        <label>Price :</label>
                        <label>Rs.<label id="productPrice">1500.00</label></label> 
                    </div>
                    <div>
                        <label >Quantity :</label>
                        <label id="productQuantity">25 <label>Kg</label></label>
                    </div>
                    <div>
                        <label >Location :</label>
                        <label id="productLocation">Dehiowita</label>
                    </div>
                </div>   
            </div>
            <div  class="flex flex-col items-center font-semibold w-[300px] h-[380px] border-[3px] border-[#BFDC0C] rounded-3xl shadow-2xl shadow-neutral-600">
                <div class="">
                    <img class="w-[250px] h-[210px] py-1 " src="images/fer2.png" alt="fertilizer">
                </div>
                <div class="mt-3 "> <!--flex justify-center-->
                    <label id="productName">Carrot</label>
                </div>
                <div class="flex flex-col gap-4 px-3 mt-2 place-self-start"> <!--  -->
                    <div>
                        <label>Price :</label>
                        <label>Rs.<label id="productPrice">1500.00</label></label> 
                    </div>
                    <div>
                        <label >Quantity :</label>
                        <label id="productQuantity">25 <label>Kg</label></label>
                    </div>
                    <div>
                        <label >Location :</label>
                        <label id="productLocation">Dehiowita</label>
                    </div>
                </div>
                
            </div>
            <div  class="flex flex-col items-center font-semibold w-[300px] h-[380px] border-[3px] border-[#BFDC0C] rounded-3xl shadow-2xl shadow-neutral-600">
                <div class="">
                    <img class="w-[250px] h-[210px] py-1 " src="images/agro.jpg" alt="fertilizer">
                </div>
                <div class="mt-3 "> <!--flex justify-center-->
                    <label id="productName">Carrot</label>
                </div>
                <div class="flex flex-col gap-4 px-3 mt-2 place-self-start"> <!--  -->
                    <div>
                        <label>Price :</label>
                        <label>Rs.<label id="productPrice">1500.00</label></label> 
                    </div>
                    <div>
                        <label >Quantity :</label>
                        <label id="productQuantity">25 <label>Kg</label></label>
                    </div>
                    <div>
                        <label >Location :</label>
                        <label id="productLocation">Dehiowita</label>
                    </div>
                </div>
                
            </div>
        </div>  
        <br><br> 
        <a href="agrosell.php" class="flex justify-center cursor-pointer w-[200px] self-center text-black font-bold border-[3px] bg-[#ddf2a1] border-[#BFDC0C] rounded-3xl px-4 py-1 mt-4 ">View All</a>
    </div>

    <!-- system services in home page -->
    <div class="flex flex-col">
        <h1 class="flex justify-center mt-20 font-serif text-3xl italic font-bold mb-14">Our Services</h1>
        <div class="flex font-bold justify-evenly ">
            <div class="flex flex-col items-center">
                <img src="images/paired.png" class="w-[170px] h-[170px] mb-5 border-2 rounded-3xl border-[#BFDC0C]" alt="Sell product under paire price">
                <label >Sell product under paire price</label>
            </div>
            <div class="flex flex-col items-center">
                <img src="images/agro.png" class="w-[170px] h-[170px] mb-5 border-2 rounded-3xl border-[#BFDC0C]" alt="Buy quality agrochemicals">
                <label >Buy quality agrochemicals</label>
            </div>
            <div class="flex flex-col items-center">
                <img src="images/new.png" class="w-[170px] h-[170px] mb-5 border-2 rounded-3xl border-[#BFDC0C]" alt="Knowledge of new techniques">
                <label >Knowledge of new techniques</label>
            </div>
            <div class="flex flex-col items-center">
                <img src="images/verites.png" class="w-[170px] h-[170px] mb-5 border-2 rounded-3xl border-[#BFDC0C]" alt="Knowledge of crop varieties">
                <label >Knowledge of crop varieties</label>
            </div>
        </div>
    </div>

    <!-- system features in home page -->
    <div class="flex flex-col bg-[#D9D9D9] mt-32 mb-16 border-4 rounded-3xl w-[75%] mx-auto border-[#11ff01]">
        <div class="flex mt-8 mb-10 font-bold justify-evenly ">
            <div class="flex flex-col w-[200px] h-[200px]">
                <div class="flex justify-center"> <!-- for image center -->
                <img src="images/atm.png" class=" w-[80px] h-[80px] mb-5 " alt="Sell product under paire price">
                </div>
                <label >CDM payment Allowed</label>
                <label class="mt-4 font-medium">Cash Deposit Machine or bank paymnet allowed</label>
            </div>
            <div class="flex flex-col w-[200px] h-[200px]">
                <div class="flex justify-center"> 
                <img src="images/pay.png" class="w-[90px] h-[80px] mb-5" alt="Sell product under paire price">
                </div>
                <label >Online Payment Allowed</label>
                <label class="mt-4 font-medium">Customer can pay the money using online method</label>
            </div>
            <div class="flex flex-col w-[200px] h-[200px]">
                <div class="flex flex-col items-center"> 
                <img src="images/sms.jpg" class="w-[80px] h-[80px] mb-5" alt="Sell product under paire price">
                <label >SMS Supports</label>
                </div>                
                <label class="mt-4 font-medium">Send SMS Quickly after uploading new technology</label>
            </div>
            <div class="flex flex-col w-[200px] h-[200px]">
                <div class="flex justify-center"> 
                <img src="images/pdf.png" class="w-[80px] h-[80px] mb-5" alt="Sell product under paire price">
                </div>
                <label >PDF downlaod available</label>
                <label class="mt-4 font-medium">Allowed download for transaction details pdf</label>
            </div>
        </div>
    </div> 

    <!-- about us section in home page -->
    <div class="">
        <h1 class="flex justify-center mt-32 font-serif text-3xl italic font-bold mb-14">About Us</h1> 
        <div class="">
            <div class="">
                <img src="images/home8.jpg" alt="" class="w-[500px] h-[350px] relative left-12 top-4 rounded-3xl">
                <img src="images/futter.jpg" alt="" class="w-[300px] h-[200px] absolute left-[450px] top-[3270px] rounded-3xl">
                <img src="images/home.jpg" alt="" class="w-[350px] h-[220px] absolute left-32 top-[3340px] rounded-3xl">
            </div>
            <div class=" absolute left-[790px] top-[3050px] w-[470px] h-[320px]">
                <p class="justify-self-end text-justify font-semibold w-[450px] h-[250px]">
                The MyAgro website creates a platform for farmers engaged in vegetable and fruit cultivation to sell their produce at fair prices. 
                MyAgro Institute can be known as an institute recognized by farmers, governments, and farmer organizations. Chamoth Migara owns the company MyAgro, which was founded in Nugegoda in 2013.
                Apart from this, the institute provides solutions to the problems faced by farmers in relation to agricultural business and provides advisory services for agricultural activities.
                </p>
                <button class="justify-self-end cursor-pointer w-[200px] self-center text-black italic font-bold border-[3px] bg-[#ddf2a1] border-[#BFDC0C] rounded-3xl px-4 py-1 mt-4 ">Know More</button>
            </div>
        </div>
    </div>

    <!-- footer section in home page -->
    <div class="flex flex-col border-4 mt-[400px] h-[300px]  bg-[#D9D9D9] ">
        <div class="flex">
            <div class="absolute flex flex-col py-8 left-12">
                <h1 class="py-2 text-2xl font-semibold">MyAgro</h1>
                <label>
                    The company is owned by Chamoth Migara.
                </label>
                <label>
                    Started in 2013
                </label>
                <label>
                    No 250/ Nugegoda/ Colombo
                </label>
            </div>
            <div class="absolute flex flex-col gap-2 py-8 left-[500px]">
                <h1 class="py-1 text-2xl font-semibold ">Quick Link</h1>
                <a href="#" class="text-1xl">Register</a>
                <a href="#" class="text-1xl">Login</a>
                <a href="#" class="text-1xl">Our Service</a>
                <a href="#" class="text-1xl">About Us</a>
                <a href="#" class="text-1xl">Contact Us</a>
                <a href="#" class="text-1xl">FAQ</a>
            </div>
            <div class="absolute flex flex-col gap-2 py-8 left-[850px]">
                <h1 class="py-1 text-2xl font-semibold">Follow Us</h1>
                <a href="#" class="text-1xl">Facebook : https://www.facebook.com/MyAgro</a>
                <a href="#" class="text-1xl">Twitter  : https://www.twitter.com/MyAgro</a>
                <a href="#" class="text-1xl">Instagram : https://www.instagram.com/ MyAgro</a>
                <div class="flex gap-4">
                    <img src="images/insta.png" class="w-[30px] h-[30px] mt-2" alt="instagram image">
                    <img src="images/fb.png" class="w-[25px] h-[26px] mt-[9px]" alt="facebook image">
                    <img src="images/x.png" class="w-[25px] h-[24px] mt-[10px]" alt="twitter image">
                </div>
            </div>
        </div>
        <h1 class="relative flex text-sm justify-center text-white bg-black  italic top-[280px]">Copyright @ 2024 MyAgro Pvt  Ltd: All Right Reserved</h1>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- change image every minute -->
    <script>
        // Array of image URLs
        const images = [   
            "images/home9.jpg", 
            "images/home2.png",
            "images/home.jpeg",
            "images/home8.jpg",
            "images/farm.jpg",
            "images/vegetable.jpg",
            // Add more images as needed
        ];

        let currentIndex = 0; // Start from the first image

        // Function to change the image
        function changeImage() {
            // Update the image source
            currentIndex = (currentIndex + 1) % images.length; // Cycle through images
            document.getElementById("dynamicImage").src = images[currentIndex];
        }

        // Change image every minute (60000 milliseconds)
        setInterval(changeImage, 5000);
    </script>

    <!-- show output message -->
    <script>
        var message ="<?php echo isset($_SESSION['home_message']) ? $_SESSION['home_message'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
        if (message != "") {
            if(message.includes('success')) {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                iconColor: "#69f44a",
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                });
                Toast.fire({
                icon: "success",
                title: message,
                });
            } else {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                iconColor: "#f84444",
                background: "#fcf2f2",
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                });
                Toast.fire({
                icon: "error",
                title: message,
                });
            }
            // remove after once message is shown
            <?php unset($_SESSION['home_message']); ?>
        } 
    </script>
    
</body>
</html>