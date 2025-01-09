// connect with php file
const request_btn = document.getElementById("request_btn");
request_btn.disabled = true;
const aname = document.getElementById("aname");
const verify_otp = document.getElementById("verify_otp");
const verify_btn = document.getElementById("verify_btn");
const email = document.getElementById("email");
const email_btn = document.getElementById("email_btn");

var otp_value = "<?php echo $_SESSION['otp']; ?>";

// check OTP code correct or not
verify_btn.addEventListener("click", () => {
  if (verify_otp.value == otp_value) {
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
      title: "OTP verified successfully",
    });
    request_btn.disabled = false;
  } else {
    const Toast = Swal.mixin({
      toast: true,
      position: "top-end",
      showConfirmButton: false,
      iconColor: "#f84444",
      background: "#fcf2f2",
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
      },
    });
    Toast.fire({
      icon: "error",
      title: "Incorrect OTP",
    });
    request_btn.disabled = true;
  }
});

email_btn.addEventListener("click", (e) => {
  // verify email is correct format or not
  const emailValue = email.value.trim();
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(emailValue)) {
    alert("Invalid email address");
    e.preventDefault(); // prevent form submission
  }
});

// Avoid Enter keypress from other input fields triggering email validation
document.querySelectorAll("input").forEach((inputField) => {
  inputField.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
      event.preventDefault(); // Prevent form submit via Enter on other fields
    }
  });
});
