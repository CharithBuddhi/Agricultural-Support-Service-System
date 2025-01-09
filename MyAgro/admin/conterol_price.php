<?php session_start(); 
if(!isset($_SESSION['login_admin_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Calculation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <style>
        label{
            color: white;
        }
    </style>

</head>
<body class="bg-[#1c4094] text-white">
<div class="flex">
    <!-- load staff menu bar here -->
    <div class="load_data_container w-[20%]"></div>

    <!-- main content here -->
    <div class="flex flex-col pl-2 mt-6 ml-10 w-fit">
        <h1 class="font-serif text-3xl text-center font-pop">Price Calculation</h1>
        <form action="cal.php" method="post" class="flex self-center text-black gap-[65px] mt-7">
            <div class="flex flex-col w-[300px] gap-4">

                
                
            <!-- first tow input filed display condition. if update display with value, if add new disply witout value input fields value  -->
            <?php

                if(isset($_GET['crop'])){
                    $crop = $_GET['crop'];
                    ?>
                        <div class="flex flex-col">
                            <label for="crop">Crop</label>
                            <input type='text' id='crop' name='crop' value='<?php echo $crop?>' class='h-8 rounded-md' readonly required>
                        </div>
                    <?php
                }else{
                    ?>
                        <div class="flex flex-col">
                            <label for="crop">Crop</label>
                            <select id="crop" name="crop" class="h-8 font-semibold rounded-md" required>
                                <option value="">Select Crop</option>
                                <option value="Vegetable">Vegetable</option>
                                <option value="Fruit">Fruit</option>
                            </select>
                        </div>
                    <?php
                }


                if(isset($_GET['name'])){
                   $name = $_GET['name'];
                   ?>
                    <div class='flex flex-col '>
                        <label for='crop_name'>Name of the crop</label>
                        <input type='text' id='crop_name' name='crop_name' value='<?php echo $name?>' class='h-8 rounded-md' readonly required>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class='flex flex-col '>
                        <label for='crop_name'>Name of the crop</label>
                        <select id="crop_name" name="crop_name" class='h-8 font-semibold rounded-md' required>
                            <option value="">Select Crop</option>
                        </select>
                    </div>
                    <?php
                }

                if(isset($_GET['varieties'])){
                    $varieties = $_GET['varieties'];
                    ?>
                    <div class='flex flex-col '>
                        <label for='crop_variety'>Varieties of the crop</label>
                        <input type='text' id='crop_variety' name='crop_variety' value='<?php echo $varieties?>' class='h-8 rounded-md' readonly required>
                    </div>
                    <?php
                }else{
                    ?>
                    <div class='flex flex-col '>
                        <label for='crop_variety'>Varieties of the crop</label>
                        <select id="crop_variety" name="crop_variety" class='h-8 font-semibold rounded-md' required>
                            <option value="">Select Variety</option>
                        </select>
                    </div>
                    <?php
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    ?>
                    <input type='hidden' id='price_id' name='price_id' value='<?php echo $id?>' class='h-8 rounded-md'>
                    <?php
                }
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                    ?>
                    <input type='hidden' id='search' name='search' value='<?php echo $search?>' class='h-8 rounded-md'>
                    <?php
                }
                
            ?>

                <!-- Price Calculation Form -->
                <div class="flex flex-col">
                    <label for="period">Average cultivation Period (as a days)</label>
                    <input type="number" id="period" min="30" step="1" name="period" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="farmer_salary">Salary per day for the farmer</label>
                    <input type="number" id="farmer_salary" min="0" step="0.01" name="farmer_salary"  class="h-8 px-1 rounded-md" placeholder="Average salary 1386.37"  required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_land">Cost of land preparation</label>
                    <input type="number" id="cost_land" min="0" step="0.01" name="cost_land" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_plough">Cost for plough</label>
                    <input type="number" id="cost_plough" min="0"  step="0.01" name="cost_plough" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_beds">Cost for preparation beds & ridges </label>
                    <input type="number" id="cost_beds" min="0" step="0.01" name="cost_beds" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_fertilizer">Cost of fertilizer application</label>
                    <input type="number" id="cost_fertilizer" min="0" step="0.01" name="cost_fertilizer" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_seeds">Cost of purchase & planting of plants or seeds</label>
                    <input type="number" id="cost_seeds" min="0" step="0.01" name="cost_seeds" class="h-8 rounded-md" required>
                </div>
            </div>
            <div class="flex flex-col w-[300px] mt-[1px] gap-4" required>
                <div class="flex flex-col">
                    <label for="cost_pest">Cost of pest & disease control </label>
                    <input type="number" id="cost_pest" step="0.01" min="0" name="cost_pest" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_water">Cost of water management</label>
                    <input type="number" id="cost_water" step="0.01" min="0" name="cost_water" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_harvesting">Cost of harvesting & drawing</label>
                    <input type="number" id="cost_harvesting" min="0" step="0.01" name="cost_harvesting" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_other">Costs for other expenses</label>
                    <input type="number" id="cost_other" step="0.01" min="0" name="cost_other" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="yield">Average yield per acre (kg)</label>
                    <input type="number" id="yield" step="0.01" min="5" name="yield" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="min_profit">Minimum profit percentage</label>
                    <input type="number" id="min_profit" step="0.01" min="1" name="min_profit" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="max_profit">Maximum profit percentage</label>
                    <input type="number" id="max_profit" step="0.01" min="1" name="max_profit" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="benefit">Marketing margin profit percentage</label>
                    <input type="number" id="benefit" step="0.01" min="1" name="benefit" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="taxt">Tax percentage</label>
                    <input type="number" id="taxt" step="0.01" min="1" name="taxt" class="h-8 rounded-md" required>
                </div>
                <div class="flex justify-around">
                    <button type="reset" id="clear" class="px-4 py-1 mt-4 border-2 w-[120px] cursor-pointer bg-cyan-300 rounded-xl">Clear</button>
                    <button type="submit" name="calculate" class="px-4 py-1 text-black mt-4 border-2 cursor-pointer bg-cyan-300 w-[120px] rounded-xl">Submit</button>   
                </div>
            </div>
        </form>
    </div>
 
    <!-- Calculated Price Form -->
    <form action="" method="post" id="price_show" class="flex flex-col gap-1 mt-[110px] ml-10 h-fit w-max">
        <div>
            <h1 class="mb-4 font-serif text-2xl text-center">Calculated Price</h1>
        </div>
        <div class="flex flex-col gap-2">
            
            <div class="flex gap-2">
                <h1 class="text-lg font-bold text-black font-pop">Crop Category:</h1>
                <?php 
                if(isset($_GET['crops'])){
                    $crop_result = $_GET['crops'];
                    echo "<p class='mt-1 font-serif font-medium'>$crop_result</p>";
                }
                ?>
            </div>
            <div class="flex gap-2">
                <h1 class="text-lg font-bold text-black font-pop">Crop Name:</h1>
                <?php 
                if(isset($_GET['crop_name'])){
                    $crop_name_result = $_GET['crop_name'];
                    echo "<p class='mt-1 font-serif font-medium'>$crop_name_result</p>";
                }
                ?>
            </div>
            <div class="flex gap-2">
                <h1 class="text-lg font-bold text-black font-pop">Crop Variety:</h1>
                <?php 
                if(isset($_GET['crop_variety'])){
                    $crop_variety_result = $_GET['crop_variety'];
                    echo "<p class='mt-1 font-serif font-medium'>$crop_variety_result</p>";
                }
                ?>
            </div>
            <div class="flex gap-2">
                <h1 class="text-lg font-bold text-black font-pop">Low price:</h1>
                <?php 
                if(isset($_GET['min_result'])){
                    $min_result = $_GET['min_result'];
                    echo "<p class='font-semibold'>Rs. $min_result</p>";
                }
                ?>
            </div>
            <div class="flex gap-2">
                <h1 class="text-lg font-bold text-black font-pop">High price:</h1>

                <?php 
                if(isset($_GET['max_result'])){
                    $max_result = $_GET['max_result'];
                    echo "<p class='font-semibold'>Rs. $max_result</p>";
                }
                ?>
            </div>
        </div>

        <!-- Hidden inputs to pass data -->
        <input type="hidden" name="crop" value="<?php echo $crop_result ?? ''; ?>">
        <input type="hidden" name="crop_name" value="<?php echo $crop_name_result ?? ''; ?>">
        <input type="hidden" name="crop_variety" value="<?php echo $crop_variety_result ?? ''; ?>">
        <input type="hidden" name="min_result" value="<?php echo $min_result ?? ''; ?>">
        <input type="hidden" name="max_result" value="<?php echo $max_result ?? ''; ?>">

        <div class="flex justify-around gap-4 font-semibold text-black">
            <input type="submit" name="confirm" class="py-1 mt-4 bg-yellow-300 border-2 cursor-pointer px-14 w-fit rounded-xl">
        </div>
    </form>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- load side menu bar  -->
<script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/adminpanel.php');
    })
