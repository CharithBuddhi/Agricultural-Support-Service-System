<?php 
// require_once('transaction.php');
?>
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
        
        if(isset($_POST['confirm_order'])){
            ?>

            <!-- payment form -->
            <form action="" method="post">
                <input type="hidden" name="agro_id" value="<?= $_POST['agro_id']; ?>" >
                <input type="hidden" name="agro_category" value="<?= $_POST['agro_category']; ?>">
                <input type="hidden" name="agro_type" value="<?= $_POST['agro_type']; ?>">
                
                <input type="hidden" name="agro_name" value="<?= $_POST['agro_name']; ?>">
                <input type="hidden" name="agro_price" value="<?= $_POST['agro_price']; ?>">
                <input type="hidden" name="agro_quantity" value="<?= $_POST['agro_quantity']; ?>">

                <input type="hidden" name="shop_name" value="<?= $_POST['shop_name']; ?>">
                <input type="hidden" name="agro_location" value="<?= $_POST['agro_location']; ?>">
                <input type="hidden" name="order_quantity" value="<?= $_POST['quantity']; ?>">

                <input type="hidden"  name="send_total" value="<?= $_POST['send_total']; ?>">
                <input type="hidden"  name="send_half" value="<?= $_POST['send_half']; ?>">

                <input type="hidden" name="supplier_id" value="<?= $_POST['supplier_id']; ?>">
                <input type="hidden" name="supplier_name" value="<?= $_POST['supplier_name']; ?>">
                <input type="hidden" name="supplier_phone" value="<?= $_POST['supplier_phone']; ?>">
                <input type="hidden" name="supplier_email" value="<?= $_POST['supplier_email']; ?>">

            </form>
            
            <!--select payment type -->
            <div class="flex flex-col gap-5 font-serif text-center">
                <!-- display erro massgae -->
                <div id="paymentResponse" class="hidden"></div>

                <h1 class="mt-12 font-serif text-3xl italic font-bold">Payment</h1>  
                <p class="text-2xl">Select the type you want to payment</p>
                
                <div class="flex justify-center gap-8 mt-10">

                    <div action="" method="post" class="flex flex-col gap-2">
                    
                        <button type="submit" id="payButton" name="Online Payment">
                            <img src="images/payment Online.jpg" alt="online payment image" class="cursor-pointer w-[400px] h-[300px] rounded-3xl"></button>
                        </button>               
                        <label class="text-lg font-bold">Online Payment</label>
                        <h1 class="mt-3 text-xl font-normal">Pay your payment directly online</h1>

                    </div>

                    <div class="flex flex-col gap-2 text-xl">
                        <a href="CDM.php"><img src="images/CDM.jpg" alt="Cash Deposit Machine" class="cursor-pointer w-[400px] h-[300px] rounded-3xl"></a>
                        <label class="text-lg font-bold">CDM  Payment</label>
                        <h1 class="mt-3">Pay your payment through a CDM machine</h1>
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
        const payBtn = document.querySelector('#payButton');

        //payment request
        payBtn.addEventListener('click', () => {
            
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
            return fetch('orderProcessing.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({

                    createCheckoutSession:1,

                    agro_id: document.querySelector('input[name="agro_id"]').value,
                    agro_category: document.querySelector('input[name="agro_category"]').value,
                    agro_type: document.querySelector('input[name="agro_type"]').value,

                    agro_name: document.querySelector('input[name="agro_name"]').value,
                    agro_price: document.querySelector('input[name="agro_price"]').value,
                    agro_quantity: document.querySelector('input[name="agro_quantity"]').value,

                    shop_name: document.querySelector('input[name="shop_name"]').value,
                    agro_location: document.querySelector('input[name="agro_location"]').value,
                    order_quantity: document.querySelector('input[name="order_quantity"]').value,
                    
                    total_price: document.querySelector('input[name="send_total"]').value,
                    half_price: document.querySelector('input[name="send_half"]').value,

                    // customer_name: "Charitha",
                    // customer_email: "XHl7t@example.com",
                    // customer_phone: "+94 717235416",
                    // customer_address: "No 56, Galla Road, Colombo",

                    provider_id: document.querySelector('input[name="supplier_id"]').value,
                    provider_name: document.querySelector('input[name="supplier_name"]').value,
                    provider_phone: document.querySelector('input[name="supplier_phone"]').value,
                    provider_email: document.querySelector('input[name="supplier_email"]').value

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

</body>
</html>