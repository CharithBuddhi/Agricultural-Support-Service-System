<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/MyAgro/style.css">
    <title>MyAgro</title>
</head>
<body class="select-none">
    
    <?php  
        include('db_connect.php');
        
        if(isset($_GET['qun'])){
            
            $typ = $_GET['type'];
            $vegfruitle_id  = $_GET['id'];
            $qun = $_GET['qun'];

            $SELECT = "SELECT vegfruit_total FROM `vegetablefruit` WHERE `vegfruitle_id` = '$vegfruitle_id'";
            $result1 = $conn->query($SELECT);
            $row = $result1->fetch_assoc();
            $db_quantity = $row['vegfruit_total'];

            $total_quantity = $db_quantity + $qun;
            $sql = "UPDATE `vegetablefruit` SET `vegfruit_total`='$total_quantity' WHERE `vegfruitle_id` = '$vegfruitle_id'";            
            $result = $conn->query($sql);
            
            if($result){
                header("Location: agrosell.php?type=$typ");
                exit();
            }

        }
        require('header.php');

    ?>
    
    <!-- selling section -->
    <h1 class="flex justify-center mt-2 mb-3 font-serif text-3xl italic font-bold">Vegetabales and Fruits</h1>

    <div class="flex"> 

        <!-- filter section -->
        <div class="relative flex flex-col w-1/5 ml-4">
            
            
            <form action="" method="post" class=" rounded-2xl h-fit">
                
                <label for="" class="mb-3 ml-2 font-serif text-2xl">Filter Section</label>
               
                <div id="" class="flex flex-col px-2 py-1 font-medium w-[200px] ">
                    <label for="" class="mt-2">Product Category</label>
                    <select name="Select_Category" id="Product_Category" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="">Select Category</option>
                        <?php
                            $selected_category = isset($_POST['Select_Category']) ? $_POST['Select_Category'] : '';
                            if($selected_category == "vegetable"){
                                echo '<option value="vegetable" selected>Vegetable</option>';
                                echo '<option value="fruit">Fruit</option>';
                            } elseif($selected_category == "fruit"){
                                echo '<option value="vegetable">Vegetable</option>';
                                echo '<option value="fruit" selected>Fruit</option>';
                            }else{
                                echo '<option value="vegetable">Vegetable</option>';
                                echo '<option value="fruit">Fruit</option>';
                            }

                        ?>
                    </select>
                </div>

                <div id="" class="flex flex-col px-2 py-1 font-medium w-[200px] ">
                    <label for="" class="mt-2">Product Name</label>
                    <select name="Select_Name" id="Select_Name" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="" selected>Select Name</option>
                    </select>
                </div>

                <div id="" class="flex flex-col px-2 py-1 font-medium w-[200px] ">
                    <label for="" class="mt-2">Product Variety</label>
                    <select name="Select_Variety" id="Select_Variety" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
                        <option value="" selected>Select Variety</option>
                        <!-- set after submit dispaly product variety -->
                        <?php
                            // $selected_variety = isset($_POST['Select_Variety']) ? $_POST['Select_Variety'] : '';
                            // if(isset($_POST['Select_Variety'])){
                            //     echo '<option value="'.$selected_variety.'" selected>'.$selected_variety.'</option>';
                            // }
                        ?>
                    </select>
                </div>
                
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
                        <option value="" select>Select Area</option>

                        <!-- display selectd district after submiting -->

                        <?php
                            $selected_area = isset($_POST['Area']) ? $_POST['Area'] : '';
                            if(isset($_POST['Area'])){
                                echo '<option value="'.$selected_area.'" selected>'.$selected_area.'</option>';
                            }
                        ?>

                    </select>
                    
                    <label for="" class="mt-2">Product Name</label>
                    <input type="text" name="search_product_name" value="<?php if(isset($_POST['search_product_name'])){ echo $_POST['search_product_name']; } ?>" class="w-[200px] font-serif border h-7 border-blue-500 rounded-md">
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
                    
                    $query = "SELECT v.*, f.farmer_status FROM vegetablefruit v JOIN farmer f ON v.farmer_id = f.farmer_id"; 

                    // Create an array to hold the conditions
                    
                    $conditions = array();     // $conditions = []; also can craeate like this

                    // Check if category is set and not empty
                    if (!empty(trim($_POST['Select_Category']))) {
                        $category = $_POST['Select_Category'];
                        $conditions[] = "vegetable_category = '$category'";
                        $conditions[] = "vegfruit_total >= 1";
                        $conditions[] = "f.farmer_status = 0";
                    }
    
                    if (!empty(trim($_POST['Select_Name']))) {
                        $Select_Name = $_POST['Select_Name'];
                        $conditions[] = "vegetable_name = '$Select_Name'";
                    }
    
                    if (!empty(trim($_POST['Select_Variety']))) {
                        $Select_Variety = $_POST['Select_Variety'];
                        $conditions[] = "vegfruitle_verity = '$Select_Variety'";
                    }

                    if (!empty(trim($_POST['District']))) {
                        $District = $_POST['District'];
                        $conditions[] = "vegfruit_distric = '$District'";
                    }

                    if (!empty(trim($_POST['Area']))) {
                        $Area = $_POST['Area'];
                        $conditions[] = "vegfruit_area = '$Area'";
                    } 
    
                    // If there are conditions, add them to the query
                    if (count($conditions) > 0) {
                        $query .= " WHERE " . implode(' AND ', $conditions);
                    }

                    if (!empty(trim($_POST['search_product_name']))) {
                        
                        $search_product_name = $_POST['search_product_name'];
                        $search_product_name_1 = "%$search_product_name%";

                        $query .= " AND CONCAT(vegetable_name) LIKE ? ";

                    }

                    // Prepare the statement
                    $stmt = $conn->prepare($query);

                    if ($stmt === false) {

                        die('Prepare error: ' . $conn->error);
                        
                    }
                    
                    // Bind parameters if Fertilizer_Name is set
                    if (!empty(trim($_POST['search_product_name']))) {
                        $stmt->bind_param("s", $search_product_name_1);
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
                                <div id="<?php echo $row['vegfruitle_id']; ?>" class="flex flex-col items-center pt-3 font-semibold w-[290px] max-w-[310px] h-fit border-[3px] border-[#6efa2c] rounded-3xl shadow-2xl shadow-neutral-600">
                                    <form action="retail.php" method="post" class="flex flex-col items-center">
                                        <input type="hidden" id="vegetable_category" name="vegetable_category" value="<?php echo $row['vegetable_category']; ?>"/>
                                        <input type="hidden" name="vegfruitle_id" value="<?php echo $row['vegfruitle_id']; ?>"/>
                                        <div class="">
                                        <img class="w-[180px] h-[180px] py-1 rounded-full" src="images/vegetable/<?php echo $row['vegfruit_image']; ?>" alt="fertilizer">
                                        </div>
                                        <div class="mt-2">
                                            <label id="vegetable_name"><?php echo $row['vegetable_name']; ?></label>
                                        </div>
                                        <div class="flex flex-col gap-1 px-3 mt-2 place-self-start">
                                            <div class="">
                                                <label class="font-bold">Variety Name : </label>
                                                <label id="vegfruitle_verity"><?php echo $row['vegfruitle_verity']; ?></label>
                                            </div>
                                            <div> 
                                                <label class="font-bold">Price for  1kg : </label>
                                                <label>Rs.<label id="vegfruit_price"><?php echo $row['vegfruit_price']; ?></label></label> 
                                            </div>
                                            <div>
                                                <label class="font-bold">Available Stock : </label>
                                                <label id="vegfruit_total"><?php echo $row['vegfruit_total']; ?></label>
                                                <label id="measurement"><?php echo $row['measurement']; ?></label>
                                            </div>
                                            <div>
                                                <label class="font-bold">Pick up location : </label>
                                                <label id="vegfruit_location"><?php echo $row['vegfruit_location']; ?></label>
                                            </div>
                                        </div>
                                        <div class="flex self-start gap-2 mt-2 mb-1 h-fit">
                                            <label for="" class="ml-3 font-bold">Order :</label>
                                            <input type="hidden" id="totalQuantity" value="<?php echo $row['vegfruit_total']; ?>" class="totalQuantity">
                                            <button type="button" id="quantity_increase" class="relative text-2xl font-extrabold text-blue-500 quantity_increase bottom-1">+</button>
                                            <input type="text" value="1 kg" class="relative text-center text-black border-2 border-black rounded-lg quantity w-28 h-7" id="quantity" name="quantity" min="1" max="<?php echo isset($row['vegfruit_total']) ? $row['vegfruit_total'] : ''; ?>" readonly>
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
                            <h1 class="relative text-4xl italic font-semibold text-center right-40">There has not been any vegetable available</h1>
                        </div>
                        <?php
                    }


                }else{
                    
                    $category = "vegetable";

                    $query = "SELECT v.*, f.farmer_status FROM vegetablefruit v JOIN farmer f ON v.farmer_id = f.farmer_id WHERE vegfruit_total > 0 AND f.farmer_status = 0 ";
                    $result = mysqli_query($conn, $query);
    
                    if($result && $result->num_rows > 0) {
                         
                        while($row = $result->fetch_assoc()) {
                             
                            ?>

                                <div id="<?php echo $row['vegfruitle_id']; ?>" class="flex flex-col items-center pt-3 font-semibold w-[290px] max-w-[310px] h-fit border-[3px] border-[#6efa2c] rounded-3xl shadow-2xl shadow-neutral-600">
                                    <form action="retail.php" method="post" class="flex flex-col items-center">
                                        <input type="hidden" id="vegetable_category" name="vegetable_category" value="<?php echo $row['vegetable_category']; ?>"/>
                                        <input type="hidden" name="vegfruitle_id" value="<?php echo $row['vegfruitle_id']; ?>"/>
                                        <div class="">
                                        <img class="w-[180px] h-[180px] py-1 rounded-full" src="images/vegetable/<?php echo $row['vegfruit_image']; ?>" alt="fertilizer">
                                        </div>
                                        <div class="mt-2">
                                            <label id="vegetable_name"><?php echo $row['vegetable_name']; ?></label>
                                        </div>
                                        <div class="flex flex-col gap-1 px-3 mt-2 place-self-start">
                                            <div class="">
                                                <label class="font-bold">Variety Name : </label>
                                                <label id="vegfruitle_verity"><?php echo $row['vegfruitle_verity']; ?></label>
                                            </div>
                                            <div> 
                                                <label class="font-bold">Price for  1kg : </label>
                                                <label>Rs.<label id="vegfruit_price"><?php echo $row['vegfruit_price']; ?></label></label> 
                                            </div>
                                            <div>
                                                <label class="font-bold">Available Stock : </label>
                                                <label id="vegfruit_total"><?php echo $row['vegfruit_total']; ?></label>
                                                <label id="measurement"><?php echo $row['measurement']; ?></label>
                                            </div>
                                            <div>
                                                <label class="font-bold">Pick up location : </label>
                                                <label id="vegfruit_location"><?php echo $row['vegfruit_location']; ?></label>
                                            </div>
                                        </div>
                                        <div class="flex self-start gap-2 mt-2 mb-1 h-fit">
                                            <label for="" class="ml-3 font-bold">Order :</label>
                                            <input type="hidden" id="totalQuantity" value="<?php echo $row['vegfruit_total']; ?>" class="totalQuantity">
                                            <button type="button" id="quantity_increase" class="relative text-2xl font-extrabold text-blue-500 quantity_increase bottom-1">+</button>
                                            <input type="text" value="1 kg" class="relative text-center text-black border-2 border-black rounded-lg quantity w-28 h-7" id="quantity" name="quantity" min="1" max="<?php echo isset($row['vegfruit_total']) ? $row['vegfruit_total'] : ''; ?>" readonly>
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
                            <h1 class="relative text-4xl italic font-semibold text-center right-40">There has not been any vegetable available</h1>
                        </div>
                        <?php
                    }
                }

            ?>

          
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Add your JavaScript to handle the dynamic changes of AREA -->
    <script>
        document.getElementById('district').addEventListener('change', function() {
            var district = this.value;
            var category = document.getElementById('Product_Category').value;

            const params = new URLSearchParams();
            params.append('vegetable_district', district);
            params.append('category', category);

            // Send AJAX request to fetch areas based on the selected district
            fetch('fetch_areas.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: params.toString()
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
                    let totalQuantity = parseFloat(container.querySelector('.totalQuantity').value);

                    if (currentQuantity < totalQuantity) {  
                        quantityInput.value = (currentQuantity + 0.25)+' Kg';
                    } else {
                        quantityInput.value = totalQuantity + ' kg';
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

                    if (currentQuantity > 1) {  
                        quantityInput.value = currentQuantity - 0.25 + ' Kg';
                    } else {
                        quantityInput.value = 1 + ' Kg';
                    }
                });
            });
        });


    </script>

    <script>
        $(document).ready(function() {

            // Fetch crop names based on change origin
            $('#Product_Category').change(function() {
                var origin = $(this).val();
                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_names_vegefrut_table', origin: origin },
                    success: function(data) {
                        $('#Select_Name').html(data);
                    }
                });
            });

            // Fetch crop varieties based on change crop name
            $('#Select_Name').change(function() {
                
                var origin = $('#Product_Category').val();
                var name = $(this).val();
                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_varieties_vegefrut_table', name: name , origin: origin },
                    success: function(data) {
                        
                        // getting out put displya this id element
                        $('#Select_Variety').html(data);
                    }
                });
            });

            // Fetch crop varieties based on change crop name
            
                
            var origin = $('#Product_Category').val();
            var name = $('#Select_Name').val();

            if(name == '') {
                
                $('#Select_Name').html('<option value="">Select Name</option>');

            }else if(name != ''){

                $.ajax({
                    url: 'get_vegetables_data.php',
                    method: 'POST',
                    data: { action: 'fetch_crop_varieties_vegefrut_table', name: name , origin: origin },
                    success: function(data) {
                        
                        // getting out put displya this id element
                        $('#Select_Name').html(data);
                    }
                });
            }

            
            
        });
    </script>

    <!-- show output message -->
    <script>
        var message ="<?php echo isset($_SESSION['vegetable_sell']) ? $_SESSION['vegetable_sell'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
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
            <?php unset($_SESSION['vegetable_sell']); ?>
        } 
    </script>
    
</body>
</html>