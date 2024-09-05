<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Add</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-slate-100">

    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <!-- product add section -->
    <div class="flex justify-center">
        <h1 class="flex justify-center bg-gradient-to-r from-[#F3F6EC] from-10% via-[#B0DF4D] via-80% to-[#A6E918] to-100% w-[400px] mt-2 font-serif text-3xl italic font-bold border-2 border-lime-400 rounded-3xl">sell your product</h1>
    </div>
    <div class="flex justify-center gap-40 mt-16 font-serif text-xl">
        <div class="flex flex-col gap-5">
            <div class="">
                <h3 class="">Product Catogry :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3 class="">Product Name :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3 class="">Price (per 1kg) :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3 class="">Quantity :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3 class="">Home town :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3>Address :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3 class="">Stock Images :</h3>
                <input type="image" width="48" height="48" class="text-lg text-justify border-2 w-[300px] h-[80px] rounded border-black">
            </div>
        </div> 
        <div class="flex flex-col gap-5">
            <div class="">
                <h3 class="t">Bank Name :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3 class="">Bank Account Number :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3 class="t">Bank Account Name :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <h3 class="">Account Branch :</h3>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="flex gap-5 mt-3 justify-evenly">
                <input type="reset" value="Clear" class="border-2 border-black rounded rounded-lg focus:cursor-pointer w-[125px]">
                <input type="submit" value="Submit" class="border-2 border-black rounded rounded-lg focus:cursor-pointer w-[125px]">
            </div>
        </div>  
    </div>     
</body>
</html>