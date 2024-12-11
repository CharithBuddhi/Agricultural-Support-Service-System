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
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Farmer Info</title>
    <style>
        .table-hover tbody tr:hover td {
            background: #e1e3e5;
            color: black;
        }  
    </style>
</head>
<body class="bg-[#1c4094] text-white">
    
    <div class="w-screen h-screen">
        <div class="flex w-full h-full">

            <!-- Dashboard Menu bar load here-->
            <div class="load_data_container w-[20%]"></div>

            <div class="flex flex-col w-[79%] h-fit">

                <div class="flex items-center justify-between p-5">
                    <h1 class="font-serif text-2xl font-semibold">Report Generation</h1>
                </div>

                
                <div class="p-5">
                    <h1 class="text-xl font-semibold">Product Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Order Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Control Price Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Staff Report</h1>
                </div>
                
                <div class="p-5">
                    <h1 class="text-xl font-semibold">Farmer Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Supplier Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Customer Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Technology Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Technology Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Requeast Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Transaction Report</h1>
                </div>

                <div class="p-5">
                    <h1 class="text-xl font-semibold">Verites Report</h1>
                </div>
                
            </div>

        </div>
    </div>

    <!-- load side menu bar  -->
    <script>
        $(document).ready(function(){
            $('.load_data_container').load('sendcode/adminpanel.php');
        })
    </script>

</body>
</html>