$(document).ready(function () {
  // price delete message show
  $(".price_delete_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "You can't recover this again!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "delete.php",
          data: {
            price_id: id,
            price_delete_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response == 200) {
              Swal.fire({
                title: "Success!",
                text: "Control price deleted successfully.",
                icon: "success",
                timer: 1000,
              });
              // reload price page  here
              setTimeout(function () {
                location.reload();
              }, 1000); // 1000 milliseconds = 1 seconds
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Control price is safe.",
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  // inqury delet message show
  $(".inqury_delete_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "You can't recover this again!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        // after confirm using ajax and creating object send object delete.php file
        $.ajax({
          method: "POST",
          url: "delete.php",
          data: {
            notify_id: id,
            inqury_delete_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response == 200) {
              Swal.fire({
                title: "Success!",
                text: "Inquiry deleted successfully.",
                icon: "success",
                timer: 1000,
              });
              // reload inqury page  here
              setTimeout(function () {
                location.reload();
              }, 1000); // 1000 milliseconds = 2 seconds
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Inqury is safe.",
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  // request delet message show
  $(".request_delete_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "You can't recover this again!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        // after confirm using ajax and creating object send object delete.php file
        $.ajax({
          method: "POST",
          url: "delete.php",
          data: {
            request_id: id,
            request_delete_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response == 200) {
              Swal.fire({
                title: "Success!",
                text: "Request deleted successfully.",
                icon: "success",
                timer: 1000,
              });
              // reload request page  here
              setTimeout(function () {
                location.reload();
              }, 1000); // 1000 milliseconds = 2 seconds
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Request is safe.",
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  // harvest delet message show
  $(".hrvst_delete_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "You can't recover this again!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "delete.php",
          data: {
            harvest_id: id,
            harvest_delete_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response == 200) {
              Swal.fire({
                title: "Success!",
                text: "Harvesting month deleted successfully.",
                icon: "success",
                timer: 1000,
              });
              // reload harvesting page  here
              setTimeout(function () {
                location.reload();
              }, 1000); // 1000 milliseconds = 2 seconds
            } else {
              Swal.fire({
                title: "Cancelled",
                text: "Harvesting month is safe.",
                icon: "error",
              });
            }
          },
        });
      }
    });
  });

  //this function some times work with cache data
  // technology delete message show
  $(".technology_delete_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "You can't recover this again!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "delete.php",
          data: {
            tech_id: id,
            technology_delete_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response == 200) {
              Swal.fire({
                title: "Success!",
                text: "Technology details deleted successfully.",
                icon: "success",
                timer: 1000,
              });
              // reload harvesting page  here
              setTimeout(function () {
                location.reload();
              }, 1000); // 1000 milliseconds = 1 seconds
            } else if (response !== 200) {
              Swal.fire({
                title: "Cancelled",
                text: response,
                icon: "error",
              });
            } else if (response == 500) {
              Swal.fire({
                title: "Cancelled",
                text: "Technology details already deleted.",
                icon: "error",
              });
            }
          },
        });
      }
    });
  });
});
