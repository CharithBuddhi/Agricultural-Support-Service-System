<?php 
error_reporting(0);
session_start();
if(!isset($_SESSION['login_staff_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Technology</title>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }
    </style>
</head>
<body class="bg-[#350dc3] text-white">
<div class="flex w-full h-full">
    
    <!-- load staff menu bar here -->
    <div class="load_data_container w-[20%]"></div>

    <div class="flex flex-col w-[79%] ">
        
        <!-- New Technology manage table section -->
        <div class="flex flex-col w-full">
            <div class="mt-[18px]">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-mt-2">
                            <div class="flex card-header ">
                                <h1 class="mt-4 text-xl">New Technology Manage</h1>
                            </div>
                            <div class="p-1 ml-3 h-[50px]">
        
                                <div class="flex">
                                    
                                    <div class="col-md-7">
        
                                        <form action="" method="post" class="flex gap-4e">
                                            <div class="input-group">
                                                <input type="text" name="search_technology" value="<?php if(isset($_POST['search_technology'])){ echo $_POST['search_technology']; } ?>" class="form-control" placeholder="use for search technology type or ID"  required>
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>  
                                        </form>
                                    </div>
                                    <button class="relative left-[270px]" data-bs-toggle="modal" data-bs-target="#add_technology">
                                        <div class="flex flex-col items-center justify-center w-32 bg-blue-500 border-2 border-white hover:bg-blue-600 hover:text-white rounded-xl h-9">
                                            <h3>Upload</h3>
                                        </div>
                                    </button>
                                    
                                </div>
                            </div>
        
                        </div>
                    </div>
        
                    <div class="col-md-12">
                        <div class="card-mt-1">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="card-body table-responsive" id="price_table" style="max-height: 350px; overflow-y: auto;">
                                    <table class="table text-center text-white table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Video Name</th>
                                                <th scope="col">Video</th>
                                                <th scope="col">Action</th>
                                            <tr>   
                                        </thead>
                                        <tbody>
                                            
                                            <?php
                                                require 'db_conn.php';
                                                
                                                if(isset($_POST['search_technology'])){
                                                    $filter_technology = $_POST['search_technology'];
                                                    $query = "SELECT * FROM `technology` WHERE CONCAT(`tech_id`, `video_name`) LIKE '%$filter_technology%'";
                                                    $query_run = mysqli_query($conn, $query);
                                                
                                                    // CONCAT keyword filter the inside bracket column data only
                                                    // mysqli_num_rows use to check inside the query_run is empty or not
                                                    if(mysqli_num_rows($query_run) >  0)
                                                    {
            
                                                        foreach($query_run as $items){
                                                            //want to print table rows here and need to use insdie the td again php tag so close php tag here
                                                            ?>
                                                            <tr>   
                                                                <!-- using = mark can access the data, this are the print like echo -->
                                                                <td class="font-bold"><?= $items['tech_id']; ?></td>
                                                                <td><?= $items['view_name']; ?></td>            
                                                                <td class="w-[120px]"><?php echo '<video src="videos/'.$items['video_name'].'" controls class="h-[60px] w-[150px]" loop></video>'; ?></td>
                                                                <td class="flex justify-center h-[80px]">
                                                                    <button type="button" value=<?php echo $items['tech_id'] ?> class="technology_delete_btn">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7 hover:text-red-500">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
            
                                                            <?php
                                                        }
            
                                                    }
                                                    else{
                                                        
                                                        ?>
                                                            <tr>
                                                                <td colspan="5">No Record Found</td>
                                                            </tr>
                                                        <?php
                                                    }
                                                }
                                            
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
        
                </div>
            </div>
        </div>
        
        <!-- Send Notification -->
        <div class="flex flex-col h-full gap-2 my-5 ml-3 ">
            <form action="send.php" method="POST" class="flex flex-col gap-3">
                <h1 class="text-2xl border-b border-[#302952]">Send Notification</h1>
                <div class="flex flex-col gap-2">
                
                <!-- get all farmers phone numbers -->

                <?php
                
                    $sql = "SELECT farmer_phone FROM farmer";
                    $result = $conn->query($sql);
                
                ?>
                
                    <label for="phone">Select a Phone Number:</label>
                    <select name="phone" id="phone" class="h-10 text-black rounded-md w-80" required>
                        <?php
                        // Check if there are results from the query
                        if ($result->num_rows > 0) {
                            // Output each phone number as an option
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='" . $row['farmer_phone'] . "'>" . $row['farmer_phone'] . "</option>";
                            }
                        } else {
                            echo "<option>No phone numbers found</option>";
                        }
                        ?>
                    </select>    
                </div>
                <div class="flex">
                    <div class="flex flex-col gap-2">
                        <h1 class="p-1">Message:</h1>
                        <textarea name="message" rows="4" type="text" id="message" class="text-black rounded-md w-[320px]" required></textarea>    
                    </div>
                    <div class="flex gap-4 mt-20 ml-10">
                        <button type="reset" class="w-24 h-10 border-2 border-white bg-slate-500 hover:bg-slate-700 hover:text-white rounded-xl">Clear</button>
                        <button type="submit" class="w-24 h-10 bg-blue-500 border-2 border-white hover:bg-blue-700 hover:text-white rounded-xl">Send</button>
                    </div>
                    
                </div>
            </form>
        </div>
    
    </div>
        
</div>

<!-- Upload techniques modal -->
<div class="modal fade" id="add_technology" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content absolute text-black left-[200px] w-[500px]">
            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Upload new techniques video</h5></b>
                <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="insert.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="flex flex-col gap-2"> 
                                               
                        <div class="flex flex-col font-bold">
                            <label for="video_name">Upload Video:</label>
                            <input type="text" name="video_name" id="video_name" class="h-10 p-2 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
                        
                        <div class="flex flex-col font-bold">
                            <label for="video">Upload Video:</label>
                            <input type="file" accept="video/*" name="file" id="file" class="h-[100px] border-2 rounded-lg w-96 p-2 border-slate-300" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="technology_submit"  class="w-24 btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// Close the database connection
$conn->close();
?>

<script src="js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/custom.js"></script>


<!-- load side menu bar  -->
<script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/satffpanel.php');
    })
</script>

<!-- show output message -->
<script>

// show inquiry reply success or error message
var message =
  "<?php echo isset($_SESSION['technology']) ? $_SESSION['technology'] : ''; ?>"; //send status include massage  varible message, but if not status then print ''.

if (message != "") {
    if(message.includes('success')) {
        const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        iconColor: "#69f44a",
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
        });
        Toast.fire({
        icon: "success",
        title: message,
        });
    } else {
        const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        iconColor: "#f84444",
        background: "#fae1e1",
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
        });
        Toast.fire({
        icon: "error",
        title: message,
        });
    }
    // remove after once message is shown
    <?php unset($_SESSION['technology']); ?>
}   
</script>

</body>
</html>