<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQs</title>
    <link rel="stylesheet" href="/MyAgro/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
        .libre-baskerville-regular-italic {
            font-family: "Libre Baskerville", serif;
            font-weight: 700;
            font-style: italic;
        }
    </style>
</head>

<body>
    <!-- navigation bar -->
    <?php require('header.php'); ?>

    <div class="flex flex-col justify-center gap-2 mb-[170px] select-none">
        <h1 class="mt-10 mb-20 text-4xl text-center libre-baskerville-regular-italic">Frequently Asked Questions</h1>

        <div class="self-center px-6 py-5 ml-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl hover:scale-105 hover:bg-gray-100 w-fit hover:shadow-2xl">
            <div class="w-[700px] ">
                <dt class="flex items-center justify-between" aria-controls="faq-0">
                    <h3 class="text-xl font-semibold select-none">Why should I use MyAgro?</h3>
                    <ion-icon name="chevron-down-outline" class="text-2xl transition rotate-180"></ion-icon>
                </dt>
                <dd id="faq-0" class="hidden mt-3 transition">
                    <p class="select-none">MyAgro is a website that helps to you sell or buy vegetables and fruits at reasonable prices. Users are given knowledge about new technical tools used in agriculture and knowledge about common nutrients in vegetables and fruits.</p>
                </dd>
            </div>
        </div>

        <div class="self-center px-6 py-5 ml-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl hover:scale-105 hover:bg-gray-100 w-fit hover:shadow-2xl">
            <div class="w-[700px] flex flex-col">
                <dt class="flex items-center justify-between" aria-controls="faq-1">
                    <h3 class="text-xl font-semibold select-none">How many accounts can be created?</h3>
                    <ion-icon name="chevron-down-outline" class="text-2xl transition rotate-180"></ion-icon>
                </dt>
                <dd id="faq-1" class="hidden mt-3 transition select-none">
                    <p class="select-none">It is not possible to create an account again with the same user type using the same username, email, or NIC number. Multiple user types can create accounts if desired. There is an opportunity to use the same email for that.</p>
                </dd>
            </div>
        </div>

        <div class="self-center px-6 py-5 ml-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl hover:scale-105 hover:bg-gray-100 w-fit hover:shadow-2xl">
            <div class="w-[700px] ">
                <dt class="flex items-center justify-between" aria-controls="faq-6">
                    <h3 class="text-xl font-semibold select-none">How to create your account?</h3>
                    <ion-icon name="chevron-down-outline" class="text-2xl transition rotate-180"></ion-icon>
                </dt>
                <dd id="faq-6" class="hidden mt-3 transition">
                    <p class="select-none">MyAgro website basically has three types of users. That is, the customer, the farmer, and the supplier. All users must enter the OTP code received in the email sent to the system and unlock the register or request button. Choose your user type correctly.</p>
                    <h3 class="mt-2 font-medium">Customer</h3>
                    <p>If you are only buying vegetables, fruits fertilizer or agrochemical system then you should select user type as customer. All your information must be true. It is mandatory to use the email account you use for creation account. After filling all the sections of the form, click on the register button and register directly in the system. After successful registration, you can login to the system.</p>
                    <h3 class="mt-2 font-medium">Farmer</h3>
                    <p>If you are a person who wants to buy and sell vegetables or fruits then the user type is farmer. You can also buy agrochemicals and fertilizers. While registering as a farmer, a photograph of the government registered SL-GAP document must be uploaded. The farmer cannot register directly into the system. After the farmer enters all the correct information and submits a request, the accuracy of the information is checked. Only if the information is correct will the farmer be registered in the system within twenty four hours. Otherwise an email will be sent explaining the error.</p>
                    <h3 class="mt-2 font-medium">Supplier</h3>
                    <p>If you want to sell agrochemicals, buy vegetables and fruits, select the supplier account type and register in the system. Registering as a supplier should include the registered name of the business and the document confirming the registration of the business. If the information is correct, the system will register the supplier. If the information is incorrect, it will be notified through an email and this will take a maximum of 24 hours.</p>
                </dd>
            </div>
        </div>

        <div class="self-center px-6 py-5 ml-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl hover:scale-105 hover:bg-gray-100 w-fit hover:shadow-2xl">
            <div class="w-[700px] ">
                <dt class="flex items-center justify-between" aria-controls="faq-2">
                    <h3 class="text-xl font-semibold select-none">How to buy vegetables or fruits?</h3>
                    <ion-icon name="chevron-down-outline" class="text-2xl transition rotate-180"></ion-icon>
                </dt>
                <dd id="faq-2" class="hidden mt-3 transition">
                    <p class="select-none">You cannot buy vegetables or fruits at the same time through the system. You only do half of the transaction through the system. Also, to get vegetables or fruits, the farmer should go to the delivery place and pay the remaining amount.</p>
                </dd>
            </div>
        </div>

        <div class="self-center px-6 py-5 ml-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl hover:scale-105 hover:bg-gray-100 w-fit hover:shadow-2xl">
            <div class="w-[700px] ">
                <dt class="flex items-center justify-between" aria-controls="faq-3">
                    <h3 class="text-xl font-semibold select-none">How to buy fertilizers or agrochemical?</h3>
                    <ion-icon name="chevron-down-outline" class="text-2xl transition rotate-180"></ion-icon>
                </dt>
                <dd id="faq-3" class="hidden mt-3 transition">
                    <p class="select-none">You cannot buy fertilizers or agrochemicals at once through the system. You only do half of the transaction through the system. Also, to get fertilizers or agrochemicals, the supplier should go to the given shop and pay the remaining amount.</p>
                </dd>
            </div>
        </div>

        <div class="self-center px-6 py-5 ml-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl hover:scale-105 hover:bg-gray-100 w-fit hover:shadow-2xl">
            <div class="w-[700px] ">
                <dt class="flex items-center justify-between" aria-controls="faq-4">
                    <h3 class="text-xl font-semibold select-none">How to pay using CDM payment method?</h3>
                    <ion-icon name="chevron-down-outline" class="text-2xl transition rotate-180"></ion-icon>
                </dt>
                <dd id="faq-4" class="hidden mt-3 transition">
                    <p class="select-none">Select the payment method as CDM while making the payment at the end of the purchase. You will then be shown the relevant account details for payment. If you agree to the payment, press the confirm button. You must make the payment within 18 hours from the confirmed date. After you make the payment you have to upload a photo of the payment slip into the system. For that use the payment section of your dashboard.</p>
                </dd>
            </div>
        </div>

        <div class="self-center px-6 py-5 ml-10 bg-white border-2 border-gray-200 shadow-lg rounded-xl hover:scale-105 hover:bg-gray-100 w-fit hover:shadow-2xl">
            <div class="w-[700px] ">
                <dt class="flex items-center justify-between" aria-controls="faq-5">
                    <h3 class="text-xl font-semibold select-none">How to use page of nutrients of product?</h3>
                    <ion-icon name="chevron-down-outline" class="text-2xl transition rotate-180"></ion-icon>
                </dt>
                <dd id="faq-5" class="hidden mt-3 transition">
                    <p class="select-none">You must first upload a photo to the system following the instructions shown in red. The system will then display some of the nutrients commonly found in the vegetable in the image you entered. If the system does not have information related to the image you entered, it will display a message that the information cannot be found.</p>
                </dd>
            </div>
        </div>


    </div>

    <!-- footer section in home page -->
    <?php require('footer.php'); ?>

    <!-- script for hiddend and show answer -->
    <script>
        // accordion
        const dtElemants = document.querySelectorAll('dt');
        dtElemants.forEach((element) => {
            element.addEventListener('click', () => {
                const ddID = element.getAttribute('aria-controls');
                const ddElemant = document.getElementById(ddID);
                const iconElemant = element.querySelector('ion-icon');

                ddElemant.classList.toggle('hidden'); //hidden are available then convert block, block are available then convert hidden
                iconElemant.classList.toggle('rotate-180'); //rotate-180 are available then convert rotate-0, rotate-0 are available then convert rotate-180
            });
        })
    </script>

</body>

</html>