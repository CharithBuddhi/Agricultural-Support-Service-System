<?php session_start(); 

if(!isset($_SESSION['login_id']) && !isset($_SESSION['login_user']) && !isset($_SESSION['login_type'])){
    header("Location: index.php");
    exit();
}

include('db_connect.php');

if (isset($_POST['rate_provider'])) {

    $rate_value = $_POST['rate_value'];
    $description = $_POST['description'];
    $order_id  = $_POST['order_id'];

    $customer_id = $_SESSION['login_id'];
    $customer_type = $_SESSION['login_type'];

    $provider_id = $_POST['provider_id_rate'];

    $product_category = $_POST['product_category_rate'];
    
    if(($product_category == 'vegetable') || ($product_category == 'Fruits')){

        $provider_type = "farmer";

    }else if(($product_category == 'Fertilizer') || ($product_category == 'Chemical')){

        $provider_type = "supplier";
        
    }
     
    $product_id = $_POST['product_id_rate'];

    $sql1 = "INSERT INTO rating_provider (rate_value, description, provider, provider_type, customer_id, customer_type, product_id, product_category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("isssisis", $rate_value, $description, $provider_id, $provider_type, $customer_id, $customer_type, $product_id, $product_category);
    $result1 = $stmt1->execute();

    if ($result1) {
        
        $sql = "UPDATE transaction SET rating = 1 WHERE Reference_id = '$order_id'";
        $result = $conn->query($sql);    

        if ($result) {
            $_SESSION['rateing'] = "Thanks for your rating!";
            header("Location: order_history.php");
            exit();
        }else{
            $_SESSION['rateing'] = "Something went wrong with your rating!";
            header("Location: order_history.php");
            exit();
        }
    }
    $stmt1->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- pdf convert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Order History</title>
    <style>
        .modal-body {
            max-height: calc(100vh - 200px); /* Adjust height */
            overflow-y: auto;
        }
    </style>
</head>

<body>

    <?php require('user_header.php'); ?>

    <div id="" class="w-screen h-screen">
        
        <div class="flex bg-white">

            <div class="w-full mt-8">

                <h1 id="" class="h-8 mb-12 ml-10 font-serif text-3xl font-bold w-fit">Order History</h1>

                <div class="flex flex-wrap mr-16">

                    <?php 
                        include('db_connect.php');
                        $user_id = $_SESSION['login_id'];
                        $sql = "SELECT * FROM transaction WHERE customer_id = $user_id ORDER BY FIELD(payment_status, 'Pending or succeeded', 'Completed', 'Canceled'), Reference_id DESC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                    ?>                    
                        <form class="flex flex-col ml-20 mb-12 gap-1 p-3 w-[320px] border-l-2 border-b-2 border-slate-200  rounded-lg shadow-2xl">
                            
                            <div class="flex flex-col items-center gap-1">
                                <label id="product_id" hidden> <?php echo $row['item_id']; ?></label>
                                <label id="product_name" class="text-xl font-bold"> <?php echo ucfirst($row['item_name']); ?></label>
                                <label id="product_category" class="font-medium"> <?php echo ucfirst($row['item_category']); ?></label>
                                <label id="product_price" class="font-medium" hidden> <?php echo $row['item_price']; ?></label>
                                <label id="product_quantity" class="font-medium" hidden> <?php echo $row['item_quantity']; ?></label>
                            </div>
                            
                            <label id="customer_name" hidden><?php echo $row['customer_name']; ?></label>
                            <label id="customer_email" hidden><?php echo $row['customer_email']; ?></label>

                            <p class="flex gap-1 mt-4">
                                <label class="pl-0.5 font-medium">RP ID :</label>
                                <label id="rp_id"><?php echo $row['Reference_id']; ?></label>
                            </p>
                            
                            <p hidden>
                                <label class="font-medium">Product price:</label> 
                                <label id="product_price"><?php echo "Rs. ".$row['item_price']; ?></label>
                            </p>

                            <p>
                                <label class="font-medium">Order Quantity:</label>
                                <label id="order_quantity"><?php echo $row['order_quantity']; ?></label>
                                <?Php 
                                if($row['item_category'] == "fertilizer"){
                                    ?>
                                    <label>Kg</label>
                                    <?php
                                }
                                ?>
                            </p>

                            <p>
                                <label class="font-medium">Paid Amount:</label>
                                <label hidden id="paid_amount"><?php echo $row['paid_amount']; ?></label>
                                <?php 
                                    if($row['paid_amount'] == ""){
                                        ?>
                                        <label class="font-medium text-red-500">CDM Payment</label>
                                        <?php
                                    }else{
                                        echo "Rs. ".$row['paid_amount'];
                                } ?>
                            </p>

                            <p>
                                <label class="font-medium">Toatal Amount:</label>
                                <label id="total_amount"><?php echo "Rs. ".$row['total_amount']; ?></label>
                            </p>

                            <p>
                                <label class="font-medium">Location:</label>
                                <label id="location"><?php echo $row['item_location']; ?></label>
                            </p>

                            <p hidden>
                                <label class="font-medium">Order Date:</label>
                                <label id="order_date"><?php echo $row['created']; ?></label>
                            </p>
                            
                            <p class="mt-2">
                                <label class="font-medium">Provider Name:</label> 
                                <label id="provider_name"><?php echo ucfirst($row['provider_name']); ?></label>
                                <label id="provider_id" hidden><?php echo $row['provider_id']; ?></label>
                            </p>
                            
                            <p>
                                <label class="font-medium">Provider Number:</label> 
                                <label id="provider_phone"><?php echo "+".$row['provider_phone']; ?></label>
                                <label id="provider_email" hidden><?php echo $row['provider_email']; ?></label>
                            </p>


                            <label id="payment_status" hidden><?php echo $row['payment_status']; ?></label>
                            <?php 
                                if(($row['payment_status'] == "Pending") || ($row['payment_status'] == "succeeded")){
                                    ?>
                                    <p class="pl-2 pr-2 pt-0.5 pb-0.5 mt-1 mb-1 font-bold text-white bg-yellow-500 rounded-lg w-fit">Pending</p>
                                    <?php
                                }else if($row['payment_status'] == "Completed"){
                                    ?>
                                    <p class="pl-2 pr-2 pt-0.5 pb-0.5 mt-1 mb-1 font-bold text-white bg-green-500 rounded-lg w-fit">Completed</p>
                                    <?php
                                }else if($row['payment_status'] == "Canceled"){
                                    ?>
                                    <p class="pl-2 pr-2 pt-0.5 pb-0.5 mt-1 mb-1 font-bold text-white bg-red-500 rounded-lg w-fit">Cancelled</p>
                                    <?php
                                }
                            ?>

                            <div class="flex gap-1 mt-1">
                                <button type="button" id="Modal_Btn" value="<?php echo $row['Reference_id']; ?>" class="Modal_Btn pl-4 pr-4 pt-0.5 pb-0.5 mb-1 font-bold text-white rounded-md bg-slate-800">
                                    View
                                </button>

                                <button type="button" id="Modal_view_Btn" value="<?php echo $row['Reference_id']; ?>" class="Modal_view_Btn pl-4 pr-4 pt-0.5 pb-0.5 mb-1 font-bold text-white rounded-md bg-slate-800">
                                    Invoice
                                    <i class="ml-1 fa-solid fa-file-pdf"></i>
                                </button>
                                
                                <?php 
                                    if(($row['payment_status'] == "Completed") && ($row['rating'] == 0)){
                                        ?>
                                        <button type="button" id="Modal_rating_Btn" value="<?php echo $row['Reference_id']; ?>" class="Modal_rating_Btn pl-4 pr-4 pt-0.5 pb-0.5 mb-1 font-bold text-white rounded-md bg-slate-800">Rating</button>
                                        <?php
                                    }
                                ?>

                            </div>
                            
                        </form>
                    <?php
                            }
                        }else {
                            ?>
                                <h1 class="w-full mt-20 text-4xl font-semibold text-center">You have no orders yet</h1>
                            <?php
                        }

                    ?>

                </div>

            </div>
        </div>

    </div>

    <!--  Modal view order Information using tailwind css-->
    <div id="Modal_view" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div class="p-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[500px]">

            <!-- Modal Body -->
            <div>

                <div class="">

                    <div class="flex flex-col gap-2"> 

                        <div class="flex justify-between">
                            <h1 class="text-2xl font-semibold">Order Invoice</h1>
                            <p id="payment_status_view" class="text-lg font-bold"></p>
                        </div>

                        <!-- Payment Information -->
                        <div class="flex flex-col w-full gap-2 p-2 border-2 rounded-xl">
                            <h4 class="text-lg font-bold">Payment Information</h4>
                            <div class="flex gap-1">
                                <p class="font-medium">Reference Number : </p>
                                <p id="reference_number_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Order Quantity : </p>
                                <p id="order_quantity_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Paid Amount : </p>
                                <p id="paid_amount_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Total Amount : </p>
                                <p id="total_amount_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Location : </p>
                                <p id="location_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Order Date : </p>
                                <p id="order_date_view"></p>
                            </div>
                        </div>

                        <!-- Product Information -->
                        <div class="flex flex-col w-full gap-2 p-2 border-2 rounded-xl">
                            <h4 class="text-lg font-bold">Product Information</h4>
                            <div class="flex gap-1">
                                <p class="font-medium">Product Name : </p>
                                <p id="product_name_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Product Category : </p>
                                <p id="product_category_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Product Price : </p>
                                <p id="product_price_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Product Quantity : </p>
                                <p id="product_quantity_view"></p>
                            </div>
                        </div>

                        <!-- Customer  Information -->
                        <div class="flex flex-col w-full gap-2 p-2 border-2 rounded-xl">
                            <h4 class="text-lg font-bold">Customer Information</h4>
                            <div class="flex gap-1">
                                <p class="font-medium">Customer Name : </p>
                                <p id="customer_name_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Customer Email : </p>
                                <p id="customer_email_view"></p>
                            </div>
                        </div>

                        <!-- Provider Information -->
                        <div class="flex flex-col w-full gap-2 p-2 border-2 rounded-xl">
                            <h4 class="text-lg font-bold">Provider Information</h4>
                            <div class="flex gap-1">
                                <p class="font-medium">Provider Name : </p>
                                <p id="provider_name_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Provider Phone : </p>
                                <p id="provider_phone_view"></p>
                            </div>
                            <div class="flex gap-1">
                                <p class="font-medium">Provider Email : </p>
                                <p id="provider_email_view"></p>
                            </div>
                        </div>

                    </div>
                    
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end mt-4 text-center">
                    <button type="button" id="close" class="w-24 transition rounded-lg close h-9 bg-slate-400 hover:bg-slate-500">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for rating using star mark -->
    <div id="Modal_rating" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        
        <form action="" method="POST" id="rate" class="pr-6 pb-4 pt-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black w-[400px]">

            <!-- Modal Body -->
            <div class="flex flex-col gap-2 mt-5">

                <div class="flex justify-center">

                    <div class="flex flex-col items-center gap-2">

                        <h4 class="text-lg font-bold">Rate This Provider</h4>
                        <div class="flex items-center gap-1">

                            <span id="rate_1" class="text-4xl text-gray-400 cursor-pointer">&#9733;</span>
                            <span id="rate_2" class="text-4xl text-gray-400 cursor-pointer">&#9733;</span>
                            <span id="rate_3" class="text-4xl text-gray-400 cursor-pointer">&#9733;</span>
                            <span id="rate_4" class="text-4xl text-gray-400 cursor-pointer">&#9733;</span>
                            <span id="rate_5" class="text-4xl text-gray-400 cursor-pointer">&#9733;</span>

                            <input type="text" name="rate_value" value=""  id="rate_value" hidden>
                            <input type="text" name="order_id" value=""  id="order_id" hidden>
                            
                            <input type="text" name="provider_id_rate" value=""  id="provider_id_rate" hidden>
                            <input type="text" name="product_id_rate" value=""  id="product_id_rate" hidden>
                            <input type="text" name="product_category_rate" value=""  id="product_category_rate" hidden>   

                        </div>

                        <div class="mt-2">
                            <textarea class="p-2 border-2 rounded-lg border-slate-400" name="description" cols="30" rows="3" placeholder="Describe your experience.."></textarea>
                        </div>

                    </div>

                </div>
                
                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mt-6 text-center">
                    <button type="button" id="close_rating" class="w-20 h-8 transition rounded-lg close bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="rate_provider" id="rate_provider" class="w-20 h-8 transition bg-blue-500 rounded-lg btn hover:bg-blue-600">Rate</button>
                </div>

            </div>


        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- sweetalert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- generate pdf -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            const buttons = document.querySelectorAll(".Modal_view_Btn");

            // querySelectorAll use handle for class name
            const Modal_Btn = document.querySelectorAll(".Modal_Btn");
            const modal = document.getElementById("Modal_view");
            const close_btn = document.getElementById("close");

            function generatePDF(content) {
                // Generate PDF from the virtual element content
                const virtualElement = document.createElement('div');
                virtualElement.innerHTML = content;
                
                const options = {
                    filename: 'order_invoice.pdf',
                    image: { type: 'jpeg', quality: 1.0 },  // Sets high-quality JPEG images
                    html2canvas: { scale: 3 },  // Increases the scale for better resolution
                    jsPDF: { unit: 'in', format: 'a5', orientation: 'portrait' }
                };
                html2pdf().set(options).from(virtualElement).save();

            }

            // Iterate through each button and add a click event listener
            buttons.forEach(button => {
                button.addEventListener("click", function() {
                    
                let form = this.closest('form');

                // Retrieve the values you need
                let paymentStatus = form.querySelector('#payment_status')?.innerText || "N/A";
                let referenceId = form.querySelector('#rp_id')?.innerText || "N/A";
                let orderQuantity = form.querySelector('#order_quantity')?.innerText || "N/A";
                let paidAmount = form.querySelector('#paid_amount')?.innerText || "CDM Payment";
                let totalAmount = form.querySelector('#total_amount')?.innerText || "N/A";
                let location = form.querySelector('#location')?.innerText || "N/A";
                let orderDate = form.querySelector('#order_date')?.innerText || "N/A";

                let productName = form.querySelector('#product_name')?.innerText || "N/A";
                let productCategory = form.querySelector('#product_category')?.innerText || "N/A";
                let productPrice = form.querySelector('#product_price')?.innerText || "N/A";
                let productQuantity = form.querySelector('#product_quantity')?.innerText || "N/A";

                let customerName = form.querySelector('#customer_name')?.innerText || "N/A";
                let customerEmail = form.querySelector('#customer_email')?.innerText || "N/A";

                let providerName = form.querySelector('#provider_name')?.innerText || "N/A";
                let providerPhone = form.querySelector('#provider_phone')?.innerText || "N/A";
                let providerEmail = form.querySelector('#provider_email')?.innerText || "N/A";

                // Set the content for virtualElement with the values dynamically
                const pdfContent = `
                    <div class="flex items-center justify-center">
                        <div class=" w-[500px]">
                            <div class="flex flex-col gap-2">

                                <h1 class="mt-2 font-serif text-2xl font-bold text-center">MyAgro</h1>
                                
                                <div class="flex">
                                    
                                    <!-- Set paymentStatus to "Pending" if it is "succeeded" -->
                                    <p class="ml-1 text-lg font-bold" style="color: 
                                        ${
                                            (paymentStatus === "Completed")
                                            ? "#46d82f"
                                            : (paymentStatus === "Pending" || paymentStatus === "succeeded")
                                                ? (paymentStatus = "Pending", "#eab308")  // Set status to "Pending" if it was "succeeded"
                                            : "#ff0000"
                                        }">
                                        ${paymentStatus}
                                    </p>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Payment Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Reference Number:</p><p>${referenceId}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Order Quantity:</p><p>${orderQuantity}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Paid Amount:</p><p>Rs. ${paidAmount}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Total Amount:</p><p>${totalAmount}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Location:</p><p>${location}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Order Date:</p><p>${orderDate}</p></div>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Product Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Product Name:</p><p>${productName}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Product Category:</p><p>${productCategory}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Product Price:</p><p>${productPrice}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Product Quantity:</p><p>${productQuantity}</p></div>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Customer Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Customer Name:</p><p>${customerName}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Customer Email:</p><p>${customerEmail}</p></div>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Provider Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Provider Name:</p><p>${providerName}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Provider Phone:</p><p>${providerPhone}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Provider Email:</p><p>${providerEmail}</p></div>
                                </div>
                                <div class="invoice-footer" style="text-align: center;">
                                    <p class="text-lg font-semibold">Thank you for choosing us!</p>
                                    <p>We appreciate your trust in our services. If you have any questions or need assistance, please don’t hesitate to reach out.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Call the function to generate PDF with the populated content
                generatePDF(pdfContent);
                });
            });

            // view order details
            // Iterate through each button and add a click event listener
            Modal_Btn.forEach(button => {
                button.addEventListener("click", function() {

                    let form = this.closest('form');

                    // payment_information
                    let payment_status = form.querySelector('#payment_status').innerText;
                    if((payment_status == "Pending") || (payment_status == "succeeded")) {

                        document.getElementById('payment_status_view').innerText = "Pending";
                        document.getElementById('payment_status_view').style.color = "#eab308";

                    }else if(payment_status == "Completed") {

                        document.getElementById('payment_status_view').innerText = "Completed";
                        document.getElementById('payment_status_view').style.color = "#46d82f";

                    }else {

                        document.getElementById('payment_status_view').innerText = "Cancelled";
                        document.getElementById('payment_status_view').style.color = "#ff0000";
                    }

                    let Reference_id = form.querySelector('#rp_id').innerText;
                    let order_quantity = form.querySelector('#order_quantity').innerText;
                    
                    let paid_amount = form.querySelector('#paid_amount').innerText;
                    if(paid_amount == "") {

                        document.getElementById('paid_amount_view').innerText = "CDM Payment";
                    }else {

                        document.getElementById('paid_amount_view').innerText = "Rs. " + paid_amount;
                    }

                    let total_amount = form.querySelector('#total_amount').innerText;
                    let location = form.querySelector('#location').innerText;   
                    let order_date = form.querySelector('#order_date').innerText;
                    
                    document.getElementById('reference_number_view').innerText = Reference_id;
                    document.getElementById('order_quantity_view').innerText = order_quantity;
                    document.getElementById('total_amount_view').innerText = total_amount;
                    document.getElementById('location_view').innerText = location;
                    document.getElementById('order_date_view').innerText = order_date;
                    
                    // product_information
                    let product_name = form.querySelector('#product_name').innerText;
                    let product_category = form.querySelector('#product_category').innerText;
                    let product_price = form.querySelector('#product_price').innerText;
                    let product_quantity = form.querySelector('#product_quantity').innerText;
                    
                    document.getElementById('product_name_view').innerText = product_name;
                    document.getElementById('product_category_view').innerText = product_category;
                    document.getElementById('product_price_view').innerText = product_price;
                    document.getElementById('product_quantity_view').innerText = product_quantity;

                    // customer_information
                    let customer_name = form.querySelector('#customer_name').innerText;
                    let customer_email = form.querySelector('#customer_email').innerText;
                    
                    document.getElementById('customer_name_view').innerText = customer_name;
                    document.getElementById('customer_email_view').innerText = customer_email;

                    // provider_information
                    let provider_name = form.querySelector('#provider_name').innerText;
                    let provider_phone = form.querySelector('#provider_phone').innerText;
                    let provider_email = form.querySelector('#provider_email').innerText;
                    
                    document.getElementById('provider_name_view').innerText = provider_name;
                    document.getElementById('provider_phone_view').innerText = provider_phone;
                    document.getElementById('provider_email_view').innerText = provider_email;

                    modal.style.display = "block";

                });
            });
            
            close_btn.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }

        });

    </script>

    <!-- modal display, hidden rating star manage -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const rating_buttons = document.querySelectorAll(".Modal_rating_Btn");
            const modal_rate = document.getElementById("Modal_rating");
            const close_btn_rating = document.getElementById("close_rating");

            const rateValue = document.getElementById("rate_value");
            const order_id = document.getElementById("order_id");

            const labels = [
                document.getElementById("rate_1"),
                document.getElementById("rate_2"),
                document.getElementById("rate_3"),
                document.getElementById("rate_4"),
                document.getElementById("rate_5")
            ];

            let selectedRating = 0; // Store the current selected rating

            // Function to highlight stars up to the specified index
            function highlightStars(index) {
                labels.forEach((label, i) => {
                    label.style.color = i <= index ? '#f9ea05' : '';
                });
            }

            // Add event listeners to each label for hover and click
            labels.forEach((label, index) => {
                // Highlight up to the hovered star
                label.addEventListener("mouseenter", () => highlightStars(index));
                
                // Set selected rating on click and store the index
                label.addEventListener("click", () => {
                    selectedRating = index + 1; // Store the selected rating (1-based)
                    rateValue.value = selectedRating; // Update the hidden input value
                    highlightStars(index); // Persist highlight on selected stars
                });
            });

            // Reset color to the selected rating when mouse leaves any label
            labels.forEach(label => {
                label.addEventListener("mouseleave", () => highlightStars(selectedRating - 1));
            });

            // rating modal display
            rating_buttons.forEach(button => {
                button.addEventListener("click", function() {

                    order_id.value = button.value;

                    let form = this.closest('form');

                    let product_id = form.querySelector('#product_id').innerText;
                    document.getElementById('product_id_rate').value = product_id;

                    let product_category = form.querySelector('#product_category').innerText;
                    document.getElementById('product_category_rate').value = product_category;

                    let provider_id = form.querySelector('#provider_id').innerText;
                    document.getElementById('provider_id_rate').value = provider_id;

                    // Get the clicked button
                    modal_rate.style.display = "block";

                });
            });

            //user clicks on the close button (span), close the modal
            close_btn_rating.onclick = function() {
                modal_rate.style.display = "none";
            }

            // user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {

                if (event.target == modal_rate) {
                    modal_rate.style.display = "none";
                }
            }
        });
    </script>

    <!-- show output message -->
    <script>
        var message ="<?php echo isset($_SESSION['rateing']) ? $_SESSION['rateing'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
        if (message != "") {
            if(message.includes('Thanks')) {
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
            <?php unset($_SESSION['rateing']); ?>
        } 
    </script>
       
</body>

</html>