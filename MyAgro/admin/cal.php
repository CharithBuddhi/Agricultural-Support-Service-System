<?php
session_start();
date_default_timezone_set("Asia/colombo");

if(isset($_POST['calculate'])){

    if(isset($_POST['crop_name']) && isset($_POST['crop_variety']) && isset($_POST['period']) &&
    isset($_POST['farmer_salary']) && isset($_POST['cost_land']) && isset($_POST['cost_plough']) &&
    isset($_POST['cost_beds']) && isset($_POST['cost_seeds']) && isset($_POST['cost_fertilizer']) &&
    isset($_POST['cost_pest']) && isset($_POST['cost_water']) && isset($_POST['cost_harvesting']) &&
    isset($_POST['cost_other']) && isset($_POST['yield']) && isset($_POST['min_profit']) &&
    isset($_POST['max_profit']) && isset($_POST['benefit']) && isset($_POST['taxt'])){

        // get data from form
        $id = $_POST['price_id'];
        $search = $_POST['search'];
        $crop_name = $_POST['crop_name'];
        $crop_variety = $_POST['crop_variety'];
        $period = $_POST['period'];
        $farmer_salary = $_POST['farmer_salary'];
        $cost_land = $_POST['cost_land'];
        $cost_plough = $_POST['cost_plough'];
        $cost_beds = $_POST['cost_beds'];
        $cost_seeds = $_POST['cost_seeds'];
        $cost_fertilizer = $_POST['cost_fertilizer'];
        $cost_pest = $_POST['cost_pest'];
        $cost_water = $_POST['cost_water'];
        $cost_harvesting = $_POST['cost_harvesting'];
        $cost_other = $_POST['cost_other'];
        $yield = $_POST['yield'];
        $min_profit = $_POST['min_profit'];
        $max_profit = $_POST['max_profit'];
        $benefit = $_POST['benefit'];
        $taxt = $_POST['taxt'];

        require('db_conn.php');

    

        // check if harvest month already added
        $run = "SELECT * FROM `controlprice` WHERE crop_name = '$crop_name' AND varieties_name = '$crop_variety'";
        $result = mysqli_query($conn,$run);
        $row = mysqli_num_rows($result);
        if($row > 0 && $id == ""){
            $_SESSION['price_message'] = "This control price already added, please edit it.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }else{

            // salary for farmer
            $leave = (int)($period / 7)*2 ;
            $work = $period - $leave;
            $salary = $farmer_salary * $work;
        
            // one kilo product cost calculation
            $product_cost = ($salary + $cost_land + $cost_plough + $cost_beds + $cost_seeds + $cost_fertilizer + $cost_pest + $cost_water + $cost_harvesting + $cost_other) / $yield;
        
            // min control price calculation
            if($min_profit > $max_profit){
                $_SESSION['price_message'] = 'Min profit percentage cannot be greater than max profit percentage';
                // reload previos page
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit();
            }else{
                if($min_profit < 0 || $max_profit < 0 || $benefit < 0 || $taxt < 0){
                    $_SESSION['price_message'] = 'Profit percentage cannot be negative';
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                }else if($min_profit > 100 || $max_profit > 100 || $benefit > 100 || $taxt > 100){
                    $_SESSION['price_message'] = 'Profit or tax percentage cannot be greater than 100';
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    exit();
                }else{
                    $after_min_profit = ($product_cost * $min_profit) / 100;
                    $after_max_profit = ($product_cost * $max_profit) / 100;
                    
                    
                    $sql = "SELECT `yala_start`, `yala_end`, `maha_start`, `maha_end` FROM `harvest` WHERE crop_variety ='$crop_variety' ";
                    $result = mysqli_query($conn,$sql);
                    
                    if(mysqli_num_rows($result) >  0){
        
                        foreach ($result as $items){
                            $yala_start = $items['yala_start'];
                            $yala_end = $items['yala_end'];
                            $maha_start = $items['maha_start'];
                            $maha_end = $items['maha_end'];
        
        
                            // Function to check if today is within the date range
                            function isTodayInRange($yala_start, $yala_end,$maha_start,$maha_end) {
                                // Get the current date (today's date)
                                $today = new DateTime(); 
        
                                // Convert the input start and end dates to DateTime objects
                                $yala_start = new DateTime($yala_start);
                                $yala_end = new DateTime($yala_end);
                                $maha_start = new DateTime($maha_start);
                                $maha_end = new DateTime($maha_end);
        
                                // Check if today's date is within the range
                                if ($today >= $yala_start && $today <= $yala_end || $today >= $maha_start && $today <= $maha_end) {
                                    return true;  // Today is in the range
                                } else {
                                    return false; // Today is not in the range
                                }
                            }
        
                            if (isTodayInRange($yala_start, $yala_end,$maha_start,$maha_end)) {
                                $after_min_benefit_price = (($product_cost + $after_min_profit) * 0) / 100;
                                $after_max_benefit_price = (($product_cost + $after_max_profit) * 0) / 100;
                                echo "0";    
                            }else{
                                echo "2";
                                $after_min_benefit_price = (($product_cost + $after_min_profit) * $benefit) / 100;
                                $after_max_benefit_price = (($product_cost + $after_max_profit) * $benefit) / 100;
                            }
        
                            $after_min_taxt_price = (($product_cost + $after_min_profit + $after_min_benefit_price) * $taxt) / 100;       
                            $min_control_price = $product_cost + $after_min_profit + $after_min_benefit_price + $after_min_taxt_price;
                            
                            $after_max_taxt_price = (($product_cost + $after_max_profit + $after_max_benefit_price) * $taxt) / 100;       
                            $max_control_price = $product_cost + $after_max_profit + $after_max_benefit_price + $after_max_taxt_price;
        
                            // Round the number to two decimal places
                            $min_control_price = round($min_control_price, precision: 2);
                            $max_control_price = round($max_control_price, precision: 2);
        
                            // send final calculation output to conterol_price.php
                            if ($id == ""){
                                header('Location: conterol_price.php?&max_result='.$max_control_price.'&min_result='.$min_control_price.'&crop_name='.$crop_name.'&crop_variety='.$crop_variety);
                                exit;
                            }else{
                                header('Location: conterol_price.php?id='.$id.'&max_result='.$max_control_price.'&min_result='.$min_control_price.'&crop_name='.$crop_name.'&crop_variety='.$crop_variety.'&search='.$search);
                                exit;
                            }
        
                        }  
        
                    }else{
                        $_SESSION['price_message'] = 'Harvest month should be submitted before calculation.';
                        header("Location: " . $_SERVER['HTTP_REFERER']);
                        exit;
                    }          
        
                }
            }

        }

    }else{
        $_SESSION['price_message'] = 'All fields field are required, please check again crop and varieties.';
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }


}else{

    header("Location: index.php");
    exit;
}

?>