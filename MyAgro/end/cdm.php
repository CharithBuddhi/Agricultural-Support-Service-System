<?php
 session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDM Payment</title>
    <link rel="stylesheet" href="style.css">
    <!-- pdf convert CDN Link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.2/html2pdf.bundle.js"></script>
</head>
<body>

    <?php 
        if(isset($_POST['agro_id']) && isset($_POST['agro_category']) && isset($_POST['agro_type']) && isset($_POST['agro_name']) && 
        isset($_POST['agro_price']) && isset($_POST['agro_quantity']) && isset($_POST['shop_name']) && isset($_POST['agro_location']) && 
        isset($_POST['order_quantity']) && isset($_POST['send_total']) &&isset($_POST['supplier_id']) &&isset($_POST['supplier_name']) &&
        isset($_POST['supplier_phone']) && isset($_POST['supplier_email'])) {  

            $_SESSION['agro_type'] = $_POST['agro_type'];

            $payment_status = 'Canceled';
            $product_id = $_POST['agro_id'];
            $product_category = $_POST['agro_category'];
            $product_name = $_POST['agro_name'];
            $product_price = $_POST['agro_price'];
            $product_quantity = $_POST['agro_quantity'];
            $agro_location = $_POST['agro_location'];
            $quantity = $_POST['order_quantity'];
            $total_price = $_POST['send_total'];
            $provider_id = $_POST['supplier_id'];
            $provider_name = $_POST['supplier_name'];
            $provider_phone = $_POST['supplier_phone'];
            $provider_email = $_POST['supplier_email'];
            

            require('db_connect.php');

            $username = $_SESSION['login_user'];
            $usertype = $_SESSION['login_type'];
            
            $sql = "SELECT * FROM $usertype WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if($result  && mysqli_num_rows($result) > 0){
                
                $row = mysqli_fetch_assoc($result);
                
                if($usertype == 'farmer'){ 
                    $PR_ID = $row['farmer_id'];
                    $name = $row['farmer_name'];
                    $Email = $row['farmer_email'];
                }elseif($usertype == 'supplier'){
                    $PR_ID = $row['supplier_id'];
                    $name = $row['supplier_name'];
                    $Email = $row['supplier_email'];
                }elseif($usertype == 'customer'){
                    $PR_ID = $row['customer_id'];
                    $name = $row['customer_name'];
                    $Email = $row['customer_email'];
                }

                $transaction_id = 'pi_' .$product_id.$provider_id.$PR_ID.$total_price.$quantity;

                // already exist order
                $sql = "SELECT txn_id  FROM transaction WHERE txn_id = '$transaction_id'";

                $result = mysqli_query($conn, $sql);

                if($result  && mysqli_num_rows($result) > 0){

                    $sqli = "SELECT Reference_id FROM transaction WHERE txn_id = '$transaction_id'";
                    $result = mysqli_query($conn, $sqli);
                    $row = mysqli_fetch_assoc($result);
                    $ref = $row['Reference_id'];
                    $_SESSION['ref'] = $ref;

                }else{

                    $sql = "INSERT INTO transaction (customer_id, customer_name, customer_email, provider_id, provider_name, provider_phone, provider_email, item_category, item_name, item_id, item_price, item_quantity, item_location, order_quantity, total_amount, txn_id, payment_status, created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, now())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ississsssiddsddss", $PR_ID, $name, $Email, $provider_id, $provider_name, $provider_phone, $provider_email, $product_category, $product_name, $product_id, $product_price, $product_quantity, $agro_location, $quantity, $total_price, $transaction_id, $payment_status );
                    $insert = $stmt->execute();

                    if($insert){

                        $sqli = "SELECT Reference_id FROM transaction WHERE txn_id = '$transaction_id'";
                        $result = mysqli_query($conn, $sqli);
                        $row = mysqli_fetch_assoc($result);
                        $ref = $row['Reference_id'];
                        $_SESSION['ref'] = $ref;
                    }
                    
                }
                
            $conn->close();

            ?>  

                <form action="connect.php" method="POST" id="confirm_form"  name="confirm_form">
                    <!-- Added hidden input to send confirm_btn value with the form -->
                    <input type="hidden" name="confirm_btn" value="1">
                </form>

                <div class="">
                    <h1 id="message" class="mt-8 font-serif text-3xl italic font-bold text-center">Cash Deposit Manual payment</h1>
                    
                    <div id="cdm_invoice" class="flex flex-col items-center w-full gap-5 mt-8 bg-slate-100">
                        <h1 class="font-serif text-2xl">Deposit Information</h1>
                        <div class="flex flex-col w-2/4 gap-2 p-5 border-2 rounded-lg">
                            
                            <div class="flex flex-col gap-2 text-md">
        
                                <h1 class="text-lg font-bold text-[#46d82f]">Account Information</h1>
                                <div class="flex justify-between">
                                    <h1><B>Bank Name :</B></h1>
                                    <label>Pepoles Bank</label>
                                </div>
                                <div class="flex justify-between">
                                    <h1><B>Account Name :</B></h1>
                                    <label>MyAgro Pvt Ltd</label>   
                                </div>
                                <div class="flex justify-between">
                                    <h1><B>Account Number :</B></h1>
                                    <label>1802100240110</label>
                                </div>
                                <div class="flex justify-between">
                                    <h1><B>Account Branch :</B></h1>
                                    <label>Deraniyagala</label>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <h1><B>Payment Amount :</B></h1>
                                    <label>Rs. <?php echo $_POST['send_total']; ?></label>
                                </div>
                                
                            </div>
        
                            <div class="flex flex-col gap-2 text-md">
        
                                <h1 class="text-lg font-bold text-[#46d82f]">Voucher Filling Information</h1>
                                <div class="flex justify-between">
                                    <h1><B>Private Registration(PR) ID :</B></h1>         <!--private registration id-->
                                    <label><?php echo $PR_ID; ?></label>
                                </div>
                                <div class="flex justify-between">
                                    <h1><B>Reference Number(RN) :</B></h1>
                                    <label><?php echo $ref; ?></label>
                                </div>
                                <div class="flex justify-between">
                                    <h1><B>Purchase Product Name :</B></h1>
                                    <label><?php echo ucfirst($_POST['agro_name']); ?></label>
                                </div>
                                <div class="flex justify-between">
                                    <h1><B>Your Name :</B></h1>
                                    <label><?php echo ucfirst($name); ?></label>   
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
        
                    <div class="absolute top-5 right-4 w-fit">
                        <button id="cdm" class="flex gap-2 px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.0" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m.75 12 3 3m0 0 3-3m-3 3v-6m-1.5-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            Download PDF
                        </button>
                    </div>
        
                </div>

                <div class="flex justify-center gap-10">
                    <a id="back_btn" style="display: block;" href="agrosell.php?type=<?php echo $_SESSION['agro_type']; ?>" class="w-1/6 py-2 mt-5 mb-5 font-bold text-center text-white bg-blue-500 rounded-lg hover:bg-blue-800">Cancel</a>
                    <button name="confirm_btn" id="confirm_btn" class="mb-5 text-center w-1/6 py-2 mt-5 font-bold text-white rounded-lg bg-lime-500 hover:bg-[#55fd3b]">Confirm Payment</a>
                </div>
        
                <div class="flex flex-col items-center">
                    <p class="text-lg font-bold text-red-600">You need to paid the above mention amount before 18 hours, if not your order cancel automatically.</p>
                    <p class="text-lg font-bold text-red-600">After paid the amount recipt should be upload using order hisory CDM payment section.</p>
                </div>

                <?php
            }else{
                 ?>
                <div class="">
                    <h1 class="text-2xl font-bold text-center text-red-500">Your Payment has been failed</h1>
                    <p class="text-lg font-bold text-center text-red-500">Please try again! </p>
                </div>
            <?php
            }

        }else {
    ?>
        <div class="">
            <h1 class="text-2xl font-bold text-center text-red-500">Your Payment has been failed</h1>
            <p class="text-lg font-bold text-center text-red-500">Please try again! </p>
        </div>
    <?php
        }
    ?>

    <!-- pdf Download -->
    <script>
        window.onload = function () {
            document.getElementById("cdm").addEventListener("click", function () {
                const cdm_invoice = document.getElementById("cdm_invoice");
                var opt = {
                margin: 0,
                filename: "MyAgro CDM Payment invoice.pdf",
                image: { type: "jpeg", quality: 0.98 },
                html2canvas: { scale: 2 },
                jsPDF: { unit: "in", format: "letter", orientation: "portrait" },
                };
                html2pdf().from(cdm_invoice).set(opt).save();
            });
            
        };
    </script>

    <!-- confirm change status pending -->
    <script>
        const confirm_btn = document.getElementById('confirm_btn');
        const confirm_form = document.getElementById('confirm_form');
        confirm_btn.addEventListener('click', () => {
            confirm_form.submit();
        });
    </script>

    <!-- show output message -->
    <script>
        var message ="<?php echo isset($_SESSION['cdm_message']) ? $_SESSION['cdm_message'] : ''; ?>"; //send profile_status include massage  varible message, but if not status then print ''.
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
            <?php unset($_SESSION['cdm_message']); ?>
        } 
    </script>
    
</body>
</html>