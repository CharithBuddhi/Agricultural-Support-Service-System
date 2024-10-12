<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Dashboard Menu bar -->
    <div type="text" class="flex h-screen flex-col text-white bg-[#08025e] rounded-r-3xl" id="menubar">

        <!-- logo MyAgro -->
        <div class="flex justify-center h-[80px] p-2 mt-2 border-b-2 border-slate-100">
            <ion-icon name="leaf-outline" class="  w-[35px] h-[35px]"></ion-icon>
            <ion-icon name="leaf-outline" class="  w-[35px] h-[35px] scale-x-[-1]"></ion-icon>
            <label class="text-3xl text-center w-[120px] ">MyAgro</label> 
        </div>  
                
        <!-- Dashboard icons -->
        <a href="admin.php" id="dashboard" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
            </svg>
            <h1>Dashboard</h1>
        </a>

        <!-- profile icon -->
        <a href="admin_profile.php" id="profile" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <h1>Profile</h1>
        </a>

        <!-- control price icon -->
        <a href="price.php" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
            </svg>
            <h1>Control Price</h1>
        </a>

        <!-- staff icon -->
        <a href="staff_info.php" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
            <h1>Staff info</h1>
        </a>

        <!-- user icon -->
        <a href="user.php" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <h1>User info</h1>
        </a>

        <!-- user icon -->
        <a href="farmer_info.php" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <h1>Farmer info</h1>
        </a>

        <!-- product info icon -->
        <a href="product.php" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
            <h1>Product info</h1>
        </a>

        <!-- order info icon -->
        <a href="product.php" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
            </svg>
            <h1>Order info</h1>
        </a>

        <!-- report icon -->
        <a href="report.php" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
            </svg>
            <h1>Report</h1>
        </a>

        <!-- log out icon -->
        <a href="logout.php?admin=logout" class="flex gap-2 pl-5 pt-3 pb-3 rounded-lg text-lg w-[100%] hover:text-black hover:bg-[#0AFFFF]"  id="log_out" >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
            <h1>Log Out</h1>
        </a>  
    </div>



    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- <script>
    // Get the current URL of the web page
    var currentURL = window.location.href;

    // Get elements by their IDs
    const dashboard = document.getElementById('dashboard');
    const profile = document.getElementById('profile');
    const request = document.getElementById('request');
    const report = document.getElementById('report');

    // Example of how to compare the URL and set the background
    if (currentURL === "http://localhost/Agricultural-Support-Service-System/MyAgro/admin/admin.php") {
        dashboard.style.background = "#0AFFFF";  // Use style.background
    } else if (currentURL === "http://localhost/Agricultural-Support-Service-System/MyAgro/admin/admin_profile.php") {
        profile.style.background = "#0AFFFF";    // Use style.background
    } else {
        console.log("You are on a different page.");
    } -->
<!-- </script> -->


    <!-- <script>
        // Get the menubar element
        const menubar = document.getElementById('menubar');
        // Get the buttons in the menubar
        const buttons = menubar.querySelectorAll('button');

        // Add an event listener to each button
        buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Check if the menubar is currently expanded
            if (menubar.style === 'width:20%') { // adjust this value to your desired expanded width
            // Shrink the menubar
            menubar.style = 'width:5%'; // adjust this value to your desired shrunk width
            } else {
            // Expand the menubar
            menubar.style = 'width:30%';
            }
        });
        });
    </script> -->

</body>
</html>