<?php
session_start();

if($_SESSION['category'] == "chemical"){
    $category = "chemical";
    $type = $_POST['agro_type'];
    $_SESSION['login_url'] = "chemicalsell.php?type=$type";  

}elseif($_SESSION['category'] == "fertilizer"){
    $category = "fertilizer";
    $type = $_POST['agro_type'];
    $_SESSION['login_url'] = "agrosell.php?type=$type"; 

}

if(!isset($_SESSION['login_id']) && !isset($_SESSION['login_user']) && !isset($_SESSION['login_type'])){
    header('Location: login.php');
    exit();
}
date_default_timezone_set("Asia/colombo");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirme Order</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <!-- order confirmed page -->
    <h1 class="mt-3 font-serif text-3xl font-bold h-1/5">Order confirmed</h1>

    <div class="flex bg-[#D9D9D9] h-[770px] mt-4">

        <?php 

            require('db_connect.php');
            $id = $_POST['agro_id'];

            if(isset($id)){

                $query = "SELECT a.*, s.supplier_name,s.supplier_phone,s.supplier_email
                            FROM agrochemical a
                            JOIN supplier s ON a.supplier_id = s.supplier_id
                            WHERE a.agro_id = '$id';
                            ";
                // a means agrochemical table and s means supplier table
                $result = mysqli_query($conn, $query);
                                        
                if(mysqli_num_rows($result) >  0)
                {

                    $data = mysqli_fetch_array($result);
                    $name = $data['agro_name'];
                ?>
                    <div class="flex flex-col w-[500px] items-center h-[600px] ml-40 mt-12">
                        <img src="images/fertilizer/saveferti/<?php echo $data['agro_image'] ?>" alt="" class="w-[200px] h-[200px] rounded-3xl border-4 ">
                        <h3 class="mt-2 text-3xl font-bold "><?php echo $data['agro_name'] ?></h3><br>
                        <p class="font-medium text-justify"><?php echo $data['agro_description'] ?></p>   
                    </div>
                    <form action="paymentType.php" method="post" class="flex flex-col items-start gap-3 p-4 mt-12 ml-10 text-base font-medium text-justify border-4 h-fit rounded-3xl">
                        
                        <div class="flex gap-2">
                            <input type="hidden" name="agro_id" value="<?php echo $data['agro_id']; ?>" >
                            <label>Product Category : </label>
                            <label><?php echo $data['agro_category']; ?></label>
                            <input type="hidden" name="agro_category" value="<?php echo $data['agro_category']; ?>">
                            <input type="hidden" name="agro_type" value="<?php echo $_POST['agro_type']; ?>">

                        </div>
                        
                        <div class="flex gap-2 ">
                            <label>Product Name : </label>
                            <label><?php echo $data['agro_name']; ?></label>
                            <input type="hidden" name="agro_name" value="<?php echo $data['agro_name']; ?>">
                        </div>

                        <div class="flex gap-2 ">
                            <label>Product Price: </label>
                            <label >Rs.</label><label id="price"><?php echo $data['agro_price']; ?></label>
                            <input type="hidden" name="agro_price" value="<?php echo $data['agro_price']; ?>">
                        </div>

                        <?Php 
                            if($data['agro_category'] == "fertilizer"){
                                ?>
                                 <div class="flex gap-2 ">
                                    <label>Product Quantity :</label>
                                    <label id="agro_quantity"><?php echo $data['agro_quantity']; ?></label>
                                    <label>Kg</label>
                                </div>
                                <?php
                            }
                        ?>
                        <input type="hidden" name="agro_quantity" value="<?php echo $data['agro_quantity']; ?>">

                        <div class="flex gap-2 ">
                            <label>Shop Name : </label>
                            <label><?php echo $data['shop_name']; ?></label>
                            <input type="hidden" name="shop_name" value="<?php echo $data['shop_name']; ?>">
                        </div>

                        <div class="flex gap-2 ">
                            <label>Pick Up Location : </label>
                            <label><?php echo $data['agro_location'].','.$data['agro_area']; ?></label>
                            <input type="hidden" name="agro_location" value="<?php echo $data['agro_location'].', '.$data['agro_area']; ?>">
                        </div>
                        
                        <div class="flex gap-2 ">
                            <label>Order Quantity  : </label>
                            <label id="quantity"><?php echo $_POST['quantity']; ?></label>
                            <?Php 
                            if($data['agro_category'] == "fertilizer"){
                                ?>
                                <label>Kg</label>
                                <?php
                            }
                            ?>
                            <input type="hidden" name="quantity" value="<?php echo $_POST['quantity']; ?>">
                        </div>

                        <div class="flex gap-2 ">
                            <label>Total price : </label>
                            <label>Rs.</label><label id="total" class="text-base font-semibold text-justify"></label>
                            <input type="hidden" id="send_total" name="send_total" value="">
                        </div>

                        <div class="flex gap-2 ">
                            <label>Supplier Name : </label>
                            <label><?php echo $data['supplier_name']; ?></label>
                            <input type="hidden" name="supplier_id" value="<?php echo $data['supplier_id']; ?>">
                            <input type="hidden" name="supplier_name" value="<?php echo $data['supplier_name']; ?>">
                        </div>

                        <div class="flex gap-2 ">
                            <label>Supplier Phone No : </label>
                            <label>+<?php echo $data['supplier_phone']; ?></label>
                            <input type="hidden" name="supplier_phone" value="<?php echo $data['supplier_phone']; ?>">
                        </div>

                        <div class="flex gap-2 ">
                            <label>Supplier Email : </label>
                            <label><?php echo $data['supplier_email']; ?></label>
                            <input type="hidden" name="supplier_email" value="<?php echo $data['supplier_email']; ?>">
                        </div><br>

                        <div class="flex gap-4">
                            <?php 
                            if($category == "chemical"){
                                ?>
                                <a href="chemicalsell.php?type=<?php echo $_POST['agro_type']; ?>" class="flex justify-center cursor-pointer w-[200px] self-center text-black font-bold border-[3px] bg-[#ddf2a1] border-[#BFDC0C] rounded-3xl px-4 py-1 mt-2 ">Cancel</a>
                                <?php
                            }else if($category == "fertilizer"){
                                ?>
                                <a href="agrosell.php?type=<?php echo $_POST['agro_type']; ?>" class="flex justify-center cursor-pointer w-[200px] self-center text-black font-bold border-[3px] bg-[#ddf2a1] border-[#BFDC0C] rounded-3xl px-4 py-1 mt-2 ">Cancel</a>
                                <?php
                            }
                            ?>
                            <button type="submit" id="processPayment" name="confirm_order" class="flex justify-center cursor-pointer w-[200px] self-center text-black font-bold border-[3px] bg-[#ddf2a1] border-[#BFDC0C] rounded-3xl px-4 py-1 mt-2 ">Confirm</button>
                        </div>
                        
                    </form>
                    <div class="absolute ml-40 mr-32 bottom-20">
                        <p class="mt-3 text-lg font-bold text-justify text-red-600">Please note that you can’t order cancel after you pay. your order can go to provide location and get that product 
                            with pay of left of amount cash on hand.if you have any question, please contact us.
                        </p>
                    </div>

                <?php

                }else{

                    ?>
                    
                    <div class="flex flex-wrap justify-center w-[100%] items-center">
                        <h1 class="relative text-4xl italic font-semibold text-center right-40">Now Product is Over, Not available any more!</h1>
                    </div>

                    <?php
                }

            }else{
                
                header('location: index.php');
                exit(0);
            }
        
        ?>
        
    </div>

    <!-- calculate full and half payment -->
    <script>

        var total = document.getElementById('total');
        const send_total = document.getElementById('send_total');
        // var half = document.getElementById('half');
        // const send_half = document.getElementById('send_half');
        var quantity = parseFloat(document.getElementById('quantity').innerHTML);
        var price = document.getElementById('price').innerHTML;
        var oneQuantity = <?php echo $data['agro_quantity']; ?>;

        var payQuantity = quantity / oneQuantity;
        var total_price = (price * payQuantity).toFixed(2);
        // var half_price = (total_price/2).toFixed(2);
        total.innerHTML = total_price;
        send_total.value = total_price;
        // send_half.value = half_price;
        // half.innerHTML = half_price;
        
    </script>
    
</body>
</html>