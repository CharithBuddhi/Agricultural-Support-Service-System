<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price Calculation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">

    <style>
        label{
            color: white;
        }
    </style>

</head>
<body class="bg-[#350dc3] text-white">
<div class="flex">
    <div class="flex flex-col w-[20%] bg-[#08025e] rounded-r-3xl  h-screen"></div>
    <div class="flex flex-col pl-2 mt-6 ml-16 w-fit">
        <h1 class="font-serif text-3xl text-center font-pop">Price Calculation</h1>
        <form action="cal.php" method="post" class="flex self-center text-black gap-[75px] mt-7">
            <div class="flex flex-col w-[300px] gap-4">

            <!-- first tow input filed display condition. if update display with value, if add new disply witout value input fields value  -->
            <?php 

                if(isset($_GET['name'])){
                   $name = $_GET['name'];
                    echo "<div class='flex flex-col '>
                            <label for='crop_name'>Name of the crop</label>
                            <input type='text' id='crop_name' name='crop_name' placeholder='Potato' value='$name' class='h-8 rounded-md' required>
                        </div>";

                }else{
                    echo "<div class='flex flex-col '>
                            <label for='crop_name'>Name of the crop</label>
                            <input type='text' id='crop_name' name='crop_name' placeholder='Potato' value='' class='h-8 rounded-md' required>
                        </div>";
                }
                if(isset($_GET['varieties'])){
                    $varieties = $_GET['varieties'];
                    echo "<div class='flex flex-col '>
                            <label for='crop_variety'>Varieties of the crop</label>
                            <input type='text' id='crop_variety' name='crop_variety' placeholder='sweet potato' value='$varieties' class='h-8 rounded-md' required>
                        </div>";
                }else{
                    echo "<div class='flex flex-col '>
                            <label for='crop_variety'>Varieties of the crop</label>
                            <input type='text' id='crop_variety' name='crop_variety' placeholder='sweet potato' value='' class='h-8 rounded-md' required>
                        </div>";
                }
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    echo "<input type='hidden' id='price_id' name='price_id' value='$id' class='h-8 rounded-md'>";
                }
                if(isset($_GET['search'])){
                    $search = $_GET['search'];
                    echo "<input type='hidden' id='search' name='search' value='$search' class='h-8 rounded-md'>";
                }
                
            ?>

                <!-- Price Calculation Form -->
                <div class="flex flex-col">
                    <label for="period">Average cultivation Period (as a days)</label>
                    <input type="number" id="period" min="5" step="1" name="period" placeholder="30-40:50" class="h-8 rounded-md" required>
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
                    <label for="cost_seeds">Cost of purchase & planting of plants or seeds</label>
                    <input type="number" id="cost_seeds" min="0" step="0.01" name="cost_seeds" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_fertilizer">Cost of fertilizer application</label>
                    <input type="number" id="cost_fertilizer" min="0" step="0.01" name="cost_fertilizer" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="cost_pest">Cost of pest & disease control </label>
                    <input type="number" id="cost_pest" step="0.01" min="0" name="cost_pest" class="h-8 rounded-md" required>
                </div>
            </div>
            <div class="flex flex-col w-[300px] mt-[1px] gap-4" required>
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
                    <input type="number" id="yield" step="0.01" min="0" name="yield" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="min_profit">Minimum profit percentage</label>
                    <input type="number" id="min_profit" step="0.01" min="0" name="min_profit" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="max_profit">Maximum profit percentage</label>
                    <input type="number" id="max_profit" step="0.01" min="0" name="max_profit" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="benefit">Marketing cost margin (as a percentage)</label>
                    <input type="number" id="benefit" step="0.01" min="0" name="benefit"  placeholder="124.83" class="h-8 rounded-md" required>
                </div>
                <div class="flex flex-col">
                    <label for="taxt">Tax percentage</label>
                    <input type="number" id="taxt" step="0.01" min="0" name="taxt"  placeholder="124.83" class="h-8 rounded-md" required>
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
                    <?php 
                    if(isset($_GET['crop_name'])){
                        $crop_name_result = $_GET['crop_name'];
                        echo "<p class='font-serif text-xl font-medium'>$crop_name_result</p>";
                    }
                    ?>
                    <?php 
                    if(isset($_GET['crop_variety'])){
                        $crop_variety_result = $_GET['crop_variety'];
                        echo "<p class='font-serif text-xl font-medium'>: $crop_variety_result</p>";
                    }
                    ?>
                </div>
                <div class="flex gap-2">
                    <h1 class="text-lg font-pop">Low price</h1>
                    <?php 
                    if(isset($_GET['min_result'])){
                        $min_result = $_GET['min_result'];
                        echo "<p class='font-semibold'>Rs. $min_result</p>";
                    }
                    ?>
                </div>
                <div class="flex gap-2">
                    <h1 class="text-lg font-pop">High price</h1>

                    <?php 
                    if(isset($_GET['max_result'])){
                        $max_result = $_GET['max_result'];
                        echo "<p class='font-semibold'>Rs. $max_result</p>";
                    }
                    ?>
                </div>
            </div>

            <!-- Hidden inputs to pass data -->
            <input type="hidden" name="crop_name" value="<?php echo $crop_name_result ?? ''; ?>">
            <input type="hidden" name="crop_variety" value="<?php echo $crop_variety_result ?? ''; ?>">
            <input type="hidden" name="min_result" value="<?php echo $min_result ?? ''; ?>">
            <input type="hidden" name="max_result" value="<?php echo $max_result ?? ''; ?>">

            <div class="flex justify-around gap-4 font-semibold text-black">
                <input type="submit" name="confirm" class="py-1 mt-4 bg-yellow-300 border-2 cursor-pointer px-14 w-fit rounded-xl">
            </div>
            <div class="flex justify-around gap-4 font-semibold text-black">
                <a href="price.php" class="px-16 py-1 mt-2 bg-red-500 border-2 cursor-pointer w-fit rounded-xl">Back</a>
            </div>
        </form>
