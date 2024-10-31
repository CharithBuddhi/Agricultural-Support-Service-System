<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Play Video</title>
</head>
<body>
    <div class="flex flex-col ml-2 bg-slate-400">
        <!-- search bar -->
        <form action="techno.php" method="post" class="flex justify-center mt-2 mb-1" enctype="multipart/form-data">
            <a href="techno.php" class="relative right-[310px]">
                <button  type="button" class="bg-red-300 w-[100px] rounded-3xl border border-slate-500 text-lg font-bold">Back</button>
            </a>
            <div class="flex">
                <div class="flex">
                    <input type="text" name="search_techniq" value="<?php if(isset($_POST['search_techniq'])){ echo $_POST['search_techniq']; } ?>"
                        class="h-10 text-xl border-l-2 outline-none rounded-l-3xl w-96" placeholder="search all techniques using keyword all"  required>
                    <button type="submit" class="h-10 text-white bg-blue-500 rounded-r-3xl w-28">Search</button>
                </div>  
            </div>
        </form>
        
        <!-- clickble video display -->
        <?php 
        
            require ('db_connect.php');

            $id = $_GET['id'];
            
            $query = "SELECT * FROM `technology` WHERE `tech_id` = '$id'";
                        
            $query_run = mysqli_query($conn, $query);
            
            $data = mysqli_fetch_array($query_run);
            $name = $data['video_name'];
            $vievName = $data['view_name'];
            
            if(mysqli_num_rows($query_run) > 0){
                
                ?>
                    <video id="video" src="/Agricultural-Support-Service-System/MyAgro/admin/videos/<?php echo $name; ?>" class="w-full h-[600px]" controls></video>
                    <div class="flex justify-between pt-2 bg-white">
                        <div class="text-lg ">
                            <label for="video" class="pl-1 text-lg font-semibold "><?php echo $vievName; ?></label>    
                        </div>
                        <form action="" method="POST">
                            <div class="flex pr-5 text-lg gap-7">
                                <button type="submit" class="flex gap-1" name="like" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
                                    </svg>    
                                    <label for="" class="font-semibold"><?php echo $data['like_video']; ?></label>
                                </button>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.498 15.25H4.372c-1.026 0-1.945-.694-2.054-1.715a12.137 12.137 0 0 1-.068-1.285c0-2.848.992-5.464 2.649-7.521C5.287 4.247 5.886 4 6.504 4h4.016a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23h1.294M7.498 15.25c.618 0 .991.724.725 1.282A7.471 7.471 0 0 0 7.5 19.75 2.25 2.25 0 0 0 9.75 22a.75.75 0 0 0 .75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 0 0 2.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384m-10.253 1.5H9.7m8.075-9.75c.01.05.027.1.05.148.593 1.2.925 2.55.925 3.977 0 1.487-.36 2.89-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398-.306.774-1.086 1.227-1.918 1.227h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 0 0 .303-.54" />
                                    </svg>    
                                </button>
                            </div>
                        </form>
                    </div>
                <?php   
                  
            }else{
                header('Location: techno.php');
                exit(0);
            }
        
        ?>
    </div>
    
    <!-- Related video handling -->
    <div class="flex flex-col mt-6 ml-2">
        <?php
        
            // $query = "SELECT * FROM `technology` WHERE `view_name` LIKE '%$vievName%' AND `tech_id` != '$id'";  // AND `tech_id` != '$id' using this get value withoud current display video

            // Split the input viewName into individual words and it puts the Words ArrayS
            $words = explode(" ", $vievName);

            // Start building the query
            $query = "SELECT * FROM `technology` WHERE `tech_id` != '$id' AND (";

            // Add conditions for each word
            foreach ($words as $index => $word) {
                if ($index > 0) {
                    $query .= " OR ";
                }
                $query .= "`view_name` LIKE '%$word%'";
            }

            // Close the query
            $query .= ")";

            $query_run = mysqli_query($conn, $query);
            
            if(mysqli_num_rows($query_run) >  0){
                
                ?>
                
                <div>
                    <label for="" class="ml-2 text-lg font-semibold ">Related Videos</label>
                </div>
                <div class="flex gap-8">
                    <?php 
                    foreach($query_run as $items){
                       
                        ?>
                        
                        <div>
                            <a href="video_play.php?id=<?php echo $items['tech_id']; ?>">
                                <video src="/Agricultural-Support-Service-System/MyAgro/admin/videos/<?php echo $items['video_name']?>" class="w-[400px] h-[225px] rounded-3xl shadow-md border-4 hover:rounded-none hover:shadow-2xl"></video>
                                <label class="ml-1 text-lg"><?php echo $items['view_name'] ?></label>
                            </a>
                        </div> 
                        
                        <?Php  
                    }
                    ?>
                    
                </div>
              
               <?php 
            }

        ?>
        
    </div>
    
    <!-- update like amount after click -->
    <?php 

        if(isset($_SESSION['like'])){
            
            unset($_SESSION['like']);
            
            $id = $_GET['id'];
            $sql = "SELECT `like_video` FROM `technology` WHERE `tech_id`= '$id'";
            $query_run = mysqli_query($conn, $sql);
            
            if($query_run){
                
                $data = mysqli_fetch_assoc($query_run);
                
                $like = $data['like_video'];
                $like = $like + 1;
                
                $update = "UPDATE `technology` SET `like_video`='$like' WHERE `tech_id`= '$id'";
                $result = mysqli_query($conn, $update);
            }
            
        }
    ?>
    
</body>
</html>