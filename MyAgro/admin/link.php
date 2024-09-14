<?php 
error_reporting(0);
session_start(); 
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
    <div class="flex flex-col w-[20%] bg-[#08025e] rounded-r-3xl  h-screen"></div>
    <div class=" w-[80%] ">
        <div class="row">
            <div class="col-md-12">
                <div class="card-mt-4">
                    <div class="flex card-header ">
                        <h1 class="mt-8 text-xl">Search Here</h1>
                        <h1 class="relative left-[370px] w-[500px] mt-2">
                        <!-- display successfully massage here -->
                        <?php
                            if($_SESSION['msg']){
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                '.$_SESSION['msg'].'
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                            }
                            unset($_SESSION['msg']);
                        ?></h1>

                    </div>
                    <div class="card-body">

                        <div class="flex">
                            
                            <div class=" col-md-7">

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

            <div class="col-md-16">
                <div class="card-mt-2">
                    <div class="card-body">
                        <table class="table text-center text-white table-hover hover:text-[#dfdde3]">
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
                                                        <a href="delete.php?price_id=<?php echo $items['price_id'] ?>&search=<?php echo $filtervalues ?>">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <?php
                                            }

                                        }
                                        else{
                                            
                                            ?>
                                                <tr>
                                                    <td colspan="6">No Record Found</td>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</div>
</body>
</html>