<?php session_start();
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
                            <label>Name : </label>
                            <label><?php echo $data['agro_name']; ?></label>
                            <input type="hidden" name="agro_name" value="<?php echo $data['agro_name']; ?>">
                        </div>
                        <div class="flex gap-2 ">
                            <label>Price 1 packet: </label>
                            <label id="price"><?php echo $data['agro_price']; ?></label>
                            <input type="hidden" name="agro_price" value="<?php echo $data['agro_price']; ?>">
                        </div>
                        <div class="flex gap-2 ">
                            <label>Location : </label>
                            <label><?php echo $data['agro_location'].','.$data['agro_area']; ?></label>
                            <input type="hidden" name="agro_location" value="<?php echo $data['agro_location'].','.$data['agro_area']; ?>">
                        </div>
                        <div class="flex gap-2 ">
                            <label>Shop Name : </label>
                            <label><?php echo $data['shop_name']; ?></label>
                            <input type="hidden" name="shop_name" value="<?php echo $data['shop_name']; ?>">
                        </div>
                        <div class="flex gap-2 ">
                            <label>Order Quantity  : </label>
                            <label id="quantity"><?php echo $_POST['quantity']; ?></label><label>Kg</label>
                            <input type="hidden" name="quantity" value="<?php echo $_POST['quantity']; ?>">
                        </div>
                        <div class="flex gap-2 ">
                            <label>Total price : </label>
                            <label id="total" class="text-base font-semibold text-justify">Rs.</label>
                            <input type="hidden" id="send_total" name="send_total" value="">
                        </div>
                        <div class="flex gap-2 ">
                            <label>Half payment : </label>
                            <label id="half" class="text-base font-semibold text-justify">Rs.</label>
                            <input type="hidden"  id ="send_half" name="send_half" value="">   
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
                            <a href="agrosell.php?type=<?php echo $_POST['agro_type']; ?>" class="flex justify-center cursor-pointer w-[200px] self-center text-black font-bold border-[3px] bg-[#ddf2a1] border-[#BFDC0C] rounded-3xl px-4 py-1 mt-4 ">Cancel</a>
                            <button type="submit" name="confirm_order" class="flex justify-center cursor-pointer w-[200px] self-center text-black font-bold border-[3px] bg-[#ddf2a1] border-[#BFDC0C] rounded-3xl px-4 py-1 mt-4 ">Confirm</button>
                        </div>
                    </form>
                    <div class="absolute ml-10 mr-10 bottom-10">
                        <p class="mt-3 text-lg text-justify text-red-600">Farmer name is <?php echo $data['supplier_name'] ?>, you can go 
                            provide this address location and get your product
                        </p><br>
                        <p class="mt-3 text-lg font-bold text-justify text-red-600">** This payment not a full payment. 
                            you can pay advance for your order. please note that you can’t order cancel after you pay. your order can go to provide location and get that product 
                            with pay of left of amount cash on hand.if you have any question, please contact us. **
                        </p>
                    </div>

                <?php

                }else{

                    ?>
                    
                    <div class="flex flex-wrap justify-center w-[100%] items-center">
                        <h1 class="relative text-4xl italic font-semibold text-center right-40">There is no fertilizer available</h1>
                    </div>

                    <?php
                }

            }else{
                
                header('location: index.php');
                exit(0);
            }
        
        ?>
        
    </div>

    <script>

        var total = document.getElementById('total');
        const send_total = document.getElementById('send_total');
        var half = document.getElementById('half');
        const send_half = document.getElementById('send_half');
        var quantity = document.getElementById('quantity').innerHTML;
        var price = document.getElementById('price').innerHTML;
        var oneQuantity = <?php echo $data['agro_quantity']; ?>;

        var payQuantity = quantity / oneQuantity;
        var total_price = price * payQuantity;
        var half_price = total_price/2;
        total.innerHTML = total_price;
        send_total.value = total_price;
        send_half.value = half_price;
        half.innerHTML = half_price;
        
    </script>
    
</body>
</html>