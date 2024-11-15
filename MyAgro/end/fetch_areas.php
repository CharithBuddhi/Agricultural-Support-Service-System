<?php
session_start();
// Database connection
$conn = mysqli_connect("localhost","root","","myagro");

// Get the selected district from the AJAX request
$selected_district = $_POST['district'];
$category = $_SESSION['cate_type'];

// Query to get distinct areas for the selected district
$query = "SELECT DISTINCT agro_area FROM agrochemical WHERE agro_district = '$selected_district' AND fertilizer_category = '$category' ORDER BY agro_area";
$result = mysqli_query($conn, $query);

// Fetch all areas as an array
$areas = [];
while ($row = mysqli_fetch_assoc($result)) {
    $areas[] = $row['agro_area'];
}

// Return the result as a JSON array
echo json_encode($areas);
?>