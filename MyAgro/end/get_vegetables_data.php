<?php
    include 'db_connect.php';

    if (isset($_POST['action'])) {

        if ($_POST['action'] == 'fetch_crop_names') {
            $crop_origin = $_POST['origin'];
            $query = "SELECT crop_name FROM controlprice WHERE crop_category = '$crop_origin'";
            $result = $conn->query($query);
            $output = '<option value="">Select Variety</option>';
            while ($row = $result->fetch_assoc()) {
                $output .= '<option value="' . $row['crop_name'] . '">' . $row['crop_name'] . '</option>';
            }
            echo $output;
        }

        if ($_POST['action'] == 'fetch_crop_varieties') {

            $crop_origin = $_POST['origin'];
            $Category = $_POST['Category'];

            $query = "SELECT varieties_name FROM controlprice WHERE crop_category = '$crop_origin' AND crop_name = '$Category'";
            $result = $conn->query($query);
            $output = '<option value="">Select Variety</option>';
            while ($row = $result->fetch_assoc()) {
                $output .= '<option value="' . $row['varieties_name'] . '">' . $row['varieties_name'] . '</option>';
            }
            echo $output;
        }

        if ($_POST['action'] == 'fetch_crop_minimum and maxmum price') {

            $crop_origin = $_POST['origin'];
            $category = $_POST['category'];
            $name = $_POST['name'];

            $query = "SELECT min_price, max_price FROM controlprice WHERE crop_category = '$crop_origin' AND crop_name = '$category' AND varieties_name = '$name' LIMIT 1";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            header('Content-Type: application/json');
            
            // Construct response array
            $row = [
                'min_price' => $row['min_price'], // Example value
                'max_price' => $row['max_price'] // Example value
            ];
            
            // Return JSON response
            echo json_encode($row);

        }

        if ($_POST['action'] == 'fetch_crop_names_vegefrut_table') {
            $crop_origin = $_POST['origin'];
            $query = "SELECT vegetable_name FROM vegetablefruit WHERE vegetable_category = '$crop_origin'";
            $result = $conn->query($query);
            $output = '<option value="">Select Variety</option>';
            while ($row = $result->fetch_assoc()) {
                $output .= '<option value="' . $row['vegetable_name'] . '">' . $row['vegetable_name'] . '</option>';
            }
            echo $output;
        }

        if ($_POST['action'] == 'fetch_crop_varieties_vegefrut_table') {

            $crop_origin = $_POST['origin'];
            $name = $_POST['name'];

            $query = "SELECT vegfruitle_verity FROM vegetablefruit WHERE vegetable_category = '$crop_origin' AND vegetable_name = '$name'";
            $result = $conn->query($query);
            $output = '<option value="">Select Variety</option>';
            while ($row = $result->fetch_assoc()) {
                $output .= '<option value="' . $row['vegfruitle_verity'] . '">' . $row['vegfruitle_verity'] . '</option>';
            }
            echo $output;
        }
    }
?>