// customer and supplier stuats update Hold or active
$(document).ready(function () {
  // customer stuats update Hold
  $(".customer_status_hold_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "This Customer Account will be Hold!",
      icon: "warning",
      iconColor: "#EBEB00",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Hold",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "update.php",
          data: {
            customer_id: id,
            customer_status_hold_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response.includes("success")) {
              Swal.fire({
                title: "Success!",
                text: response,
                icon: "success",
                iconColor: "#7DED0D",
                timer: 1000,
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              Swal.fire({
                title: "Cancelled",
                text: response,
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  // customer stuats update active
  $(".customer_status_active_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "This Customer Account will be Active!",
      icon: "info",
      iconColor: "#7DED0D",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Active",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "update.php",
          data: {
            customer_id: id,
            customer_status_active_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response.includes("success")) {
              Swal.fire({
                title: "Success!",
                text: response,
                icon: "success",
                iconColor: "#7DED0D",
                timer: 1000,
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              Swal.fire({
                title: "Cancelled",
                text: response,
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  // supplier stuats update Hold
  $(".supplier_status_hold_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "This Supplier Account will be Hold!",
      icon: "warning",
      iconColor: "#EBEB00",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Hold",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "update.php",
          data: {
            supplier_id: id,
            supplier_status_hold_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response.includes("success")) {
              Swal.fire({
                title: "Success!",
                text: response,
                icon: "success",
                iconColor: "#7DED0D",
                timer: 1000,
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              Swal.fire({
                title: "Cancelled",
                text: response,
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  // supplier stuats update active
  $(".supplier_status_active_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "This Supplier Account will be Active!",
      icon: "info",
      iconColor: "#7DED0D",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Active",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "update.php",
          data: {
            supplier_id: id,
            supplier_status_active_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response.includes("success")) {
              Swal.fire({
                title: "Success!",
                text: response,
                icon: "success",
                iconColor: "#7DED0D",
                timer: 1000,
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              Swal.fire({
                title: "Cancelled",
                text: response,
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  // farmer stuats update Hold
  $(".farmer_status_hold_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "This farmer Account will be Hold!",
      icon: "warning",
      iconColor: "#EBEB00",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Hold",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "update.php",
          data: {
            farmer_id: id,
            farmer_status_hold_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response.includes("success")) {
              Swal.fire({
                title: "Success!",
                text: response,
                icon: "success",
                iconColor: "#7DED0D",
                timer: 1000,
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              Swal.fire({
                title: "Cancelled",
                text: response,
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  // farmer stuats update active
  $(".farmer_status_active_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "This farmer Account will be Active!",
      icon: "info",
      iconColor: "#7DED0D",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Active",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "update.php",
          data: {
            farmer_id: id,
            farmer_status_active_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response.includes("success")) {
              Swal.fire({
                title: "Success!",
                text: response,
                icon: "success",
                iconColor: "#7DED0D",
                timer: 1000,
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else {
              Swal.fire({
                title: "Cancelled",
                text: response,
                icon: "error",
              });
            }
          },
        });
      }
    });
  });
});
