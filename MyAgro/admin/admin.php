<?php session_start(); 
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
    <title>Admin</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body class="text-white bg-[#350dc3]">
    <div class="w-screen h-screen ">
        <div class="flex w-full h-full">

            <!-- Dashboard Menu bar load here-->
            <div class="load_data_container w-[20%]">
                
            </div>
            
            <!-- Main Dashboard -->
            <div class="flex flex-col w-4/5 gap-5">

                <!-- search bar -->
                <div class="flex justify-end mt-3">
                    <input type="text" name="search" id="search" placeholder="search...." class="w-3/5 p-2 border-2 rounded-lg h-9 border-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </div>

                <!-- Graph section -->
                <div class="flex mt-6 text-black justify-evenly">
                    <div>
                        <img src="images/grap.png" alt="" class="w-[500px] h-[250px] rounded-lg">
                    </div>
                    
                    <!-- system through order send amount -->
                    <div class="flex flex-col items-center justify-center w-[200px] gap-6 bg-blue-100 border-2 border-gray-300 border-double rounded-2xl ">
                        <div class="pr-2">
                            <img src="images/order.png"  class="w-[75px] h-[75px]">
                        </div>
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold">286</h1>
                            <label for="" class="font-serif text-xl">Orders</label>
                        </div>                         
                    </div>

                    <!-- system through order send amount -->
                    <div class="flex flex-col items-center justify-center w-[200px] gap-6 bg-blue-100 border-2 border-gray-300 border-double rounded-2xl ">
                        <div class="pr-2">
                            <img src="images/payment.png"  class="w-[75px] h-[75px]">
                        </div>
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold">152</h1>
                            <label for="" class="font-serif text-xl">Bank Payments</label>
                        </div>                                             
                    </div>

                </div>

                <!-- second section -->
                <div class="flex text-black justify-evenly h-1/5">

                   <!-- system registered farmer amount -->
                   <div class="flex items-center justify-center w-[220px] gap-6 bg-blue-100 border-2 border-gray-300 border-double rounded-2xl ">
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold">456</h1>
                            <label for="" class="font-serif text-xl">Farmers</label>
                        </div>
                        <div class="pr-2">
                            <img src="images/farmer.png"  class="w-[75px] h-[75px]">
                        </div>
                        
                    </div>

                   <!-- system registered customer amount -->
                   <div class="flex items-center justify-center gap-6 w-[220px] bg-blue-100 border-2 border-gray-300 border-double rounded-2xl ">
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold">183</h1>
                            <label for="" class="font-serif text-xl">Customers</label>
                        </div>
                        <div class="pr-2">
                            <img src="images/customer.png"  class="w-[75px] h-[75px]">
                        </div>
                        
                    </div>

                    <!-- system registered supplier amount -->
                    <div class="flex items-center justify-center w-[220px] gap-6 bg-blue-100 border-2 border-gray-300 border-double rounded-2xl ">
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold">67</h1>
                            <label for="" class="font-serif text-xl">Suppliers</label>
                        </div>
                        <div class="pr-2">
                            <img src="images/supplier.png"  class="w-[75px] h-[75px]">
                        </div>
                        
                    </div>

                    <!-- system registered staff amount -->
                    <div class="flex items-center justify-center w-[220px] gap-6 bg-blue-100 border-2 border-gray-300 border-double rounded-2xl ">
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold">2</h1>
                            <label for="" class="font-serif text-xl">Staff</label>
                        </div>
                        <div class="pr-2">
                            <img src="images/staff.png"  class="w-[75px] h-[75px]">
                        </div>
                        
                    </div>

                </div>

                <!-- third section -->
                <div class="flex text-black justify-evenly h-1/3">

                    <!-- Top Selling Fruits -->
                    <div class="flex flex-col w-[220px] p-1 border-2 border-white border-double w-1/5text-black justify-evenly rounded-2xl bg-slate-300">
                        <label for="" class="mb-1 text-lg font-semibold">Top Selling Fruits</label>
                        <div class="flex gap-5">
                            <label for="">Mango :</label>
                            <label for="">Rs.90.00</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Papaya :</label>
                            <label for="">Rs.90.00</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Watermelon :</label>
                            <label for="">Rs.90.00</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Rambutan :</label>
                            <label for="">Rs.90.00</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Abul Banana :</label>
                            <label for="">Rs.90.00</label>
                        </div>
                    </div>
                    <!-- Top Selling Vegetables -->
                    <div class="flex flex-col w-[220px] p-1 border-2 border-white border-double justify-evenly rounded-2xl bg-slate-300">
                        <label for="" class="mb-1 text-lg font-semibold">Top Selling Vegetables</label>
                        <div class="flex gap-5">
                            <label for="">Tomato :</label>
                            <label for="">Rs.90.00</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Onion :</label>
                            <label for="">Rs.125.34</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Beans :</label>
                            <label for="">Rs.130.50</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Pumpkin :</label>
                            <label for="">Rs.83.45</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Beetroot :</label>
                            <label for="">Rs.105.30</label>
                        </div>
                    </div>
                    <!-- Top Selling Agrochemicals -->
                    <div class="flex flex-col w-[220px] p-1 border-2 border-white border-double justify-evenly rounded-2xl bg-slate-300">
                        <label for="" class="mb-1 text-lg font-semibold">Top Selling Agrochemicals</label>
                        <div class="flex gap-5">
                            <label for="">Tomato :</label>
                            <label for="">Rs.90.00</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Onion :</label>
                            <label for="">Rs.125.34</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Beans :</label>
                            <label for="">Rs.130.50</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Pumpkin :</label>
                            <label for="">Rs.83.45</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Beetroot :</label>
                            <label for="">Rs.105.30</label>
                        </div>
                    </div>
                    <!-- Top Selling fertilizers -->
                    <div class="flex flex-col w-[220px] p-1 border-2 border-white border-double justify-evenly rounded-2xl bg-slate-300">
                        <label for="" class="mb-1 text-lg font-semibold">Top Selling Fertilizers</label>
                        <div class="flex gap-5">
                            <label for="">Tomato :</label>
                            <label for="">Rs.90.00</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Onion :</label>
                            <label for="">Rs.125.34</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Beans :</label>
                            <label for="">Rs.130.50</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Pumpkin :</label>
                            <label for="">Rs.83.45</label>
                        </div>
                        <div class="flex gap-5">
                            <label for="">Beetroot :</label>
                            <label for="">Rs.105.30</label>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/adminpanel.php');
    })
    </script>

<!-- show inquiry reply success or error message -->
    <script>
        var message = "<?php echo isset($_SESSION['admin_home_message']) ? $_SESSION['admin_home_message'] : ''; ?>"; //send status include massage  varible message, but if not status then print ''.
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
            <?php unset($_SESSION['admin_home_message']); ?>
        }   
    </script>

</body>
</html>
