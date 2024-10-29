function payhere() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      alert(xhttp.responseText);
      // Payment completed. It can be a successful failure.
      payhere.onCompleted = function onCompleted(orderId) {
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer
      };

      // Payment window closed
      payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
      };

      // Error occurred
      payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:" + error);
      };

      // Put the payment variables here
      var payment = {
        sandbox: true,
        merchant_id: "121XXXX", // Replace your Merchant ID
        return_url: undefined, // Important
        cancel_url: undefined, // Important
        notify_url: "http://sample.com/notify",
        order_id: "ItemNo12345",
        items: "Door bell wireles",
        amount: "1000.00",
        currency: "LKR",
        hash: "45D3CBA93E9F2189BD630ADFE19AA6DC", // *Replace with generated hash retrieved from backend
        first_name: "Saman",
        last_name: "Perera",
        email: "samanp@gmail.com",
        phone: "0771234567",
        address: "No.1, Galle Road",
        city: "Colombo",
      };

      payhere.startPayment(payment);
    }
  };
  xhttp.open("GET", "orderProcessing.php", true);
  xhttp.send();
}

// var url = "https://sandbox.payhere.lk/pay/checkout";
// var data = {
//     "sandbox": true,
//     "notify_url": "https://example.com/notify",
//     "merchant_id": "121121121", // Replace with your Merchant ID
//     "return_url": "https://example.com/return",
//     "cancel_url": "https://example.com/cancel",
//     "currency": "LKR",
//     "amount": "100.00",
//     "items": [
//         {
//             "name": "Item 1",
//             "quantity": "1",
//             "price": "100.00",
//             "currency": "LKR"
//         }
//     ]
// };
// var xhr = new XMLHttpRequest();
// xhr.open("POST", url);
// xhr.setRequestHeader("Content-Type", "application/json");
// xhr.onreadystatechange = function () {
//     if (xhr.readyState === 4 && xhr.status === 200) {
//         var response = JSON.parse(xhr.responseText);
//         console.log(response);
//     }
// };
// xhr.send(JSON.stringify(data));
