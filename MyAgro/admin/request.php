<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
    <!-- talwind css cdn -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/src/style.css">
    <!-- admin include css file style sheet and boostrap stylesheet-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- boostrap cdn link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font-awesome icon cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }  
    </style>


</head>
<body class="text-white bg-[#350dc3]">

<div class="flex">
    <div class="flex flex-col w-[20%] bg-[#08025e] rounded-r-3xl  h-screen"></div>
    <div class="flex flex-col w-[80%] rounded-3xl pl-2 ml-1">
        <div class="flex gap-5">
            <h1 class="mt-10 text-2xl text-left font-sembiold">New Request</h1>
            <button type="button" onclick="reload()" id="btn_reload" class="bg-blue-300 font-semibold relative top-10 left-[720px] w-[100px] h-[34px] text-center rounded-xl border-2">Available</button>
        </div>

        <!-- table -->
        <form action="" method="post" enctype="multipart/form-data" class="flex flex-col mt-4 "> 
            <table class="table text-center text-white table-hover">
                <thead class="table-light">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">NIC</th>
                    <th scope="col">Address</th>
                    <th scope="col">Email</th>
                    <th scope="col">Proof</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody  >

                    <?php 
                        require('db_conn.php');

                        $sql = "SELECT * FROM request WHERE user_action = '0'";
                        $result = mysqli_query($conn, $sql);
                        
                        while($row = mysqli_fetch_array($result)){
                            ?>
                            <tr>
                                <td class="font-bold"><?php echo $row['request_id']; ?></td>
                                <td><?php echo $row['your_name']; ?></td>
                                <td><?php echo $row['nic_number']; ?></td>
                                <td><?php echo $row['user_address']; ?></td>
                                <td><?php echo $row['user_email']; ?></td>
                                <!-- get image from array -->
                                <td><?php echo '<img src="/Agricultural-Support-Service-System/MyAgro/admin/images/reg/'.$row['proof_image'].'" width="50px" height="50px" class="proof_doc">'; ?></td>
                                <td><?php echo $row['user_type']; ?></td>
                                <td >                                       
                                    <a href="approve.php?id=<?php echo $row['request_id']; ?>" class="mb-3 ml-2 mr-2" type="submit">
                                        <i class="text-green-500 fa-solid fa-square-check fs-4 "></i>
                                    </a>
                                    
                                    <button type="button" class="ml-2 mr-2" name="<?php echo $row['request_id']; ?>" id="reject" onclick="rejected()">
                                        <i class="fa-duotone fa-solid fa-trash-can fs-4"></i>
                                    </button>                                                             
                                </td>
                            </tr>

                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </form>
    </div>
</div>



 <!-- Modal -->
 <div class="modal fade" id="proof-document" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <b><h5 class="text-black modal-title" id="exampleModalLabel">Verification Document</h5></b>
                <button type="button" class="text-red-600 btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img src="images/1.jpg" alt="user proof document" class="modal-img">
            </div>
            <div class="modal-footer">
                <button type="button" class="w-24 bg-slate-400 btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

 <!-- reload for new request checking(refresh page)    -->
<script>

    let btn_reload =document.getElementById('btn_reload');
    function reload(){
        location.reload();
    }

    let reject =document.getElementById('reject');

    reject.addEventListener("click", () => {
        alert("Are you sure you want to reject this request?");
        <?php 
            require('db_conn.php');
            $id = $_GET['name'];
            $sql = "DELETE FROM request WHERE request_id = '$id'";
            $result = mysqli_query($conn, $sql);
            
        ?>
    })
</script>

<!-- boostrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<!-- link admin folderinsdie js file main javasript file -->
<script src="js/main.js"></script>

</body>
</html>