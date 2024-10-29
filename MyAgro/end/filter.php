<?php
// include('db_connect.php'); // Your database connection

// // Get filter values from AJAX request
// $category = isset($_GET['category']) && $_GET['category'] != 'All' ? $_GET['category'] : '';
// $light = isset($_GET['light']) && $_GET['light'] != 'Light' ? $_GET['light'] : '';
// $water = isset($_GET['water']) && $_GET['water'] != 'Water' ? $_GET['water'] : '';
// $nutrient = isset($_GET['nutrient']) && $_GET['nutrient'] != 'Nutrient' ? $_GET['nutrient'] : '';

// // Prepare the base query
// $query = "SELECT product_name, MIN(Verities_image) AS Verities_image, MIN(verity_name) AS verity_name FROM verity WHERE 1=1";

// // Append filters to the query if any filter is selected
// if ($category != '') {
//     $query .= " AND category = ?";
// }
// if ($light != '') {
//     $query .= " AND light = ?";
// }
// if ($water != '') {
//     $query .= " AND water = ?";
// }
// if ($nutrient != '') {
//     $query .= " AND nutrient = ?";
// }

// $query .= " GROUP BY product_name";

// // Prepare the statement
// $stmt = $conn->prepare($query);

// // Dynamically bind parameters based on selected filters
// $bind_types = '';
// $params = [];
// if ($category != '') {
//     $bind_types .= 's';
//     $params[] = $category;
// }
// if ($light != '') {
//     $bind_types .= 's';
//     $params[] = $light;
// }
// if ($water != '') {
//     $bind_types .= 's';
//     $params[] = $water;
// }
// if ($nutrient != '') {
//     $bind_types .= 's';
//     $params[] = $nutrient;
// }

// if (!empty($bind_types)) {
//     $stmt->bind_param($bind_types, ...$params);
// }

// // Execute the query
// $stmt->execute();
// $result = $stmt->get_result();

// // Display the results
// if ($result->num_rows > 0) {
//     echo "<ul>";
//     while ($row = $result->fetch_assoc()) {
//         echo "<li><img src='".htmlspecialchars($row['Verities_image'])."' alt='Image' style='width: 50px; height: 50px;'> ";
//         echo htmlspecialchars($row['product_name'])." - ".htmlspecialchars($row['verity_name']);
//         echo "</li>";
//     }
//     echo "</ul>";
// } else {
//     echo "No products found.";
// }
?>
