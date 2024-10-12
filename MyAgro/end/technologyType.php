<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technology Type</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <!--select techniques type -->
    <div class="flex flex-col gap-5 font-serif text-center">
        <h1 class="mt-12 font-serif text-3xl italic font-bold">New Techniques</h1>  
        <p class="text-2xl">Select the category you want to study</p>
        <div class="flex justify-center gap-8 mt-10 font-bold ">
            <div class="flex flex-col gap-3">
                <a href="techno.php"><img src="images/complex.jpg" alt="Complex Techniques image" class="cursor-pointer w-[319.8px] h-[246px] rounded-3xl shadow-xl shadow-gray-400"></a>
                <a href="techno.php" class="text-xl">Complex Techniques</a>
                <h1 class="mt-3">Large scale machinery and equipment</h1>
            </div>
            <div class="flex flex-col gap-3">
                <a href="techno.php"><img src="images/simpl.jpg" alt="Simple Techniques image" class="cursor-pointer w-[319.8px] h-[246px] rounded-3xl shadow-xl shadow-gray-400 "></a>
                <a href="techno.php" class="text-xl">Simple Techniques</a>
                <h1 class="mt-3">Small size machinery and equipment</h1>
            </div>
        </div>
    </div>
</body>
</html>