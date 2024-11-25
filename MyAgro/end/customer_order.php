<?php session_start(); 

if(!isset($_SESSION['login_id']) && !isset($_SESSION['login_user']) && !isset($_SESSION['login_type'])){
    header("Location: index.php");
    exit();
}

include('db_connect.php');

if (isset($_POST['complete_order'])) {

    $complete_RP_ID = $_POST['complete_RP_ID'];
    $complete_customer_id = $_POST['complete_customer_id'];
    $complete_order_price  = $_POST['complete_order_price'];
    $complete_product_name = $_POST['complete_product_name'];
    $provider_id = $_POST['complete_provider_id'];

    $customer_name = $_SESSION['login_user'];
    $customer_type = $_SESSION['login_type'];
    $user_id = $_SESSION['login_id'];
       
    $sql = "UPDATE transaction SET payment_status = 'Completed' , responsible = '$user_id' , update_time = NOW() WHERE Reference_id = '$complete_RP_ID' AND customer_id = '$complete_customer_id' AND item_name = '$complete_product_name' AND provider_id = '$provider_id'";
    $result = $conn->query($sql);

    if ($result && $conn->affected_rows > 0) {
        // Update was successful and rows were affected
        $_SESSION['verify_order'] = "Your order has been completed!";
    } else {
        // Update failed or no rows were affected
        $_SESSION['verify_order'] = "Something went wrong, Please try again!";
    }
    
    header("Location: customer_order.php");
    exit();

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

                <h1 id="" class="h-8 mb-12 ml-10 font-serif text-3xl font-bold w-fit">Customer Orders</h1>

                <div class="flex flex-wrap mr-16">

                    <?php 
                        include('db_connect.php');
                        $user_id = $_SESSION['login_id'];
                        $user_type = $_SESSION['login_type'];
                        $sql = "SELECT * FROM transaction WHERE provider_id = '$user_id' AND provider_type = '$user_type' AND payment_status = 'succeeded'  ORDER BY  Reference_id ASC";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            
                            while($row = $result->fetch_assoc()) {
                            ?> 

                            <form class="flex flex-col ml-[50px] mb-12 gap-1 p-3 w-[340px] border-l-2 border-b-2 border-slate-200 rounded-lg shadow-2xl">
                                
                                <div class="flex flex-col items-center gap-1">
                                    <label id="product_id" hidden> <?php echo $row['item_id']; ?></label>
                                    <label id="product_name" class="text-xl font-bold"> <?php echo ucfirst($row['item_name']); ?></label>
                                    <label id="product_category" class="font-medium"> <?php echo ucfirst($row['item_category']); ?></label>
                                    <label id="product_price" class="font-medium" hidden> <?php echo $row['item_price']; ?></label>
                                    <label id="product_quantity" class="font-medium" hidden> <?php echo $row['item_quantity']; ?></label>
                                </div>

                                <label id="rp_id" hidden><?php echo $row['Reference_id']; ?></label>

                                <label id="location" hidden><?php echo $row['item_location']; ?></label>

                                <label id="provider_id" hidden><?php echo $row['provider_id']; ?></label>

                                <label id="provider_name" hidden><?php echo $row['provider_name']; ?></label>

                                <label id="provider_phone" hidden><?php echo $row['provider_phone']; ?></label>

                                <label id="provider_email" hidden><?php echo $row['provider_email']; ?></label>

                                <label id="product_price" hidden><?php echo "Rs. ".$row['item_price']; ?></label>

                                <p class="flex gap-1 mt-4">
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
                                    <?php echo "Rs. ".$row['paid_amount'];?>
                                </p>

                                <p>
                                    <label class="font-medium">Toatal Amount:</label>
                                    <label id="total_amount"><?php echo "Rs. ".$row['total_amount']; ?></label>
                                </p>

                                <p>
                                    <label class="font-medium">Order Date:</label>
                                    <label id="order_date"><?php echo $row['created']; ?></label>
                                </p>
                                
                                <p class="flex gap-1 mt-4">
                                    <label class="pl-0.5 font-medium">Customer ID :</label>
                                    <label id="customer_id"><?php echo $row['customer_id']; ?></label>
                                </p>

                                <p class="">
                                    <label class="font-medium">Customer Name:</label> 
                                    <label id="customer_name"><?php echo ucfirst($row['customer_name']); ?></label>
                                </p>

                                <p class="">
                                    <label class="font-medium">Customer Email:</label> 
                                    <label id="customer_email"><?php echo $row['customer_email']; ?></label>
                                </p>

                                <label id="payment_status" hidden>Purchased</label>
                                <p class="pl-2 pr-2 pt-0.5 pb-0.5 mt-1 mb-1 font-bold text-white bg-yellow-500 rounded-lg w-fit">Purchased</p>

                                <div class="flex gap-2 mt-1">
                                    <button type="button" id="Modal_Btn" value="<?php echo $row['Reference_id']; ?>" class="pt-1 pb-1 pl-2 pr-2 mb-1 font-bold text-white rounded-md Modal_Btn bg-slate-800">
                                        View
                                    </button>

                                    <button type="button" id="Modal_view_Btn" value="<?php echo $row['Reference_id']; ?>" class="pt-1 pb-1 pl-2 pr-2 mb-1 font-bold text-white rounded-md Modal_view_Btn bg-slate-800">
                                        Invoice
                                        <i class="ml-1 fa-solid fa-file-pdf"></i>
                                    </button>
                                    
                                    <button type="button" id="Modal_complte_Btn" value="<?php echo $row['Reference_id']; ?>" class="pt-1 pb-1 pl-2 pr-2 mb-1 font-bold text-white rounded-md Modal_complte_Btn bg-slate-800">
                                        Complete Order
                                    </button>

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
                            <p id="payment_status_view" class="text-lg font-bold text-yellow-500">Purchased</p>
                        </div>

                        <!-- Payment Information -->
                        <div class="flex flex-col w-full gap-2 p-2 border-2 rounded-xl">
                            <h4 class="text-lg font-bold">Payment Information</h4>
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
                            <div class="flex gap-1">
                                <p class="font-medium">Location : </p>
                                <p id="location_view"></p>
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

    <!-- Modal for complete order -->
    <div id="Modal_verify_order" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        
        <form action="" method="POST" id="rate" class="pr-6 pb-4 pt-4 rounded-xl fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 border shadow-2xl border-slate-500 bg-[#fefefe] text-black h-[300px] w-[450px]">

            <!-- Modal Body -->
            <div class="flex flex-col gap-4">

                <div class="flex justify-center">

                    <div class="flex flex-col items-center w-full gap-2 p-2">

                        <h4 class="text-lg font-bold">Complete Order</h4>

                        <div class="flex flex-col w-full gap-1 mt-4 ml-10">

                            <input type="text" name="complete_provider_id" id="complete_provider_id" value="" hidden required>

                            <div class="flex gap-2 p-1">
                                <label class="font-medium">Product Name :</label>
                                <input type="text" name="complete_product_name" id="complete_product_name" value="" class="font-medium outline-none" required readonly>
                            </div>

                            <div class="flex gap-2 p-1">
                                <label class="font-medium">Order Price :</label>
                                <input type="text" name="complete_order_price" id="complete_order_price" value="" class="font-medium outline-none" required readonly>
                            </div>

                            <div class="flex gap-2 p-1">
                                <label class="font-medium">Customer ID :</label>
                                <input type="text" name="complete_customer_id" id="complete_customer_id" value="" class="font-medium outline-none" required readonly>
                            </div>

                            <div class="flex gap-2 p-1 ">
                                <label class="font-medium">Enter RP ID Getting From Customer :</label>
                                <input type="text" name="complete_RP_ID" id="complete_RP_ID" class="w-24 h-8 border-2 rounded-lg border-slate-300" required>
                            </div>

                        </div>

                    </div>

                </div>
                
                <!-- Modal Footer -->
                <div class="flex justify-end gap-2 mr-6 text-center">
                    <button type="button" id="close_rating" class="w-20 h-8 transition rounded-lg close bg-slate-400 hover:bg-slate-500">Close</button>
                    <button type="submit" name="complete_order" id="complete_order" class="w-24 h-8 transition bg-blue-500 rounded-lg btn hover:bg-blue-600">Complete</button>
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
                                    <p class="ml-1 text-lg font-bold" style="color:#eab308">Purchased</p>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Payment Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Order Quantity:</p><p>${orderQuantity}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Paid Amount:</p><p>Rs. ${paidAmount}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Total Amount:</p><p>${totalAmount}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Order Date:</p><p>${orderDate}</p></div>
                                </div>

                                <div class="flex flex-col w-full gap-1 pt-2 pl-2 border-2 rounded-xl">
                                    <h4 class="text-lg font-bold">Product Information</h4>
                                    <div class="flex gap-1"><p class="font-medium">Product Name:</p><p>${productName}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Product Category:</p><p>${productCategory}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Product Price:</p><p>${productPrice}</p></div>
                                    <div class="flex gap-1 mb-1"><p class="font-medium">Product Quantity:</p><p>${productQuantity}</p></div>
                                    <div class="flex gap-1"><p class="font-medium">Location:</p><p>${location}</p></div>
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

                    let order_quantity = form.querySelector('#order_quantity').innerText;
                    
                    let paid_amount = form.querySelector('#paid_amount').innerText;

                    document.getElementById('paid_amount_view').innerText = "Rs. " + paid_amount;

                    let total_amount = form.querySelector('#total_amount').innerText;
                    let location = form.querySelector('#location').innerText;   
                    let order_date = form.querySelector('#order_date').innerText;
                    
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
                    document.getElementById('provider_phone_view').innerText = "+" +provider_phone;
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

    <!-- modal display, hidden Modal_complte_Btn star manage -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const complete_buttons = document.querySelectorAll(".Modal_complte_Btn");
            const modal_rate = document.getElementById("Modal_verify_order");
            const close_btn_rating = document.getElementById("close_rating");

            const order_id = document.getElementById("order_id");

            complete_buttons.forEach(button => {
                button.addEventListener("click", function() {

                    let form = this.closest('form');

                    // payment_information
                    let customer_id = form.querySelector('#customer_id').innerText;
                    document.getElementById('complete_customer_id').value = customer_id;

                    let total_amount = form.querySelector('#total_amount').innerText;
                    document.getElementById('complete_order_price').value = total_amount;

                    let product_name = form.querySelector('#product_name').innerText;
                    document.getElementById('complete_product_name').value = product_name;

                    let provider_id = form.querySelector('#provider_id').innerText;
                    document.getElementById('complete_provider_id').value = provider_id;

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
        var message ="<?php echo isset($_SESSION['verify_order']) ? $_SESSION['verify_order'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
        if (message != "") {
            if(message.includes('completed')) {
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
            <?php unset($_SESSION['verify_order']); ?>
        } 
    </script>
       
</body>

</html>