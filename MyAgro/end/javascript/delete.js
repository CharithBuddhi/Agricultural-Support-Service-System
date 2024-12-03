$(document).ready(function () {
  // product delete message show
  $(".product_delete_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "You can't recover this product again!",
      icon: "question",
      iconColor: "#f44336",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "font_delete.php",
          data: {
            product_id: id,
            product_delete_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response == 200) {
              Swal.fire({
                title: "Success!",
                text: "Product deleted successfully.",
                icon: "success",
                timer: 1000,
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else if (response == 500) {
              Swal.fire({
                title: "Cancelled",
                text: "This product details are missin.",
                icon: "error",
              });
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

  // product delete message show
  $(".vegetable_delete_btn").click(function (e) {
    e.preventDefault();
    var id = $(this).val();

    Swal.fire({
      title: "Are you sure?",
      text: "You can't recover this product again!",
      icon: "question",
      iconColor: "#f44336",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          method: "POST",
          url: "font_delete.php",
          data: {
            vegetable_id: id,
            vegetable_delete_btn: true,
          },
          success: function (response) {
            console.log(response);
            if (response == 200) {
              Swal.fire({
                title: "Success!",
                text: "Product deleted successfully.",
                icon: "success",
                timer: 1000,
              });
              setTimeout(function () {
                location.reload();
              }, 1000);
            } else if (response == 500) {
              Swal.fire({
                title: "Cancelled",
                text: "This product details are missin.",
                icon: "error",
              });
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
