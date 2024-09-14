$(document).ready(function () {
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
              });
              // reload price table using jaquary here
              $("#price_table").load(location.href + " #price_table");

              // Delays the execution of the function by 2 seconds
              setTimeout(function () {
                location.reload("price.php");
              }, 1500);
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
});
