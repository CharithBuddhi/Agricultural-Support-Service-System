<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrochemical Type</title>
    <link rel="stylesheet" href="/MyAgro/style.css">
</head>
<body>

    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <div class="flex flex-col items-center w-full h-full gap-5">
        
        <div>
            <h1 class="flex justify-center mt-20 font-serif text-3xl italic font-bold ">Select Category</h1>   
        </div>

        <div class="flex items-center justify-center mt-16">

            <div class="">
                <a href="fertilizer_category.php" class="flex flex-col items-center gap-3 p-2 border-2 shadow-2xl rounded-2xl border-slate-300">
                    <img src="images/fer1.png" alt="Fertilizer type" class="  w-[300px] h-[300px]">
                    <h1 for="" class="font-serif font-bold cursor-pointer">Fertilizer</h1>
                </a>
            </div>

            <!-- logo MyAgro -->
            <div class="relative flex self-end p-2 top-2">
                <ion-icon name="leaf-outline" class="w-[50px] h-[50px]"></ion-icon>
                <ion-icon name="leaf-outline" class="w-[50px] h-[50px] scale-x-[-1]"></ion-icon>
            </div>

            <div class="" >
                <a href="agro_category.php" class="flex flex-col items-center gap-3 p-2 border-2 shadow-2xl rounded-2xl border-slate-300"> 
                    <img src="images/agro.jpg" alt="Fertilizer type" class="  w-[300px] h-[300px]">
                    <label for="" class="font-serif font-bold cursor-pointer">Agrochemical</label>     
                </a>
            </div>

        </div>
        
        
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>