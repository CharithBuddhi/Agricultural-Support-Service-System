<?php
session_start();
if(!isset($_SESSION['login_staff_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Varieties</title>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }
        .modal-body {
            max-height: calc(100vh - 200px); /* Adjust height */
            overflow-y: auto;
        }
    </style>
</head>
<body class="bg-[#305dc7] text-white">

<div class="flex w-full h-screen">
    
    <!-- load staff menu bar here -->
    <div class="load_data_container w-[20%]"></div>
    
    <div class="flex flex-col w-[79%]">
        
        
        <div class="flex flex-col w-full">
            <div class="mt-[18px]">
                
                <!-- Verites manage table section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-mt-2">
                            <div class="flex card-header ">
                                <h1 class="mt-4 text-xl">Verities Manage</h1>
                            </div>
                            <div class="p-1 ml-3 h-[50px]">
        
                                <div class="flex">
                                    
                                    <div class="col-md-7">
        
                                        <form action="" method="post" class="flex gap-4e">
                                            <div class="input-group">
                                                <input type="text" name="search_verities" value="<?php if(isset($_POST['search_verities'])){ echo $_POST['search_verities']; } ?>" class="form-control" placeholder="Use for search varietie name"  required>
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>  
                                        </form>
                                    </div>
                                    <button class="relative left-[270px]" data-bs-toggle="modal" data-bs-target="#add_verities">
                                        <div class="flex flex-col items-center justify-center w-32 bg-blue-500 border-2 border-white hover:bg-blue-600 hover:text-white rounded-xl h-9">
                                            <h3>Add Verities</h3>
                                        </div>
                                    </button>
                                    
                                </div>
                            </div>
        
                        </div>
                    </div>
        
                    <div class="col-md-12">
                        <div class="card-mt-1">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body table-responsive" style="max-height: 500px; overflow-y: auto;">
                                    <table class="table text-center text-white table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Product Name</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Verites Name</th>
                                                <th scope="col">Verites Image</th>
                                                <th scope="col">Info</th>
                                                <th scope="col">Action</th>
                                            <tr>   
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                                require 'db_conn.php';
                                                
                                                if(isset($_POST['search_verities'])){
                                                    $filter_verities = $_POST['search_verities'];
                                                    $query = "SELECT * FROM `verity` WHERE CONCAT(`product_name`, `verity_name`) LIKE '%$filter_verities%'";
                                                    $query_run = mysqli_query($conn, $query);
                                                
                                                    // CONCAT keyword filter the inside bracket column data only
                                                    // mysqli_num_rows use to check inside the query_run is empty or not
                                                    if(mysqli_num_rows($query_run) >  0)
                                                    {
            
                                                        foreach($query_run as $items){
                                                            //want to print table rows here and need to use insdie the td again php tag so close php tag here
                                                            ?>
                                                            <tr>   
                                                                <!-- using = mark can access the data, this are the print like echo data-bs-toggle="modal" data-bs-target="#update_verities"-->
                                                                <?php $updateVarity = $items['verity_id']; ?>
                                                                <td class="font-bold" id="verity_id" name="verity_id"><?= $items['verity_id']; ?></td>
                                                                <td><?= $items['product_category']; ?></td> 
                                                                <td><?= $items['product_name']; ?></td> 
                                                                <td><?= $items['verity_name']; ?></td>            
                                                                <td><?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/admin/images/verity/'.$items['Verities_image'].'" class="ml-16 proof_doc h-[40px] w-[80px]">'; ?></td>
                                                                <td class="text-black">
                                                                    <textarea class="rounded-lg disabled:bg-white" disabled cols="25" rows="2"><?= $items['Description']; ?></textarea>
                                                                </td>
                                                                <td class="flex justify-center gap-3 ">
                                                                    <button type="button" id="update_btn" data-id="<?php echo $items['verity_id']; ?>" class="update_btn" name="update_btn" >
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class= " size-7 hover:text-blue-500 h-[55px]">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                        </svg>
                                                                    </button>
                                                                    <button type="button" value=<?php echo $items['verity_id'] ?> class="verity_delete_btn">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" size-7 hover:text-red-500">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
            
                                                            <?php
                                                        }
            
                                                    }
                                                    else{
                                                        
                                                        ?>
                                                            <tr>
                                                                <td colspan="6">No Record Found</td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
        
                </div>

                <!-- Nutrients manage table section -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-mt-2">
                            <div class="flex card-header ">
                                <h1 class="mt-4 text-xl">Nutrients Manage</h1>
                            </div>
                            <div class="p-1 ml-3 h-[50px]">
        
                                <div class="flex">
                                    
                                    <div class="col-md-7">
        
                                        <form action="" method="post" class="flex gap-4e">
                                            <div class="input-group">
                                                <input type="text" name="search_nutrients" value="<?php if(isset($_POST['search_nutrients'])){ echo $_POST['search_nutrients']; } ?>" class="form-control" placeholder="Use for search fruits name"  required>
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>  
                                        </form>
                                    </div>
                                    <button class="relative left-[270px]" data-bs-toggle="modal" data-bs-target="#add_nutritions">
                                        <div class="flex flex-col items-center justify-center w-32 bg-blue-500 border-2 border-white hover:bg-blue-600 hover:text-white rounded-xl h-9">
                                            <h3>Add Nutrients</h3>
                                        </div>
                                    </button>
                                    
                                </div>
                            </div>
        
                        </div>
                    </div>
        
                    <div class="col-md-12">
                        <div class="card-mt-1">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body table-responsive" style="max-height: 500px; overflow-y: auto;">
                                    <table class="table text-center text-white table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Item Name</th>
                                                <th scope="col">Item Category</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Nutrients-01</th>
                                                <th scope="col">Nutrients-02</th>
                                                <th scope="col">Action</th>
                                            <tr>   
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                                require 'db_conn.php';
                                                
                                                if(isset($_POST['search_nutrients'])){
                                                    $filter_nutrients = $_POST['search_nutrients'];
                                                    $query = "SELECT * FROM `nutrition` WHERE CONCAT(`item`, `nutrient_id`) LIKE '%$filter_nutrients%'";
                                                    $query_run = mysqli_query($conn, $query);
                                                
                                                    // CONCAT keyword filter the inside bracket column data only
                                                    // mysqli_num_rows use to check inside the query_run is empty or not
                                                    if(mysqli_num_rows($query_run) >  0)
                                                    {
            
                                                        foreach($query_run as $items){
                                                            //want to print table rows here and need to use insdie the td again php tag so close php tag here
                                                            ?>
                                                            <tr>   
                                                                <!-- using = mark can access the data, this are the print like echo data-bs-toggle="modal" data-bs-target="#update_verities"-->
                                                                <td hidden id="nutrient_valu3"><?= $items['nutrient_valu3']; ?></td>
                                                                <td hidden id="nutrient_valu4"><?= $items['nutrient_valu4']; ?></td>
                                                                <td hidden id="nutrient_valu5"><?= $items['nutrient_valu5']; ?></td>
                                                                <td hidden id="nutrient_valu6"><?= $items['nutrient_valu6']; ?></td>
                                                                <td class="font-bold" id="nutrient_id" name="nutrient_id"><?= $items['nutrient_id']; ?></td>
                                                                <td id="item"><?= $items['item']; ?></td> 
                                                                <td id="item_category"><?= $items['item_category']; ?></td> 
                                                                <td id="nutrient_amont"><?= $items['nutrient_amont']; ?></td>
                                                                <td id="nutrient_valu1"><?= $items['nutrient_valu1']; ?></td> 
                                                                <td id="nutrient_valu2"><?= $items['nutrient_valu2']; ?></td>            
                                                                <td class="flex justify-center gap-3 ">
                                                                    <button type="button" id="update_nutrient_btn" data-id="<?php echo $items['nutrient_id']; ?>" class="update_nutrient_btn" name="update_nutrient_btn" >
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class= " size-7 hover:text-blue-500">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                        </svg>
                                                                    </button>
                                                                    <button type="button" value=<?php echo $items['nutrient_id'] ?> class="nutrient_delete_btn">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" size-7 hover:text-red-500">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
            
                                                            <?php
                                                        }
            
                                                    }
                                                    else{
                                                        
                                                        ?>
                                                            <tr>
                                                                <td colspan="6">No Record Found</td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
        
                </div>

            </div>
        </div>
    
    </div>
    
</div>

<!-- varities add modal -->
<div class="modal fade" id="add_verities" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl ">
         <div class="absolute text-black modal-content">
            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Add new verities details</h5></b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insert.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="flex flex-col ml-4 font-semibold">

                        <!-- Veritis Info -->
                        <div>
                            <label for="" class="text-2xl italic font-bold border-b-2 border-black">Veritis Info</label>
                            <div class="grid grid-cols-3 gap-3 mt-2">
                                <div class="flex flex-col gap-1">
                                    <label for="Product_name">Product Name</label>
                                    <input type="text" id="Product_name" name="Product_name" placeholder="Chili" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Verities_name">Verities Name</label>
                                    <input type="text" id="Verities_name" name="Verities_name" placeholder="Hungarian Yellow Wax (HYW)" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Origin">Origin</label>
                                    <input type="text" id="Origin" name="Origin" placeholder="North America" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Days_maturity">Days to Maturity</label>
                                    <input type="text" id="Days_Maturity" name="Days_Maturity" placeholder="65-75 days" class="h-8 border-2 border-black rounded-md w-72" required>
                                
                                    <label for="Category" class="mt-3">Category</label>
                                    <select name="Category" id="Category"  class="h-8 border-2 border-black rounded-md w-72" required>
                                        <option value="vegetable">vegetable</option>
                                        <option value="Fruit">Fruit</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Verities_image">Verities Image</label>
                                    <input type="file" accept="image/*" id="Verities_image" name="Verities_image" placeholder="Product name" class="w-72 border-2 h-[30px] border-black rounded-md" required>
                                </div>

                                <div class="flex flex-col gap-1">
                                    <label for="Description">Description</label>
                                    <textarea name="Description" rows="4" type="text" id="Description" placeholder="Chilies are perennial, cold-sensitive plants that belong to the nightshade family (Solanazeae). There are many varieties whose fruits differ in shape, color and pungency. Chillies, like sweet peppers, belong to the genus Capsicum, with 5 different species. The most important is Capsicum annuum, which includes varieties such as Cayenne and Jalapeño. Varieties of this species can be found in almost all heat ranges, except extremely hot. Another species is Capsicum chinense, to which the habanero belong. They originate from Peru and among them are extremely spicy varieties. Unlike the white flowers of the other chili species, the Capsicum baccatum species has yellowish to greenish spots on its flowers. The fruits of some varieties are also striking, hanging from the plant like bells, or 'UFO's' (Bishop's Crown). For the species Capsicum frutescens the flowers and fruits always standing upright on the plant are typical. In Europe, the species Capsicum pubescens is still quite unknown. Since its stem quickly becomes woody, the name tree chili is occasionally used. Striking features of this species are its hairy leaves, blue-purple flowers, and black seeds. The fruits are thick-fleshed and spherical. Excitingly, its fruits can be perceived as differently spicy by different people due to the particular composition of capsaicin and dihydro-capsaicin." class="text-black border-2 border-black rounded-md w-72" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Sowing Info -->
                        <div>
                            <label for="" class="mt-4 text-2xl italic font-bold border-b-2 border-black">Sowing Info</label>
                            <div class="grid grid-cols-3 gap-3 mt-1">
                                <div class="flex flex-col gap-1">
                                    <label for="Light">Light requirement</label>
                                    <select name="Light" class="h-8 border-2 border-black rounded-md w-72" id="Light"  required>
                                        <option value="Sunny">Sunny</option>
                                        <option value="Semi-shaded">Semi-Shaded</option>
                                        <option value="Shady">Shady</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Water">Water requirement</label>
                                    <select name="Water" class="h-8 border-2 border-black rounded-md w-72" id="Water"  required>
                                        <option value="Very humid">Very humid</option>
                                        <option value="Wet">Wet</option>
                                        <option value="Dry">Dry</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient">Nutrient requirement</label>
                                    <select name="Nutrient" class="h-8 border-2 border-black rounded-md w-72" id="Nutrient"  required>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Soil">Soil</label>
                                    <input type="text" id="Soil" name="Soil" placeholder="Light (sandy)" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="distance">Seeding distance</label>
                                    <input type="text" id="distance" name="distance" placeholder="40 cm" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="depth">Seeding depth</label>
                                    <input type="text" id="depth" name="depth" placeholder="1 cm" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="spacing">Row spacing</label>
                                    <input type="text" id="spacing" name="spacing" placeholder="60 cm" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                            </div>
                        </div>

                        <!-- Growing Info -->
                        <div>
                            <label for="" class="mt-4 text-2xl italic font-bold border-b-2 border-black">Growing Info</label>
                            <div class="grid grid-cols-3 gap-3 mt-2">
                                <div class="flex flex-col gap-1">
                                    <label for="Harvest_message">Harvesting Description</label>
                                    <textarea name="Harvest_message" rows="4" type="text" id="Harvest_message" class="text-black border-2 border-black rounded-md w-72" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div>
                            <label for="" class="mt-4 text-2xl italic font-bold border-b-2 border-black">Additional Info</label>
                            <div class="grid grid-cols-3 gap-3 mt-1">
                                <div class="flex flex-col gap-1">
                                    <div class="flex flex-col gap-1">
                                        <label for="Companion">Companion Plants</label>
                                        <input type="text" id="Companion" name="Companion" placeholder="Brussels sprouts, Chili" class="h-8 border-2 border-black rounded-md w-72">
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="Antagonistic">Antagonistic Plants</label>
                                        <input type="text" id="Antagonistic" name="Antagonistic" placeholder="Beetroot, Potato" class="h-8 border-2 border-black rounded-md w-72">
                                    </div>

                                </div>
                                <div class="flex flex-col gap-1">
                                    <div class="flex flex-col gap-1">
                                        <label for="Diseases">Diseases</label>
                                        <input type="text" id="Diseases" name="Diseases" placeholder="Blossomrot, Grey mold" class="h-8 border-2 border-black rounded-md w-72">
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="Pests">Pests</label>
                                        <input type="text" id="Pests" name="Pests" placeholder="Blight of carrot" class="h-8 border-2 border-black rounded-md w-72">
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="verities_submit"  class="w-24 btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- nutritions add modal -->
<div class="modal fade" id="add_nutritions" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg ">
        <div class="absolute p-2 text-black modal-content">
            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Add new nutritions details</h5></b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insert.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="font-semibold">

                        <div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1">
                                    <label for="Item_name">Item Name</label>
                                    <input type="text" id="Item_name" name="Item_name" placeholder="Chili" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">                                                                    
                                    <label for="Category">Category</label>
                                    <select name="Category" id="Category"  class="h-8 border-2 border-black rounded-md w-72" required>
                                        <option value="Vegetable">Vegetable</option>
                                        <option value="Fruit">Fruit</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Quantity">Quantity</label>
                                    <input type="text" id="Quantity" name="Quantity" placeholder="140g" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient1">Nutrient Value1</label>
                                    <input type="text" id="Nutrient1" name="Nutrient1" placeholder="Calories 65" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient2">Nutrient Value2</label>
                                    <input type="text" id="Nutrient2" name="Nutrient2" placeholder="Carbohydrate 16.5g" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient3">Nutrient Value3</label>
                                    <input type="text" id="Nutrient3" name="Nutrient3" placeholder="Fiber 2.8g" class="h-8 border-2 border-black rounded-md w-72">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient4">Nutrient Value4</label>
                                    <input type="text" id="Nutrient4" name="Nutrient4" placeholder="Vitamin C 82.7mg" class="h-8 border-2 border-black rounded-md w-72">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient5">Nutrient Value5</label>
                                    <input type="text" id="Nutrient5" name="Nutrient5" placeholder="Potassium 232mg" class="h-8 border-2 border-black rounded-md w-72">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient6">Nutrient Value6</label>
                                    <input type="text" id="Nutrient6" name="Nutrient6" placeholder="Calcium 60.2mg" class="h-8 border-2 border-black rounded-md w-72">
                                </div>

                            </div>
                            
                        </div> 
                                               
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="nutrition_submit"  class="w-24 btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- varities update modal -->
<div class="modal fade" id="update_verities" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl ">
         <div class="absolute text-black modal-content">
            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Update verities details</h5></b>
                <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="flex flex-col ml-4 font-semibold">

                        <!-- Veritis Info -->
                        <div>
                            <input type="text" id="up_verity_id" name="verity_id" hidden>
                            <label for="" class="text-2xl italic font-bold border-b-2 border-black">Veritis Info</label>
                            <div class="grid grid-cols-3 gap-3 mt-2">
                                <div class="flex flex-col gap-1">
                                    <label for="up_Product_name">Product Name</label>
                                    <input type="text" id="up_Product_name" name="Product_name" placeholder="Chili" value="<?php $updateVarity ?>" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="up_Verities_name">Verities Name</label>
                                    <input type="text" id="up_Verities_name" name="Verities_name" placeholder="Hungarian Yellow Wax (HYW)" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="up_Origin">Origin</label>
                                    <input type="text" id="up_Origin" name="Origin" placeholder="North America" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="up_Days_Maturity">Days to Maturity</label>
                                    <input type="text" id="up_Days_Maturity" name="Days_Maturity" placeholder="65-75 days" class="h-8 border-2 border-black rounded-md w-72" required>
                                    
                                    <label for="up_Category" class="mt-3">Category</label>
                                    <select name="Category" id="up_Category"  class="h-8 border-2 border-black rounded-md w-72" required>
                                        <option value="vegetable">vegetable</option>
                                        <option value="Fruit">Fruit</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="up_Verities_image">Verities Image</label>
                                    <input type="file" accept="image/*" id="up_Verities_image" name="Verities_image" placeholder="Product name" class="w-72 border-2 h-[30px] border-black rounded-md" >
                                    <img id="veritiesImagePreview" src="" alt="Verities Image" class="w-72 border-2 h-[110px] border-black rounded-md" required/>
                                </div>

                                <div class="flex flex-col gap-1">
                                    <label for="Description">Description</label>
                                    <textarea name="Description" rows="6" type="text" id="up_Description" placeholder="Chilies are perennial, cold-sensitive plants that belong to the nightshade family (Solanazeae). There are many varieties whose fruits differ in shape, color and pungency. Chillies, like sweet peppers, belong to the genus Capsicum, with 5 different species. The most important is Capsicum annuum, which includes varieties such as Cayenne and Jalapeño. Varieties of this species can be found in almost all heat ranges, except extremely hot. Another species is Capsicum chinense, to which the habanero belong. They originate from Peru and among them are extremely spicy varieties. Unlike the white flowers of the other chili species, the Capsicum baccatum species has yellowish to greenish spots on its flowers. The fruits of some varieties are also striking, hanging from the plant like bells, or 'UFO's' (Bishop's Crown). For the species Capsicum frutescens the flowers and fruits always standing upright on the plant are typical. In Europe, the species Capsicum pubescens is still quite unknown. Since its stem quickly becomes woody, the name tree chili is occasionally used. Striking features of this species are its hairy leaves, blue-purple flowers, and black seeds. The fruits are thick-fleshed and spherical. Excitingly, its fruits can be perceived as differently spicy by different people due to the particular composition of capsaicin and dihydro-capsaicin." class="text-black border-2 border-black rounded-md w-72" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Sowing Info -->
                        <div>
                            <label for="" class="mt-4 text-2xl italic font-bold border-b-2 border-black">Sowing Info</label>
                            <div class="grid grid-cols-3 gap-3 mt-1">
                                <div class="flex flex-col gap-1">
                                    <label for="Light">Light requirement</label>
                                    <select id="up_Light" name="Light" class="h-8 border-2 border-black rounded-md w-72" required>
                                        <option value="Sunny">Sunny</option>
                                        <option value="Semi-shaded">Semi-Shaded</option>
                                        <option value="Shady">Shady</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Water">Water requirement</label>
                                    <select name="Water" class="h-8 border-2 border-black rounded-md w-72" id="up_Water"  required>
                                        <option value="Very humid">Very humid</option>
                                        <option value="Wet">Wet</option>
                                        <option value="Dry">Dry</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient">Nutrient requirement</label>
                                    <select name="Nutrient" class="h-8 border-2 border-black rounded-md w-72" id="up_Nutrient"  required>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Soil">Soil</label>
                                    <input type="text" id="up_Soil" name="Soil" placeholder="Light (sandy)" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="distance">Seeding distance</label>
                                    <input type="text" id="up_distance" name="distance" placeholder="40 cm" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="depth">Seeding depth</label>
                                    <input type="text" id="up_depth" name="depth" placeholder="1 cm" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="spacing">Row spacing</label>
                                    <input type="text" id="up_spacing" name="spacing" placeholder="60 cm" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                            </div>
                        </div>

                        <!-- Growing Info -->
                        <div>
                            <label for="" class="mt-4 text-2xl italic font-bold border-b-2 border-black">Growing Info</label>
                            <div class="grid grid-cols-3 gap-3 mt-2">
                                <div class="flex flex-col gap-1">
                                    <label for="Harvest_message">Harvesting Description</label>
                                    <textarea name="Harvest_message" rows="4" type="text" id="up_Harvest_message" class="text-black border-2 border-black rounded-md w-72" required></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div>
                            <label for="" class="mt-4 text-2xl italic font-bold border-b-2 border-black">Additional Info</label>
                            <div class="grid grid-cols-3 gap-3 mt-1">
                                <div class="flex flex-col gap-1">
                                    <div class="flex flex-col gap-1">
                                        <label for="Companion">Companion Plants</label>
                                        <input type="text" id="up_Companion" name="Companion" placeholder="Brussels sprouts, Chili" class="h-8 border-2 border-black rounded-md w-72">
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="Antagonistic">Antagonistic Plants</label>
                                        <input type="text" id="up_Antagonistic" name="Antagonistic" placeholder="Beetroot, Potato" class="h-8 border-2 border-black rounded-md w-72">
                                    </div>

                                </div>
                                <div class="flex flex-col gap-1">
                                    <div class="flex flex-col gap-1">
                                        <label for="Diseases">Diseases</label>
                                        <input type="text" id="up_Diseases" name="Diseases" placeholder="Blossomrot, Grey mold" class="h-8 border-2 border-black rounded-md w-72">
                                    </div>
                                    <div class="flex flex-col gap-1">
                                        <label for="Pests">Pests</label>
                                        <input type="text" id="up_Pests" name="Pests" placeholder="Blight of carrot" class="h-8 border-2 border-black rounded-md w-72">
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="verities_update"  class="w-24 btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- nutritions update modal -->
<div class="modal fade" id="update_nutritions" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg ">
        <div class="absolute p-2 text-black modal-content">
            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Update new nutritions details</h5></b>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="font-semibold">

                        <div>
                            <input type="text" name="update_item_id" id="update_item_id" hidden>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="flex flex-col gap-1">
                                    <label for="Item_name">Item Name</label>
                                    <input type="text" id="update_Item_name" name="update_Item_name" placeholder="Chili" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">                                                                    
                                    <label for="Category">Category</label>
                                    <select name="update_Category" id="update_Category"  class="h-8 border-2 border-black rounded-md w-72" required>
                                        <option value="Vegetable">Vegetable</option>
                                        <option value="Fruit">Fruit</option>
                                    </select>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Quantity">Quantity</label>
                                    <input type="text" id="update_Quantity" name="update_Quantity" placeholder="140g" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient1">Nutrient Value1</label>
                                    <input type="text" id="update_Nutrient1" name="update_Nutrient1" placeholder="Calories 65" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient2">Nutrient Value2</label>
                                    <input type="text" id="update_Nutrient2" name="update_Nutrient2" placeholder="Carbohydrate 16.5g" class="h-8 border-2 border-black rounded-md w-72" required>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient3">Nutrient Value3</label>
                                    <input type="text" id="update_Nutrient3" name="update_Nutrient3" placeholder="Fiber 2.8g" class="h-8 border-2 border-black rounded-md w-72">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient4">Nutrient Value4</label>
                                    <input type="text" id="update_Nutrient4" name="update_Nutrient4" placeholder="Vitamin C 82.7mg" class="h-8 border-2 border-black rounded-md w-72">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient5">Nutrient Value5</label>
                                    <input type="text" id="update_Nutrient5" name="update_Nutrient5" placeholder="Potassium 232mg" class="h-8 border-2 border-black rounded-md w-72">
                                </div>
                                <div class="flex flex-col gap-1">
                                    <label for="Nutrient6">Nutrient Value6</label>
                                    <input type="text" id="update_Nutrient6" name="update_Nutrient6" placeholder="Calcium 60.2mg" class="h-8 border-2 border-black rounded-md w-72">
                                </div>

                            </div>
                            
                        </div> 
                                               
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update_nutrition" class="w-24 btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/custom.js"></script>
<!-- <script src="js/update.js"></script> -->

<!-- load side menu bar  -->
<script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/satffpanel.php');
    })
</script>

<!-- select and show update data here -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get all verities update buttons
        let updateButtons = document.querySelectorAll('.update_btn');

        // Get all verities update buttons
        let nutrition_update_Buttons = document.querySelectorAll('.update_nutrient_btn');

        // Add click event listener to each button
        updateButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Get verity_id from data attribute
                let verity_id = this.getAttribute('data-id');

                // Send an AJAX request to fetch data
                fetch(`update.php`,{
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: 'verity_id=' + verity_id
                    })
                    .then(response => response.json())
                    .then(data => {
                        
                        // Populate the modal's input fields with the fetched data
                        document.getElementById('up_verity_id').value = data.verity_id;
                        document.getElementById('up_Product_name').value = data.product_name;
                        document.getElementById('up_Verities_name').value = data.verity_name;
                        document.getElementById('up_Days_Maturity').value = data.Days_Maturity;
                        document.getElementById('up_Category').value = data.product_category;

                        let imagePath = "http://localhost/Agricultural-Support-Service-System/MyAgro/admin/images/verity/" + data.Verities_image;

                        // Set the src of the image preview to the file path from the database
                        document.getElementById('veritiesImagePreview').src = imagePath;

                        document.getElementById('up_Description').value = data.Description;
                        document.getElementById('up_Light').value = data.Light;
                        document.getElementById('up_Water').value = data.Water;
                        document.getElementById('up_Nutrient').value = data.Nutrient;
                        document.getElementById('up_Soil').value = data.Soil;
                        document.getElementById('up_distance').value = data.distance;
                        document.getElementById('up_depth').value = data.depth;
                        document.getElementById('up_spacing').value = data.spacing;
                        document.getElementById('up_Harvest_message').value = data.Harvest_message;
                        document.getElementById('up_Companion').value = data.Companion;
                        document.getElementById('up_Antagonistic').value = data.Antagonistic;
                        document.getElementById('up_Diseases').value = data.Diseases;
                        document.getElementById('up_Pests').value = data.Pests;
                        document.getElementById('up_Origin').value = data.Origin;

                        // Show the modal
                        let modal = new bootstrap.Modal(document.getElementById('update_verities'));
                        modal.show();
                    })
                    .catch(error => console.error('Error fetching verity data:', error));
            });

        });

        nutrition_update_Buttons.forEach(function (buttons) {
            buttons.addEventListener('click', function () {
                
                let row = this.closest('tr'); 

                let nutrient_id = row.querySelector('#nutrient_id').innerText;
                let item = row.querySelector('#item').innerText;
                let item_category = row.querySelector('#item_category').innerText;
                let nutrient_amont = row.querySelector('#nutrient_amont').innerText;
                let nutrient_valu1 = row.querySelector('#nutrient_valu1').innerText;
                let nutrient_valu2 = row.querySelector('#nutrient_valu2').innerText;
                let nutrient_valu3 = row.querySelector('#nutrient_valu3').innerText;
                let nutrient_valu4 = row.querySelector('#nutrient_valu4').innerText;
                let nutrient_valu5 = row.querySelector('#nutrient_valu5').innerText;
                let nutrient_valu6 = row.querySelector('#nutrient_valu6').innerText;


                document.getElementById('update_item_id').value = nutrient_id;
                document.getElementById('update_Item_name').value = item;
                document.getElementById('update_Category').value = item_category;
                document.getElementById('update_Quantity').value = nutrient_amont;
                document.getElementById('update_Nutrient1').value = nutrient_valu1;
                document.getElementById('update_Nutrient2').value = nutrient_valu2;
                document.getElementById('update_Nutrient3').value = nutrient_valu3;
                document.getElementById('update_Nutrient4').value = nutrient_valu4;
                document.getElementById('update_Nutrient5').value = nutrient_valu5;
                document.getElementById('update_Nutrient6').value = nutrient_valu6;

                // Show the modal
                let modal_nutrition = new bootstrap.Modal(document.getElementById('update_nutritions'));
                modal_nutrition.show();

            }); 

                
        });

    });
</script>




<!-- show output message -->
<script>
    var message ="<?php echo isset($_SESSION['verity_status']) ? $_SESSION['verity_status'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.

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
        <?php unset($_SESSION['verity_status']); ?>
    } 
</script>

<?php
// Close the database connection
$conn->close();
?>  

</body>
</html>