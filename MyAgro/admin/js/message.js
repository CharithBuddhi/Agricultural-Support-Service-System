// // show success or error message
// var message =
//   "<?php echo isset($_SESSION['status']) ? $_SESSION['status'] : ''; ?>"; //send status include massage  varible message, but if not status then print ''.

// if (message != "") {
//   if (message.toLowerCase().contains("success")) {
//     const Toast = Swal.mixin({
//       toast: true,
//       position: "top-end",
//       showConfirmButton: false,
//       iconColor: "#69f44a",
//       background: "#e4fddf",
//       timer: 4000,
//       timerProgressBar: true,
//       didOpen: (toast) => {
//         toast.onmouseenter = Swal.stopTimer;
//         toast.onmouseleave = Swal.resumeTimer;
//       },
//     });
//     Toast.fire({
//       icon: "success",
//       title: message,
//     });
//   } else {
//     const Toast = Swal.mixin({
//       toast: true,
//       position: "top-end",
//       showConfirmButton: false,
//       iconColor: "#f84444",
//       background: "#fae1e1",
//       timer: 4000,
//       timerProgressBar: true,
//       didOpen: (toast) => {
//         toast.onmouseenter = Swal.stopTimer;
//         toast.onmouseleave = Swal.resumeTimer;
//       },
//     });
//     Toast.fire({
//       icon: "error",
//       title: message,
//     });
//   }
//   // remove after once message is shown
//   sessionStorage.removeItem("status");
// }
