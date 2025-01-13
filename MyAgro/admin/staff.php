<?php session_start(); 
if(!isset($_SESSION['login_staff_user'])){
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
    <title>Staff</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body class="bg-[#305dc7] text-white">
    <div class="w-screen h-screen">
        <div class="flex w-full h-full">

            <!-- Dashboard Menu bar load here-->
            <div class="load_data_container w-[20%]">
                
            </div>
            
            <!-- Main Dashboard -->
            <div class="flex flex-col w-4/5">

                <button class="w-32 mt-1 ml-3 bg-blue-400 rounded-lg h-9 hover:bg-blue-500">
                    <a href="cancel_cdm_order.php">Refresh System</a>
                </button>

                <!-- user amount section -->
                <div class="text-black flex ml-[1%] mt-2 gap-[1%] h-[14%]">

                    <!-- system registered farmer amount -->
                    <div class="flex items-center justify-center w-[24%] gap-7 h-full bg-blue-100 border-2 border-gray-300 border-double rounded-md ">
                        
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold" id="total_farmer">0</h1>
                            <label for="" class="font-serif text-xl">Farmers</label>
                        </div>
                        
                        <div class="pr-2">
                            <img src="images/farmer.png"  class="w-[75px] h-[75px]">
                        </div>
                        
                    </div>

                    <!-- system registered customer amount -->
                    <div class="flex items-center justify-center w-[24%] gap-7 h-full bg-blue-100 border-2 border-gray-300 border-double rounded-md ">
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold" id="total_customer">0</h1>
                            <label for="" class="font-serif text-xl">Customers</label>
                        </div>
                        <div class="pr-2">
                            <img src="images/customer.png"  class="w-[75px] h-[75px]">
                        </div>
                        
                    </div>

                    <!-- system registered supplier amount -->
                    <div class="flex items-center justify-center w-[24%] gap-7 h-full bg-blue-100 border-2 border-gray-300 border-double rounded-md ">
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold" id="total_supplier">0</h1>
                            <label for="" class="font-serif text-xl">Suppliers</label>
                        </div>
                        <div class="pr-2">
                            <img src="images/supplier.png"  class="w-[75px] h-[75px]">
                        </div>
                        
                    </div>

                    <!-- system registered staff amount -->
                    <div class="flex items-center justify-center w-[24%] gap-16 h-full bg-blue-100 border-2 border-gray-300 border-double rounded-md ">
                        <div class="flex flex-col p-2">
                            <h1 class="text-3xl font-semibold" id="total_staff">0</h1>
                            <label for="" class="font-serif text-xl">Staff</label>
                        </div>
                        <div class="pr-2">
                            <img src="images/staff.png"  class="w-[75px] h-[75px]">
                        </div>
                        
                    </div>

                </div>

                <!-- Graph section -->
                <div class="flex text-black ml-[1%] mt-[1%] gap-[1%] h-[30%]">

                    <div class="w-[60%]">
                        <canvas id="myChart"></canvas>
                    </div>
                    
                    <div class="w-[40%]">
                        <div id="piechart_3d" class="z-0 bg-blue-300"></div>       
                    </div>


                </div>

                <!-- second Graph section -->
                <div class="flex text-black ml-[1%] gap-[1%] mt-[1%] h-[26%]">
                    
                    <div class="w-[24%]">
                        <canvas id="request_chart"></canvas>
                    </div>

                    <div class="w-[24%]">
                        <canvas id="voucher_chart"></canvas>
                    </div>

                    <div class="w-[24%] z-20">
                        <canvas id="order_summry"></canvas>
                    </div>

                    <!-- Top Selling Vegetables -->
                    <div class="flex flex-col w-[24%] z-10 pl-2 pt-1 h-full border-2 border-white border-double rounded-md bg-blue-100">
                        <label for="" class="mb-1 mt-[6px] text-lg font-semibold">Top Selling Vegetables</label>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Vegetable1_name"></label>
                            <label id="Vegetable1_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Vegetable2_name"></label>
                            <label id="Vegetable2_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Vegetable3_name"></label>
                            <label id="Vegetable3_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Vegetable4_name"></label>
                            <label id="Vegetable4_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Vegetable5_name"></label>
                            <label id="Vegetable5_price"></label>
                        </div>
                    </div>

                </div>

                <!-- selling section -->
                <div class="flex text-black ml-[1%] mt-[1%] gap-[1%] h-[23%]">

                    <!-- Top Selling Agrochemicals -->
                    <div class="flex flex-col w-[34%] pl-2 pt-1 h-full border-2 border-white border-double rounded-md bg-blue-100">
                        <label for="" class="mb-1 mt-[6px] text-lg font-semibold">Top Selling Chemicals</label>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Agro1_name"></label>
                            <label id="Agro1_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Agro2_name"></label>
                            <label id="Agro2_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Agro3_name"></label>
                            <label id="Agro3_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Agro4_name"></label>
                            <label id="Agro4_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Agro5_name"></label>
                            <label id="Agro5_price"></label>
                        </div>
                    </div>
                    
                    <!-- Top Selling fertilizers -->
                    <div class="flex flex-col w-[39%] pl-2 pt-1 h-full border-2 border-white border-double rounded-md bg-blue-100">
                        <label for="" class="mb-1 mt-[6px] text-lg font-semibold">Top Selling Fertilizers</label>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fertilizer1_name"></label>
                            <label id="Fertilizer1_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fertilizer2_name"></label>
                            <label id="Fertilizer2_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fertilizer3_name"></label>
                            <label id="Fertilizer3_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fertilizer4_name"></label>
                            <label id="Fertilizer4_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fertilizer5_name"></label>
                            <label id="Fertilizer5_price"></label>
                        </div>
                    </div>

                    <!-- Top Selling Fruits -->
                    <div class="flex flex-col w-[24%] pl-2 pt-1 h-full border-2 border-white border-double text-black rounded-md bg-blue-100">
                        <label for="" class="mt-[6px] mb-1 text-lg font-semibold">Top Selling Fruits</label>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fruit1_name"></label>
                            <label id="Fruit1_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fruit2_name"></label>
                            <label id="Fruit2_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fruit3_name"></label>
                            <label id="Fruit3_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fruit4_name"></label>
                            <label id="Fruit4_price"></label>
                        </div>
                        <div class="flex mt-[7px] gap-3">
                            <label id="Fruit5_name"></label>
                            <label id="Fruit5_price"></label>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    $(document).ready(function(){
        $('.load_data_container').load('sendcode/satffpanel.php');
    })
    </script>

    <!-- Draw Pie 3D chart here -->
    <script type="text/javascript">
        function fetch_payment_chart() {
            $.ajax({
            url: "chart_data.php",
            method: "POST",
            data: { chart_data: "fetch_threeD_chart_count" }, // Fixed typo here
            success: function (data) {
                try {
                var paymentData = JSON.parse(data);

                // Extract data from the response
                var online_successful = paymentData.online_succeded || 0;
                var online_cancelled = paymentData.online_cancelled || 0;
                var cdm_successful = paymentData.cdm_succeded || 0;
                var cdm_cancelled = paymentData.cdm_cancelled || 0;

                // Call drawChart with fetched data
                drawChart(online_successful, online_cancelled, cdm_successful, cdm_cancelled);
                } catch (error) {
                console.error("Failed to parse JSON response:", error, data);
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX request failed:", error);
            },
            });
        }

        google.charts.load("current", { packages: ["corechart"] });
        google.charts.setOnLoadCallback(fetch_payment_chart); // Load chart after fetching data

        function drawChart(online_successful, online_cancelled, cdm_successful, cdm_cancelled) {
            var data = google.visualization.arrayToDataTable([
            ["Task", "Order Amount"],
            ["Successful Online Payments", online_successful],
            ["Cancelled Online Payments", online_cancelled],
            ["Canceled CDM Payments", cdm_cancelled],
            ["Successful CDM Payments", cdm_successful],
            ]);

            var options = {
            title: "Payment Status",
            is3D: true,
            width: 400,
            height: 350,
            backgroundColor: "#305dc7",
            colors: ["#4CAF50", "#FF9800", "#E91E63", "#03A9F4"],
            // legend: { position: "bottom" },
            // slices: {
            //     0: { color: "#4CAF50" },
            //     1: { color: "#FF9800" },
            //     2: { color: "#E91E63" },
            //     3: { color: "#03A9F4" },
            // },
            //change font color of labels
            legend: { textStyle: { color: "#fff" } },
            //chnage title color
            titleTextStyle: { color: "#fff" },
            };

            var chart = new google.visualization.PieChart(document.getElementById("piechart_3d"));
            chart.draw(data, options);
        }
        // Fetch data every 6 seconds
        setInterval(fetch_payment_chart, 6000);
    </script>

    <!-- Script for user amount set and chart initilization and drawing -->
    <script>
        $(document).ready(function () {

            // set user count
            function fetchFarmerCount() {
                $.ajax({
                    url: "chart_data.php", // The PHP script URL
                    method: "POST",
                    data: { user_data: "fetch_user_counts" },
                    success: function (response) {
                        try {
                            var data = JSON.parse(response);
                            document.getElementById('total_farmer').innerText = data.farmer;
                            document.getElementById('total_customer').innerText = data.customer;
                            document.getElementById('total_supplier').innerText = data.supplier;
                            document.getElementById('total_staff').innerText = data.staff;
                            
                        }catch (error) {
                            console.error("Failed to parse response:", error, response);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX error:", status, error);
                    }
                });
            }
            
            // Draw all summary chart
            const all_summry = document.getElementById("myChart");
            // Initialize the Chart instance globally
            let summry_chart = new Chart(all_summry, {
                type: "bar",
                data: {
                    labels: [
                    "Prices",
                    "Vegetables",
                    "Fruits",
                    "Fertilizers",
                    "Agrochemicals",
                    "Nutrients",
                    "Varieties",
                    "Techniques",
                    "Requests",
                    "Inquiries",
                    ],
                    datasets: [
                    {
                        label: "System Summary",
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                        backgroundColor: ["rgba(255, 255, 255, 1)"],
                        borderWidth: 1,
                    },
                    ],
                },
                options: {
                    responsive: true,
                    scales:{
                        x: {
                            ticks: {
                                color:'white'
                            }
                        },
                        y: {
                            ticks: {
                                color:'white'
                            },
                            beginAtZero: true
                        }
                    },
                    plugins:{
                        legend: {
                            labels: {
                                color: 'white'
                            }
                        }
                    }
                },
            });


            // order summry chart create
            const order_summry = document.getElementById("order_summry");
            // Initialize the Chart instance globally
            let chartInstance = new Chart(order_summry, {
                type: "polarArea",
                data: {
                    labels: ["Completed", "Processing", "Canceled"],
                    datasets: [
                        {
                        data: [0, 0, 0], // Initial placeholder data
                        backgroundColor: ["#4CAF50", "#e5d512", "#E91E63"],
                        borderWidth: 0,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins:{
                        legend: {
                            labels: {
                                color: 'white'
                            }
                        }
                    }
                    
                },
            });

            // function for get value from database
            function fetchChartData() {
                $.ajax({
                url: "chart_data.php",
                method: "POST",
                data: { chart_data: "fetch_chart_counts" },
                success: function (data) {
                    try {
                        var parsedData = JSON.parse(data);

                        // Update the summary order chart data dynamically
                        if (summry_chart && summry_chart.data && summry_chart.data.datasets) {
                            summry_chart.data.datasets[0].data = [
                                parsedData.price,
                                parsedData.vegetable,
                                parsedData.fruit,
                                parsedData.fertilizer,
                                parsedData.agrochemical,
                                parsedData.nutrient,
                                parsedData.variety,
                                parsedData.technique,
                                parsedData.request,
                                parsedData.inquiry,
                            ];
                            summry_chart.update(); // Refresh the chart
                        }
                        else {
                            console.error("Summary Chart instance or datasets not properly initialized.");
                        }

                        // Update the order chart data dynamically
                        if (chartInstance && chartInstance.data && chartInstance.data.datasets) {
                            chartInstance.data.datasets[0].data = [
                                parsedData.completed,
                                parsedData.process,
                                parsedData.canceled,
                            ];
                            chartInstance.update(); // Refresh the chart
                        }
                        else {
                            console.error("Order Chart instance or datasets not properly initialized.");
                        }
                        
                    }
                    catch (error) {
                        console.error("Failed to parse JSON response:", error, data);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX request failed:", error);
                },
                });
                
            }


            // Draw request_chart chart
            const request_chart = document.getElementById("request_chart");
            // Initialize the Chart instance globally
            let requestInstance = new Chart(request_chart, {
                type: "doughnut",
                data: {
                    labels: ["Accepted","Pending"],
                    datasets: [
                        {
                        data: [10, 10], // Initial placeholder data
                        backgroundColor: ["#4CAF50","#e5d512"],
                        borderWidth: 0,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins:{
                        legend: {
                            labels: {
                                color: 'white'
                            }
                        }
                    }
                    
                },
            });


            // Draw voucher chart
            const voucher_chart = document.getElementById("voucher_chart");
            // Initialize the Chart instance globally
            let voucherInstance = new Chart(voucher_chart, {
                type: "pie",
                data: {
                    labels: ["Accepted","Pending","Rejected"],
                    datasets: [
                        {
                        data: [10, 10, 10], // Initial placeholder data
                        backgroundColor: ["#4CAF50","#e5d512","#E91E63"],
                        borderWidth: 0,
                        },
                    ],
                },
                options: {
                    responsive: true,
                    plugins:{
                        legend: {
                            labels: {
                                color: 'white'
                            }
                        }
                    }
                    
                },
            });

            //Draw requesting chart and voucher chart
            function fetch_requesting() {
                $.ajax({
                    url: "chart_data.php",
                    method: "POST",
                    data: { request_data: "fetch_request" },
                    success: function (data) {
                        try {
                            var requestData = JSON.parse(data);

                            // Check if request data exists and is not empty
                            if (requestInstance && requestInstance.data && requestInstance.data.datasets) {
                                requestInstance.data.datasets[0].data = [
                                    requestData.accept,
                                    requestData.pending,
                                    
                                ];
                                requestInstance.update(); // Refresh the chart
                            }
                            else {
                                console.error("Request Chart instance or datasets not properly initialized.");
                            }

                            // Check if voucher data exists and is not empty
                            if (voucherInstance && voucherInstance.data && voucherInstance.data.datasets) {
                                voucherInstance.data.datasets[0].data = [
                                    requestData.voucher_approve,
                                    requestData.voucher_pending,
                                    requestData.voucher_reject,
                                    
                                ];
                                voucherInstance.update(); // Refresh the chart
                            }
                            else {
                                console.error("Voucher Chart instance or datasets not properly initialized.");
                            }

                        } catch (error) {
                            console.error("Failed to parse JSON response:", error, data);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("AJAX request failed:", error);
                    },
                });
            }



            
            // Fetch data initially and then Fetch data every 5 seconds
            fetchFarmerCount();
            setInterval(fetchFarmerCount, 8000);

            // Fetch data initially and then every 5 seconds
            fetchChartData();
            setInterval(fetchChartData, 5000);

            fetch_requesting();
            setInterval(fetch_requesting, 7000);

        });

    </script>

    <!-- top selling product handle -->
    <script>
        function fetch_top_selling() {
            $.ajax({
                url: "chart_data.php",
                method: "POST",
                data: { selling_data: "fetch_top_selling" }, // Fixed typo here
                success: function (response) {
                    try {
                        var SellingData = JSON.parse(response);

                        // Dyanamicaly update top 5 fruits in admin panel
                        if (SellingData.fruits && SellingData.fruits.length > 0) {
                            for (var i = 0; i < SellingData.fruits.length; i++) {
                                document.getElementById(`Fruit${i + 1}_name`).innerText = SellingData.fruits[i].name+" :";
                                document.getElementById(`Fruit${i + 1}_price`).innerText = "Rs."+SellingData.fruits[i].price;

                            }
                        }

                        // Dyanamically update top 5 vegetables
                        if (SellingData.vegetables && SellingData.vegetables.length > 0) {
                            for (var i = 0; i < SellingData.vegetables.length; i++) {
                                document.getElementById(`Vegetable${i + 1}_name`).innerText = SellingData.vegetables[i].name+" :";
                                document.getElementById(`Vegetable${i + 1}_price`).innerText = "Rs."+SellingData.vegetables[i].price;

                            }
                        }

                        // Dyanamically update top 5 chemicals
                        if (SellingData.agrochemicals && SellingData.agrochemicals.length > 0) {
                            for (var i = 0; i < SellingData.agrochemicals.length; i++) {
                                document.getElementById(`Agro${i + 1}_name`).innerText = SellingData.agrochemicals[i].name+" :";
                                document.getElementById(`Agro${i + 1}_price`).innerText = "Rs."+SellingData.agrochemicals[i].price;

                            }
                        }

                        //Dyanamically update top 5 fertilizers
                        if (SellingData.fertilizers && SellingData.fertilizers.length > 0) {
                            for (var i = 0; i < SellingData.fertilizers.length; i++) {
                                document.getElementById(`Fertilizer${i + 1}_name`).innerText = SellingData.fertilizers[i].name+" :";
                                document.getElementById(`Fertilizer${i + 1}_price`).innerText = "Rs."+SellingData.fertilizers[i].price;

                            }
                        }
                        
                    }catch (error) {
                        console.error("Failed to parse response:", error, response);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX error:", status, error);
                }
            });
        }
        fetch_top_selling();
        setInterval(fetch_top_selling, 7000);
        
    </script>

    <!-- show inquiry reply success or error message -->
    <script>
        var message = "<?php echo isset($_SESSION['staff_home_message']) ? $_SESSION['staff_home_message'] : ''; ?>"; //send status include massage  varible message, but if not status then print ''.
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
            <?php unset($_SESSION['staff_home_message']); ?>
        }   
    </script>

</body>
</html>
