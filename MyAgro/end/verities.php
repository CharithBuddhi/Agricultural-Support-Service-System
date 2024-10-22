<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIfferent Verities</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <div class="flex flex-col gap-5 h-screen bg-[#f8fde3]">
        <h1 class="mt-5 font-serif text-3xl font-bold text-center">Crop of verities </h1>

        <!-- search bar -->
        <form action="" method="POST" class="flex self-center text-black gap-[75px]">
            <div class="">
                <input type="text" name="search_verities" value="<?php if(isset($_POST['search_verities'])){ echo $_POST['search_verities']; } ?>" class="h-10 p-2 outline-none rounded-3xl w-80" placeholder="Search for species or varieties"  required>
                <button type="submit" name="search_verities_btn" class="relative right-[40px] top-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>  
        </form>

        <!-- fillter section -->
        <form action="" method="POST" class="flex justify-center gap-4 mt-3">
            <div class="flex flex-col justify-center gap-1">
                <label for="category" class="ml-2 font-medium text-md">Category</label>
                <select name="category" id="category" class="h-8 w-[150px] rounded-md outline-none">
                    <option value="" <?php if (!empty($_POST['category']) && $_POST['category'] == "") echo 'selected'; ?>>All Categories</option>
                    <option value="vegetable" <?php if (!empty($_POST['category']) && $_POST['category'] == "vegetable") echo 'selected'; ?>>Vegetable</option>
                    <option value="Fruit" <?php if (!empty($_POST['category']) && $_POST['category'] == "Fruit") echo 'selected'; ?>>Fruit</option>
                </select>
            </div>

            <div class="flex flex-col justify-center gap-1">
                <label for="Light" class="font-medium text-md">Light</label>
                <select name="Light" id="Light" class="w-[150px] rounded-md outline-none h-8">
                    <option value="" <?php if (!empty($_POST['Light']) && $_POST['Light'] == "") echo 'selected'; ?>>Light</option>
                    <option value="Sunny" <?php if (!empty($_POST['Light']) && $_POST['Light'] == "Sunny") echo 'selected'; ?>>Sunny</option>
                    <option value="Semi-shaded" <?php if (!empty($_POST['Light']) && $_POST['Light'] == "Semi-shaded") echo 'selected'; ?>>Semi-Shaded</option>
                    <option value="Shady" <?php if (!empty($_POST['Light']) && $_POST['Light'] == "Shady") echo 'selected'; ?>>Shady</option>
                </select>
            </div>

            <div class="flex flex-col justify-center gap-1">
                <label for="Water" class="font-medium text-md">Water</label>
                <select name="Water" id="Water" class="w-[150px] rounded-md outline-none h-8">
                    <option value="" <?php if (!empty($_POST['Water']) && $_POST['Water'] == "") echo 'selected'; ?>>Water</option>
                    <option value="Very humid" <?php if (!empty($_POST['Water']) && $_POST['Water'] == "Very humid") echo 'selected'; ?>>Very humid</option>
                    <option value="Wet" <?php if (!empty($_POST['Water']) && $_POST['Water'] == "Wet") echo 'selected'; ?>>Wet</option>
                    <option value="Dry" <?php if (!empty($_POST['Water']) && $_POST['Water'] == "Dry") echo 'selected'; ?>>Dry</option>
                </select>
            </div>

            <div class="flex flex-col justify-center gap-1">
                <label for="Nutrient" class="font-medium text-md">Nutrients</label>
                <select name="Nutrient" id="Nutrient" class="w-[150px] rounded-md outline-none h-8">
                    <option value="" <?php if (!empty($_POST['Nutrient']) && $_POST['Nutrient'] == "") echo 'selected'; ?>>Nutrient</option>
                    <option value="Low" <?php if (!empty($_POST['Nutrient']) && $_POST['Nutrient'] == "Low") echo 'selected'; ?>>Low</option>
                    <option value="Medium" <?php if (!empty($_POST['Nutrient']) && $_POST['Nutrient'] == "Medium") echo 'selected'; ?>>Medium</option>
                    <option value="High" <?php if (!empty($_POST['Nutrient']) && $_POST['Nutrient'] == "High") echo 'selected'; ?>>High</option>
                </select>
            </div>

            
            <button type="submit" name="filter_btn" id="filter_btn" class="w-[150px] ml-2 mt-7 h-8 bg-[#3944e2] text-white rounded-md">Filter</button>
        </form>

        <div class="mt-4 mb-5 ml-10">
            <label class="font-serif text-lg font-light text-gray-400">Click a plant to see a list of varieties and useful growing tips.</label>
        </div>

        <!-- output display here -->
        <div class="flex flex-wrap ml-10 mr-10 gap-9">

        <?php 
            require('db_connect.php');  


            // search varieties detials show here
            if(isset($_POST['search_verities_btn'])) {

                $filter= $_POST['search_verities'];

                $query ="SELECT MIN(Verities_image) AS Verities_image, product_name, MIN(verity_name) AS verity_name 
                            FROM `verity` 
                            WHERE CONCAT(verity_name, product_name) LIKE ? 
                            GROUP BY product_name";

                // prepare statment
                $stmt = $conn->prepare($query);

                if ($stmt === false) {
                     die('Prepare error: ' . $conn->error);
                }

                $filter_veriti = "%$filter%";
                $stmt->bind_param("s", $filter_veriti);

                if (!$stmt->execute()) {
                     die('Execute error: ' . $stmt->error);
                }

                // Get result set from the statement
                $result = $stmt->get_result();

                if($result && $result->num_rows > 0) {
                     
                    while($row = $result->fetch_assoc()) {
                         
                        ?>
                        
                            <a href="varities_details.php?product=<?php echo $row['product_name']; ?>&verity=<?php echo $row['verity_name']; ?>" class="flex flex-col items-center justify-center gap-1 p-3 bg-white border border-gray-200 shadow-md hover:shadow-2xl hover:bg-slate-100 w-fit h-fit rounded-3xl shadow-gray-400">
                                <img src="/Agricultural-Support-Service-System/MyAgro/admin/images/verity/<?php echo $row['Verities_image']; ?>" alt="" class="w-[140px] h-[160px] rounded-3xl">
                                <label for="" class="font-semibold"><?php echo $row['product_name']; ?></label>
                                <label for="" class="font-medium"><?php echo $row['verity_name']; ?></label>
                            </a>

                        <?php
                    }
                    $stmt->close();

                } else {
                    ?>
                    <h1 class="w-full text-4xl italic font-semibold text-center">No Record Found</h1>
                    <?php
                }

            }

            if(isset($_POST['filter_btn'])) { 

                $query = "SELECT MIN(Verities_image) AS Verities_image, product_name, MIN(verity_name) AS verity_name FROM verity"; 

                // Create an array to hold the conditions
                $conditions = array();

                // Check if category is set and not empty
                if (!empty(trim($_POST['category']))) {
                    $category = $_POST['category'];
                    $conditions[] = "product_category = '$category'";
                }

                // Check if water is set and not empty
                if (!empty(trim($_POST['Water']))) {
                    $water = $_POST['Water'];
                    $conditions[] = "Water = '$water'";
                }

                // Check if light is set and not empty
                if (!empty(trim($_POST['Light']))) {
                    $light = $_POST['Light'];
                    $conditions[] = "Light = '$light'";
                }

                // Check if nutrient is set and not empty
                if (!empty(trim($_POST['Nutrient']))) {
                    $nutrient = $_POST['Nutrient'];
                    $conditions[] = "Nutrient = '$nutrient'";
                }

                // If there are conditions, add them to the query
                if (count($conditions) > 0) {
                    $query .= " WHERE " . implode(' AND ', $conditions);
                }

                // Add the GROUP BY clause
                $query .= " GROUP BY product_name";

                // Now you can execute the query
                $result = mysqli_query($conn, $query);

                if($result && $result->num_rows > 0) {
                     
                    while($row = $result->fetch_assoc()) {
                         
                        ?>
                        
                            <a href="varities_details.php?product=<?php echo $row['product_name']; ?>&verity=<?php echo $row['verity_name']; ?>" class="flex flex-col items-center justify-center gap-1 p-3 bg-white border border-gray-200 shadow-md hover:shadow-2xl hover:bg-slate-100 w-fit h-fit rounded-3xl shadow-gray-400">
                                <img src="/Agricultural-Support-Service-System/MyAgro/admin/images/verity/<?php echo $row['Verities_image']; ?>" alt="" class="w-[140px] h-[160px] rounded-3xl">
                                <label for="" class="font-semibold"><?php echo $row['product_name']; ?></label>
                                <label for="" class="font-medium"><?php echo $row['verity_name']; ?></label>
                            </a>

                        <?php
                    }

                } else {
                    ?>
                    <h1 class="w-full text-4xl italic font-semibold text-center">No Record Found</h1>
                    <?php
                }
            }
            
            if(!isset($_POST['search_verities_btn']) && !isset($_POST['filter_btn'])) {  
                
                $query = "SELECT MIN(Verities_image) AS Verities_image, product_name, MIN(verity_name) AS verity_name FROM `verity` GROUP BY product_name";
                $result = mysqli_query($conn, $query);

                if($result && $result->num_rows > 0) {
                     
                    while($row = $result->fetch_assoc()) {
                         
                        ?>
                            <a href="varities_details.php?product=<?php echo $row['product_name']; ?>&verity=<?php echo $row['verity_name']; ?>" class="flex flex-col items-center justify-center gap-1 p-3 bg-white border border-gray-200 shadow-md hover:shadow-2xl hover:bg-slate-100 w-fit h-fit rounded-3xl shadow-gray-400">
                                <img src="/Agricultural-Support-Service-System/MyAgro/admin/images/verity/<?php echo $row['Verities_image']; ?>" alt="" class="w-[140px] h-[160px] rounded-3xl">
                                <label for="" class="font-semibold"><?php echo $row['product_name']; ?></label>
                                <label for="" class="font-medium"><?php echo $row['verity_name']; ?></label>
                            </a>

                        <?php
                    }

                } else {
                    ?>
                    <h1 class="w-full text-4xl italic font-semibold text-center">Not varities information update yet</h1>
                    <?php
                }
            }
        ?>
   
        </div>  
         
    </div>

    <!-- footer section in home page -->
    <?php require('footer.php'); ?>

    <script>
        const filter_btn = document.getElementById("filter_btn");
        const search_not_found = document.getElementById("search_not_found");
        filter_btn.addEventListener("click", () => {
            search_not_found.style.display = "none"; 
        })
    </script>
    
</body>
</html>