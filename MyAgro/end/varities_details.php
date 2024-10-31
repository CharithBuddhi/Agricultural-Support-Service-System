<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Varities Details</title>
</head>
<body>

    <?php


    require('header.php');

    if(isset($_GET['product'])){
        $product_name = $_GET['product'];
        $verity_name = $_GET['verity'];
    }else{
        header("Location: verities.php");
    }
    
    ?>
    
    <!-- main div -->
    <div class="p-12 bg-[#fcfcf1] font-medium">

        <!-- product name heading -->
        <div>
            <h1><label class="font-semibold">You are here: </label><a href="verities.php" class="font-medium hover:underline"> Varieties</a> <label for="" class="font-semibold"> > </label><label for="" class="font-semibold"> <?php echo $product_name; ?> </label> </h1>
        <hr class=" mt-1 border-1 border-[#C19A6B]">
        </div>

        <!-- main two scroll part  -->
        <div class="flex gap-4 mt-10 ">

            <!-- h-screen overflow-y-auto w-fit varieties details scroll part -->
            <div class="w-[65%]">
                <div class="flex flex-col ">

                <?php 
    
                    include('db_connect.php');

                    if(isset($product_name)){
                        $query = "SELECT * FROM `verity` WHERE product_name = ? AND verity_name = ?";
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ss", $product_name, $verity_name); // "ss" means two string parameters
                        $stmt->execute();
                        $result = $stmt->get_result();
                                                
                    
                        if(mysqli_num_rows($result) >  0)
                        {

                            while($items = $result->fetch_assoc()){
                                
                                $Companion = $items['Companion'];
                                $Antagonistic = $items['Antagonistic'];
                                $Diseases = $items['Diseases'];
                                $Pests = $items['Pests'];

                                // Split the comma-separated string into an array
                                $CompanionArray = explode(",", $Companion);
                                $AntagonisticArray = explode(",", $Antagonistic);
                                $DiseasesArray = explode(",", $Diseases);
                                $PestsArray = explode(",", $Pests);

                                // Use array_filter to remove any empty values ("" or null)
                                $filterCompanionArray = array_filter($CompanionArray, function($value) {
                                    return !empty(trim($value)); // check the value is not empty, if empty then return false. after retun false value array_filter the not attach that value new array.
                                });
                                $filterAntagonisticArray = array_filter($AntagonisticArray, function($value) {
                                    return !empty(trim($value)); // trim use remvoe whitespace
                                });
                                $filterDiseasesArray = array_filter($DiseasesArray, function($value) {
                                    return !empty(trim($value)); // only true values are attached new array by array_filter
                                });
                                $filterPestsArray = array_filter($PestsArray, function($value) {
                                    return !empty(trim($value)); 
                                });

                                // Sort the array in ascending order
                                sort($filterCompanionArray); //rsort use for descending order 
                                sort($filterAntagonisticArray); 
                                sort($filterDiseasesArray); 
                                sort($filterPestsArray); 

                                ?>

                                <!-- image section -->
                                <div class="flex gap-4 ">
                                    <img src="../admin/images/verity/<?= $items['Verities_image']; ?>" alt="varietes image" class="object-cover w-40 h-40 bg-white bg-cover rounded-full">
                                    <div class="flex flex-col">
                                        <h1 class="font-medium text-4xl font-serif  mt-[50px]"><?= $items['product_name']; ?></h1>
                                        <h1 class="font-serif text-2xl font-light "> Variety name : <?= $items['verity_name']; ?></h1>
                                    </div>
                                </div>
                
                                <!-- description section -->
                                <div class="">
                                    <h1 class="mt-6 mb-2 font-serif text-2xl font-bold">Description</h1>
                                    <div class="w-[730px]">
                                        <p class="text-lg"><?= $items['Description']; ?>
                                        </p>
                                    </div>
                                </div>
                
                                <!-- Days_Maturity section -->
                                <div class="w-[730px] ">
                                    <h1 class="mt-6 font-serif text-lg font-semibold">Days to Maturity:</h1>
                                    <p class="text-lg"><?= $items['Days_Maturity']; ?></p>
                                </div>

                                <!-- origin section -->
                                <div class="w-[730px] ">
                                    <h1 class="mt-6 font-serif text-xl font-semibold">Origin:</h1>
                                    <p class="text-lg"><?= $items['Origin']; ?></p>
                                    <hr class=" mt-4 border-1 border-[#C19A6B]">
                                </div>
                
                                <!-- details section -->
                                <div class="">
                                    <h1 class="mt-6 mb-2 font-serif text-2xl font-bold">Details</h1>
                                    <div class="grid grid-cols-2 gap-2 w-[730px]">
                    
                                        <div class="flex gap-2 bg-[#F7E7CE] rounded-lg p-4 w-[350px]">
                                            <img src="images/varite/icone/sun_3227250.png" alt="" class="w-12 h-12 mt-1">
                                            <div class="flex flex-col text-lg">
                                                <h1 class="font-semibold">Light requirement</h1>
                                                <h1><?= $items['Light']; ?></h1>
                                            </div>
                                        </div>
                    
                                        <div class="flex gap-2 bg-[#F7E7CE] rounded-lg p-4 w-[350px]">
                                            <img src="images/varite/icone/watering-can_2470040.png" alt="" class="w-12 h-12 mt-1">
                                            <div class="flex flex-col text-lg">
                                                <h1 class="font-semibold">Water requirement</h1>
                                                <h1><?= $items['Water']; ?></h1>
                                            </div>
                                        </div>
                    
                                        <div class="flex gap-2 bg-[#F7E7CE] rounded-lg p-4 w-[350px]">
                                            <img src="images/varite/icone/sprout_2470027.png" alt="" class="w-12 h-12 mt-1">
                                            <div class="flex flex-col text-lg">
                                                <h1 class="font-semibold">Nutrient requirement</h1>
                                                <h1><?= $items['Nutrient']; ?></h1>
                                            </div>
                                        </div>
                    
                                        <div class="flex gap-2 bg-[#F7E7CE] rounded-lg p-4 w-[350px]">
                                            <img src="images/varite/icone/soil_3382631.png" alt="" class="w-12 h-12 mt-1">
                                            <div class="flex flex-col text-lg">
                                                <h1 class="font-semibold">Soil</h1>
                                                <h1><?= $items['Soil']; ?></h1>
                                            </div>
                                        </div>
                    
                                        <div class="flex gap-2 bg-[#F7E7CE] rounded-lg p-4 w-[350px]">
                                            <img src="images/varite/icone/width.JPG" alt="" class="w-12 h-12 mt-1">
                                            <div class="flex flex-col text-lg">
                                                <h1 class="font-semibold">Seeding distance</h1>
                                                <h1><?= $items['distance']; ?></h1>
                                            </div>
                                        </div>
                    
                                        <div class="flex gap-2 bg-[#F7E7CE] rounded-lg p-4 w-[350px]">
                                            <img src="images/varite/icone/Capture.JPG" alt="" class="w-12 h-12 mt-1">
                                            <div class="flex flex-col text-lg">
                                                <h1 class="font-semibold">Row spacing</h1>
                                                <h1><?= $items['spacing']; ?></h1>
                                            </div>
                                        </div>
                    
                                        <div class="flex gap-2 bg-[#F7E7CE] rounded-lg p-4 w-[350px]">
                                            <img src="images/varite/icone/agriculture_10579115.png" alt="" class="w-12 h-12 mt-1">
                                            <div class="flex flex-col text-lg">
                                                <h1 class="font-semibold">Seeding depth</h1>
                                                <h1><?= $items['depth']; ?></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class=" mt-4 border-1 w-[730px] border-[#C19A6B]">
                                </div>
                
                                <!-- Growing tips -->
                                <div class="">
                                    <h1 class="mt-6 mb-2 font-serif text-2xl font-bold">Growing tips</h1>
                                    <div class="w-[730px]">
                                        <p class="text-lg"><?= $items['Harvest_message']; ?></p>
                                        <hr class=" mt-4 border-1 border-[#C19A6B]">
                                    </div>
                                </div>
                
                                <!-- Companion Plants section -->
                                <div class="flex flex-col gap-2 mt-6 w-[730px] ">
                                    <div class="flex gap-2">
                                        <img src="images/varite/icone/papaya-leaf_7405486.png" alt="" class="w-8 h-8 mt-1">
                                        <h1 class="mt-1 mb-2 font-serif text-2xl font-bold">Companion Plants</h1>
                                    </div>
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        <?php
                                        foreach($filterCompanionArray as $Compan){
                                            ?>
                                            <!-- htmlspecialchars() use or the HTML output to prevent XSS attacks -->
                                            <h1 class="text-lg bg-[#F7E7CE] pl-3 pr-3 font-medium rounded-2xl"><?= htmlspecialchars($Compan); ?></h1>
                                            <?php
                                        }
                                        
                                        ?>
                                    </div>
                                    <hr class=" mt-4 border-1 border-[#C19A6B]">
                                </div>
                
                                <!-- Antagonistic Plants section -->
                                <div class="flex flex-col gap-2 mt-6 w-[730px] ">
                                    <div class="flex gap-2">
                                        <img src="images/varite/icone/monstera_12322235.png" alt="" class="w-8 h-8 mt-1">
                                        <h1 class="mt-1 mb-2 font-serif text-2xl font-bold">Antagonistic Plants</h1>
                                    </div>
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        <?php
                                        foreach($filterAntagonisticArray as $Antago){
                                            ?>
                                            <h1 class="text-lg bg-[#F7E7CE] pl-3 pr-3 font-medium rounded-2xl"><?= htmlspecialchars($Antago); ?></h1>
                                            <?php
                                        }
                                        
                                        ?>
                                    </div>
                                    <hr class=" mt-4 border-1 border-[#C19A6B]">
                                </div>
                
                                <!-- Diseases section -->
                                <div class="flex flex-col gap-2 mt-6 w-[730px] ">
                                    <div class="flex gap-2">
                                        <img src="images/varite/icone/microbe_8157303.png" alt="" class="w-8 h-8 mt-1">
                                        <h1 class="mt-1 mb-2 font-serif text-2xl font-bold">Diseases</h1>
                                    </div>
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        <?php
                                        foreach($filterDiseasesArray as $Diseas){
                                            ?>
                                            <h1 class="text-lg bg-[#F7E7CE] pl-3 pr-3 font-medium rounded-2xl"><?= htmlspecialchars($Diseas); ?></h1>
                                            <?php
                                        }
                                        
                                        ?>
                                    </div>
                                    <hr class=" mt-4 border-1 border-[#C19A6B]">
                                </div>
                
                                <!-- Pests section -->
                                <div class="flex flex-col gap-2 mt-6 w-[730px] ">
                                    <div class="flex gap-2">
                                        <img src="images/varite/icone/pest_2674474.png" alt="" class="w-8 h-8 mt-1">
                                        <h1 class="mt-1 mb-2 font-serif text-2xl font-bold">Pests</h1>
                                    </div>
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        <?php
                                        foreach($filterPestsArray as $Pests){
                                            ?>
                                            <h1 class="text-lg bg-[#F7E7CE] pl-3 pr-3 font-medium rounded-2xl"><?= htmlspecialchars($Pests); ?></h1>
                                            <?php
                                        }
                                        
                                        ?>
                                    </div>
                                    <hr class=" mt-4 border-1 border-[#C19A6B]">
                                </div>
                                <?php
                            }
                            $stmt->close();
                            
                        }
                        else{
                            ?>
                                <h1 class="text-4xl italic font-semibold text-center">No Record Founded</h1>
                            <?php
                        }
                    }

                ?>
                </div>       
            </div>

            <!-- different varieties scroll -->
            <div class="flex rounded-2xl p-3 bg-white overflow-y-scroll max-h-[600px] flex-col h-fit w-[34%]">
                <h1 class="font-serif text-2xl font-bold">Varieties</h1>
                <div class="flex flex-col mt-5">
                    <form action="" method="post" class="flex">
                        <div for="search" class=" flex rounded-3xl h-10 pl-3 pr-3 bg-[#EEEEEE]">
                            <input class="bg-[#EEEEEE] w-[280px] mt-1 outline-none h-8" type="text" id="search" name="search" value="<?php if(isset($_POST['search'])){ echo $_POST['search']; } ?>"  placeholder="search for varieties">
                            <button type="submit" class="">
                                <svg for="search" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                            </button>
                        </div>  
                    </form>
                </div>

                <?php 

                    if(isset($_POST['search'])){
                        $filter = $_POST['search'];
                        $query = "SELECT * FROM `verity` WHERE verity_name LIKE ? AND product_name = ? AND verity_name != ?";
                        $stmt = $conn->prepare($query);

                        $searchTerm = "%$filter%"; // Assuming 'search_value' is the value you are looking for in CONCAT(product_name, verity_name)

                        $stmt->bind_param("sss", $searchTerm, $product_name, $verity_name); // "ss" means two string parameters
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                        // CONCAT keyword filter the inside bracket column data only
                        // mysqli_num_rows use to check inside the query_run is empty or not
                        if(mysqli_num_rows($result) >  0)
                        {

                            while ($items = $result->fetch_assoc()){
                            //want to print table rows here and need to use insdie the td again php tag so close php tag here
                                ?>
                                <a href="varities_details.php?product=<?= $items['product_name'] ?>&verity=<?= $items['verity_name'] ?>" class="flex gap-2 mt-4 ml-2">
                                    <img src="../admin/images/verity/<?= $items['Verities_image'] ?>" alt="" class="w-[40px] h-[40px] rounded-2xl">
                                    <h1 class="font-medium"><?= $items['verity_name'] ?></h1>
                                </a>
                                <?php 
                            }
                            unset($_POST['search']);
                        }else{
                            ?>
                                <h1 class="mt-5 font-medium text-center">Not varieties Found</h1>
                            <?php
                        }
                        $stmt->close();
                    }else{

                        $query = "SELECT * FROM `verity` WHERE product_name = ? AND verity_name != ?";
                        $stmt = $conn->prepare($query);

                        $stmt->bind_param("ss",$product_name, $verity_name); // "ss" means two string parameters
                        $stmt->execute();
                        $result = $stmt->get_result();
                    
                        // CONCAT keyword filter the inside bracket column data only
                        // mysqli_num_rows use to check inside the query_run is empty or not
                        if(mysqli_num_rows($result) >  0)
                        {

                            while ($items = $result->fetch_assoc()){
                            //want to print table rows here and need to use insdie the td again php tag so close php tag here
                                ?>
                                <a href="varities_details.php?product=<?= $items['product_name'] ?>&verity=<?= $items['verity_name'] ?>" class="flex gap-2 mt-4 ml-2">
                                    <img src="../admin/images/verity/<?= $items['Verities_image'] ?>" alt="varietes image" class="w-[40px] h-[40px] rounded-2xl">
                                    <h1 class="font-medium"><?= $items['verity_name'] ?></h1>
                                </a>
                                <?php 
                            }
                        }else{
                            ?>
                                <h1 class="mt-5 font-medium text-center">Not varieties Found</h1>
                            <?php
                        }
                        $stmt->close();
                    }
                ?>

            </div>

        </div>
    </div>
</body>
</html>
<?php
// Close the database connection
$conn->close();
?>