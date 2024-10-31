<?php 

// if(isset($_POST['id'])){
//     // Prepare the SQL statement
//     $sql = "INSERT INTO controlprice (crop_name, varieties_name, min_price, max_price, create_date) 
//     VALUES (?, ?, ?, ?, now())";

//     // Prepare the statement
//     $stmt = mysqli_prepare($conn, $sql);

//     // Bind the parameters to the placeholders
//     mysqli_stmt_bind_param($stmt, 'ssdd', $crop_name_result, $crop_variety_result, $min_result, $max_result);

//     // Execute the statement
//     $result = mysqli_stmt_execute($stmt);

//     if($result){
//         $_SESSION['msg'] = "New control price added successfully";
//         echo "<script>window.location.href = 'price.php';</script>";
//     } else {
//         echo "Failed to insert data: " . mysqli_error($conn);
//     }
// }

?>