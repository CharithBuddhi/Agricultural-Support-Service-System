<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <title>Contact Us</title>

</head>
<body class="bg-gray-100 ">
    <?php require('header.php'); ?>
    <div class="flex items-center justify-center w-full min-h-screen overflow-hidden">
        <div class="overflow-hidden ">
            <div class="relative flex flex-col w-full max-w-4xl gap-10 p-8 text-white shadow-lg md:pt-10 md:pb-10 md:space-y-0 md:flex-row md:space-x-6 bg-cyan-700 rounded-xl">
                <div class="flex flex-col justify-between gap-8 ">
                    <div class="flex flex-col gap-2 align-center">
                        <h1 class="text-3xl font-bold tracking-wide">Contact MyAgro</h1>
                        <p class="pt-2 text-sm text-cyan-100">If you have any questions or concerns, please don't hesitate to contact us. Our team is always here to help. We're here to answer any questions you may have.</p>
                    </div>
                    <div class="flex flex-col space-y-4 ">
                        <div class="inline-flex items-center space-x-2">
                            <ion-icon name="call" class="text-xl text-teal-300"></ion-icon>
                            <span>+94 712 345 678</span>
                        </div>
                        <div class="inline-flex items-center space-x-2">
                            <ion-icon name="mail" class="text-xl text-teal-300"></ion-icon>
                            <span>contactmyagro@gmail.com</span>
                        </div>
                        <div class="inline-flex items-center space-x-2">
                            <ion-icon name="location" class="text-xl text-teal-300"></ion-icon>
                            <span>No 250/ Nugegoda/ Colombo</span>
                        </div>
                    </div>
                    <div class="z-40 flex flex-col space-y-4">
                        <div class="flex space-x-4 text-lg">
                            <a href="http://www.facebook.com">
                                <ion-icon name="logo-facebook" class="text-2xl"></ion-icon>
                            </a>
                            <a href="http://www.twitter.com">
                                <ion-icon name="logo-twitter" class="text-2xl"></ion-icon>
                            </a>
                            <a href="http://www.instagram.com">
                                <ion-icon name="logo-instagram" class="text-2xl"></ion-icon>
                            </a>
                        </div>
                        <p class="text-sm text-cyan-100">Thank you for choosing MyAgro. We appreciate your feedback and support. We look forward to working with you again.</p>
                    </div>   
                </div>
                
                <div class="absolute z-0 w-40 h-40 bg-teal-400 rounded-full top-[-70px] right-[-80px] ">

                </div>
                <div class="absolute z-10 w-40 h-40 bg-teal-400 rounded-full bottom-[-45px] right-[320px]">
                    
                </div>

                <div class="z-30 flex flex-col bg-white text-black shadow-lg rounded-xl md:w-[1000px]">
                                        
                    <form action="" class="z-20 flex flex-col">
                        <label for="" class="mb-3 font-serif text-3xl font-semibold">Let's Talk</label>

                        <div class="flex flex-col ml-1 mr-1 space-y-4 ">
                            <div  class="flex flex-col gap-4">
                                <label for="name">Name</label>
                                <input type="text" id="name" placeholder="charitha buddhika" class="rounded-md outline-none h-7 ring-1 ring-gray-300 focus:ring-2 focus:ring-teal-300" required>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label for="email">Email</label>
                                <input type="email" id="email" placeholder="anne123@gmail.com" class="rounded-md outline-none h-7 ring-1 ring-gray-300 focus:ring-2 focus:ring-teal-300" required>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label for="subject">Subject</label>
                                <input type="text" id="subject" placeholder="How to get free access" class="rounded-md outline-none h-7 ring-1 ring-gray-300 focus:ring-2 focus:ring-teal-300" required>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <label for="message">Message</label>
                                <textarea id="message" placeholder="message" class="rounded-md outline-none h-28 ring-1 ring-gray-300 focus:ring-2 focus:ring-teal-300 rows-5" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="w-40 h-8 mb-4 font-bold text-white rounded-lg bg-cyan-600 hover:bg-cyan-300">Send Message</button> 
                            </div>
                            
                        </div> 
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>

    </script>
    
</body>
</html>