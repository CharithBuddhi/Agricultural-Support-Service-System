<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/MyAgro/style.css">
    <title>MyAgro</title>
</head>
<body>
    <!-- navigation bar -->
    <?php require('header.php'); ?>
    
    <!-- selling section -->
    <h1 class="flex justify-center mt-2 mb-3 font-serif text-3xl italic font-bold">Agrochemicals and Fertilizers</h1>

    <div class="mb-3 ml-5 mr-6">
        <?php 
            $typ = $_GET['type'];
            $_SESSION['cate_type'] = $_GET['type'];
            $_SESSION['category'] = "chemical";
        ?>

        <h1><label class="font-semibold">You are here: </label><a href="typeagrochemical.php" class="font-medium hover:underline"> Select Category</a> 
        <label for="" class="font-semibold"> > </label><a href="chemical_category.php" class="font-medium hover:underline"> Select Type</a> 
        <label for="" class="font-semibold"> <?php echo '> '.$typ; ?> </label></h1>
        <hr class=" mt-1 border-1 border-[#C19A6B]">
    </div>
    
    <div class="flex"> 

        <!-- filter section -->
        <div class="relative flex flex-col w-1/5 ml-4">
            
            <label for="" class="mb-3 ml-2 font-serif text-2xl">Filter Section</label>
            <div>

                
                <?php  

                    include('db_connect.php');     
                    $Fertilizer_category = $_GET['type'];
                    
                ?>

                <!-- Organic Chemical -->
                <div id="Organic" class="flex flex-col px-2 py-1 font-medium w-[200px]" style="display: none;">

                    <label for="" class="mt-2">Organic Type</label>
                    <select name="" id="Organic_select" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="">Select Organic Type</option>
                        
                        <?php
                        
                            
                            $query = "SELECT DISTINCT fertilizer_type FROM agrochemical WHERE fertilizer_category = '$Fertilizer_category' ORDER BY fertilizer_type";
                            $result = mysqli_query($conn, $query);
                            $types = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            foreach ($types as $type):                        
                            ?>
                            
                            <option value="<?= $type['fertilizer_type'] ?>" <?php if (isset($_POST['type']) && $_POST['type'] == $type['fertilizer_type']) echo 'selected'; ?>>
                                <?= $type['fertilizer_type'] ?>
                            </option>

                            <?php 
                            endforeach; 
                        ?>


                    </select>
                    
                </div>
                
                <!-- Insecticides Chemical -->
                <div id="Insecticides" class="flex flex-col px-2 py-1 font-medium w-[200px]"style="display: none;" >

                    <label for="" class="mt-2">Insecticides Type</label>
                    <select name="" id="Insecticides_select" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="">Select Insecticides Type</option>

                        <?php
                        
                                
                            $query = "SELECT DISTINCT fertilizer_type FROM agrochemical WHERE fertilizer_category = '$Fertilizer_category' ORDER BY fertilizer_type";
                            $result = mysqli_query($conn, $query);
                            $types = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            foreach ($types as $type):                        
                            ?>
                            
                            <option value="<?= $type['fertilizer_type'] ?>" <?php if (isset($_POST['type']) && $_POST['type'] == $type['fertilizer_type']) echo 'selected'; ?>>
                                <?= $type['fertilizer_type'] ?>
                            </option>

                            <?php 
                            endforeach; 
                        ?>
                        
                    </select>

                </div>
                
                <!-- Fungicides Chemical -->
                <div id="Fungicides" class="flex-col px-2 py-1 font-medium w-[200px]" style="display: none;">

                    <label for="" class="mt-2">Fungicides Type</label>
                    <select name="" id="Fungicides_select" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="">Select Fungicides Type</option>

                        <?php
                        
                                
                            $query = "SELECT DISTINCT fertilizer_type FROM agrochemical WHERE fertilizer_category = '$Fertilizer_category' ORDER BY fertilizer_type";
                            $result = mysqli_query($conn, $query);
                            $types = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            foreach ($types as $type):                        
                            ?>
                            
                            <option value="<?= $type['fertilizer_type'] ?>" <?php if (isset($_POST['type']) && $_POST['type'] == $type['fertilizer_type']) echo 'selected'; ?>>
                                <?= $type['fertilizer_type'] ?>
                            </option>

                            <?php 
                            endforeach; 
                        ?>

                    </select>
                    
                </div>
                
                <!-- Weedicides Chemical -->
                <div id="Weedicides" class="flex flex-col px-2 py-1 font-medium w-[200px] " style="display: none;">

                    <label for="" class="mt-2">Weedicides Type</label>
                    <select name="" id="Weedicides_select" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="">Select Weedicides Type</option>
                        
                        <?php
                        
                                
                            $query = "SELECT DISTINCT fertilizer_type FROM agrochemical WHERE fertilizer_category = '$Fertilizer_category' ORDER BY fertilizer_type";
                            $result = mysqli_query($conn, $query);
                            $types = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            foreach ($types as $type):                        
                            ?>
                            
                            <option value="<?= $type['fertilizer_type'] ?>" <?php if (isset($_POST['type']) && $_POST['type'] == $type['fertilizer_type']) echo 'selected'; ?>>
                                <?= $type['fertilizer_type'] ?>
                            </option>

                            <?php 
                            endforeach; 
                        ?>
                    </select>
                    
                </div>
                
            </div>

            <form action="" method="post" class=" rounded-2xl h-fit">

                <!-- identify type -->
                <?php

                    if($_GET['type'] == 'Organic'){

                        echo "<script>
                            const Organic = document.getElementById('Organic');
                            Organic.style.display = 'block';
                        </script>";
                    }

                    if($_GET['type'] == 'Insecticides'){

                        echo "<script>
                            const Insecticides = document.getElementById('Insecticides');
                            Insecticides.style.display = 'block';
                        </script>";
                    }

                    if($_GET['type'] == 'Fungicides'){

                        echo "<script>
                            const Fungicides = document.getElementById('Fungicides');
                            Fungicides.style.display = 'block';
                        </script>";
                    }

                    if($_GET['type'] == 'Weedicides'){

                        echo "<script>
                            const Weedicides = document.getElementById('Weedicides');
                            Weedicides.style.display = 'block';
                        </script>";
                    }
                ?>

                <!-- common filter section -->
                <div class="flex flex-col px-2 font-medium">

                    <?php

                        // List of district options
                        $districts = [
                            "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", "Galle", 
                            "Gampaha", "Hambantota", "Jaffna", "Kalutara", "Kandy", "Kegalle", 
                            "Kilinochchi", "Kurunegala", "Mannar", "Matale", "Matara", "Monaragala", 
                            "Mullaitivu", "Nuwara Eliya", "Polonnaruwa", "Puttalam", "Ratnapura", 
                            "Trincomalee", "Vavuniya"
                        ];

                        // Get the selected district (if the form is submitted)
                        $selected_district = isset($_POST['District']) ? $_POST['District'] : '';
                        
                    ?>

                    <input type="text" id ="category" name ="category" value="chemical" hidden>
                    <input type="text" id="Fertilizer_category" name="Fertilizer_category" hidden>
                    <input type="text" id="type" name="type" hidden>

                    <label for="" class="mt-2">District</label>
                    <select name="District" id="district" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="">Select District</option>

                        <!-- display selectd district after submiting -->
                        <?php foreach ($districts as $district): ?>
                            <option value="<?= $district ?>" <?= $district == $selected_district ? 'selected' : '' ?>>
                                <?= $district ?>
                            </option>
                        <?php endforeach;
                            
                        ?>

                    </select>
                    
                    <label for="" class="mt-2">Area</label>
                    <select name="Area" id="area" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="">Select Area</option>

                        <!-- display selectd district after submiting -->

                        <?php
                        
                            $query = "SELECT DISTINCT agro_area FROM agrochemical WHERE agro_district = '$selected_district' AND agro_category = 'chemical'  ORDER BY agro_area";
                            $result = mysqli_query($conn, $query);
                            $areas = mysqli_fetch_all($result, MYSQLI_ASSOC);                            
                            

                            foreach ($areas as $area):                        
                            ?>
                            
                            <option value="<?= $area['agro_area'] ?>" <?php if (isset($_POST['Area']) && $_POST['Area'] == $area['agro_area']) echo 'selected'; ?>>
                                <?= $area['agro_area'] ?>
                            </option>

                            <?php 
                            endforeach; 
                        ?>

                    </select>
                    
                    <label for="" class="mt-2">Fertilizer Name</label>
                    <input type="text" name="Fertilizer_Name" value="<?php if(isset($_POST['Fertilizer_Name'])){ echo $_POST['Fertilizer_Name']; } ?>" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                </div>

                <!-- filter button -->
                <div class="flex gap-1 px-2 py-5">
                    <button type="reset" class="w-[100px] h-8 font-serif border border-blue-500 rounded-md ">Clear</button>
                    <button type="submit" name="filter" class="w-[100px] h-8 font-serif border border-blue-500 rounded-md bg-orange-400">Filter</button>
                </div> 
                            
            </form>

        </div> 
        
        <!-- product section -->
        <div class="relative flex flex-wrap w-4/5 gap-12 mt-10">

            <?php
                include('db_connect.php');

                if(isset($_POST['filter'])){

                    // filter data and show filtered data
                    
                    $query = "SELECT agro_id, agro_image, agro_name,total_quantity, agro_price, agro_quantity, agro_location, shop_name, s.supplier_status FROM agrochemical JOIN supplier s ON agrochemical.supplier_id = s.supplier_id "; 

                    // Create an array to hold the conditions
                    $conditions = array();
    
                    // Check if category is set and not empty
                    if (!empty(trim($_POST['category']))) {
                        $category = $_POST['category'];
                        $conditions[] = "agro_category = '$category'";
                        $conditions[] = "s.supplier_status = 0";
                    }
    
                    if (!empty(trim($_POST['Fertilizer_category']))) {
                        $Fertilizer_category = $_POST['Fertilizer_category'];
                        $conditions[] = "fertilizer_category = '$Fertilizer_category'";
                    }
    
                    if (!empty(trim($_POST['type']))) {
                        $type = $_POST['type'];
                        $conditions[] = "fertilizer_type = '$type'";
                    }

                    if (!empty(trim($_POST['District']))) {
                        $District = $_POST['District'];
                        $conditions[] = "agro_district = '$District'";
                    }

                    if (!empty(trim($_POST['Area']))) {
                        $Area = $_POST['Area'];
                        $conditions[] = "agro_area = '$Area'";
                    } 
    
                    // If there are conditions, add them to the query
                    if (count($conditions) > 0) {
                        $query .= " WHERE " . implode(' AND ', $conditions);
                    }

                    if (!empty(trim($_POST['Fertilizer_Name']))) {
                        
                        $Fertilizer_Name = $_POST['Fertilizer_Name'];
                        $Fertilizer_Name1 = "%$Fertilizer_Name%";

                        $query .= " AND CONCAT(agro_name) LIKE ? ";

                    }

                    // Prepare the statement
                    $stmt = $conn->prepare($query);

                    if ($stmt === false) {

                        die('Prepare error: ' . $conn->error);
                        
                    }
                    
                    // Bind parameters if Fertilizer_Name is set
                    if (!empty(trim($_POST['Fertilizer_Name']))) {
                        $stmt->bind_param("s", $Fertilizer_Name1);
                    }

                    // Execute the statement
                    if (!$stmt->execute()) {
                        die('Execute error: ' . $stmt->error);
                    }

                    // Get result set from the statement
                    $result = $stmt->get_result();
                    
                    if($result && $result->num_rows > 0) {

                        while($row = $result->fetch_assoc()) {
                             
                            ?>
                                <div id="<?php echo $row['agro_id']; ?>" class="flex flex-col items-center pt-3 font-semibold w-[290px] max-w-[310px] h-fit border-[3px] border-[#6efa2c] rounded-3xl shadow-2xl shadow-neutral-600">
                                    <form action="retail.php" method="post" class="flex flex-col items-center">
                                        <input type="hidden" name="agro_category" value="chemical"/>
                                        <input type="hidden" name="agro_type" value="<?php echo $_GET['type']; ?>"/>
                                        <input type="hidden" name="agro_id" value="<?php echo $row['agro_id']; ?>"/>
                                        <div class="">
                                            <img class="w-[180px] h-[150px] py-1 " src="images/fertilizer/saveferti/<?php echo $row['agro_image']; ?>" alt="fertilizer">
                                        </div>
                                        <div class="mt-2">
                                            <label id="productName"><?php echo $row['agro_name']; ?></label>
                                        </div>
                                        <div class="flex flex-col gap-1 px-3 mt-2 place-self-start">
                                            <div>
                                                <label class="font-bold">Shop Name : </label>
                                                <label id="productLocation"><?php echo $row['shop_name']; ?></label>
                                            </div>
                                            <div> 
                                                <label class="font-bold">Product  Price : </label>
                                                <label>Rs.<label id="productPrice"><?php echo $row['agro_price']; ?></label></label> 
                                            </div>
                                            <div hidden>
                                                <label class="font-bold">Product Quantity :</label>
                                                <label id="productQuantity"><?php echo $row['agro_quantity']; ?></label>
                                            </div>
                                            <div>
                                                <label class="font-bold">Pick up location : </label>
                                                <label id="productLocation"><?php echo $row['agro_location']; ?></label>
                                            </div>
                                        </div>
                                        <div class="flex self-start gap-2 mt-2 mb-1 ml-3 h-fit">
                                            <input type="hidden" id="totalQuantity" value="<?php echo $row['total_quantity']; ?>" class="totalQuantity">
                                            <input type="hidden"  value="<?php echo $row['agro_quantity']; ?>" class="packetQuantity">
                                            <label for="" class="font-bold">Order :</label>
                                            <button type="button" id="quantity_increase" class="relative text-2xl font-extrabold text-blue-500 quantity_increase bottom-1">+</button>
                                            <input type="text" value="<?php echo $row['agro_quantity']; ?>" class="relative text-center text-black border-2 border-black rounded-lg quantity w-28 h-7" id="quantity" name="quantity" min="1" max="<?php echo isset($row['total_quantity']) ? $row['total_quantity'] : ''; ?>" readonly>
                                            <button  type="button" id="quantity_decrease" class="relative text-2xl font-extrabold text-blue-500 quantity_decrease quantity bottom-1">-</button>
                                        </div>
                                        <button class="w-[290px] max-w-[310px] h-10 font-serif text-white bg-[#6efa2c] rounded-b-3xl">Order</button>
                                    </form>
                                </div>
                                
    
                            <?php
                        }
    
                    } else {
                        ?>
                        <div class="flex flex-wrap justify-center w-[100%] items-center">
                            <h1 class="relative text-4xl italic font-semibold text-center right-40">There is no agrochemical available</h1>
                        </div>
                        <?php
                    }


                }else{
                    
                    $category = "chemical";
                    $type = $_GET['type'];

                    $query = "SELECT agro_id, agro_image,total_quantity, agro_name, agro_price, agro_quantity, agro_location, shop_name, s.supplier_status FROM agrochemical JOIN supplier s ON agrochemical.supplier_id = s.supplier_id WHERE agro_category = '$category' AND fertilizer_category = '$type' AND s.supplier_status = 0";
                    $result = mysqli_query($conn, $query);
    
                    if($result && $result->num_rows > 0) {
                         
                        while($row = $result->fetch_assoc()) {
                             
                            ?>

                                <div id="<?php echo $row['agro_id']; ?>" class="flex flex-col items-center pt-3 font-semibold w-[290px] max-w-[310px] h-fit border-[3px] border-[#6efa2c] rounded-3xl shadow-2xl shadow-neutral-600">
                                    <form action="retail.php" method="post" class="flex flex-col items-center">
                                        <input type="hidden" name="agro_type" value="<?php echo $_GET['type']; ?>"/>
                                        <input type="hidden" name="agro_id" value="<?php echo $row['agro_id']; ?>"/>
                                        <div class="">
                                        <img class="w-[180px] h-[150px] py-1 " src="images/fertilizer/saveferti/<?php echo $row['agro_image']; ?>" alt="fertilizer">
                                        </div>
                                        <div class="mt-2">
                                            <label id="productName"><?php echo $row['agro_name']; ?></label>
                                        </div>
                                        <div class="flex flex-col gap-1 px-3 mt-2 place-self-start">
                                            <div class="">
                                                <label class="font-bold">Shop Name : </label>
                                                <label id="productLocation"><?php echo $row['shop_name']; ?></label>
                                            </div>
                                            <div> 
                                                <label class="font-bold">Product Price : </label>
                                                <label>Rs.<label id="productPrice"><?php echo $row['agro_price']; ?></label></label> 
                                            </div>
                                            
                                            <div hidden>
                                                <label class="font-bold">Product Quantity :</label>
                                                <label id="productQuantity"><?php echo $row['agro_quantity']; ?></label>
                                            </div>

                                            <div>
                                                <label class="font-bold">Pick up location : </label>
                                                <label id="productLocation"><?php echo $row['agro_location']; ?></label>
                                            </div>
                                        </div>
                                        <div class="flex self-start gap-2 mt-2 mb-1 h-fit">
                                            <input type="hidden" id="totalQuantity" value="<?php echo $row['total_quantity']; ?>" class="totalQuantity">
                                            <input type="hidden"  value="<?php echo $row['agro_quantity']; ?>" class="packetQuantity">
                                            <label for="" class="ml-3 font-bold">Order :</label>
                                            <button type="button" id="quantity_increase" class="relative text-2xl font-extrabold text-blue-500 quantity_increase bottom-1">+</button>
                                            <input type="text" value="<?php echo $row['agro_quantity']; ?>" class="relative text-center text-black border-2 border-black rounded-lg quantity w-28 h-7" id="quantity" name="quantity" min="1" max="<?php echo isset($row['total_quantity']) ? $row['total_quantity'] : ''; ?>" readonly>
                                            <button  type="button" id="quantity_decrease" class="relative text-2xl font-extrabold text-blue-500 quantity_decrease quantity bottom-1">-</button>
                                        </div>
                                        <button class="w-[290px] h-10 font-serif max-w-[310px] text-white bg-[#6efa2c] rounded-b-2xl">Order</button>
                                    </form>
                                </div>
    
                            <?php
                        }
    
                    } else {
                        ?>
                        <div class="flex flex-wrap justify-center w-[100%] items-center">
                            <h1 class="relative text-4xl italic font-semibold text-center right-40">There is no agrochemical available</h1>
                        </div>
                        <?php
                    }
                }

            ?>

          
        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- change chmecial category save form input filed for submit -->
    <script>
        
        type =document.getElementById("type");
        Fertilizer_category =document.getElementById("Fertilizer_category");

        district =document.getElementById("district");
        district.addEventListener("change",function(){
            header("Location: chemicalsell.php");
            exit;
        })

        if(window.location.href.includes("type=Insecticides")){

            Insecticides_select =document.getElementById("Insecticides_select");

            Fertilizer_category.value = 'Insecticides';
            type.value = Insecticides_select.value;
            
            Insecticides_select.addEventListener("change",function(){
                type.value = Insecticides_select.value;
            })

        }

        if(window.location.href.includes("type=Fungicides")){

            Fungicides_select =document.getElementById("Fungicides_select");

            Fertilizer_category.value = 'Fungicides';
            type.value = Fungicides_select.value;

            Fungicides_select.addEventListener("change",function(){
                type.value = Fungicides_select.value;
            })

        }

        if(window.location.href.includes("type=Weedicides")){

            Weedicides_select =document.getElementById("Weedicides_select");

            Fertilizer_category.value = 'Weedicides';
            type.value = Weedicides_select.value;

            Weedicides_select.addEventListener("change",function(){
                type.value = Weedicides_select.value;
            })

        }

        if(window.location.href.includes("type=Organic")){

            Organic_select =document.getElementById("Organic_select");

            Fertilizer_category.value = 'Organic';
            type.value = Organic_select.value;

            Organic_select.addEventListener("change",function(){
                type.value = Organic_select.value;
            })

        }

    </script>

    <!-- Add your JavaScript to handle the dynamic changes of AREA -->
    <script>
        document.getElementById('district').addEventListener('change', function() {
            var district = this.value;
            // var category = '';  delete here some code chekc agrosell.php

            // Send AJAX request to fetch areas based on the selected district
            fetch('fetch_areas.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'district=' + district 
            })
            .then(response => response.json())
            .then(data => {
                // Clear existing options
                let areaSelect = document.getElementById('area');
                areaSelect.innerHTML = '<option value="">Select Area</option>';

                // Populate with new options
                data.forEach(area => {
                    let option = document.createElement('option');
                    option.value = area;
                    option.text = area;
                    areaSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error:', error));
        });

    </script>

    <!-- Add your JavaScript to identify the increase and decrease buttons with Separately -->
    <script>
        
        document.addEventListener('DOMContentLoaded', function () {
            // Get all increase buttons
            let quantityIncreaseButtons = document.querySelectorAll('.quantity_increase');
             
            // Add a click event listener to each increase button
            quantityIncreaseButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    
                    // Find the closest div containing this button
                    let container = button.closest('.flex');
                   
                    // Access elements within this specific container
                    let quantityInput = container.querySelector('.quantity');
                    let currentQuantity = parseFloat(quantityInput.value);
                    let currentvalue = parseFloat(container.querySelector('.packetQuantity').value);
                    let totalQuantity = parseFloat(container.querySelector('.totalQuantity').value);

                    if (currentQuantity < totalQuantity) {  
                        quantityInput.value = currentQuantity + currentvalue;
                    } else {
                        quantityInput.value = totalQuantity;
                    }
                });
            });

            // Get all decrease buttons
            let quantityDecreaseButtons = document.querySelectorAll('.quantity_decrease');
            
            // Add a click event listener to each decrease button
            quantityDecreaseButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    
                    // Find the closest div containing this button
                    let container = button.closest('.flex');
                
                    // Access elements within this specific container
                    let quantityInput = container.querySelector('.quantity');
                    let currentQuantity = parseFloat(quantityInput.value);
                    let currentvalue = parseFloat(container.querySelector('.packetQuantity').value);

                    if (currentQuantity > currentvalue) {  
                        quantityInput.value = currentQuantity - currentvalue;
                    } else {
                        quantityInput.value = currentvalue;
                    }
                });
            });
        });


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