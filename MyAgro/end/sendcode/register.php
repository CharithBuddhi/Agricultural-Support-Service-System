<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Register menu bar -->
    <div class="flex flex-col items-center">
     <!-- shapes -->
     <div class="">
            <p class="absolute top-[160px] left-[2px] text-xl font-semibold text-white">Select your user type</p>
            <a href="customer.php">
                <div class="absolute gap-1 flex w-[220px] h-[80px] rounded-2xl bg-white top-[200px] left-[-10px] border-2 justify-center border-cyan-500 hover:border-4  hover:border-teal-300 text-xl hover:w-[250px]">
                    <label for="" class="mt-5 font-serif">Customer</label>
                    <img src="images/customer.png" alt="cus" class="w-[40px] h-[40px] mt-4">
                </div>
            </a>
            <a href="farmer.php">
                <div class="absolute gap-5 flex w-[220px] h-[80px] rounded-2xl bg-white top-[280px] left-[-10px] border-2 justify-center border-cyan-500 hover:border-4  hover:border-teal-300 text-xl hover:w-[250px]">
                    <label for="" class="mt-5 font-serif">Farmer</label>
                    <img src="images/farmer.png" alt="cus" class="w-[40px] h-[40px] mt-4">
                </div>
            </a>
            <a href="supplier.php">
                <div class="absolute gap-1 flex w-[220px] h-[80px] rounded-2xl bg-white top-[360px] left-[-10px] border-2 justify-center border-cyan-500 hover:border-4  hover:border-teal-300 text-xl hover:w-[250px]">
                    <label for="" class="mt-5 font-serif">Supplier</label>
                    <img src="images/supplier.png" alt="cus" class="w-[40px] h-[40px] mt-4">
                </div>
            </a>
            
        </div>

    </div>


</body>
</html>