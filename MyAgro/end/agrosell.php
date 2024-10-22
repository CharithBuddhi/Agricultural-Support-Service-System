<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>MyAgro</title>
</head>
<body>
    <!-- navigation bar -->
    <?php require('header.php'); ?>
    
    <!-- selling section -->
    <h1 class="flex justify-center mt-2 mb-3 font-serif text-3xl italic font-bold">Agrochemicals and Fertilizers</h1>
    <div class="flex"> 

        <!-- filter section -->
        <div class="relative flex flex-col ml-4 w-[250px]">
            <label for="" class="mb-3 font-serif text-2xl italic">Filter</label>
            <form action="" method="post" class=" rounded-2xl h-[300px] ">
                <div class="flex flex-col px-2 py-1 font-medium w-[200px] gap-2">
                    <label for="">Category</label>
                    <select name="" id="" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="fertilizer">Fertilizer</option>
                        <option value="agrochemicals">Agrochemicals</option>
                    </select>
                    <label for="">Name</label>
                    <input type="text" class="w-[200px] font-serif border border-blue-500 rounded-md">
                    <label for="">location</label>
                    <input type="text" class="w-[200px] font-serif border border-blue-500 rounded-md">
                </div>
                <div class="flex gap-1 px-2 py-10">
                    <button>
                        <input type="reset" value="Clear" class="w-[100px] h-8 font-serif border border-blue-500 rounded-md ">
                    </button>
                    <button>
                        <input type="submit" value="Filter"  class="w-[100px] h-8 font-serif border border-blue-500 rounded-md"> 
                    </button>
                </div>             
            </form>
        </div>
        
        <!-- product section -->
        <div class="flex flex-wrap gap-12 mt-10 ml-10">

            <?php
                include('db_connect.php');
                if(isset($_POST['filter'])){
                    $category = $_POST['category'];
                    $name = $_POST['name'];
                    $location = $_POST['location'];
                }
            ?>

            <a href="retail.php"  class="flex flex-col items-center font-semibold w-[280px] h-[350px] border-[3px] border-[#BFDC0C] rounded-3xl shadow-2xl shadow-neutral-600">
                <div class="">
                    <img class="w-[250px] h-[210px] py-1 " src="images/fer1.png" alt="fertilizer">
                </div>
                <div class="mt-2">
                    <label id="productName">Carrot</label>
                </div>
                <div class="flex flex-col gap-1 px-3 mt-2 place-self-start">
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
            </a>
          
        </div>
    </div>
</body>
</html>