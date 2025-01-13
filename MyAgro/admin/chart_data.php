<?php

    include 'db_conn.php';

    // fetch user count data
    if (isset($_POST['user_data']) && $_POST['user_data'] == 'fetch_user_counts') {
        $user_count_output = array();

        $sql = "SELECT COUNT(*) AS count FROM farmer";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $user_count_output['farmer'] = $row['count'];

        $sql = "SELECT COUNT(*) AS count FROM customer";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $user_count_output['customer'] = $row['count'];

        $sql = "SELECT COUNT(*) AS count FROM staff";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $user_count_output['staff'] = $row['count'];

        $sql = "SELECT COUNT(*) AS count FROM supplier";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $user_count_output['supplier'] = $row['count'];

        // Return the counts as JSON
        echo json_encode($user_count_output);
    
    }

    // fetch 3D chart data
    if (isset($_POST['chart_data']) && $_POST['chart_data'] == 'fetch_threeD_chart_count') {
        $output = array();

        // Query to get the count of online payment 
        $query_online_payment = "SELECT * FROM transaction WHERE payment_status = 'succeeded' AND stripe_id IS NOT NULL";
        $result_online_payment = $conn->query($query_online_payment);
        $number_of_rows = $result_online_payment->num_rows;
        $output['online_succeded'] = $number_of_rows;

        // Query to get the count of online canceled payment 
        $query_online_canceled = "SELECT * FROM transaction WHERE payment_status = 'Canceled' AND stripe_id IS NOT NULL";
        $result_online_canceled = $conn->query($query_online_canceled);
        $row_online_canceled = $result_online_canceled->num_rows;
        $output['online_cancelled'] = $row_online_canceled;

        // Query to get the count of cdm payment 
        $query_cdm_payment = "SELECT * FROM transaction WHERE payment_status = 'succeeded' AND stripe_id IS NULL";
        $result_cdm_payment = $conn->query($query_cdm_payment);
        $row_cdm_payment = $result_cdm_payment->num_rows;
        $output['cdm_succeded'] = $row_cdm_payment;    

        // Query to get the count of cdm canceled payment 
        $query_cdm_canceled = "SELECT * FROM transaction WHERE payment_status = 'Canceled' AND stripe_id IS NULL";
        $result_cdm_canceled = $conn->query($query_cdm_canceled);
        $row_cdm_canceled = $result_cdm_canceled->num_rows;
        $output['cdm_cancelled'] = $row_cdm_canceled;

        // Return the counts as JSON
        echo json_encode($output);
    }

    // fetch summary chart and oder chrart data
    if (isset($_POST['chart_data']) && $_POST['chart_data'] == 'fetch_chart_counts') {
        $response = array();

        // Query to get the count of control price 
        $query_control_price = "SELECT COUNT(*) AS count FROM controlprice";
        $result_control_price = $conn->query($query_control_price);
        $row_control_price = $result_control_price->fetch_assoc();
        $response['price'] = $row_control_price['count'];
    
        // Query to get the count of vegetable
        $query_vegetable = "SELECT COUNT(*) AS count FROM vegetablefruit WHERE vegetable_category = 'vegetable' AND vegfruit_total > 0";
        $result_vegetable = $conn->query($query_vegetable);
        $row_vegetable = $result_vegetable->fetch_assoc();
        $response['vegetable'] = $row_vegetable['count'];
    
        // Query to get the count of fruit
        $query_fruit = "SELECT COUNT(*) AS count FROM vegetablefruit WHERE vegetable_category = 'fruit' AND vegfruit_total > 0";
        $result_fruit = $conn->query($query_fruit);
        $row_fruit = $result_fruit->fetch_assoc();
        $response['fruit'] = $row_fruit['count'];
    
        // Query to get the count of agrochemical
        $query_agrochemical = "SELECT COUNT(*) AS count FROM agrochemical WHERE agro_category = 'chemical' AND total_quantity > 0";
        $result_agrochemical = $conn->query($query_agrochemical);
        $row_agrochemical = $result_agrochemical->fetch_assoc();
        $response['agrochemical'] = $row_agrochemical['count'];

        // Query to get the count of fertilizer
        $query_fertilizer = "SELECT COUNT(*) AS count FROM agrochemical WHERE agro_category = 'fertilizer' AND total_quantity > 0";
        $result_fertilizer = $conn->query($query_fertilizer);
        $row_fertilizer = $result_fertilizer->fetch_assoc();
        $response['fertilizer'] = $row_fertilizer['count'];

        // Query to get the count of nutrient
        $query_nutrient = "SELECT COUNT(*) AS count FROM nutrition";
        $result_nutrient = $conn->query($query_nutrient);
        $row_nutrient = $result_nutrient->fetch_assoc();
        $response['nutrient'] = $row_nutrient['count'];

        // Query to get the count of variety
        $query_variety = "SELECT COUNT(*) AS count FROM verity";
        $result_variety = $conn->query($query_variety);
        $row_variety = $result_variety->fetch_assoc();
        $response['variety'] = $row_variety['count'];

        // Query to get the count of technique
        $query_technique = "SELECT COUNT(*) AS count FROM technology";
        $result_technique = $conn->query($query_technique);
        $row_technique = $result_technique->fetch_assoc();
        $response['technique'] = $row_technique['count'];

        // Query to get the count of request
        $query_request = "SELECT COUNT(*) AS count FROM request";
        $result_request = $conn->query($query_request);
        $row_request = $result_request->fetch_assoc();
        $response['request'] = $row_request['count'];

        // Query to get the count of inquiry
        $query_inquiry = "SELECT COUNT(*) AS count FROM inquiry";
        $result_inquiry = $conn->query($query_inquiry);
        $row_inquiry = $result_inquiry->fetch_assoc();
        $response['inquiry'] = $row_inquiry['count'];

        


        // Query to get the count of completed orders
        $query_completed = "SELECT COUNT(*) AS count FROM transaction WHERE payment_status = 'Completed'";
        $result_completed = $conn->query($query_completed);
        $row_completed = $result_completed->fetch_assoc();
        $response['completed'] = $row_completed['count'];
    
        // Query to get the count of processed orders
        $query_process = "SELECT COUNT(*) AS count FROM transaction WHERE payment_status = 'succeeded'";
        $result_process = $conn->query($query_process);
        $row_process = $result_process->fetch_assoc();
        $response['process'] = $row_process['count'];
    
        // Query to get the count of canceled orders
        $query_canceled = "SELECT COUNT(*) AS count FROM transaction WHERE payment_status = 'Canceled'";
        $result_canceled = $conn->query($query_canceled);
        $row_canceled = $result_canceled->fetch_assoc();
        $response['canceled'] = $row_canceled['count'];
    
        // Return the counts as JSON
        echo json_encode($response);
    }


    // fetch top selling data
    if (isset($_POST['selling_data']) && $_POST['selling_data'] === "fetch_top_selling") {

        // Query for top 5 selling fruits
        $query_fruits = "SELECT item_name, item_price, COUNT(item_name) AS usage_count FROM transaction
            WHERE payment_status = ('Completed' OR 'succeeded') AND item_category = 'fruit' GROUP BY item_name ORDER BY usage_count DESC 
            LIMIT 5";
        $result_fruits = $conn->query($query_fruits);
        if ($result_fruits) {
            while ($row_fruits = $result_fruits->fetch_assoc()) {
                $top_selling['fruits'][] = array(
                    'name' => $row_fruits['item_name'],
                    'price' => round($row_fruits['item_price'], 2)
                );
            }
        } else {
            echo json_encode(['error' => "Database query failed: " . $conn->error]);
            exit;
        }


        // Query for top 5 selling vegetables
        $query_vegetables = "SELECT item_name, item_price, COUNT(item_name) AS usage_count FROM transaction
            WHERE payment_status = ('Completed' OR 'succeeded') AND item_category = 'vegetable' GROUP BY item_name ORDER BY usage_count DESC 
            LIMIT 5";
        $result_vegetables = $conn->query($query_vegetables);
        if ($result_vegetables) {
            while ($row_vegetables = $result_vegetables->fetch_assoc()) {
                $top_selling['vegetables'][] = array(
                    'name' => $row_vegetables['item_name'],
                    'price' => round($row_vegetables['item_price'], 2)
                );
            }
        } else {
            echo json_encode(['error' => "Database query failed: " . $conn->error]);
            exit;
        }

        // Query for top 5 selling agrochemicals
        $query_agrochemicals = "SELECT item_name, item_price, COUNT(item_name) AS usage_count FROM transaction
            WHERE payment_status = ('Completed' OR 'succeeded') AND item_category = 'chemical' GROUP BY item_name ORDER BY usage_count DESC 
            LIMIT 5";
        $result_agrochemicals = $conn->query($query_agrochemicals);
        if ($result_agrochemicals) {
            while ($row_agrochemicals = $result_agrochemicals->fetch_assoc()) {
                $top_selling['agrochemicals'][] = array(
                    'name' => $row_agrochemicals['item_name'],
                    'price' => round($row_agrochemicals['item_price'], 2)
                );
            }
        } else {
            echo json_encode(['error' => "Database query failed: " . $conn->error]);
            exit;
        }


        // Query for top 5 selling fertilizers
        $query_fertilizers = "SELECT item_name, item_price, COUNT(item_name) AS usage_count FROM transaction
            WHERE payment_status = ('Completed' OR 'succeeded') AND item_category = 'fertilizer' GROUP BY item_name ORDER BY usage_count DESC 
            LIMIT 5";
        $result_fertilizers = $conn->query($query_fertilizers);
        if ($result_fertilizers) {
            while ($row_fertilizers = $result_fertilizers->fetch_assoc()) {
                $top_selling['fertilizers'][] = array(
                    'name' => $row_fertilizers['item_name'],
                    'price' => round($row_fertilizers['item_price'], 2)
                );
            }
        } else {
            echo json_encode(['error' => "Database query failed: " . $conn->error]);
            exit;
        }

        // Send the result as JSON
        echo json_encode($top_selling);
    }

    // fetch data income
    if (isset($_POST['earning_data']) && $_POST['earning_data'] === "fetch_earning_income") {  

        // Query for income data with month
        $query_earning = "SELECT MONTH(date) AS month, YEAR(date) AS year, SUM(income) AS total_income FROM income GROUP BY YEAR(date), MONTH(date)";
        $result_earning = $conn->query($query_earning);

        if ($result_earning->num_rows > 0) {
            $earning_incom = []; // Initialize array to avoid undefined variable warnings
            while ($row = $result_earning->fetch_assoc()) {
                $earning_incom['earning'][] = array(
                    'earning_income' => $row['total_income'], // Use 'total_income' instead of 'income'
                    'earning_year' => $row['year'],
                    'earning_month' => $row['month']
                );
            }
        } else {
            echo json_encode(['error' => "No records found."]);
            exit;
        }

        // Send the result as JSON
        echo json_encode($earning_incom);

    }




    // fetch data request for supplier dashboard
    if (isset($_POST['request_data']) && $_POST['request_data'] === "fetch_request") {  

        $user_request = array();
        
        // Query to get the request count of completed 
        $query_completed = "SELECT COUNT(*) AS count FROM request WHERE user_action = 1";
        $result_completed = $conn->query($query_completed);
        $row_completed = $result_completed->fetch_assoc();
        $user_request['accept'] = $row_completed['count'];
    
        // Query to get the count request of pending 
        $query_process = "SELECT COUNT(*) AS count FROM request WHERE user_action = 0";
        $result_process = $conn->query($query_process);
        $row_process = $result_process->fetch_assoc();
        $user_request['pending'] = $row_process['count'];
    


        // Query to get the count of voucher canceled 
        $query_v_canceled = "SELECT COUNT(*) AS count FROM voucher WHERE action = 2";
        $result_canceled = $conn->query($query_v_canceled);
        $row_canceled = $result_canceled->fetch_assoc();
        $user_request['voucher_reject'] = $row_canceled['count'];

        // Query to get the count of voucher approved 
        $query_v_approved = "SELECT COUNT(*) AS count FROM voucher WHERE action = 1";
        $result_approved = $conn->query($query_v_approved);
        $row_approved = $result_approved->fetch_assoc();
        $user_request['voucher_approve'] = $row_approved['count'];

        // Query to get the count of voucher pending 
        $query_v_pending = "SELECT COUNT(*) AS count FROM voucher WHERE action = 0";
        $result_pending = $conn->query($query_v_pending);
        $row_pending = $result_pending->fetch_assoc();
        $user_request['voucher_pending'] = $row_pending['count'];

        

        // Send the result as JSON
        echo json_encode($user_request);

    }
    


    // Close the database connection
    $conn->close();
    
?>