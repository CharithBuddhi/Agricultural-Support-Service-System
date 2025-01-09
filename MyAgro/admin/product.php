<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['login_admin_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Farmer Info</title>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }  
    </style>
</head>
<body class="bg-[#1c4094] text-white">
    
    <div class="w-screen h-screen">
        <div class="flex w-full h-full">

            <!-- Dashboard Menu bar load here-->
            <div class="load_data_container w-[20%]"></div>

            <div class="flex flex-col w-[79%] h-fit">
                
                <!-- farmer product manage table section -->
                <div class="flex flex-col w-full">
                    <div class="mt-[10px] ml-4">

                        <div class="flex flex-col">

                            <div class="gap-1">
                                <div class="flex">
                                    <h1 class="mt-5 font-serif text-2xl">Farmer Product Details</h1>
                                </div>  
                                <form action="" method="post" class="flex mt-1">
                                    <div class="flex gap-2">
                                        <input type="text" class="h-8 p-1 font-sans text-black rounded-md border-1 w-96" name="search_farmer_product" value="<?php if(isset($_POST['search_farmer_product'])){ echo $_POST['search_farmer_product']; } ?>" placeholder="Search by farmer name or product name" required>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-center h-8 w-[100px] rounded-lg">Search</button>
                                    </div>  
                                </form>                                           
                            </div>
                
                            <div class="mt-3">
                                <div class="" id="customer_table" style="max-height: 310px; overflow-y: auto;">
                                    <table class="w-full font-sans text-center text-white table-auto table-hover">
                                        <thead>
                                            <tr class="h-10 text-center text-black bg-white">
                                                <th>Farmer</th>
                                                <th>Product Name</th>
                                                <th>Verity Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>District</th>
                                                <th>Area</th>
                                                <th>Image</th>
                                            <tr>   
                                        </thead>
                                        <tbody id="">
                                            <?php
                                                require('db_conn.php');                      

                                                // search payment detials show here
                                                if(isset($_POST['search_farmer_product'])) {
                                                    
                                                    $query_1 = "SELECT v.*, f.username FROM vegetablefruit v JOIN farmer f ON v.farmer_id = f.farmer_id"; 
                                                    
                                                    $search_farmer_or_product = $_POST['search_farmer_product'];
                                                    $search_farmer_or_product_1 = "%$search_farmer_or_product%";
                            
                                                    $query .= " WHERE CONCAT(f.username, v.vegetable_name) LIKE ? ";
                                
                                                    // Prepare the statement
                                                    $stmt = $conn->prepare($query_1 . $query);
                                
                                                    if ($stmt === false) {
                                
                                                        die('Prepare error: ' . $conn->error);
                                                        
                                                    }
                                                    
                                                    $stmt->bind_param("s", $search_farmer_or_product_1);
                                
                                                    // Execute the statement
                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }
                                
                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();

                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td id="farmer_username"><?= $row['username']; ?></td>
                                                                    <td id="vegetable_name"><?= $row['vegetable_name']; ?></td>
                                                                    <td id="vegfruitle_verity"><?= $row['vegfruitle_verity']; ?></td>
                                                                    <td id="vegfruit_price"><?= "Rs ".$row['vegfruit_price']; ?></td>
                                                                    <td id="vegfruit_total"><?= $row['vegfruit_total'].$row['measurement']; ?></td>
                                                                    <td id="vegfruit_distric"><?= $row['vegfruit_distric']; ?></td>
                                                                    <td id="vegfruit_area"><?= $row['vegfruit_area']; ?></td>
                                                                    <td class="flex items-center justify-center mt-1">
                                                                        <?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/end/images/vegetable/'.$row['vegfruit_image'].'" width="50px" height="50px" class="farmer_product_image">'; ?>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }

                                                }else{


                                                    $query = "SELECT v.*, f.username FROM vegetablefruit v JOIN farmer f ON v.farmer_id = f.farmer_id";

                                                    // prepare statment
                                                    $stmt = $conn->prepare($query);

                                                    if ($stmt === false) {
                                                        die('Prepare error: ' . $conn->error);
                                                    }

                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }

                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();

                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td id="farmer_username"><?= $row['username']; ?></td>
                                                                    <td id="vegetable_name"><?= $row['vegetable_name']; ?></td>
                                                                    <td id="vegfruitle_verity"><?= $row['vegfruitle_verity']; ?></td>
                                                                    <td id="vegfruit_price"><?= "Rs ".$row['vegfruit_price']; ?></td>
                                                                    <td id="vegfruit_total"><?= $row['vegfruit_total'].$row['measurement']; ?></td>
                                                                    <td id="vegfruit_distric"><?= $row['vegfruit_distric']; ?></td>
                                                                    <td id="vegfruit_area"><?= $row['vegfruit_area']; ?></td>
                                                                    <td class="flex items-center justify-center mt-1">
                                                                        <?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/end/images/vegetable/'.$row['vegfruit_image'].'" width="50px" height="50px" class="farmer_product_image">'; ?>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                $conn->close();
                                    
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- supplier product manage table section -->
                <div class="flex flex-col w-full">
                    <div class="mt-[10px] ml-4">

                        <div class="flex flex-col">

                            <div class="gap-1">
                                <div class="flex">
                                    <h1 class="mt-5 font-serif text-2xl">Supplier Product Details</h1>
                                </div>  
                                <form action="" method="post" class="flex mt-1">
                                    <div class="flex gap-2">
                                        <input type="text" class="h-8 p-1 font-sans text-black rounded-md border-1 w-96" name="search_supplier_product" value="<?php if(isset($_POST['search_supplier_product'])){ echo $_POST['search_supplier_product']; } ?>" placeholder="Search by farmer name or product name" required>
                                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white text-center h-8 w-[100px] rounded-lg">Search</button>
                                    </div>  
                                </form>                                           
                            </div>
                
                            <div class="mt-3">
                                <div class="" id="customer_table" style="max-height: 310px; overflow-y: auto;">
                                    <table class="w-full font-sans text-center text-white table-auto table-hover">
                                        <thead>
                                            <tr class="h-10 text-center text-black bg-white">
                                                <th>Supplier</th>
                                                <th>Product Name</th>
                                                <th>Product Category</th>
                                                <th>Shop Name</th>
                                                <th>SLS No</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>District</th>
                                                <th>Area</th>
                                                <th>Image</th>
                                            <tr>   
                                        </thead>
                                        <tbody id="">
                                            <?php
                                                require('db_conn.php');                      

                                                // search payment detials show here
                                                if(isset($_POST['search_supplier_product'])) {
                                                    
                                                    $query_3 = "SELECT a.*, s.username FROM agrochemical a JOIN supplier s ON a.supplier_id = s.supplier_id"; 
                                                    
                                                    $search_supplier_or_product = $_POST['search_supplier_product'];
                                                    $search_supplier_or_product_1 = "%$search_supplier_or_product%";
                            
                                                    $query_4 .= " WHERE CONCAT(s.username, a.agro_name) LIKE ? ";
                                
                                                    // Prepare the statement
                                                    $stmt = $conn->prepare($query_3 . $query_4);
                                
                                                    if ($stmt === false) {
                                
                                                        die('Prepare error: ' . $conn->error);
                                                        
                                                    }
                                                    
                                                    $stmt->bind_param("s", $search_supplier_or_product_1);
                                
                                                    // Execute the statement
                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }
                                
                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();

                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                    <td><?= $row['username']; ?></td>
                                                                    <td><?= $row['agro_name']; ?></td>
                                                                    <td><?= $row['agro_category']; ?></td>
                                                                    <td><?= $row['shop_name']; ?></td>
                                                                    <td><?= $row['sls_id']; ?></td>
                                                                    <td><?= "Rs ".$row['agro_price']; ?></td>
                                                                    <td><?= $row['total_quantity'].$row['meassure']; ?></td>
                                                                    <td><?= $row['agro_district']; ?></td>
                                                                    <td><?= $row['agro_area']; ?></td>
                                                                    <td class="flex items-center justify-center mt-1">
                                                                        <?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/end/images/fertilizer/saveferti/'.$row['agro_image'].'" width="50px" height="50px" class="supplier_product_image">'; ?>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }

                                                }else{


                                                    $query = "SELECT a.*, s.username FROM agrochemical a JOIN supplier s ON a.supplier_id = s.supplier_id"; 

                                                    // prepare statment
                                                    $stmt = $conn->prepare($query);

                                                    if ($stmt === false) {
                                                        die('Prepare error: ' . $conn->error);
                                                    }

                                                    if (!$stmt->execute()) {
                                                        die('Execute error: ' . $stmt->error);
                                                    }

                                                    // Get result set from the statement
                                                    $result = $stmt->get_result();

                                                    if($result && $result->num_rows > 0) {
                                                        
                                                        while($row = $result->fetch_assoc()) {
                                                            
                                                            ?>

                                                                <tr class="h-10 text-center border-b-2 border-slate-300">
                                                                <td><?= $row['username']; ?></td>
                                                                    <td><?= $row['agro_name']; ?></td>
                                                                    <td><?= $row['agro_category']; ?></td>
                                                                    <td><?= $row['shop_name']; ?></td>
                                                                    <td><?= $row['sls_id']; ?></td> 
                                                                    <td><?= "Rs ".$row['agro_price']; ?></td>
                                                                    <td><?= $row['total_quantity'].$row['meassure']; ?></td>
                                                                    <td><?= $row['agro_district']; ?></td>
                                                                    <td><?= $row['agro_area']; ?></td>
                                                                    <td class="flex items-center justify-center mt-1">
                                                                        <?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/end/images/fertilizer/saveferti/'.$row['agro_image'].'" width="50px" height="50px" class="supplier_product_image">'; ?>
                                                                    </td>
                                                                </tr>

                                                            <?php
                                                        }
                                                        $stmt->close();

                                                    }else{
                                                        ?>
                                                        <tr>
                                                            <td colspan="8">No Record Found</td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                $conn->close();
                                    
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </div>

        </div>

    </div>

    <!-- Modal for farmer proof document view -->
    <div id="product_modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">      
        <div class="p-4 rounded-xl border shadow-2xl border-slate-500 bg-[#fefefe] text-black"
            style="max-width: 90%; max-height: 90%; overflow-y: auto;">

            <!-- Modal Header -->
            <div class="mb-5">
                <b><h5>Product Image</h5></b>
            </div>

            <!-- Modal Body -->
            <div class="flex items-center justify-center align-middle">
                <img src="" alt="product image" class="object-contain modal-img">
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-2 mt-4 text-center">
                <button type="button" id="close" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
            </div>
        </div>
    </div>

    <!-- load side menu bar  -->
    <script>
        $(document).ready(function(){
            $('.load_data_container').load('sendcode/adminpanel.php');
        })
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- farmer proof document popup and hide function -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const modal = document.getElementById("product_modal"); 
            const close_btn = document.getElementById("close"); ;

            function centerModal() {
                modal.style.display = "block"; // After modal show set modal attribute again

                modal.style.display = "flex";
                modal.style.alignItems = "center";  // Use camelCase for 'align-items'
                modal.style.justifyContent = "center";  // Use camelCase for 'justify-content'

            }

            document.addEventListener("click", function (e) {
                //if click on the image then set that doc src for modal
                if (e.target.classList.contains("farmer_product_image")) {
                    const src = e.target.getAttribute("src");
                    document.querySelector(".modal-img").src = src;

                    // call function to center modal
                    centerModal();
                }
                if (e.target.classList.contains("supplier_product_image")) {
                    const src = e.target.getAttribute("src");
                    document.querySelector(".modal-img").src = src;

                    // call function to center modal
                    centerModal();
                }
            });

            // When the user clicks on the close button (span), close the modal
            close_btn.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        });
    </script>

</body>

</html>