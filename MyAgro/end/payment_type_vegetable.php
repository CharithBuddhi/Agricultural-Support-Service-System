<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Type</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <?php 
        
        if(isset($_POST['vegetable_confirm_order'])){
            
            $_SESSION['select_payment_function'] = "vegetable";
            $order_quantity = (float) $_POST['quantity'];
            $vegfruit_total = (float) $_POST['vegfruit_total'];
            $vegfruitle_id = $_POST['vegfruitle_id'];

            $total_quantity = $vegfruit_total - $order_quantity;

            $sql = "UPDATE `vegetablefruit` SET `vegfruit_total`='$total_quantity' WHERE `vegfruitle_id` = '$vegfruitle_id'";            
            $result = $conn->query($sql);

            ?>

            <!-- payment form -->
            <form action="cdm_vegetable.php" method="post" id="payment_form_vegetable">
                
                <input type="hidden" name="vegfruitle_id" value="<?= $_POST['vegfruitle_id']; ?>" >
                <input type="hidden" name="vegetable_category" value="<?= $_POST['vegetable_category']; ?>">
                <input type="hidden" name="vegetable_name" value="<?= $_POST['vegetable_name']; ?>">

                <input type="hidden" name="vegfruitle_verity" value="<?= $_POST['vegfruitle_verity']; ?>">
                <input type="hidden" name="vegfruit_price" value="<?= $_POST['vegfruit_price']; ?>">

                <input type="hidden" name="vegfruit_location" value="<?= $_POST['vegfruit_location']; ?>">
                <input type="hidden" name="order_quantity" value="<?= (float) $_POST['quantity']; ?>">

                <input type="hidden"  name="send_total" value="<?= $_POST['send_total']; ?>">
                
                <input type="hidden" name="farmer_id" value="<?= $_POST['farmer_id']; ?>">
                <input type="hidden" name="farmer_username" value="<?= $_POST['farmer_username']; ?>">
                <input type="hidden" name="farmer_phone" value="<?= $_POST['farmer_phone']; ?>">
                <input type="hidden" name="farmer_email" value="<?= $_POST['farmer_email']; ?>">

                <button type="submit" id="CDM_sub" name="CDM_sub" class="hidden"></button>
            </form>
            
            <!--select payment type -->
            <div class="flex flex-col gap-5 font-serif text-center">
                <!-- display erro massgae -->
                <div id="paymentResponse" class="hidden"></div>

                <h1 class="mt-12 font-serif text-3xl italic font-bold">Payment</h1>  
                <p class="text-2xl">Select the type you want to payment</p>
                
                <div class="flex justify-center gap-8 mt-10">

                    <div action="" method="post" class="flex flex-col gap-2">
                    
                        <button type="submit" id="payButton_vegetable" name="Online Payment">
                            <img src="images/payment Online.jpg" alt="online payment image" class="cursor-pointer w-[400px] h-[300px] rounded-3xl"></button>
                        </button>               
                        <label class="text-lg font-bold">Online Payment</label>
                        <h1 class="mt-3 text-xl font-normal">Pay directly online</h1>

                    </div>

                    <div class="flex flex-col gap-2 text-xl">
                        <button type="submit" id="CDM_vegetable" name="CDM_vegetable"><img src="images/CDM_payment.jpg" alt="Cash Deposit Machine" class="CDM cursor-pointer w-[400px] h-[300px] rounded-3xl"></button>
                        <label class="text-lg font-bold">Cash Deposit Manualy</label>
                        <h1 class="mt-3">Pay through a Cash Deposit voucher</h1>
                    </div>
                    
                </div>

            </div>
            
            <?php  
        }
    ?>
    
    <script>
        // Set stripe publish key to intialize stipe.js
        const stripe = Stripe('pk_test_51QEPjARxjCPZ5J0VljXbUGrY0NuzDKvFyrUvZkcFNpND9W1c94R1NUEZgkWLsTloAKXtSGBDJvS6oln1PnrVXyNJ00USpCJ7sH');
            
            // Select payment button
            const payButton_vegetable = document.querySelector('#payButton_vegetable');

            //payment request
            payButton_vegetable.addEventListener('click', () => {
                
                // setLoading(true);

                createChekoutSession().then(function (data){

                    if(data.session_id){

                        stripe.redirectToCheckout({
                            sessionId: data.session_id
                        }).then(handleResult);
    
                    }else{

                        handleResult(data);
                    }


                });
            });

            // Create checkout session
            const createChekoutSession = function (Stripe){
                return fetch('orderProcessing_vegetable.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({

                        createCheckoutSession:1,

                        vegfruitle_id: document.querySelector('input[name="vegfruitle_id"]').value,
                        vegetable_category: document.querySelector('input[name="vegetable_category"]').value,
                        vegetable_name: document.querySelector('input[name="vegetable_name"]').value,

                        vegfruitle_verity: document.querySelector('input[name="vegfruitle_verity"]').value,
                        vegfruit_price: document.querySelector('input[name="vegfruit_price"]').value,
                        vegfruit_location: document.querySelector('input[name="vegfruit_location"]').value,

                        order_quantity: document.querySelector('input[name="order_quantity"]').value,
                        total_price: document.querySelector('input[name="send_total"]').value,                      

                        provider_id: document.querySelector('input[name="farmer_id"]').value,
                        provider_name: document.querySelector('input[name="farmer_username"]').value,
                        provider_phone: document.querySelector('input[name="farmer_phone"]').value,
                        provider_email: document.querySelector('input[name="farmer_email"]').value

                    }),
                    
                }).then(function (result){
                    return result.json();
                });
                
            } 

        // Handle any errors returned from Checkout
        const handleResult = function (result){
            if(result.error){
                showMessage(result.error.message);
            }
            setLoading(false);
        }

        // Show an error message
        function showMessage (messageText) {
            const message = document.querySelector('#paymentResponse');
            message.classList.remove('hidden');
            message.textContent = messageText;

            setTimeout(function(){
                message.classList.add('hidden');
                message.textContent = '';
            }, 4000);
        }

    </script>

    <!-- Set form action and send it to cdm.php file after click cdm button -->
    <script>
        const payment_form = document.getElementById('payment_form_vegetable');
        const CDM_vegetable = document.getElementById('CDM_vegetable');
        const CDM_sub = document.getElementById('CDM_sub');
        CDM_vegetable.addEventListener('click', () => {
            CDM_sub.click();
        });
    </script>

</body>
</html>
            
            