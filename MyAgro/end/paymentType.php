<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Type</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <!--select payment type -->
    <div class="flex flex-col gap-5 font-serif text-center">
        <h1 class="mt-12 font-serif text-3xl italic font-bold">Payment</h1>  
        <p class="text-2xl">Select the type you want to payment</p>
        <div class="flex justify-center gap-8 mt-10 font-bold ">
            <div class="flex flex-col gap-2">
                <a href="retail.html"><img src="images/payment Online.jpg" alt="online payment image" class="cursor-pointer w-[400px] h-[300px] rounded-3xl"></a>
                <a href="retail.html" class="text-xl">Online Payment</a>
                <h1 class="mt-3">Pay your payment directly online</h1>
            </div>
            <div class="flex flex-col gap-2">
                <a href="retail.html"><img src="images/CDM.jpg" alt="Cash Deposit Machine" class="cursor-pointer w-[400px] h-[300px] rounded-3xl"></a>
                <a href="retail.html" class="text-xl">CDM  Payment</a>
                <h1 class="mt-3">To pay your payment through a CDM machine</h1>
            </div>
        </div>
    </div>
</body>
</html>