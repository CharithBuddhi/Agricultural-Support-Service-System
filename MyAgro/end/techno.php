<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Techniques</title>
</head>
<body>

    <div class="flex flex-col">
        <div class="mt-4">
            <h1 class="font-serif text-4xl italic text-center">Complex Techniques</h1>
        </div>
        <form action="" method="post" class="flex mt-10" enctype="multipart/form-data">
            <div class="flex ml-6">
                <input type="text" name="search_techniq" value="<?php if(isset($_POST['search_techniq'])){ echo $_POST['search_techniq']; } ?>"
                 class="h-10 text-xl border-l-2 border-y-2 border-slate-300 rounded-l-md w-96" placeholder="search all techniques using keyword all"  required>
                <button type="submit" class="h-10 text-white bg-blue-500 rounded-r-md w-28">Search</button>
            </div>  
        </form>
        <div>
            <?php 

                require ('db_connect.php');

                if(isset($_POST['search_techniq'])){
                    
                    $filter_techniq = $_POST['search_techniq'];
                    
                    if($filter_techniq == 'all'){
                        
                        $query = "SELECT * FROM `technology` "; //WHERE type = 'simple'
                        
                        $query_run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) >  0){
                            
                            ?>
                                <div class="grid justify-between grid-cols-3 ml-6">
                                    <?php
                                        foreach($query_run as $items) {
                                            ?>
                                                <div class="flex flex-col mt-8">
                                                    <a href="video_play.php?id=<?php echo $items['tech_id']; ?>">
                                                        <video src="/Agricultural-Support-Service-System/MyAgro/admin/videos/<?php echo $items['video_name']; ?>" class="w-[400px] h-[250px] rounded-3xl shadow-md border-2 hover:rounded-none hover:shadow-2xl"></video>
                                                        <div class="flex space-x-10">
                                                            <label class="ml-2 text-lg"><?php echo $items['view_name']; ?></label>
                                                        </div>     
                                                    </a>
                                                </div>
                                            <?php 
                                        }
                                    ?>
                                </div>
                                
                            <?php
    
                        }else{
                            echo "<div class=\"flex items-center justify-center h-screen font-serif text-3xl italic\">
                                        <h1>No Record Found</h1>
                                </div>";
                        }
                                        
                    }else{
                        
                        $query = "SELECT * FROM `technology` WHERE `view_name` LIKE '%$filter_techniq%' AND type = 'simple' ";
                        $query_run = mysqli_query($conn, $query); 

                        if(mysqli_num_rows($query_run) >  0){
                            ?>
                                <div class="grid justify-between grid-cols-3 ml-6">
                                    <?php
                                        foreach($query_run as $items) {
                                            ?>
                                                <div class="flex flex-col mt-8">
                                                    <a href="video_play.php?id=<?php echo $items['tech_id']; ?>">
                                                        <video src="/Agricultural-Support-Service-System/MyAgro/admin/videos/<?php echo $items['video_name']; ?>" class="w-[400px] h-[250px] rounded-3xl shadow-md border-2 hover:rounded-none hover:shadow-2xl"></video>
                                                        <div class="flex space-x-10">
                                                            <label class="ml-2 text-lg"><?php echo $items['view_name']; ?></label>
                                                        </div>     
                                                    </a>
                                                </div>
                                            <?php 
                                        }
                                    ?>
                                </div>

                            <?php
                            
                        }else{
                            echo "<div class=\"flex justify-center mt-10 font-serif text-2xl italic\">
                                        <h1>No Record Found</h1>
                                </div>";
                        }
                            
                    }
                      
                }

            ?>
            
        </div>
           
    </div>

    <script src="javascript/tech.js"></script>
    
</body>
</html>