</div>


</body>
</html>

<!-- update in table in control price -->
<!-- Insert to control price table in the database -->
<?php
session_start(); // Ensure session is started
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
                // Prepare the update statement using prepared statements
                $sql = "UPDATE `controlprice` SET `min_price`=?, `max_price`=?, `create_date`=now() WHERE price_id = ?";
                
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ssi", $min_result, $max_result, $id);

                // Execute the update query
                if(mysqli_stmt_execute($stmt)) {
                    $_SESSION['msg'] = "Control price updated successfully";
                    echo "<script>window.location.href = 'price.php?search=$search';</script>";
                } else {
                    echo "Failed to update data: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt); // Close statement
            } else {
                echo "Database connection error.";
            }

        } else {
            // Handle the insert operation
            require('db_conn.php');
            if ($conn) {
                // Prepare the SQL insert statement
                $sql = "INSERT INTO controlprice (crop_name, varieties_name, min_price, max_price, create_date) 
                        VALUES (?, ?, ?, ?, now())";

                $stmt = mysqli_prepare($conn, $sql);
                
                // Use appropriate data types: 'ssdd' for string, string, decimal, decimal
                mysqli_stmt_bind_param($stmt, 'ssdd', $crop_name_result, $crop_variety_result, $min_result, $max_result);

                // Execute the insert query
                if(mysqli_stmt_execute($stmt)) {
                    $_SESSION['msg'] = "New control price added successfully";
                    echo "<script>window.location.href = 'price.php';</script>";
                } else {
                    echo "Failed to insert data: " . mysqli_error($conn);
                }

                mysqli_stmt_close($stmt); // Close statement
            } else {
                echo "Database connection error.";
            }
        }

    } else {
        // Alert if any fields are missing
        echo "<script>alert('All fields are required');</script>";
    }
}
?>

