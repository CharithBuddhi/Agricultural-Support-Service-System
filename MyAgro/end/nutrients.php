<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutrients of crop</title>
    <link rel="stylesheet" href="style.css"> 
</head>
<body>
    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <h1 class="my-6 font-serif text-3xl italic font-semibold text-center">Nutrients  of crop</h1>

    <div class="flex justify-center gap-10">
        <form class="flex p-4 flex-col ml-2 border-[1px] border-gray-400 shadow-lg rounded-xl shadow-gray-400">
            <label class="text-red-600 text-md">When inserting a photo, clearly insert the vegetable or fruit as follows.</br> Otherwise, the accuracy of your results may decrease.</label>
            <div class="flex flex-col mt-4">
                <h3>Examples</h3>
                <div class="flex gap-7">
                    <img src="images/carrot.jpg" alt="" class="w-[80px] h-[80px] rounded-xl shadow-lg shadow-gray-400">
                    <img src="images/pineapple.jpg" alt="" class="w-[80px] h-[80px] rounded-xl shadow-lg shadow-gray-400">
                    <img src="images/watermelon.jpg" alt="" class="w-[80px] h-[80px] rounded-xl shadow-lg shadow-gray-400">
                </div>
            </div>
            <div class="flex flex-col">
                <label for="" class="mt-2">Upload image:</label>
                <input type="file" id="image" name="image" class="mt-2 w-[500px] h-[300px] border-2 border-gray-200">   
            </div>
            <div class="flex flex-col">
                <label for="" class="mt-2">Accepted file types:</label>
                <div class="relative w-[10px] flex h-[10px] top-5 rounded-full bg-cyan-400"></div>
                <pre for="">  jpg/jpeg,png</pre>
            </div>
            <div class="flex gap-8">
                <button type="reset" class="mt-5 mr-6 h-8 rounded-full w-[145px] bg-white border-2">Clear</button>
                <button type="submit" class="mt-5 h-8 rounded-full w-[160px] bg-[#6EE70F]/50 text-black">Submit</button>
            </div>
        </form>
        <div class="flex flex-col gap-5 p-4 border-[1px] w-[400px] border-gray-400 shadow-lg rounded-xl shadow-gray-400">
            <h1>Identify object name:apple</h1>
            <div class="flex gap-3">
                <label for="">sugar :</label>
                <label for="">78%</label>
            </div>
            <div class="flex gap-3">
                <label for="">sugar :</label>
                <label for="">5%</label>
            </div>
            <div class="flex gap-3">
                <label for="">potasiam :</label>
                <label for="">55%</label>
            </div>
        </div>
    </div>
    
</body>
</html>