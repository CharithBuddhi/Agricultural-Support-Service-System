<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDM Payment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <h1 class="mt-3 font-serif text-3xl italic font-bold text-center">Cash Deposit Machine payment</h1>
    <div class="flex flex-col items-center gap-5 mt-8 ml-2 font-serif">
        <h1 class="text-2xl">Account Information</h1>
        <div class="flex flex-col text-xl gap-3 border-2 border-black w-[450px] h-[200px] rounded">
            <div class="flex">
                <h1>Bank Name :</h1>
                <label for="">peeoples bank</label>
            </div>
            <div class="flex">
                <h1>Account Name :</h1>
                <label for="">Rajakaruna WACB</label>   
            </div>
            <div class="flex">
                <h1>Account Number :</h1>
                <label for="">1802100240110</label>
            </div>
            <div class="flex">
                <h1>Account Branch :</h1>
                <label for="">Deraniyagala</label>
            </div>
            <div class="flex mb-2">
                <h1>Amount :</h1>
                <label for="">Rs. 100</label>
            </div>
        </div>
        <a href="index.html" class="border-2 border-black text-2xl w-[150px] object-right rounded-3xl text-center">Confirm</a>    
    </div>
</body>
</html>