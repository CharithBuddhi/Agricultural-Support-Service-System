<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css"> 
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Contact Us</title>

</head>
<body >
    <?php require('header.php'); ?>
    <div class="flex items-center justify-center w-full min-h-screen overflow-hidden bg-cover z-20 bg-no-repeat bg-[url('images/contact.jpg')]">
        <div class="overflow-hidden ">
            <div class="relative flex flex-col w-full max-w-4xl gap-10 p-8 text-white shadow-lg md:pt-10 md:pb-10 md:space-y-0 md:flex-row md:space-x-6 bg-cyan-700 rounded-xl">
                <div class="flex flex-col justify-between gap-8 ">
                    <div class="flex flex-col gap-2 align-center">
                        <h1 class="text-3xl font-bold tracking-wide">Get in Touch</h1>
                        <p class="pt-2 text-sm text-cyan-100">If you have any questions or concerns, please don't hesitate to contact us. Our team is always here to help. We're here to answer any questions you may have.</p>
                    </div>

                    <div class="flex gap-2">
                        <p class="text-2xl font-bold">Hot Line :</p>
                        <p class="text-2xl text-white">0112 345 678</p>
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
                    <div class="z-20 flex flex-col space-y-4">
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
                                        
                    <form action="insert.php" method="post" class="z-20 flex flex-col mt-1 ml-2">
                        <label for="" class="mb-3 font-serif text-3xl font-semibold">Let's Talk</label>

                        <div class="flex flex-col ml-1 mr-1 space-y-4">
                            <div  class="flex flex-col gap-1">
                                <label for="name" class="font-semibold">Name</label>
                                <input name="name" maxlength="40" type="text" id="name" placeholder="charitha buddhika" class="rounded-md outline-none h-7 ring-1 ring-gray-300 focus:ring-2 focus:ring-teal-300" required>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label for="email" class="font-semibold">Email</label>
                                <input type="email" maxlength="50" id="email" name="email" placeholder="anne123@gmail.com" class="rounded-md outline-none h-7 ring-1 ring-gray-300 focus:ring-2 focus:ring-teal-300" required>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label for="subject"  class="font-semibold">Subject</label>
                                <input name="subject" maxlength="60" type="text" id="subject" placeholder="How to get free access" class="rounded-md outline-none h-7 ring-1 ring-gray-300 focus:ring-2 focus:ring-teal-300" required>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label for="message" class="font-semibold">Message</label>
                                <textarea name="message" maxlength="800" id="message" placeholder="message" class="rounded-md outline-none h-28 ring-1 ring-gray-300 focus:ring-2 focus:ring-teal-300 rows-5" required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" id="contact_submit" name="contact_submit" class="flex items-center justify-center h-10 gap-1 mb-4 font-bold text-white w-28 rounded-3xl bg-gradient-to-r from-cyan-600 to-teal-400">   
                                    <h1>Submit</h1>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                    </svg>
                                </button> 
                            </div>
                            
                        </div> 
                    </form>
                    
                </div>
                
            </div>
        </div>
    </div>

        <!-- footer section in home page -->
        <?php require('footer.php'); ?>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
        // verify email is correct format or not
        const contact_submit = document.getElementById("contact_submit");
        const email = document.getElementById('email');
        
        contact_submit.addEventListener("click", (e) => {
            const emailValue = email.value.trim();
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(emailValue)) {
                
                alert('Invalid email address');
                e.preventDefault(); // prevent form submission
            }
        })
    
    </script>
    
    <script>
    // show success or error message
    var message ="<?php echo isset($_SESSION['status']) ? $_SESSION['status'] : ''; ?>";   //send status include massage  varible message, but if not status then print ''.

    if (message != "") {
        if(message.includes('success')) {
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            iconColor: "#69f44a",
            timer: 3000,
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
            timer: 3000,
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
        <?php unset($_SESSION['status']); ?>
    }   
    </script>
    
</body>
</html>

