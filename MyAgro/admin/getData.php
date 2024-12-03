<?php
    include 'db_conn.php';

    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'fetch_crop_names') {
            $query = "SELECT DISTINCT crop_name FROM harvest";
            $result = $conn->query($query);
            $output = '<option value="">Select Crop</option>';
            while ($row = $result->fetch_assoc()) {
                $output .= '<option value="' . $row['crop_name'] . '">' . $row['crop_name'] . '</option>';
            }
            echo $output;
        }

        if ($_POST['action'] == 'fetch_crop_varieties') {
            $crop_name = $_POST['crop_name'];
            $query = "SELECT crop_variety FROM harvest WHERE crop_name = '$crop_name'";
            $result = $conn->query($query);
            $output = '<option value="">Select Variety</option>';
            while ($row = $result->fetch_assoc()) {
                $output .= '<option value="' . $row['crop_variety'] . '">' . $row['crop_variety'] . '</option>';
            }
            echo $output;
        }
    }
?>