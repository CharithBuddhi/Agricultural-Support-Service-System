<?php
    include 'db_connect.php';
    // fetch top selling data
    if (isset($_POST['selling']) && $_POST['selling'] === "fetch_top_product") {

        // Query for top 3 selling fertilizers and chemicals
        $query_fertilizers = "SELECT item_id, COUNT(item_id) AS usage_count FROM transaction WHERE payment_status IN ('Completed', 'succeeded') 
        AND item_category IN ('fertilizer', 'chemical') GROUP BY item_id ORDER BY usage_count DESC LIMIT 3";
        $result_fertilizers = $conn->query($query_fertilizers);
        $top_selling['fertilizers'] = []; // Initialize array
    
        if ($result_fertilizers) {
            while ($row_data = $result_fertilizers->fetch_assoc()) {
                $id = $row_data['item_id'];
    
                // Query to fetch product details
                $query_db = "SELECT agro_image, agro_name, agro_price, agro_quantity, agro_area FROM agrochemical WHERE agro_id = '$id'";
                $result_db = $conn->query($query_db);
    
                if ($result_db && $row_fertilizers = $result_db->fetch_assoc()) {
                    $top_selling['fertilizers'][] = array(
                        'image' => $row_fertilizers['agro_image'],
                        'name' => $row_fertilizers['agro_name'],
                        'price' => round($row_fertilizers['agro_price'], 2),
                        'quantity' => $row_fertilizers['agro_quantity'],
                        'location' => $row_fertilizers['agro_area']
                    );
                }
            }
        } else {
            echo json_encode(['error' => "Database query failed: " . $conn->error]);
            exit;
        }

        // Query for top 3 selling vegetbale and fruits
        $query_vegetables = "SELECT item_id, COUNT(item_id) AS usage_count FROM transaction WHERE payment_status IN ('Completed', 'succeeded') 
        AND item_category IN ('vegetable', 'fruit') GROUP BY item_id ORDER BY usage_count DESC LIMIT 3";
        $result_vegetables = $conn->query($query_vegetables);
        $top_selling['vegetables'] = []; // Initialize array
    
        if ($result_vegetables) {
            while ($row_data = $result_vegetables->fetch_assoc()) {
                $id = $row_data['item_id'];
    
                // Query to fetch product details
                $query_db = "SELECT vegfruit_image, vegetable_name, vegfruit_price, vegfruit_total, vegfruit_area FROM vegetablefruit WHERE vegfruitle_id = '$id'";
                $result_db = $conn->query($query_db);
    
                if ($result_db && $row_vegetables = $result_db->fetch_assoc()) {
                    $top_selling['vegetables'][] = array(
                        'image' => $row_vegetables['vegfruit_image'],
                        'name' => $row_vegetables['vegetable_name'],
                        'price' => round($row_vegetables['vegfruit_price'], 2),
                        'quantity' => $row_vegetables['vegfruit_total'],
                        'location' => $row_vegetables['vegfruit_area']
                    );
                }
            }
        } else {
            echo json_encode(['error' => "Database query failed: " . $conn->error]);
            exit;
        }


        // Send the result as JSON
        echo json_encode($top_selling);
    }
    

?>