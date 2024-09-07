// connect with php file
const request_btn = document.getElementById('request_btn');
request_btn.disabled = true;
const aname = document.getElementById('aname');
const verify_otp = document.getElementById('verify_otp');
const verify_btn = document.getElementById('verify_btn');
const email = document.getElementById('email');
const email_btn = document.getElementById('email_btn'); 
 
    
// disable php file automaticaly loading
document.querySelector('form').addEventListener('submit', function(event) {
  event.preventDefault();
            
});

let otp_value = Math.floor(Math.random() * 10000);

// check OTP code correct or not
verify_btn.addEventListener("click", () => {
  if (verify_otp.value == otp_value) {
    alert("OTP verified successfully");
    request_btn.disabled = false;
  } else {
    alert("Incorrect OTP");
    request_btn.disabled = true;           
  }
})

email_btn.addEventListener("click", (e) => {
  // verify email is correct format or not
  const emailValue = email.value.trim();
  const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!emailRegex.test(emailValue)) {
    alert('Invalid email address');
    e.preventDefault(); // prevent form submission
  } else {
    // email address valid and fallow next email sending step

    // create object to send email 
    let user = {
      "username": aname.value,
      "email": email.value,
      "otp": otp_value,
    }
    // send object to sendmail.php file
    fetch("sendmail.php",{
      "method": "POST",
      "headers": {
          "Content-Type": "application/json; charset=UTF-8"
      },
      "body": JSON.stringify(user)
    })

    
  }

})

