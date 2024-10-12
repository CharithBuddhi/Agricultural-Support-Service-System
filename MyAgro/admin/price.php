<?php 
error_reporting(0);
session_start(); 
if(!isset($_SESSION['login_admin_user'])){
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Price</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }
    </style>

</head>
<body class="bg-[#350dc3] text-white">
<div class="flex">
    
    <div class="load_data_container w-[20%]"></div>
    
    <div class="flex flex-col w-[79%]">
        
        <!-- control price table manage section -->
        <div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card-mt-2">
                        <div class="flex card-header ">
                            <h1 class="mt-4 text-xl">Control price manage</h1>
                            
    
                        </div>
                        <div class=" p-1 ml-3 h-[50px] ">
    
                            <div class="flex ">
                                
                                <div class="col-md-7">
    
                                    <form action="" method="get" class="flex gap-4e">
                                        <div class=" input-group">
                                            <input type="text" name="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?>" class="form-control" placeholder="use for search crop name"  required>
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>  
                                    </form>
                                </div>
                                <a href="conterol_price.php" class="relative left-[270px]">
                                    <div class="flex flex-col items-center justify-center w-32 bg-blue-500 border-2 border-white hover:bg-blue-600 hover:text-white rounded-xl h-9">
                                        <h3>Add</h3>
                                    </div>
                                </a>
                                
                            </div>
                        </div>
    
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="card-mt-1">
                        <!-- this id use reload table using jquary -->
                        <div class="card-body" id="price_table" style="max-height: 300px; overflow-y: auto;">
                            <table class="table text-center text-white table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Variety</th>
                                        <th scope="col">Min price</th>
                                        <th scope="col">Max price</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    <tr>   
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        require('db_conn.php');
    
                                        if(isset($_GET['search'])){
                                            $filtervalues = $_GET['search'];
                                            $query = "SELECT * FROM `controlprice` WHERE CONCAT(`price_id`, `crop_name`, `varieties_name`) LIKE '%$filtervalues%'";
                                            $query_run = mysqli_query($conn, $query);
                                        
                                            // CONCAT keyword filter the inside bracket column data only
                                            // mysqli_num_rows use to check inside the query_run is empty or not
                                            if(mysqli_num_rows($query_run) >  0)
                                            {
    
                                                foreach($query_run as $items){
                                                    //want to print table rows here and need to use insdie the td again php tag so close php tag here
                                                    ?>
    
                                                        <!-- using = mark can access the data, this are the print like echo -->
                                                        <td class="font-bold"><?= $items['price_id']; ?></td>
                                                        <td><?= $items['crop_name']; ?></td>
                                                        <td><?= $items['varieties_name']; ?></td>
                                                        <td><?= $items['min_price']; ?></td>
                                                        <td><?= $items['max_price']; ?></td>
                                                        <td><?= $items['create_date'] ?></td>
                                                        <td class="flex justify-center gap-4">
                                                            <a href="conterol_price.php?id=<?php echo $items['price_id'] ?>&name=<?php echo $items['crop_name'] ?>&varieties=<?php echo $items['varieties_name'] ?>&search=<?php echo $filtervalues ?>">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                            </a>
                                                            <button type="button" value=<?php echo $items['price_id'] ?> class="price_delete_btn">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-red-500">
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
                                                        <td colspan="7">No Record Found</td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    
                                    ?>
    
                                   
    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>

        <!-- harvesting month table section -->
        <div class="mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-mt-2">
                        <div class="flex card-header ">
                            <h1 class="mt-4 text-xl">Harvesting month manage</h1>
                            <h1 class="relative left-[400px] w-[350px] mt-2">
                            <!-- display successfully massage here -->
                            <?php
                                if($_SESSION['harvest_msg']){
                                    $message = $_SESSION['harvest_msg'];
                                    if (strpos($message, 'success') !== false) {
                                        
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                            </symbol>
                                            </svg>
                                            <div class="gap-1 alert alert-success d-flex align-items-center" role="alert">
                                            <svg class="flex-shrink-0 bi me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                            <div class="gap-3">
                                            '.$message.'
                                            </div>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>';

                                    }else{
                                        echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                        </symbol>
                                        </svg>
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <svg class="flex-shrink-0 bi me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                        <div>
                                        '.$message.'
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                      </div>';

                                    }
                                }
                                unset($_SESSION['harvest_msg']);
                            ?></h1>
    
                        </div>
                        <div class="p-1 ml-3 h-[50px]">
    
                            <div class="flex">
                                
                                <div class=" col-md-7">
    
                                    <form action="" method="post" class="flex gap-4e">
                                        <div class="input-group">
                                            <input type="text" name="search_harvest" value="<?php if(isset($_POST['search_harvest'])){ echo $_POST['search_harvest']; } ?>" class="form-control" placeholder="use for search crop name"  required>
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>  
                                    </form>
                                </div>
                                <button class="relative left-[270px]" data-bs-toggle="modal" data-bs-target="#add_harvest">
                                    <div class="flex flex-col items-center justify-center w-32 bg-blue-500 border-2 border-white hover:bg-blue-600 hover:text-white rounded-xl h-9">
                                        <h3>Add</h3>
                                    </div>
                                </button>
                                
                            </div>
                        </div>
    
                    </div>
                </div>
    
                <div class="col-md-12">
                    <div class="card-mt-1">
                        <div class="card-body table-responsive" id="price_table" style="max-height: 250px; overflow-y: auto;">
                            <table class="table text-center text-white table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Crop Name</th>
                                        <th scope="col">Crop Variety</th>
                                        <th scope="col">Yala Strat</th>
                                        <th scope="col">Yala End</th>
                                        <th scope="col">Maha Strat</th>
                                        <th scope="col">Maha End</th>
                                        <th scope="col">Action</th>
                                    <tr>   
                                </thead>
                                <tbody>
                                    
                                    <?php
                                        
                                        if(isset($_POST['search_harvest'])){
                                            $filter_harvest = $_POST['search_harvest'];
                                            $query = "SELECT * FROM `harvest` WHERE CONCAT(`harvest_id`, `crop_name`, `crop_variety`) LIKE '%$filter_harvest%'";
                                            $query_run = mysqli_query($conn, $query);
                                        
                                            // CONCAT keyword filter the inside bracket column data only
                                            // mysqli_num_rows use to check inside the query_run is empty or not
                                            if(mysqli_num_rows($query_run) >  0)
                                            {
    
                                                foreach($query_run as $items){
                                                    //want to print table rows here and need to use insdie the td again php tag so close php tag here
                                                    ?>
    
                                                        <!-- using = mark can access the data, this are the print like echo -->
                                                        <td class="font-bold" id="db_harvest_id"><?= $items['harvest_id']; ?></td>
                                                        <td id="db_crop_name"><?= $items['crop_name']; ?></td>
                                                        <td id="db_crop_variety"><?= $items['crop_variety']; ?></td>
                                                        <td id="db_yala_start"><?= $items['yala_start']; ?></td>
                                                        <td id="db_yala_end"><?= $items['yala_end']; ?></td>
                                                        <td id="db_maha_start"><?= $items['maha_start']; ?></td>
                                                        <td id="db_maha_end"><?= $items['maha_end']; ?></td>
                                                        <td class="flex justify-center">
                                                            <button type="button" id="edit_harvest_month" value="<?= $row['harvest_id']; ?>" class="h-fit" data-bs-toggle="modal" data-bs-target="#edit_harvest">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class= "size-6 hover:text-blue-500">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                                </svg>
                                                            </button>
                                                            <button type="button" value=<?php echo $items['harvest_id'] ?> class="hrvst_delete_btn h-fit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hover:text-red-500">
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
                                                        <td colspan="8">No Record Found</td>
                                                    </tr>
                                                <?php
                                            }
                                        }
                                    
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
        
    </div>
    
</div>

<!-- Modal for harvesting month view -->
<div class="modal fade" id="add_harvest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content absolute text-black left-[200px] w-[500px]">

            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Add Harvesting Month</h5></b>
                <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="insert.php" method="POST">
                <div class="modal-body">
                    <div class="flex flex-col gap-2"> 
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="">Crop Name:</label>
                            <input type="text" name="crop" id="crop" class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="">Variety Name:</label>
                            <input type="text" id="variety" name="variety"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
                        <div class="flex flex-col font-bold">
                            <label for="">Yala Season</label>
                            <div class="flex gap-4">
                                <div class="flex flex-col gap-1 font-semibold">
                                    <label for="">Start Month:</label>
                                    <input type="date" name="yala_start" class="h-10 border-2 rounded-lg w-44 border-slate-300" required>
                                </div>
                                <div class="flex flex-col gap-1 font-semibold">
                                    <label for="">End Month:</label>
                                    <input type="date" name="yala_end" class="h-10 border-2 rounded-lg w-44 border-slate-300" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col font-bold">
                            <label for="">Maha Season</label>
                            <div class="flex gap-4">
                                <div class="flex flex-col gap-1 font-semibold">
                                    <label for="">Start Month:</label>
                                    <input type="date" name="maha_start" class="h-10 border-2 rounded-lg w-44 border-slate-300" required>
                                </div>
                                <div class="flex flex-col gap-1 font-semibold">
                                    <label for="">End Month:</label>
                                    <input type="date" name="maha_end" class="h-10 border-2 rounded-lg w-44 border-slate-300" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="harvest_submit"  class="w-24 btn btn-primary">Add</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal for edit month -->
<div class="modal fade" id="edit_harvest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content absolute text-black left-[200px] w-[500px]">
            <div class="modal-header">
                <b><h5 class="modal-title" id="exampleModalLabel">Edit Harvesting Month</h5></b>
                <button type="button" class=" btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update.php" method="POST">
                <input type="hidden" name="month_id" id="month_id">
                <div class="modal-body">
                    <div class="flex flex-col gap-2"> 
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="">Crop Name:</label>
                            <input type="text" name="month_crop" id="month_crop"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
                        <div class="flex flex-col gap-1 font-bold">
                            <label for="">Variety Name:</label>
                            <input type="text" id="month_variety" name="month_variety"  class="h-10 border-2 rounded-lg w-96 border-slate-300" required>
                        </div>
                        <div class="flex flex-col font-bold">
                            <label for="">Yala Season</label>
                            <div class="flex gap-4">
                                <div class="flex flex-col gap-1 font-semibold">
                                    <label for="">Start Month:</label>
                                    <input type="date" name="month_yala_start" id="month_yala_start" class="h-10 border-2 rounded-lg w-44 border-slate-300" required>
                                </div>
                                <div class="flex flex-col gap-1 font-semibold">
                                    <label for="">End Month:</label>
                                    <input type="date" name="month_yala_end" id="month_yala_end" class="h-10 border-2 rounded-lg w-44 border-slate-300" required>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col font-bold">
                            <label for="">Maha Season</label>
                            <div class="flex gap-4">
                                <div class="flex flex-col gap-1 font-semibold">
                                    <label for="">Start Month:</label>
                                    <input type="date" name="month_maha_start" id="month_maha_start" class="h-10 border-2 rounded-lg w-44 border-slate-300" required>
                                </div>
                                <div class="flex flex-col gap-1 font-semibold">
                                    <label for="">End Month:</label>
                                    <input type="date" name="month_maha_end" id="month_maha_end" class="h-10 border-2 rounded-lg w-44 border-slate-300" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="harvest_month_update"  class="w-24 btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="js/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/custom.js"></script>

<!-- load side menu bar  -->
<script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/adminpanel.php');
    })
</script>

<!-- pass value for update modal -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // Get all reply buttons
        let replyButtons = document.querySelectorAll('#edit_harvest_month');

        // Add a click event listener to each reply button
        replyButtons.forEach(function (button) {
            button.addEventListener('click', function () {

                // Find the closest row to the clicked button
                let row = this.closest('tr');

                // Get the username, email, and subject from the row
                let update_month_id = row.querySelector('#db_harvest_id').innerText;
                let update_month_crop = row.querySelector('#db_crop_name').innerText;
                let update_month_crop_variety = row.querySelector('#db_crop_variety').innerText;
                let update_month_yala_start = row.querySelector('#db_yala_start').innerText;
                let update_month_yala_end = row.querySelector('#db_yala_end').innerText;
                let update_month_maha_start = row.querySelector('#db_maha_start').innerText;
                let update_month_maha_end = row.querySelector('#db_maha_end').innerText;

                // Set the values in the modal's input fields
                document.getElementById('month_id').value = update_month_id;
                document.getElementById('month_crop').value = update_month_crop;
                document.getElementById('month_variety').value = update_month_crop_variety;
                document.getElementById('month_yala_start').value = update_month_yala_start;
                document.getElementById('month_yala_end').value = update_month_yala_end;
                document.getElementById('month_maha_start').value = update_month_maha_start;
                document.getElementById('month_maha_end').value = update_month_maha_end;
            });
        });
    });
</script>

<!-- show output message -->
<script>
    var message ="<?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.

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
            background: "#fcf2f2",
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
        <?php unset($_SESSION['msg']); ?>
    } 
</script>

</body>
</html>