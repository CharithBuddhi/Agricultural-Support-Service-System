<?php
session_start();
// Database connection
$conn = mysqli_connect("localhost","root","","myagro");

    if(isset($_POST['district'])) {
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
    }

    if(isset($_POST['vegetable_district'])) {
        // Get the selected district from the AJAX request
        $selected_district = $_POST['vegetable_district'];

        if(($_POST['category'])!=""){
            $selected_category = $_POST['category'];
            $query = "SELECT DISTINCT vegfruit_area FROM vegetablefruit WHERE vegfruit_distric = '$selected_district' AND vegetable_category = '$selected_category' ORDER BY vegfruit_area";
        }else{
            $query = "SELECT DISTINCT vegfruit_area FROM vegetablefruit WHERE vegfruit_distric = '$selected_district' ORDER BY vegfruit_area";
        }
        // Query to get distinct areas for the selected district
        $result = mysqli_query($conn, $query);
    
        // Fetch all areas as an array
        $areas = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $areas[] = $row['vegfruit_area'];
        }
    }

// Return the result as a JSON array
echo json_encode($areas);
?>