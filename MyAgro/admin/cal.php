<?php

if(isset($_POST['calculate'])){

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

    // echo $cost_harvest;

    // salary for farmer
    $leave = (int)($period / 7)*2 ;
    $work = $period - $leave;
    $salary = $farmer_salary * $work;

    // one kilo product cost calculation
    $product_cost = ($salary + $cost_land + $cost_plough + $cost_beds + $cost_seeds + $cost_fertilizer + $cost_pest + $cost_water + $cost_harvesting + $cost_other) / $yield;

    // min control price calculation
    $after_min_profit = ($product_cost * $min_profit) / 100;

    $after_min_benefit_price = (($product_cost + $after_min_profit) * $benefit) / 100;

    $after_min_taxt_price = (($product_cost + $after_min_profit + $after_min_benefit_price) * $taxt) / 100;

    $min_control_price = $product_cost + $after_min_profit + $after_min_benefit_price + $after_min_taxt_price;

    // max control price calculation
    $after_max_profit = ($product_cost * $max_profit) / 100;

    $after_max_benefit_price = (($product_cost + $after_max_profit) * $benefit) / 100;

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

?>