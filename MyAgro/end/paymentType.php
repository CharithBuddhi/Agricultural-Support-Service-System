<?php session_start(); 
require_once('transaction.php');
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

    <!--select payment type -->
    <div class="flex flex-col gap-5 font-serif text-center">
        <!-- display erro massgae -->
         <div id="paymentResponse" class="hidden"></div>

        <h1 class="mt-12 font-serif text-3xl italic font-bold">Payment</h1>  
        <p class="text-2xl">Select the type you want to payment</p>
        
        <div class="flex justify-center gap-8 mt-10 font-bold ">

            <div action="" method="post" class="flex flex-col gap-2">
            
                <button type="submit" id="payButton" name="Online Payment">
                    <img src="images/payment Online.jpg" alt="online payment image" class="cursor-pointer w-[400px] h-[300px] rounded-3xl"></button>
                    <!-- <div class="bg-red-600 spinner" id="spinner">1</div>  -->
                    Online Payment
                </button>               
                <h1 class="mt-3 text-xl">Pay your payment directly online</h1>

            </div>

            <div class="flex flex-col text-xl">
                <a href="CDM.php"><img src="images/CDM.jpg" alt="Cash Deposit Machine" class="cursor-pointer w-[400px] h-[300px] rounded-3xl">
                CDM  Payment</a>
                <h1 class="mt-3">To pay your payment through a CDM machine</h1>
            </div>
            
        </div>

    </div>

    <script>
        // Set stripe publish key to intialize stipe.js
        const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY ?>');
        
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

        // Show a spinner on payment submission
        // function setLoading (isLoading){
        //     const spinner = document.querySelector('#spinner');
        //     if(isLoading){
        //         payBtn.disabled = true;
        //         spinner.classList.remove('hidden');
        //     }else{
        //         payBtn.disabled = false;
        //         spinner.classList.add('hidden');
        //     }
        // }

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