</script>

<!-- Fetch crop names on page load -->
<script>
    $(document).ready(function() {
        // Fetch crop names on page load
        $.ajax({
            url: 'getData.php',
            method: 'POST',
            data: { action: 'fetch_crop_names' },
            success: function(data) {
                $('#crop_name').html(data);
            }
        });

        // Fetch crop varieties based on selected crop name
        $('#crop_name').change(function() {
            var crop_name = $(this).val();
            $.ajax({
                url: 'getData.php',
                method: 'POST',
                data: { action: 'fetch_crop_varieties', crop_name: crop_name },
                success: function(data) {
                    $('#crop_variety').html(data);
                }
            });
        });
    });
</script>

<!-- show output message -->
<script>
        var message ="<?php echo isset($_SESSION['price_message']) ? $_SESSION['price_message'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.

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
            <?php unset($_SESSION['price_message']); ?>
        } 
</script>

</body>
</html>

<!-- update in table in control price -->
<!-- Insert to control price table in the database -->
<?php
require('db_conn.php'); // Include the database connection

if(isset($_POST['confirm'])) {
    
    // Collecting form data
    $crop_name_result = $_POST['crop_name'] ?? '';
    $crop_variety_result = $_POST['crop_variety'] ?? '';
    $min_result = $_POST['min_result'] ?? '';
    $max_result = $_POST['max_result'] ?? '';

    // Ensure all form data is present
    if(!empty($crop_name_result) && !empty($crop_variety_result) && !empty($min_result) && !empty($max_result)) {
        
        // Check if it's an update operation
        if(isset($_GET['id'])) {
            $id = $_GET['id'];
            $search = $_GET['search'] ?? ''; // Check if search value exists

            // Ensure the connection is established before running the query
            if ($conn) {
                
                // update previuose value machanisum
                $SELECT= "SELECT min_price, max_price, update_date FROM controlprice WHERE price_id = '$id'";
                $result = mysqli_query($conn, $SELECT);

                // Fetch the data from the database
                $row = mysqli_fetch_assoc($result);
                $previuse_min_price = $row['min_price'];
                $previuse_max_price = $row['max_price'];
                $update_date = $row['update_date'];
                
                // Prepare the update statement using prepared statements
                $sql = "UPDATE `controlprice` SET `pervious_min_price`=?, `pervious_max_price`=?, `create_date`=?, `min_price`=?, `max_price`=?, `update_date`=now() WHERE price_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "sssssi",$previuse_min_price, $previuse_max_price, $update_date, $min_result, $max_result, $id);
                
                // Execute the update query
                if(mysqli_stmt_execute($stmt)) {
                    $_SESSION['msg'] = "Control price updated successfully";
                    echo "<script>window.location.href = 'price.php?search=$search';</script>";
                } else {
                    $_SESSION['msg'] = "Failed to update data";
                    echo "Failed to update data: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt); // Close statement
            } else {
                $_SESSION['msg'] = "Database connection error.";
                echo "Database connection error.";
            }

        } else {
            // Handle the insert operation
            require('db_conn.php');
            if ($conn) {
                // Prepare the SQL insert statement
                $sql = "INSERT INTO controlprice (crop_category, crop_name, varieties_name, min_price, max_price, create_date, update_date) 
                        VALUES (?, ?, ?, ?, ?, now(), now())";

                $stmt = mysqli_prepare($conn, $sql);
                
                // Use appropriate data types: 'ssdd' for string, string, decimal, decimal
                mysqli_stmt_bind_param($stmt, 'sssdd', $crop_result, $crop_name_result, $crop_variety_result, $min_result, $max_result);

                // Execute the insert query
                if(mysqli_stmt_execute($stmt)) {
                    $_SESSION['msg'] = "New control price added successfully";
                    echo "<script>window.location.href = 'price.php';</script>";
                } else {
                    $_SESSION['msg'] = "Failed to insert data:". mysqli_error($conn);
                }

                mysqli_stmt_close($stmt); // Close statement
            } else {
                $_SESSION['msg'] = "Database connection error.";
            }
        }

    } else {
        // Alert if any fields are missing
        echo "<script>alert('All fields are required');</script>";
    }
}
?>

