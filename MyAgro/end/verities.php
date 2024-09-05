<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIfferent Verities</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <div class="flex flex-col gap-10">
        <h1 class="mt-5 font-serif text-3xl font-bold text-center">Crop of verities </h1>
        <!-- filter section -->
        <div class="flex gap-8 pl-4 pr-4 h-[100px] pt-4 pb-3 ml-4 align-center border-2 border-gray-200 shadow-lg shadow-gray-400 w-[65%] rounded-3xl">
            <div class="flex flex-col gap-1">
                <label for="" class="font-semibold text-justify">Category</label>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black focus:ring-2 focus:ring-teal-300">
            </div>
            <div class="flex flex-col gap-1">
                <label for="" class="font-semibold text-justify">Name</label>
                <input type="text" class="text-lg text-justify border-2 w-[300px] h-[28px] rounded border-black">
            </div>
            <div class="">
                <button type="submit" class=" mt-6 w-[100px] h-8 border-2 bg-[#DBF087] border-[#55E113] rounded-lg" >Search</button>
            </div>
        </div>
        <!-- search result section -->
        <div class="flex gap-5 ml-4">
            <!-- search image popup here -->
            <div>
                <img src="images/verites.png" alt="" class="w-[240px] h-[175px] border-2 border-gray-300 shadow-2xl rounded-3xl">
            </div>
            <!-- search details popup here -->
            <div class="flex flex-col gap-3 mt-1">                
                <div class="flex gap-2 ">
                    <h3 class="text-lg font-medium">Variety name :</h3>
                    <h3 class="text-lg" name="variety">White cabbage Andor</h3>
                </div>   
                <div class="flex gap-4">
                    <h3 class="text-lg font-medium">Information  :</h3>
                    <textarea class="text-lg w-[800px] h-[150px] text-justify" disabled>Excellent, medium early ripening, vigorously growing, fine-ribbed storage cabbage variety. Forms densely filled, medium-sized, well-rounded heads with a short inner stalk. Heads weight 1.5-2 kg. Excellent taste. Ideally suited for fresh consumption and medium-term storage. Excellent, medium early ripening, vigorously growing, fine-ribbed storage cabbage variety. Forms densely filled, medium-sized, well-rounded heads with a short inner stalk. Heads weight 1.5-2 kg. Excellent taste. Ideally suited for fresh consumption and medium-term storage.</textarea>
                </div>             
            </div>
            
        </div>
        <div class="flex gap-5 ml-4">
            <!-- search image popup here -->
            <div>
                <img src="images/verites.png" alt="" class="w-[240px] h-[175px] border-2 border-gray-300 shadow-2xl rounded-3xl">
            </div>
            <!-- search details popup here -->
            <div class="flex flex-col gap-3 mt-1">                
                <div class="flex gap-2 ">
                    <h3 class="text-lg font-medium">Variety name :</h3>
                    <h3 class="text-lg" name="variety">White cabbage Andor</h3>
                </div>   
                <div class="flex gap-4">
                    <h3 class="text-lg font-medium">Information  :</h3>
                    <textarea class="text-lg w-[800px] h-[150px] text-justify" disabled>Excellent, medium early ripening, vigorously growing, fine-ribbed storage cabbage variety. Forms densely filled, medium-sized, well-rounded heads with a short inner stalk. Heads weight 1.5-2 kg. Excellent taste. Ideally suited for fresh consumption and medium-term storage.</textarea>
                </div>             
            </div>   
        </div>
        <div class="flex gap-5 ml-4">
            <!-- search image popup here -->
            <div>
                <img src="images/verites.png" alt="" class="w-[240px] h-[175px] border-2 border-gray-300 shadow-2xl rounded-3xl">
            </div>
            <!-- search details popup here -->
            <div class="flex flex-col gap-3 mt-1">                
                <div class="flex gap-2 ">
                    <h3 class="text-lg font-medium">Variety name :</h3>
                    <h3 class="text-lg" name="variety">White cabbage Andor</h3>
                </div>   
                <div class="flex gap-4">
                    <h3 class="text-lg font-medium">Information  :</h3>
                    <textarea class="text-lg w-[800px] h-[150px] text-justify" disabled>Excellent, medium early ripening, vigorously growing, fine-ribbed storage cabbage variety. Forms densely filled, medium-sized, well-rounded heads with a short inner stalk. Heads weight 1.5-2 kg. Excellent taste. Ideally suited for fresh consumption and medium-term storage.</textarea>
                </div>             
            </div>   
        </div>

    </div>
    
</body>
</html>