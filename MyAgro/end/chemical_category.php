<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agrochemical Category</title>
    <link rel="stylesheet" href="/MyAgro/style.css">
</head>
<body>

    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <div class="flex flex-col items-center w-full h-full">
        
        <div>
            <h1 class="flex justify-center mt-10 font-serif text-3xl italic font-bold ">Select Type</h1>   
        </div>

        <div class="self-start ml-10">
            
            <?php 
                $typ = 'Agrochemical';
            ?>

            <h1><label class="font-semibold">You are here: </label><a href="typeagrochemical.php" class="font-medium hover:underline"> Select Category</a> 
            <label for="" class="font-semibold"> <?php echo '> '.$typ; ?> </label></h1>
            <hr class=" mt-1 border-1 border-[#C19A6B]">
        </div>

        <div class="flex-col items-center justify-center mt-12">

            <div class="flex items-center justify-center">

                <div class="">
                    <a href="chemicalsell.php?type=Insecticides" class="flex flex-col items-center gap-3 border-2 shadow-2xl rounded-xl border-slate-300">
                        <img src="images/fertilizer/beetle.jpg" alt="chemical type" class="  w-[300px] h-[250px] rounded-lg">
                        <h1 for="" class="mb-1 font-serif font-bold cursor-pointer">Insecticides Agrochemical</h1>
                    </a>
                </div>
        
                <!-- logo MyAgro -->
                <div class=" relative flex self-end h-[80px] top-16 p-1">
                    <ion-icon name="leaf-outline" class="w-[50px] h-[50px]"></ion-icon>
                    <ion-icon name="leaf-outline" class="w-[50px] h-[50px] scale-x-[-1]"></ion-icon>
                </div>
        
                <div class="" >
                    <a href="chemicalsell.php?type=Fungicides" class="flex flex-col items-center gap-3 border-2 shadow-2xl rounded-xl border-slate-300"> 
                        <img src="images/fertilizer/fungicides.jpeg" alt="chemical type" class="  w-[300px] h-[250px] rounded-lg">
                        <label for="" class="mb-1 font-serif font-bold cursor-pointer ">Fungicides Agrochemical</label>     
                    </a>
                </div>

            </div>

            <div class="flex items-center justify-center mt-[54px]">

                <div class="">
                    <a href="chemicalsell.php?type=Weedicides" class="flex flex-col items-center gap-3 border-2 shadow-2xl rounded-xl border-slate-300">
                        <img src="images/fertilizer/Wild.jpg" alt="chemical type" class="  w-[300px] h-[250px] rounded-lg">
                        <h1 for="" class="mb-1 font-serif font-bold cursor-pointer">Weedicides Agrochemical</h1>
                    </a>
                </div>
        
                <!-- logo MyAgro -->
                <div class="relative bottom-6 flex self-start h-[80px] p-1">
                    <ion-icon name="leaf-outline" class="w-[50px] h-[50px] scale-y-[-1]"></ion-icon>
                    <ion-icon name="leaf-outline" class="w-[50px] h-[50px] rotate-180"></ion-icon>
                </div>
        
                <div class="" >
                    <a href="chemicalsell.php?type=Organic" class="flex flex-col items-center gap-3 border-2 shadow-2xl rounded-xl border-slate-300"> 
                        <img src="images/fertilizer/misc.jpg" alt="chemical type" class="  w-[300px] h-[250px] rounded-lg">
                        <label for="" class="mb-1 font-serif font-bold cursor-pointer">Organic Insecticides Agrochemical</label>     
                    </a>
                </div>

            </div>

        </div>

    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    
</body>
</html>