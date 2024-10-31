// document.addEventListener("DOMContentLoaded", function () {
//   // Add click event listener to all buttons with the class 'verity-btn'
//   document.querySelectorAll(".verity-btn").forEach((button) => {
//     button.addEventListener("click", function () {
//       // Get the verity_id from the data attribute
//       let verity_id = this.getAttribute("data-verity-id");

//       // Send AJAX request to PHP
//       fetch("variety.php?verity_id=" + verity_id)
//         .then((response) => response.json()) // Parse JSON from PHP
//         .then((data) => {
//           console.log(data); // This is the data returned from PHP

//           // Use the data to populate the modal or fields
//           document.getElementById("Product_name").value = data.product_name;
//           document.getElementById("Verities_name").value = data.verities_name;
//           document.getElementById("Days_Maturity").value = data.Days_Maturity;
//           document.getElementById("Verities_image").value = data.verities_image;
//           document.getElementById("Description").value = data.Description;
//           document.getElementById("Light").value = data.Light;
//           document.getElementById("Water").value = data.Water;
//           document.getElementById("Nutrient").value = data.Nutrient;
//           document.getElementById("Soil").value = data.Soil;
//           document.getElementById("distance").value = data.distance;
//           document.getElementById("depth").value = data.depth;
//           document.getElementById("spacing").value = data.spacing;
//           document.getElementById("Harvest_message").value =
//             data.Harvest_message;
//           document.getElementById("Companion").value = data.Companion;
//           document.getElementById("Antagonistic").value = data.Antagonistic;
//           document.getElementById("Diseases").value = data.Diseases;
//           document.getElementById("Pests").value = data.Pests;
//           document.getElementById("Origin").value = data.Origin;

//           // Show the modal (if you're using one)
//           $("#add_verities").modal("show");
//         })
//         .catch((error) =>
//           console.error("Error fetching verity details:", error)
//         );
//     });
//   });
// });

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
});
